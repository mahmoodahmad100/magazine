@extends('cp.master')

@section('title','posts')

@section('page-content')

  <div class="row" style="margin-top:20px;">
    <div class="col-md-12">
      <table class="table">

        <thead>
          <th>#</th>
          <th>Title</th>
          <th>Created at</th>
          <th>By</th>
          <th>Action</th>
        </thead>

        <tbody>
          @foreach($posts as $post)
            <tr>
              <th>{{ $post->id }}</th>
              <td><a target="_blank" href="{{route('showPost',[$post->id,$post->title])}}">{{ $post->title }}</a></td>
              <td>{{ $post->created_at }}</td>
              <td>{{ $post->user->username }}</td>
              <td>
                <a data-isbest="{{ $post->type }}" href="#" class="btn btn-success best-btn">{{ $post->type == 1 ? 'Best post (yes)' : 'Best post' }}</a>
                <a data-isblocked="{{ $post->type }}" href="#" class="btn btn-warning block-post-btn">{{ $post->type == 2 ? 'Blocked (yes)' : 'Block' }}</a>
              </td>
            </tr>
          @endforeach
        </tbody>

      </table>
    </div>
    <div class="text-center">
      {{ $posts->links() }}
    </div>
  </div>
  <script type="text/javascript">
    var makeBestPostUrl = '{{ route('makeBestPost') }}';
    var makeBlockPOrCUrl = '{{ route('makeBlockPostOrComment') }}';
    var token = '{{ Session::token() }}';
  </script>
@endsection
