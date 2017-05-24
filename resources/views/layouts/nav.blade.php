<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('home') }}"><img class="img-circle website-logo" src="uploads/{{ $website->logo }}" alt="no image"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}"><i class="ion-ios-home"></i> home</a></li>
        @if(Auth::user() && Auth::user()->admin == 1)
          <li><a href="{{ route('cp-index') }}" target="_blank"><i class="ion-settings"></i> control panel</a></li>
        @endif
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="ion-android-folder"></i> categories <span class="caret"></span></a>
          <ul class="dropdown-menu">

            @foreach($categories as $category)
              <li><a href="{{ route('category-dept',[$category->category,$category->id]) }}">{{ $category->category }}</a></li>
            @endforeach

            <li role="separator" class="divider"></li>
            <li><a href="{{route('bestPosts')}}"><i class="fa fa-bolt"></i> see The best posts</a></li>
            <li role="separator" class="divider"></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if(!Auth::user())
          <li><a href="#" id="sign-up-btn"><i class="fa fa-user-plus"></i> sign up</a></li>
          <li><a href="#" id="sign-in-btn"><i class="fa fa-sign-in"></i> sign in</a></li>
        @else
          <li class="{{ Request::is('create') ? 'active' : '' }}"><a href="{{route('create')}}"><i class="fa fa-plus-circle"></i> create post</a></li>
          <li class="{{ Request::is('user') ? 'active' : '' }}"><a href="{{route('user')}}"><i class="fa fa-id-card-o"></i> {{ Auth::user()->username }}</a></li>
          <li class="{{ Request::is('activities') ? 'active' : '' }}"><a href="{{route('activities')}}"><i class="fa fa-superpowers"></i> activities</a></li>
          <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> sign out</a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<!-- sign-in-modal -->
{!! Form::open(['route' => 'signin', 'method' => 'post','data-parsley-validate']) !!}
<div class="modal fade" tabindex="-1" role="dialog" id="sign-in-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Sign in</h4>
      </div>
      <div class="modal-body">

          {!! Form::label('email','your email address:') !!}
          {!! Form::email('email',null,['class' => 'form-control', 'required']) !!} <br/>

          {!! Form::label('password','your password:') !!}
          {!! Form::password('password',['class' => 'form-control', 'required']) !!}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">sign in</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{!! Form::close() !!}

<!-- sign-up-modal -->
{!! Form::open(['route' => 'signup', 'method' => 'post','data-parsley-validate']) !!}
  <div class="modal fade" tabindex="-1" role="dialog" id="sign-up-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Sign up</h4>
        </div>
        <div class="modal-body">

            {!! Form::label('username','your username:') !!}
            {!! Form::text('username',null,['class' => 'form-control', 'required', 'minlength' => '5']) !!} <br/>

            {!! Form::label('email','your email address:') !!}
            {!! Form::email('email',null,['class' => 'form-control', 'required']) !!} <br/>

            {!! Form::label('password','your password:') !!}
            {!! Form::password('password',['class' => 'form-control', 'type' => 'password', 'required', 'minlength' => '8']) !!}

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary modal-sign-up-btn">sign up</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
{!! Form::close() !!}
