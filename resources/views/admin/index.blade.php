@extends('layouts.app')

@section('content')

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    <div class="container-fluid">

        <div class="row" id="">

            <div class="col-12" id="">
                <h2>Welcome Back {{ $admin->name }}</h2>
            </div>
        </div>

        <div class="row" id="">

            <div class="col-12" id="">

                <!-- Card deck -->
                <div class="card-deck flex-md-column flex-lg-row">

                    <!-- Card -->
                    <div class="card mb-4">

                        <div class="card-body">

                            <h5 class="card-title d-flex align-items-center justify-content-between">Consultation Request <a href="/consults" class="btn-floating btn-sm btn-warning"><i class="fas fa-edit"></i></a></h5>
                            <p class="card-text">You Currently Have {{ $open_consults !== 0 ?: $open_consults->count() }} Consult Request(s) That Has Not Been Responded To.</p>

                            @if($open_consults !== 0)
                                <p class="card-text"><small class="text-muted">Requested {{ $consult_created->diffInDays($today) < 1 ? 'Today' : $consult_created->diffInDays($today) . ' days ago' }}</small></p>
                            @endif
                        </div>
                    </div>

                    <!-- Card -->
                    <div class="card mb-4">

                        <div class="card-body">

                            <h5 class="card-title d-flex align-items-center justify-content-between">Open Tax Returns <a class="btn-floating btn-sm btn-warning"><i class="fas fa-edit"></i></a></h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>

                        </div>
                    </div>

                    <!-- Card -->
                    <div class="card mb-4">

                        <div class="card-body">

                            <h5 class="card-title d-flex align-items-center justify-content-between">Panel title <a class="btn-floating btn-sm btn-warning"><i class="fas fa-edit"></i></a></h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection