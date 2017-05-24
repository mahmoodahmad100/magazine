@extends('layouts.master')

@section('meta')
  @include('layouts.meta')
@endsection

@section('title','user|activities')

@section('content')
  @include('layouts.nav')

  <div class="container" style="margin-top:60px;">
    <div class="row">

      <!--the posts-->
      <div class="col-md-8 col-md-offset-4">
        <h2>the posts</h2>
        @if(Auth::user()->posts->count()>0)
          @foreach(Auth::user()->posts as $post)
            <h3><a href="{{route('showPost',[$post->id,$post->title])}}">{{$post->title}}</a></h3>
          @endforeach
        @else
          <h4>no posts yet</h4>
        @endif
      </div>

      <!--the comments-->
      <div class="col-md-8 col-md-offset-4">
        <h2>the comments</h2>
        @if(Auth::user()->comments->count()>0)
          @foreach(Auth::user()->comments as $comment)
            <h3><a href="{{route('showPost',[$comment->post->id,$comment->post->title])}}#{{$comment->id}}">{{ strip_tags($comment->body) }}</a></h3>
          @endforeach
        @else
          <h4>no comments yet</h4>
        @endif
      </div>

    </div><!--/row-->
  </div><!--/container-->

@endsection
