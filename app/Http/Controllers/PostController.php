<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Category;
use App\Like;
use App\Report;
use App\General_Settings;
use App\Http\Requests;
use Storage;

class PostController extends Controller
{
    public function postTopic(Request $request)
    {
      $this->validate($request,[
        'title' => 'required|min:5|max:38',
        'cover' => 'required|mimes:jpeg,bmp,png',
        'description' => 'required|min:20|max:51',
        'category' => 'required',
        'body' => 'required|min:10'
      ]);

      $post = new Post();
      $post->user_id = Auth::user()->id;
      $post->category_id = $request['category'];
      $post->title = $request['title'];
      $post->description = $request['description'];
      $post->body = $request['body'];

      $coverName = time().'-'.'cover'.'.'.$request->file('cover')->getClientOriginalExtension();
      $request->file('cover')->move(public_path().'/uploads/covers/',$coverName);
      $post->cover = $coverName;

      $post->save();
      notify()->flash('your post successfully posted','success',['timer' => 2000]);
      return redirect()->route('showPost',[$post->id,$post->title]);
    }

    public function postComment(Request $request)
    {
      $this->validate($request,[
        'body' => 'required|min:3'
      ]);

      $comment = new Comment();
      $comment->user_id = Auth::user()->id;
      $comment->post_id = $request->post_id;
      $comment->body = $request->body;
      $comment->save();

      notify()->flash('you have commented successfully','success',['timer' => 2000]);
      return redirect()->route('showPost',[$comment->post->id, $comment->post->title, '#'.$comment->id]);
    }

     public function getShowPost($id,$title)
     {
       $post = Post::where(['id' => $id, 'title' => $title])->first();
       $comments = Comment::where('post_id',$post->id)->get();
       $categories = Category::all();
       $countLikes = Like::all();
       $website = General_Settings::where('id',1)->first();

       return view('pages.showPost', compact(['post', 'comments' , 'categories','countLikes','website']));
     }

     public function postLike(Request $request)
     {
       $like = Like::where(['user_id' => $request['userId'], 'post_or_comment_id' => $request['p_or_c'], 'isPost' => $request['isPost']])->first();
       if($like){
         $like->delete();
         $countPostLikes = Like::where(['post_or_comment_id' => $request['p_or_c'], 'isPost' => 1])->count();
         $countCommentLikes = Like::where(['post_or_comment_id' => $request['p_or_c'], 'isPost' => 0])->count();
         return response()->json(['like' => 0, 'Plikes' => $countPostLikes, 'Clikes' => $countCommentLikes]);
       }
       else{
         $like = new Like();
         $like->user_id = $request['userId'];
         $like->post_or_comment_id = $request['p_or_c'];
         $like->isPost = $request['isPost'];
         $like->save();
         $countPostLikes = Like::where(['post_or_comment_id' => $request['p_or_c'], 'isPost' => 1])->count();
         $countCommentLikes = Like::where(['post_or_comment_id' => $request['p_or_c'], 'isPost' => 0])->count();
         return response()->json(['like' => 1, 'Plikes' => $countPostLikes, 'Clikes' => $countCommentLikes]);
       }

     }

     public function postReport(Request $request)
     {
       $report = Report::where(['user_id' => $request['userId'], 'post_or_comment_id' => $request['p_or_c'], 'isPost' => $request['isPost']])->first();
       if($report){
         $report->delete();
         return response()->json(['report' => 0]);
       }
       else{
         $this->validate($request,[
           'reason' => 'required|min:3|max:20'
         ]);
         $report = new Report();
         $report->user_id = $request['userId'];
         $report->post_or_comment_id = $request['p_or_c'];
         $report->isPost = $request['isPost'];
         $report->reason = $request['reason'];
         $report->save();
         return response()->json(['report' => 1]);
       }

     }

     public function postEditPost(Request $request)
     {
       $this->validate($request,[
         'bodyContent' => 'required|min:10',
         'titleContent' => 'required|min:5|max:38'
       ]);

       $post = Post::where('id',$request['id'])->first();
       $post->body = $request['bodyContent'];
       $post->title = $request['titleContent'];
       $post->update();
       
     }

     public function postEditComment(Request $request)
     {
       $this->validate($request,[
         'bodyContent' => 'required|min:3'
       ]);

       $comment = Comment::where('id',$request['id'])->first();
       $comment->body = $request['bodyContent'];
       $comment->update();
     }

     public function deletePost(Request $request)
     {
       $id = $request['id'];

       $comments = Comment::where('post_id',$id)->get();
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

       $likes = Like::where(['post_or_comment_id' => $id, 'isPost' => 1])->get();
       foreach($likes as $like)
       {
         $like->delete();
       }

       $reports = Report::where(['post_or_comment_id' => $id, 'isPost' => 1])->get();
       foreach($reports as $report)
       {
         $report->delete();
       }

       $post = Post::find($id);
       Storage::delete('covers/'.$post->cover);
       $post->delete();
     }

     public function deleteComment(Request $request)
     {
       $id = $request['id'];

       $comment = Comment::find($id);
       $comment->delete();

       $likes = Like::where(['post_or_comment_id' => $id, 'isPost' => 0])->get();
       foreach($likes as $like)
       {
         $like->delete();
       }

       $reports = Report::where(['post_or_comment_id' => $id, 'isPost' => 0])->get();
       foreach($reports as $report)
       {
         $report->delete();
       }

     }

     /*public function count()
     {
       $countPostLikes = Like::where(['post_or_comment_id' => $request['p_or_c'], 'isPost' => 1])->count();
       $countCommentLikes = Like::where(['post_or_comment_id' => $request['p_or_c'], 'isPost' => 0])->count();
       return response()->json(['Plikes' => $countPostLikes, 'Clikes' => $countCommentLikes]);
     }*/
}
