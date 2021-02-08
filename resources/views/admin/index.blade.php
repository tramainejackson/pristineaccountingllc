@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row" id="">

            <div class="col-12 my-5" id="">
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
                            <p class="card-text">You Currently Have {{ $open_consults }} Consult Request(s) That Has Not Been Responded To.</p>

                            @if($open_consults !== 0)
                                <p class="card-text"><small class="text-muted">Requested {{ $consult_created->diffInDays($today) < 1 ? 'Today' : $consult_created->diffInDays($today) . ' days ago' }}</small></p>
                            @else
                                <p class="card-text"><small class="text-muted">Requested 0 days ago</small></p>
                            @endif
                        </div>
                    </div>

                    <!-- Card -->
                    {{--<div class="card mb-4">--}}

                        {{--<div class="card-body">--}}

                            {{--<h5 class="card-title d-flex align-items-center justify-content-between">Open Tax Returns <a class="btn-floating btn-sm btn-warning"><i class="fas fa-edit"></i></a></h5>--}}
                            {{--<p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>--}}
                            {{--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>--}}

                        {{--</div>--}}
                    {{--</div>--}}

                    <!-- Card -->
                    <div class="card mb-4">

                        <div class="card-body">

                            <h5 class="card-title d-flex align-items-center justify-content-between">Reviews <a href="/recommendations" class="btn-floating btn-sm btn-warning"><i class="fas fa-edit"></i></a></h5>
                            <p class="card-text">You currently have {{ $testimonials }} review(s). These are your reviews from the clients that you've serviced so far. You can choose which ones display on your website.</p>

                            @if($testimonials !== 0)
                                <p class="card-text"><small class="text-muted">Testimonial received {{ $testimonial_created->diffInDays($today) < 1 ? 'Today' : $testimonial_created->diffInDays($today) . ' days ago' }}</small></p>
                            @else
                                <p class="card-text"><small class="text-muted">Last updated 0 mins ago</small></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5" id="">

            <div class="col-12 mb-5" id="">

                <div class="card" id="">

                    <div class="card-body" id="">

                        {!! Form::open(['action' => ['AdminController@update', $setting->id], 'method' => 'PATCH']) !!}

                            <div class="d-flex align-items-center justify-content-between" id="">
                                <h2 class="h2">Rates</h2>

                                <button type="submit" class="btn btn-sm btn-mdb-color" value="update_pricing_btn">Update Pricing Options</button>
                            </div>

                            <div class="md-form input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" id="material-addon1">$</span>
                                </div>

                                <input name="accounting_rate" type="number" class="form-control" value="{{ $setting->accounting_rate }}" placeholder="Accounting/Bookkeping Rate" step="0.01">

                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" id="material-addon1">per hour</span>
                                </div>

                                <label for="accounting_rate">Accounting/Bookkeping Rate</label>
                            </div>

                            <div class="md-form input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" id="material-addon1">$</span>
                                </div>

                                <input name="budgeting_rate" type="number" class="form-control" value="{{ $setting->budgeting_rate }}" placeholder="Personal Budgeting Rate" step="0.01">

                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" id="material-addon1">per hour</span>
                                </div>
                                <label for="budgeting_rate">Personal Budgeting Rate</label>
                            </div>

                            <div class="md-form input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" id="material-addon1">$</span>
                                </div>

                                <input name="tax_prep_rate" type="number" class="form-control" value="{{ $setting->tax_prep_rate }}" placeholder="Tax Preparation Rate" step="0.01">

                                <div class="input-group-prepend">
                                    <span class="input-group-text md-addon" id="material-addon1">per hour</span>
                                </div>
                                <label for="tax_prep_rate">Tax Preparation Rate</label>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection