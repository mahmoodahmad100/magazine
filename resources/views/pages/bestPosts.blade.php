@extends('layouts.master')

@section('meta')
  @include('layouts.meta')
@endsection

@section('title',"$website->name|home")

@section('content')

@include('layouts.nav')

  <div class="container" style="margin-top:60px">
    <div class="row">
      <h2 class="text-center">{{ $website->msg->bestPost_msg }}</h2>
      @foreach($posts as $post)
        <div class="col-md-4">
          <div class="panel panel-success">
            <div class="panel-heading"><h4 class="text-center"><p>{{ $post->title }}<p></h4></div>
            <a href="{{ route('showPost',[$post->id, $post->title]) }}" class="thumbnail" style="margin-bottom:0">
              <img src="{{ 'uploads/covers/'.$post->cover }}" alt="no image" class="cover"/>
            </a>
            <div class="panel-footer"><p>{{ $post->description }}</p></div>
          </div>
        </div>
      @endforeach
    </div>

  </div>

@endsection
