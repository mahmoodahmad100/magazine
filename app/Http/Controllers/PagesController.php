<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use App\Category;
use App\General_Settings;
use App\Http\Requests;

class PagesController extends Controller
{
  public function getHome()
  {
    $categories = Category::all();
    $posts = Post::orderBy('created_at','desc')->paginate(15);
    $website = General_Settings::where('id',1)->first();
    return view('pages.home',compact(['categories','posts','website']));
  }

  /*user pages*/
  public function getCreate()
  {
    $categories = Category::all();
    $website = General_Settings::where('id',1)->first();
    return view('user.create',compact(['categories','website']));
  }

  public function getActivities()
  {
    $categories = Category::all();
    $website = General_Settings::where('id',1)->first();
    return view('user.activities',compact(['categories','website']));
  }
  /*end user pages*/

  public function getCategory($name,$id)
  {
    $category = Category::where(['category' => $name, 'id' =>$id])->first();
    $categories = Category::all();
    $posts = Post::where('category_id',$category->id)->orderBy('created_at','desc')->paginate(15);
    $website = General_Settings::where('id',1)->first();
    return view('pages.category',compact(['category','categories','posts','website']));
  }

  public function getBestPosts()
  {
    $categories = Category::all();
    $posts = Post::where('type',1)->orderBy('created_at','desc')->get();
    $website = General_Settings::where('id',1)->first();
    return view('pages.bestPosts',compact(['categories','posts','website']));
  }
}
