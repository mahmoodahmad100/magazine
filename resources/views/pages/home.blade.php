@extends('layouts.master')

@section('meta')
  @include('layouts.meta')
@endsection

@section('title',"$website->name|home")

@section('content')

@include('layouts.nav')

  <div class="container" style="margin-top:60px">
    <div class="row">

      @foreach($posts as $post)
        <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading"><h4 class="text-center"><p>{{ $post->title }}<p></h4></div>
            <a href="{{ route('showPost',[$post->id, $post->title]) }}" class="thumbnail" style="margin-bottom:0">
              <img src="{{ 'uploads/covers/'.$post->cover }}" alt="no image" class="cover"/>
            </a>
            <div class="panel-footer"><p>{{ $post->description }}</p></div>
          </div>
        </div>
      @endforeach

    </div>

    <div class="text-center">
      {{ $posts->links() }}
    </div>

  </div>

@endsection
