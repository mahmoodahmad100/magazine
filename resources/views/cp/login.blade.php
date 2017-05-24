@extends('layouts.master')

@section('title','login to cp')

<!-- CSS -->
@section('css')
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/form-elements.css">
  <link rel="stylesheet" href="assets/css/style.css">
@endsection

@section('content')
        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>control panel</strong> Login Form</h1>
                            <div class="description">
                            	<p>
                                login to your magazine control panel to control the magazine
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to the magazine panel</h3>
                            		<p>Enter your email and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
    			                    <form action="{{ route('signincp') }}" method="post" class="login-form">
    			                    	<div class="form-group">
    			                    		<label class="sr-only" for="form-email">Email</label>
    			                        <input type="text" name="email" placeholder="Email..." class="form-email form-control" id="form-email">
    			                      </div>
    			                      <div class="form-group">
    			                        <label class="sr-only" for="form-password">Password</label>
    			                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
    			                      </div>
    			                        <button type="submit" class="btn">Sign in!</button>
                                  <input type="hidden" name="_token" value="{{ Session::token() }}" />

    			                    </form>
		                        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


<!-- Javascript -->
@section('js')
  <script src="assets/js/jquery.backstretch.min.js"></script>
  <script src="assets/js/scripts.js"></script>
@endsection
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
@endsection
