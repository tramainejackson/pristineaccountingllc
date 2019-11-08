@extends('layouts.app')

@section('content')

    <!-- Jumbotron -->
    <div class="jumbotron card card-image" style="background-image: url({{ asset('images/accounting_image2.jpg') }});">

        <div class="text-center py-5 px-4">

            <div class="rgba-white-strong py-3">

                <h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong><span class="d-block d-sm-inline-block">Pristing</span><span class="d-block d-sm-inline-block">Accounting</span><span class="d-block d-sm-inline-block dark-grey-text">LLC</span></strong></h2>

                <p class="mx-5 mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat fugiat, laboriosam, voluptatem,
                    optio vero odio nam sit officia accusamus minus error nisi architecto nulla ipsum dignissimos. Odit sed qui, dolorum!
                </p>
            </div>
        </div>
    </div>
    <!-- Jumbotron -->

    <div class="container-fluid">

        <div class="row mt-3 mb-5">

            <div class="col-12 mb-4">

                <div class="d-flex flex-row align-items-center">
                    <h1 class="section-title text-center"><span> Services </span></h1>
                </div>

            </div>

            <div class="col-12">

                <div class="card-deck">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Public Accounting</h5>
                            <p class="card-text">Processes involved in public accounting are preparation, review, and audit of financial statements, tax preparation, and consultation or advisory services.</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Management Accounting</h5>
                            <p class="card-text">Management accounting is a process wherein accounting professionals analyze past and present accounting data to synthesize an effective and efficient business model for their client. Some of the processes under management accounting include budgeting, asset management, cost management, and performance evaluation.</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Bookkeeping</h5>
                            <p class="card-text">Bookkeeping is the recording of financial transactions, and is part of the process of accounting in business. Transactions include purchases, sales, receipts, and payments by an individual person or an organization/corporation. There are several standard methods of bookkeeping, including the single-entry and double-entry bookkeeping systems.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-12" id="">

                <!-- Jumbotron -->
                <div class="separtator jumbotron card card-image m-0  mt-3" style="background-image: url({{ asset('images/accounting_image4.jpg') }});">
                </div>
                <!-- Jumbotron -->
            </div>
        </div>

        <div class="row" id="">

            <!-- Jumbotron -->
            <div class="jumbotron card card-image p-0 rounded-0" style="background-image: url({{ asset('images/accounting_image.jpg') }});">

                <div class="mask waves-effect waves-light rgba-indigo-light white-text text-center d-flex align-items-center flex-column justify-content-center px-2">

                    <div class="pt-3" id="">
                        <h3 class="">Consultation</h3>
                    </div>

                    <div class="" id="">
                        <p>Send me your contact information and I will reach out to you to discuss a free consultation</p>
                    </div>

                    <div class="" id="">

                        {!! Form::open(['action' => 'HomeController@index', 'method' => 'POST']) !!}

                        <div class="form-row">

                            <div class="form-group col-6">
                                {{ Form::text('first_name', '', ['class' => 'form-control', 'placeholder' => 'Enter A Fistname']) }}

                                @if ($errors->has('first_name'))
                                    <span class="text-danger">First Name cannot be empty</span>
                                @endif
                            </div>

                            <div class="form-group col-6">
                                {{ Form::text('last_name', '', ['class' => 'form-control', 'placeholder' => 'Enter A Lastname']) }}

                                @if ($errors->has('last_name'))
                                    <span class="text-danger">Last Name cannot be empty</span>
                                @endif
                            </div>

                            <div class="form-group col-12">
                                {{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Enter An Email']) }}

                                @if ($errors->has('email'))
                                    <span class="text-danger">Email Name cannot be empty</span>
                                @endif
                            </div>

                            <div class="form-group col-12">
                                {{ Form::submit('Send Consult Request', ['class' => 'btn btn-primary btn-rounded']) }}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- Jumbotron -->
        </div>

        <div class="row">

            <div class="col-12 mb-4">

                <div class="d-flex flex-row align-items-center">
                    <h1 class="section-title text-center"><span> Contact </span></h1>
                </div>

            </div>

            <!-- Grid column -->
            <div class="col-12 col-sm-auto mx-auto">
                <ul class="contact-icons">
                    <li><i class="fa fa-map-marker fa-2x"></i>
                        <p>Philadelphia, PA 19102, USA</p>
                    </li>

                    <li><i class="fa fa-phone fa-2x"></i>
                        <p>+ Coming Soon</p>
                    </li>

                    <li><i class="fa fa-envelope fa-2x"></i>
                        <p>adc0426@gmail.com</p>
                    </li>
                </ul>
            </div>
            <!-- Grid column -->
        </div>
    </div>
@endsection