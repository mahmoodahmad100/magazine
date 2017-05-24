@extends('layouts.master')

@section('title','your title Here')

@section('css')
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
@endsection
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->

@section('content')
  <!-- container section start -->
  <section id="container" class="">
      <!--header start-->

      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

            <!--logo start-->
            <a href="{{ route('cp-index') }}" class="logo">control <span class="lite">panel</span></a>
            <!--logo end-->

            <div class="top-nav notification-row">
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">

                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="img/avatar1_small.jpg">
                            </span>
                            <span class="username">Jenifer Smith</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li class="eborder-top">
                                <a href="#"><i class="icon_profile"></i> My Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="icon_mail_alt"></i> My Inbox</a>
                            </li>
                            <li>
                                <a href="#"><i class="icon_clock_alt"></i> Timeline</a>
                            </li>
                            <li>
                                <a href="#"><i class="icon_chat_alt"></i> Chats</a>
                            </li>
                            <li>
                                <a href="login.html"><i class="icon_key_alt"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>
      <!--header end-->

      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li class="">
                      <a href="{{ route('home') }}" target="_blank">
                          <i class="glyphicon glyphicon-home"></i>
                          <span>see The Home page</span>
                      </a>
                  </li>
                  <li class="">
                      <a class="{{ Request::is('cp-index') ? 'active-m' : '' }}" href="{{ route('cp-index') }}">
                          <i class="icon_house_alt"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <li class="">
                      <a class="{{ Request::is('cp-categories') ? 'active-m' : '' }}" href="{{ route('cp-categories') }}">
                          <i class="icon_document_alt"></i>
                          <span>Categories</span>
                      </a>
                  </li>
                  <li class="">
                      <a class="{{ Request::is('cp-users') ? 'active-m' : '' }}" href="{{ route('cp-users') }}">
                          <i class="glyphicon glyphicon-user"></i>
                          <span>Users</span>
                      </a>
                  </li>
                  <li class="">
                      <a class="{{ Request::is('cp-posts') ? 'active-m' : '' }}" href="{{ route('cp-posts') }}">
                          <i class="icon_documents_alt"></i>
                          <span>Posts</span>
                      </a>
                  </li>
                  <li class="">
                      <a class="{{ Request::is('cp-block') ? 'active-m' : '' }}" href="{{ route('cp-block') }}">
                          <i class="icon_table"></i>
                          <span>Reports</span>
                      </a>
                  </li>
                  <li class="">
                      <a class="{{ Request::is('cp-messages') ? 'active-m' : '' }}" href="{{ route('cp-messages') }}">
                          <i class="icon_piechart"></i>
                          <span>Messages</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              @yield('page-content')
          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section end -->
@endsection

@section('js')
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script><!--custome script for all page-->
    <script src="js/scripts.js"></script>
@endsection
