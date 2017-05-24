<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use App\Like;
use App\Report;
use App\Category;
use App\Message;
use App\General_Settings;
use App\Http\Requests;
use Storage;

class PanelController extends Controller
{
  public function getAdmin()
  {
    return view('cp.login');
  }

  public function postSignIn(Request $request)
  {
    $this->validate($request,[
        'email' => 'required|email',
        'password' => 'required|min:8'
    ]);

    if(Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'admin' => 1])){
      return redirect()->route('cp-index');
    }
    return redirect()->route('home');
  }

  public function getDashboard()
  {
    $website = General_Settings::where('id',1)->first();
    $countPosts = Post::count();
    $countCategories = Category::count();
    $countUsers = User::count();
    return view('cp.dashboard',compact(['countPosts','countCategories','countUsers','website']));
  }

  public function postGeneralInfo(Request $request)
  {
    $this->validate($request,[
      'logo' => 'image',
      'name' => 'required|min:5',
      'email' => 'required|email',
      'tags' => 'required|min:5',
      'description' => 'required|min:5'
    ]);

    $website = General_Settings::where('id',1)->first();

    $website->name = $request['name'];
    $website->email = $request['email'];
    $website->tags = $request['tags'];
    $website->description = $request['description'];

    if($request->hasFile('logo'))
    {
      $oldLogo = $website->logo;
      $logo = time().'-'.'logo'.'.'.$request->file('logo')->getClientOriginalExtension();
      $request->file('logo')->move(public_path().'/uploads/',$logo);
      $website->logo = $logo;
      Storage::delete($oldLogo);
    }

    $website->update();
    notify()->flash('you have updated the website information successfully','success',['timer' => 2000]);
    return redirect()->back();
  }

  public function getCategories()
  {
    $categories = Category::orderBy('id','asc')->get();
    return view('cp.categories',compact('categories'));
  }

  public function postCategory(Request $request)
  {
    $this->validate($request,[
      'category' => 'required|min:3'
    ]);
    $category = new Category();
    $category->category = $request['category'];
    $category->save();

    notify()->flash('you added new category successfully','success',['timer' => 2000]);
    return redirect()->back();

  }

  public function postEditCategory(Request $request)
  {
    $this->validate($request,[
      'categoryedit' => 'required|min:3'
    ]);

    $category  = Category::find($request['catId']);
    $category->category = $request['categoryedit'];
    $category->update();

    return response()->json(['edited-cat' => $request['categoryedit']] , 200);
  }

  public function getDeleteCategory(Request $request)
  {
    $id = $request['id'];
    $posts = Post::where('category_id',$id)->get();
    foreach($posts as $post)
    {
      $comments = Comment::where('post_id',$post->id)->get();
      foreach($comments as $comment)
      {
          $likes = Like::where(['post_or_comment_id' => $comment->id, 'isPost' => 0])->get();
          foreach($likes as $like)
          {
            $like->delete();
          }

          $reports = Report::where(['post_or_comment_id' => $comment->id, 'isPost' => 0])->get();
          foreach($reports as $report)
          {
            $report->delete();
          }

        $comment->delete();
      }

      $likes = Like::where(['post_or_comment_id' => $post->id, 'isPost' => 1])->get();
      foreach($likes as $like)
      {
        $like->delete();
      }

      $reports = Report::where(['post_or_comment_id' => $post->id, 'isPost' => 1])->get();
      foreach($reports as $report)
      {
        $report->delete();
      }

      $post = Post::find($post->id);
      Storage::delete('covers/'.$post->cover);
      $post->delete();
    }
    $category = Category::where('id',$id)->first();
    $category->delete();
  }

  public function getUser()
  {
    $users = User::orderBy('id','desc')->paginate(15);
    return view('cp.users',compact('users'));
  }

  public function postAdmin(Request $request)
  {
    $user = User::find($request['userId']);
    $user->admin = $request['Admin'];

    if($request['Admin'] == 1)
      $user->ban = 0;

    $user->update();

    return response()->json(['Admin' => $request['Admin']]);
  }

  public function postBan(Request $request)
  {
    $user = User::find($request['userId']);
    $user->ban = $request['Ban'];

    if($request['Ban'] == 1)
      $user->admin = 0;

    $user->update();

    return response()->json(['Ban' => $request['Ban']]);
  }

  public function postBestPost(Request $request)
  {
    $post = Post::find($request['postId']);
    $post->type = $request['BestPost'];
    $post->update();

    return response()->json(['BestPost' => $request['BestPost']]);
  }

  public function postBlockPostOrComment(Request $request)
  {
    if($request['isPost'] == 1)
    {
      $post = Post::find($request['postId']);
      $post->type = $request['Block'];
      $post->update();
    }
    elseif($request['isPost'] == 0)
    {
      $comment = Comment::find($request['commentId']);
      $comment->type = $request['Block'];
      $comment->update();
    }

    return response()->json(['Block_val' => $request['Block']]);
  }

  public function getPost()
  {
    $posts = Post::orderBy('id','desc')->paginate(10);
    return view('cp.posts',compact('posts'));
  }

  public function getReport()
  {
    $posts = Report::where('isPost',1)->get();
    $comments = Report::where('isPost',0)->get();
    return view('cp.report',compact(['posts','comments']));
  }

  public function getMsg()
  {
    $msg = Message::where('id',1)->first();
    return view('cp.messages',compact('msg'));
  }

  public function postMsgs(Request $request)
  {
    $this->validate($request,[
      'welcoming_msg' => 'required|min:5',
      'bestPost_msg' => 'required|min:5',
      'banUsers_msg' => 'required|min:5',
      'banPosts_msg' => 'required|min:5',
      'banComments_msg' => 'required|min:5'
    ]);

    $msg = Message::where('id',1)->first();
    $msg->welcoming_msg = $request['welcoming_msg'];
    $msg->bestPost_msg = $request['bestPost_msg'];
    $msg->banUsers_msg = $request['banUsers_msg'];
    $msg->banPosts_msg = $request['banPosts_msg'];
    $msg->banComments_msg = $request['banComments_msg'];
    $msg->update();
    return redirect()->back();
  }

}
