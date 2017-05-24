@extends('layouts.master')

@if($post->type == 0 || $post->type == 1)<!--checkout if the post is not blocked and show the post-->
@section('title',"$post->title")

@section('content')

  @include('layouts.nav')
  <div class="container" style="margin-top:60px;">

    <!--post section-->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">

          <div class="panel-heading">
            <span class="text-left">#{{ $i = 1 }}</span>
            <span class="pull-right"><span class="glyphicon glyphicon-time"></span> {{$post->created_at->diffforhumans()}}</span>
          </div>

          <div class="panel-body">
            <div class="row">

              <div class="col-md-9">
                <h2 class="post-title">{{ $post->title }}</h2>
                <hr/>
                <div class="post-body">{!! $post->body !!}</div>
              </div>

              <div class="col-md-3">
                <div class="panel {{ $post->user->ban == 1 ? 'panel-danger' : 'panel-default' }}">
                  <div class="panel-heading">
                    <p class="text-center"><b>{{ $post->user->username }}</b></p>
                  </div>

                  <div class="panel-body">
                    <span>
                      <img class="img-rounded avatar-post" src="uploads/avatars/{{$post->user->avatar}}" alt="no image">
                    </span>
                    <p><b>joined date:</b><i class="pull-right">{{ $post->user->created_at->diffforhumans() }}</i></p>
                    <p><b>posts:</b><i class="pull-right">{{ $post->where('user_id','=',$post->user_id)->count() }}</i></p>
                    <p><b>comments:</b><i class="pull-right">{{ $post->comments->count() }}</i></p>
                    <p><b>likes:</b><i class="pull-right">{{ $countLikes->where('user_id',$post->user_id)->count() }}</i></p>
                  </div>

                </div>
              </div>

            </div>
          </div>
          @if(Auth::user())
            <div class="panel-footer">
              <!--post Like-->
              <a href="#" data-postid="{{ $post->id }}" data-userid="{{ Auth::user()->id }}" class="like-post">
                @if(Auth::user()->likes()->where(['user_id' => Auth::user()->id, 'post_or_comment_id' => $post->id,'isPost' => 1])->first())
                  <span class="glyphicon glyphicon-star"></span>like
                @else
                  <span class="glyphicon glyphicon-star-empty"></span>like
                @endif
              </a>

              <!--post Report-->
              @if(Auth::user()->id != $post->user->id)
              |
              <a href="#" data-reported="{{ Auth::user()->reports()->where(['user_id' => Auth::user()->id, 'post_or_comment_id' => $post->id,'isPost' => 1])->first() ? 1 : 0 }}" data-postid="{{ $post->id }}" data-userid="{{ Auth::user()->id }}" class="report-post">
                @if(Auth::user()->reports()->where(['user_id' => Auth::user()->id, 'post_or_comment_id' => $post->id,'isPost' => 1])->first())
                  UnReport
                @else
                  Report
                @endif
              </a>
              @endif

              <b href="" class="p-likes" style="margin:0 10%">{{ $post->likes->where('isPost','1')->count() }} {{ $post->likes->where('isPost','1')->count() == 1 ? "like" : "likes" }}</b>
              @if(Auth::user()->id == $post->user_id)
              <a href="#" data-postid="{{ $post->id }}" class="pull-right delete-post"><span class=" glyphicon glyphicon-remove"></span></a>
              <a href="#" data-postid="{{ $post->id }}" class="pull-right edit-post" style="margin-right:2%"><span class=" glyphicon glyphicon-pencil"></span></a>
              @endif

            </div>
          @endif

        </div>
      </div>
    </div><!--end row (Post)-->
    <!--/post section-->

    <!--comment section-->
    @foreach($comments as $comment)
      <div class="row" id="{{$comment->id}}">
        <div class="col-md-12">
          <div class="panel panel-default">

            <div class="panel-heading">
              <span class="text-left">#{{ $i += 1 }}</span>
              <span class="pull-right"><span class="glyphicon glyphicon-time"></span> {{$comment->created_at->diffforhumans()}}</span>
            </div>

            <div class="panel-body">
              <div class="row">

                <!--check if the comment blocked or not and show msg if it's blocked-->
                @if($comment->type == 0)
                <div class="col-md-9">
                  <div class="comment-body">{!! $comment->body !!}</div>
                </div>
                @else
                  <div class="col-md-9 alert alert-danger">
                    <p class="comment-body text-center"><b>{{$website->msg->banComments_msg}}</b></p>
                  </div>
                @endif
                <!--/check if the comment blocked or not and show msg if it's blocked-->

                <div class="col-md-3">
                  <div class="panel {{ $comment->user->ban == 1 ? 'panel-danger' : 'panel-default' }}">
                    <div class="panel-heading">
                      <p class="text-center"><b>{{ $comment->user->username }}</b></p>
                    </div>

                    <div class="panel-body">
                      <span>
                        <img class="img-rounded avatar-post" src="uploads/avatars/{{$comment->user->avatar}}" alt="no image">
                      </span>
                      <p><b>joined date:</b><i class="pull-right">{{ $comment->user->created_at->diffforhumans() }}</i></p>
                      <p><b>posts:</b><i class="pull-right">{{ $post->where('user_id','=',$comment->user_id)->count() }}</i></p>
                      <p><b>comments:</b><i class="pull-right">{{ $comment->where('user_id',$comment->user_id)->count() }}</i></p>
                      <p><b>likes:</b><i class="pull-right">{{ $countLikes->where('user_id',$comment->user_id)->count() }}</i></p>
                    </div>

                  </div>
                </div>

              </div>
            </div>
            @if(Auth::user())
              <div class="panel-footer">

                <!--Comment Like-->
                <a href="#" data-commentid="{{ $comment->id }}" data-userid="{{ Auth::user()->id }}" class="like-comment">
                  @if(Auth::user()->likes()->where(['user_id' => Auth::user()->id, 'post_or_comment_id' => $comment->id,'isPost' => 0])->first())
                    <span class="glyphicon glyphicon-star"></span>like
                  @else
                    <span class="glyphicon glyphicon-star-empty"></span>like
                  @endif
                </a>

                <!--comment Report-->
                @if(Auth::user()->id != $comment->user->id)
                |
                <a href="#" data-reported="{{ Auth::user()->reports()->where(['user_id' => Auth::user()->id, 'post_or_comment_id' => $comment->id,'isPost' => 0])->first() ? 1 : 0 }}" data-commentid="{{ $comment->id }}" data-userid="{{ Auth::user()->id }}" class="report-comment">
                  @if(Auth::user()->reports()->where(['user_id' => Auth::user()->id, 'post_or_comment_id' => $comment->id,'isPost' => 0])->first())
                    UnReport
                  @else
                    Report
                  @endif
                </a>
                @endif

                <b class="c-likes" style="margin:0 10%">{{ $comment->likes->where('isPost','0')->count() }} {{ $comment->likes->where('isPost','0')->count() == 1 ? "like" : "likes" }}</b>

                @if(Auth::user()->id == $comment->user_id)
                <a href="#" data-commentid="{{ $comment->id }}" class="pull-right delete-comment"><span class=" glyphicon glyphicon-remove"></span></a>
                <a href="#" data-commentid="{{ $comment->id }}" class="pull-right edit-comment" style="margin-right:2%"><span class=" glyphicon glyphicon-pencil"></span></a>
                @endif
              </div>
            @endif

          </div>
        </div>
      </div><!--end row (comments)-->
    @endforeach
    <!--/comment section-->

  <!--adding a comment-->
  @if(Auth::user() && Auth::user()->ban != 1)
    <div class="row">
      <div class="col-md-12">
      {!! Form::open(['route' => 'sendcomment' ,'method' => 'post']) !!}

        {!! Form::label('body','your comment:') !!}
        {!! Form::textarea('body',null,['class' => 'form-control', 'placeholder' => 'your comment goes here']) !!}
        {!! Form::submit('comment',['class' => 'btn btn-primary', 'style' => 'margin:3px 0']) !!}
        <input type="hidden" name="post_id" value="{{ $post->id }}" />

      {!! Form::close() !!}
      </div>
    </div>
  @elseif(Auth::user() && Auth::user()->ban == 1)
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger text-center">
          <h5>you can't comment</h5>
          <h4><b>{{$website->msg->banUsers_msg}}</b></h4>
        </div>
      </div>
    </div>
  @endif
  <!--/adding a comment-->

  </div><!--end container-->

  @include('layouts.modals')

  <script type="text/javascript">
      var likeUrl = '{{ route('postLike') }}';
      var reportUrl = '{{ route('postReport') }}';
      var editPostUrl = '{{ route('editPost') }}';
      var editCommentUrl = '{{ route('editComment') }}';
      var deletePostUrl = '{{ route('deletePost') }}';
      var deleteCommentUrl = '{{ route('deleteComment') }}';
      var token = '{{ Session::token() }}';
      var homeUrl = '{{ route('home') }}';
  </script>

@endsection

<!--show msg why the post is blocked-->
@else
@section('title',"Blocked Post")

@section('content')
  @include('layouts.nav')
  <div class="container" style="margin-top:60px;">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger text-center">
          <h4><b>{{$website->msg->banPosts_msg}}</b></h4>
        </div>
      </div>
    </div>
  </div>
@endsection
<!--/show msg why the post is blocked-->
@endif

@include('layouts.editor')
