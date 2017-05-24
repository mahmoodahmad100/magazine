<!DOCTYPE html>
<html>
    <head>
        @yield('meta')
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ URL::to('css/sweetalert.css') }}">
        <link rel="stylesheet" href="{{ URL::to('css/style.css') }}" />
        @yield('css')
    </head>
    <body>

      @yield('content')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.6.2/parsley.min.js"></script>
        <script src="{{ URL::to('js/sweetalert.min.js') }}"></script>
        @yield('js')
        <script src="{{ URL::to('js/app.js') }}"></script>

        <script type="text/javascript">
        @if(notify()->ready())

          swal({
            title: "{!! notify()->message() !!}",
            type: "{{ notify()->type() }}",
            @if( notify()->option('timer') )

            timer: "{{ notify()->option('timer') }}",
            showConfirmButton:false,

            @endif
            html:true
          });

          @endif
        </script>
    </body>
</html>
