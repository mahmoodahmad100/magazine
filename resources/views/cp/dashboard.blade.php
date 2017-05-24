@extends('cp.master')

@section('title','dashboard')

@section('page-content')

  <div class="row">

    <div class="col-md-2 col-md-offset-2">
      <i class="glyphicon glyphicon-list-alt"></i>
      <div class="count">{{ $countCategories }}</div>
      <div class="title">categories</div>
    </div><!--/.col-->

    <div class="col-md-2 col-md-offset-2">
      <i class="fa fa-shopping-cart"></i>
      <div class="count">{{ $countPosts }}</div>
      <div class="title">posts</div>
    </div><!--/.col-->

    <div class="col-md-2 col-md-offset-2">
      <i class="glyphicon glyphicon-user"></i>
      <div class="count">{{ $countUsers }}</div>
      <div class="title">users</div>
    </div><!--/.col-->

  </div><!--/.row-->
    <hr>
  <!--Main settings-->
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      @include('layouts.errors')
      {!! Form::open(['route' => 'postGeneralInfo', 'files' => true,'style' =>'margin-top:30px;']) !!}

      {!! Form::label('logo','your website logo:') !!}
      {!! Form::file('logo') !!}
      <h6><i>Current logo:</i></h6>
      <img class="img-circle website-logo" src="uploads/{{ $website->logo }}" alt="no image">
      <br/>
      <br>

      {{ Form::label('name','your website name:') }}
      {{ Form::text('name',$website->name,['class' => 'form-control']) }}<br>

      {{ Form::label('email','your website email:') }}
      {{ Form::text('email',$website->email,['class' => 'form-control']) }}<br>

      {{ Form::label('tags','your website tags:') }}
      {{ Form::textarea('tags',$website->tags,['class' => 'form-control']) }}<br>

      {{ Form::label('description','your website description:') }}
      {{ Form::textarea('description',$website->description,['class' => 'form-control']) }}<br>

      {{ Form::submit('Save',['class' =>'btn btn-success btn-block']) }}

      {!! Form::close() !!}
    </div>
  </div>
  <!--/Main settings-->

@endsection
