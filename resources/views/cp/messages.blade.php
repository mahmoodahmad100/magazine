@extends('cp.master')

@section('title','Messages')

@section('page-content')

  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      @include('layouts.errors')
    {!! Form::open(['route' => 'makeMsgs' ,'method' => 'post']) !!}

      <label for="welcoming_msg"><h4 style="color:#129107"><b>Welcoming Message(s):</b></h4></label>

      <table class="table">
        <tr>
          <td>{!! Form::textarea('welcoming_msg' ,$msg->welcoming_msg,['class' => 'form-control has-success' , 'id' => 'welcoming_msg']) !!}</td>
        </tr>
      </table>

      <label for="bestPost_msg"><h4 style="color:#129107"><b>Best Post Message(s)</b></h4></label>

      <table class="table">
        <tr>
          <td>{!! Form::textarea('bestPost_msg' ,$msg->bestPost_msg,['class' => 'form-control has-success' , 'id' => 'bestPost_msg']) !!}</td>
        </tr>
      </table>

      <label for="banUsers_msg"><h4 style="color:#bb3124"><b>The reason(s) for The ban (users):</b></h4></label>

      <table class="table">
        <tr>
          <td>{!! Form::textarea('banUsers_msg' ,$msg->banUsers_msg,['class' => 'form-control has-danger' , 'id' => 'banUsers_msg']) !!}</td>
        </tr>
      </table>

      <label for="banPosts_msg"><h4 style="color:#bb3124"><b>The reason(s) for The ban (posts):</b></h4></label>

      <table class="table">
        <tr>
          <td>{!! Form::textarea('banPosts_msg' ,$msg->banPosts_msg,['class' => 'form-control has-danger' , 'id' => 'banPosts_msg']) !!}</td>
        </tr>
      </table>

      <label for="banComments_msg"><h4 style="color:#bb3124"><b>The reason(s) for The ban (comments):</b></h4></label>

      <table class="table">
        <tr>
          <td>{!! Form::textarea('banComments_msg' ,$msg->banComments_msg,['class' => 'form-control has-danger' , 'id' => 'banComments_msg']) !!}</td>
        </tr>
      </table><br>

    {!! Form::submit('Save', ['class' => 'btn btn-default btn-block']) !!}
    {!! Form::close() !!}
    </div>
  </div>

@endsection
