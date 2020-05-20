{{--Check if there any testimonials to show--}}
@php $get_testimonials = \App\Recommendation::showTestimonials()->count(); @endphp

<!--Double navigation-->
<header>
    <!-- Sidebar navigation -->
    <nav id="slide-out" class="side-nav sn-bg-2">
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

                    @if($get_testimonials >= 1)
                        <li><a class="collapsible-header waves-effect" href="{{ route('testimonials') }}"><i class="fas fa-star"></i>Testimonials</a></li>
                    @endif

                    @if(Auth::user())
                        <li><a class="collapsible-header waves-effect" href="{{ route('administrator.index') }}"><i class="fas fa-user"></i>Administrator</a></li>
                        <li><a class="collapsible-header waves-effect" href="{{ route('consult_contacts.index') }}"><i class="fas fa-users"></i>Contacts</a></li>

                        <li class="d-sm-none d-flex">
                            <a class="collapsible-header waves-effect" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @else
                        <li><a class="collapsible-header waves-effect" href="{{ route('login') }}"><i class="fas fa-user"></i></i>Login</a></li>
                    @endif
                </ul>
            </li>
            <!--/. Side navigation links -->
        </ul>
        <div class="sidenav-bg mask-strong"></div>
    </nav>
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