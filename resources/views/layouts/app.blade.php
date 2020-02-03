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

        <!--Double navigation-->
        <header>
            <!-- Sidebar navigation -->
            <div id="slide-out" class="side-nav sn-bg-2">
                <ul class="custom-scrollbar">
                    <!-- Logo -->
                    <li>
                        <div class="logo-wrapper waves-light">
                            <a href="{{ route('home_index') }}"><img src="{{ asset('images/ap_logo.png') }}" class="img-fluid flex-center"></a>
                        </div>
                    </li>
                    <!--/. Logo -->
                    <!--Social-->
                    <li>
                        <ul class="social">
                            <li><a href="#" class="icons-sm fb-ic"><i class="fab fa-facebook"> </i></a></li>
                            <li><a href="#" class="icons-sm ins-ic"><i class="fab fa-instagram"> </i></a></li>
                        </ul>
                    </li>
                    <!--/Social-->
                    <!-- Side navigation links -->
                    <li>
                        <ul class="collapsible collapsible-accordion">
                            <li><a class="collapsible-header waves-effect" href="{{ route('home_index') }}"><i class="fas fa-home"></i>Home</a></li>
                            <li><a class="collapsible-header waves-effect" href="{{ route('about') }}"><i class="fas fa-pencil-alt"></i>About Me</a></li>
                            <li><a class="collapsible-header waves-effect" href="{{ route('home_index') . '#services' }}"><i class="fas fa-clipboard-check"></i>Services</a></li>
                            <li><a class="collapsible-header waves-effect" href="{{ route('home_index') . '#consultation' }}"><i class="fas fa-desktop"></i>Consultation Request</a></li>
                            @if(Auth::user())
                                <li><a class="collapsible-header waves-effect" href="{{ route('administrator.index') }}"><i class="fas fa-user"></i>Administrator</a></li>
                                <li><a class="collapsible-header waves-effect" href="{{ route('administrator.contacts') }}"><i class="fas fa-users"></i>Contacts</a></li>
                            @endif

                            @if(Auth::user())
                                <li class="d-sm-none d-flex">
                                    <a class="collapsible-header waves-effect" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <!--/. Side navigation links -->
                </ul>
                <div class="sidenav-bg mask-strong"></div>
            </div>
            <!--/. Sidebar navigation -->
            <!-- Navbar -->
            <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg double-nav w-100">
                <!-- SideNav slide-out button -->
                <div class="float-left">
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
                </div>
                <!-- Breadcrumb-->
                <div class="breadcrumb-dn mr-auto" style="display: block;">
                    <p>Pristine Accounting LLC</p>
                </div>
                <ul class="nav navbar-nav nav-flex-icons ml-auto">

                    @if(!Auth::user())
                        <li class="nav-item d-none d-sm-flex">
                            <a href="{{ url()->current() == route('home_index') ? '#contact' : route('home_index') . '#contact' }}" class="nav-link"><i class="fa fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
                        </li>
                    @else
                        <li class="nav-item d-none d-sm-flex">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif

                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link"><i class="fa fa-comments-o"></i> <span class="clearfix d-none d-sm-inline-block">Support</span></a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link"><i class="fa fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Account</span></a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item dropdown">--}}
                        {{--<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"--}}
                           {{--aria-haspopup="true" aria-expanded="false">--}}
                            {{--Dropdown--}}
                        {{--</a>--}}
                        {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">--}}
                            {{--<a class="dropdown-item" href="#">Action</a>--}}
                            {{--<a class="dropdown-item" href="#">Another action</a>--}}
                            {{--<a class="dropdown-item" href="#">Something else here</a>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                </ul>
            </nav>
            <!-- /.Navbar -->
        </header>
        <!--/.Double navigation-->

        <!--***********************************************
        ******************* Main Content ******************
        ************************************************-->
        @yield('content')

    </div>

    <!-- Footer -->
    <footer class="page-footer font-small unique-color-dark p-0 fixed-bottom">

        <!-- Footer Text -->
        <div class="container-fluid text-center text-md-left d-none">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-6 mt-md-0 mt-3">

                    <!-- Content -->
                    <h5 class="text-uppercase font-weight-bold">Footer text 1</h5>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Expedita sapiente sint, nulla, nihil
                        repudiandae commodi voluptatibus corrupti animi sequi aliquid magnam debitis, maxime quam recusandae
                        harum esse fugiat. Itaque, culpa?</p>

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none pb-3">

                <!-- Grid column -->
                <div class="col-md-6 mb-md-0 mb-3">

                    <!-- Content -->
                    <h5 class="text-uppercase font-weight-bold">Footer text 2</h5>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Optio deserunt fuga perferendis modi earum
                        commodi aperiam temporibus quod nulla nesciunt aliquid debitis ullam omnis quos ipsam, aspernatur id
                        excepturi hic.</p>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Text -->

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2019 Copyright:
            <span class=""> Pristine Accounting LLC</span>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->

    <!-- Scripts -->
    <!-- JQuery -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/myjs.js') }}"></script>

    @yield('additional_scripts')

</body>
</html>
