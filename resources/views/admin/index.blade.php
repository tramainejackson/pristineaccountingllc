@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row" id="">

            <div class="col-12" id="">
                <h2>Welcome Back {{ $admin->name }}</h2>
            </div>
        </div>

        <div class="row" id="">

            <div class="col-12" id="">

                <!-- Card deck -->
                <div class="card-deck flex-column flex-lg-row">

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

        <div class="row" id="">

            <div class="col-12 col-lg-8" id="">

                <div class="card" id="">

                    <div class="card-body" id="">

                        <h2 class="h2">Rates</h2>

                        {!! Form::open(['action' => 'HomeController@consult_request', 'method' => 'POST']) !!}

                            <div class="md-form input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" id="material-addon1">$</span>
                                </div>

                                <input name="bookkeeping_rate" type="number" class="form-control" value="" placeholder="Accounting/Bookkeping Rate">

                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" id="material-addon1">per hour</span>
                                </div>

                                <label for="bookkeeping_rate">Accounting/Bookkeping Rate</label>
                            </div>

                            <div class="md-form input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" id="material-addon1">$</span>
                                </div>

                                <input name="budgeting_rate" type="number" class="form-control" value="" placeholder="Personal Budgeting Rate">

                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" id="material-addon1">per hour</span>
                                </div>
                                <label for="budgeting_rate">Personal Budgeting Rate</label>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection