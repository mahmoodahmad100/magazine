@extends('layouts.master')

@section('meta')
  @include('layouts.meta')
@endsection

@section('title','user|create post')

@section('content')
  @include('layouts.nav')

  <div class="container" style="margin-top:60px;">

    @if(Auth::user()->ban != 1)
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        @include('layouts.errors')
        {!! Form::open(['route' => 'sendtopic', 'method' => 'post','files' => true,'data-parsley-validate']) !!}

          {!! Form::label('title','your title:') !!}
          {!! Form::text('title',null,['class' => 'form-control', 'required', 'minlength' => '5', 'maxlength' => '38']) !!} <br/>

          {!! Form::label('cover','your cover photo:') !!}
          {!! Form::file('cover',['required']) !!}


          {!! Form::label('category','The category:') !!}
          <select name="category" class="form-control" required>
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->category }}</option>
            @endforeach
          </select><br/>

          {!! Form::label('description','your description:') !!}
          {!! Form::textarea('description',null,['class' => 'form-control', 'rows' => '3', 'required', 'minlength' => '20', 'maxlength' => '51']) !!}<br/>

          {!! Form::label('body','your topic:') !!}
          {!! Form::textarea('body',null,['class' => 'form-control', 'id' => 'topicBody']) !!}<br/>

          {!! Form::button('send',['class' => 'btn btn-success btn-block','type' => 'submit']) !!}

        {!! Form::close() !!}
      </div>
    </div>
    @else
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-danger text-center">
            <h5>you can't post</h5>
            <h4><b>{{$website->msg->banUsers_msg}}</b></h4>
          </div>
        </div>
      </div>

    @endif
  </div><!--/container-->

@endsection

@include('layouts.editor')
