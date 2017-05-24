@extends('layouts.master')

@section('title','your title Here')

@section('css')
    <link href="css/cp-style.css" rel="stylesheet">
@endsection

@section('content')
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-4 col-md-offset-4">
	              <!-- Logo -->
	              <div class="logo text-center">
	                 <h1><a href="{{ route('cp-index') }}">control panel</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li>
                      <a href="{{ route('home') }}" target="_blank">
                        <i class="fa fa-home"></i>Home page
                      </a>
                    </li>
                    <li class="{{ Request::is('cp-index') ? 'current' : '' }}">
                      <a href="{{ route('cp-index') }}">
                        <i class="fa fa-tachometer"></i> Dashboard
                      </a>
                    </li>
                    <li class="{{ Request::is('cp-categories') ? 'current' : '' }}">
                      <a href="{{ route('cp-categories') }}">
                        <i class="ion-social-buffer"></i> Categories
                      </a>
                    </li>
                    <li class="{{ Request::is('cp-users') ? 'current' : '' }}">
                      <a href="{{ route('cp-users') }}">
                        <i class="ion-ios-people"></i> Users
                      </a>
                    </li>
                    <li class="{{ Request::is('cp-posts') ? 'current' : '' }}">
                      <a href="{{ route('cp-posts') }}">
                        <i class="glyphicon glyphicon-record"></i> Posts
                      </a>
                    </li>
                    <li class="{{ Request::is('cp-reports') ? 'current' : '' }}">
                      <a href="{{ route('cp-reports') }}">
                        <i class="glyphicon glyphicon-pencil"></i> Reports
                      </a>
                    </li>
                    <li class="{{ Request::is('cp-messages') ? 'current' : '' }}">
                      <a href="{{ route('cp-messages') }}">
                        <i class="ion-email"></i> Messages
                      </a>
                    </li>
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
  			<div class="content-box-large">
  				<div class="panel-body">
            @yield('page-content')
  				</div>
  			</div>
		  </div>
		</div>
    </div>

    <footer>
         <div class="container">

            <div class="copy text-center">
               Copyright 2017 Mahmood Ahmad
            </div>

         </div>
      </footer>
@endsection
