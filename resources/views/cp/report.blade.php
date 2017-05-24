@extends('cp.master')

@section('title','Reports')

@section('page-content')

  <div class="row" style="margin-top:20px;">

    <!--the posts-->
    <div class="col-md-12">
      <h3 class="text-center">The posts</h3>
      <table class="table">

        <thead>
          <th>#</th>
          <th>Title</th>
          <th>the reason</th>
          <th>Created at</th>
          <th>Reported By</th>
          <th>Action</th>
        </thead>

        <tbody>
          @foreach($posts as $post)
            <tr>
              <th>{{ $post->post->id }}</th>
              <td><a target="_blank" href="{{route('showPost',[$post->post->id,$post->post->title])}}">{{ $post->post->title }}</a></td>
              <td>{{ $post->reason }}</td>
              <td>{{ $post->created_at }}</td>
              <td>{{ $post->user->username }}</td>
              <td><a data-isblocked="{{ $post->post->type }}" href="#" class="btn btn-warning block-post-btn">{{ $post->post->type == 2 ? 'Blocked (yes)' : 'Block' }}</a></td>
            </tr>
          @endforeach
        </tbody>

      </table>
    </div><!--/col1-->

    <!--the comments-->
    <div class="col-md-12">
      <h3 class="text-center">The comments</h3>
      <table class="table">

        <thead>
          <th>#</th>
          <th>the comment</th>
          <th>the reason</th>
          <th>Created at</th>
          <th>Reported By</th>
          <th>Action</th>
        </thead>

        <tbody>
          @foreach($comments as $comment)
            <tr>
              <th>{{ $comment->comment->id }}</th>
              <td><a target="_blank" href="{{route('showPost',[$comment->comment->post->id,$comment->comment->post->title])}}#{{$comment->comment->id}}">{{ $comment->comment->body }}</a></td>
              <td>{{ $comment->reason }}</td>
              <td>{{ $comment->created_at }}</td>
              <td>{{ $comment->user->username }}</td>
              <td><a data-isblocked="{{ $comment->comment->type }}" href="#" class="btn btn-warning block-comment-btn">{{ $comment->comment->type == 2 ? 'Blocked (yes)' : 'Block' }}</a></td>
            </tr>
          @endforeach
        </tbody>

      </table>
    </div><!--/col2-->

  </div><!--/row-->
  <script type="text/javascript">
    var makeBlockPOrCUrl = '{{ route('makeBlockPostOrComment') }}';
    var token = '{{ Session::token() }}';
  </script>
@endsection
