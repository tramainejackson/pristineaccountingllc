<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pristine Accounting LLC</title>

    <!-- Styles -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="hidden-sn deep-purple-skin">

    <!-- Loading spinner to be added when form being submitted -->
    @include('modals.loading_spinner')

    <div id="app" class="mt-5 pt-5">

        @if(session('status'))
            @section('additional_scripts')
                <script type="text/javascript">
                    toastr.success("{{ session('status') }}", "", {showMethod: 'slideDown'});
                </script>
            @endsection
        @elseif(session('bad_status'))
            @section('additional_scripts')
                <script type="text/javascript">
                    toastr.error("{{ session('bad_status') }}", "", {showMethod: 'slideDown'});
                </script>
            @endsection
        @endif

        <!--***********************************************
        *******************  Navigation  ******************
        ************************************************-->
        @include('content_parts.navigation')

        <!--***********************************************
        ******************* Main Content ******************
        ************************************************-->
        @yield('content')

        <!--***********************************************
        *******************    Footer    ******************
        ************************************************-->
        @include('content_parts.footer')

    </div>

    <!-- Scripts -->
    <!-- JQuery -->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <!-- Custom JavaScript -->
    <script type="text/javascript" src="{{ asset('js/myjs.js') }}"></script>

    @yield('additional_scripts')

</body>
</html>
