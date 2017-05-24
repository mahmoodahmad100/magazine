@extends('layouts.master')

@section('meta')
  @include('layouts.meta')
@endsection

@section('title','user|profile')

@section('content')
  @include('layouts.nav')

  <div class="container" style="margin-top:60px;">
    <div class="row">
      @include('layouts.errors')
      <div class="col-md-4 col-md-offset-4">
        <h2>General information</h2>
        {!! Form::open(['route' => 'changeGeneralInfo' ,'files' => true]) !!}

        {{ Form::label('avatar','your avatar:') }}
        {{ Form::file('avatar') }}
        <h6><i>Current avatar:</i></h6>
        <img class="img-rounded avatar" src="uploads/avatars/{{Auth::user()->avatar}}" alt="no image">
        <br/>

        {{ Form::label('username','your username:') }}
        {{ Form::text('username',Auth::user()->username,['class' => 'form-control']) }} <br/>

        {{ Form::label('email','your email address:') }}
        {{ Form::text('email',Auth::user()->email,['class' => 'form-control']) }} <br/>

        {{ Form::submit('Save',['class' => 'btn btn-info btn-block']) }}

        {!! Form::close() !!}
      </div>

      <div class="col-md-4 col-md-offset-4">
        <hr/>
        <h2>Change your password</h2>
        {!! Form::open(['route' => 'changePassword']) !!}

        {{ Form::label('old_password','your password:') }}
        {{ Form::password('old_password',['class' => 'form-control']) }}<br/>

        {{ Form::label('password','your new password:') }}
        {{ Form::password('password',['class' => 'form-control']) }}<br/>

        {{ Form::label('password_confirmation','confirm your new password:') }}
        {{ Form::password('password_confirmation',['class' => 'form-control']) }}<br/>

        {{ Form::submit('Save',['class' => 'btn btn-info btn-block']) }}

        {!! Form::close() !!}
      </div>
    </div>
  </div>

@endsection
