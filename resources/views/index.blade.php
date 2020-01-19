@extends('layouts.app')

@section('content')

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Jumbotron -->
    <div class="jumbotron card card-image mt-n5" style="background-image: url({{ asset('images/accounting_image2.jpg') }});">

        <div class="text-center py-5 px-4">

            <div class="rgba-white-strong py-3">

                <h1 class="card-title h1 pt-3 mb-5 font-bold coolText6 display-3"><strong><span class="d-block d-sm-inline-block">Pristine</span><span class="d-block d-sm-inline-block">Accounting</span><span class="d-block d-sm-inline-block dark-grey-text">LLC</span></strong></h1>

                <p class="mx-5 mb-5">The vision at Pristine Accounting is to enrich its client’s one person at a time to help
                    build up a financially savvy community, while striving to be the best financial company.
                </p>
            </div>
        </div>
    </div>
    <!-- Jumbotron -->

    <div class="container-fluid" id="services">

        <div class="row mt-3 mb-5">

            <div class="col-12 mb-4">

                <div class="d-flex flex-row align-items-center">
                    <h1 class="section-title text-center coolText6"><span>Services</span></h1>
                </div>

            </div>

            <div class="col-12 col-xl-10 mx-auto">
                <!-- Grid row -->
                <div class="row">

                    <!-- Grid column -->
                    <div class="col-lg-4">

                        <!-- Grid row -->
                        <div class="row mb-3">

                            <!-- Grid column -->
                            <div class="col-2">
                                <i class="fas fa-2x fa-book-open deep-purple-text"></i>
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-10">
                                <h2 class="font-weight-bold mb-3 h2 coolText6">Bookkeeping</h2>
                                <p class="grey-text">Bookkeeping is the most basic of all accounting functions. Bookkeeping involves maintaining accurate and updated records of all of your company’s financial activity. This includes bank records, tax filings, payroll records, and purchase and sale records. These records are essential to regulatory compliance. Proper bookkeeping makes other accounting functions, such as audits, payroll, and tax preparation, much simpler and less time consuming.</p>
                            </div>
                            <!-- Grid column -->

                        </div>
                        <!-- Grid row -->

                        <!-- Grid row -->
                        <div class="row mb-3">

                            <!-- Grid column -->
                            <div class="col-2">
                                <i class="fas fa-2x fa-file-invoice deep-purple-text"></i>
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-10">
                                <h2 class="font-weight-bold mb-3 h2 coolText6">Tax Preparation</h2>
                                <p class="grey-text">Yearly individual and commercial tax preparation can be extremely complex. Records and submissions must be prepared carefully in order to minimize your risk of unforeseen tax liabilities, fees, or audits. We can help prepare your taxes with easy from 1040s to 990s and everything in between.</p>
                            </div>
                            <!-- Grid column -->

                        </div>
                        <!-- Grid row -->

                        <!-- Grid row -->
                        <div class="row mb-md-0 mb-3">

                            <!-- Grid column -->
                            <div class="col-2">
                                <i class="far fa-2x fa-chart-bar deep-purple-text"></i>
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-10">
                                <h2 class="font-weight-bold mb-3 h2 coolText6">Consulting</h2>
                                <p class="grey-text">We can provides clients, such as companies and individuals, with services that help them analyze financial information so that they can make important business decisions.</p>
                            </div>
                            <!-- Grid column -->

                        </div>
                        <!-- Grid row -->

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-lg-4 text-center d-none d-lg-flex align-items-center justify-content-center">
                        <img class="img-fluid" src="{{ asset('images/accounting_image5.png') }}"
                             alt="Sample image">
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-lg-4">

                        <!-- Grid row -->
                        <div class="row mb-3">

                            <!-- Grid column -->
                            <div class="col-2">
                                <i class="fas fa-2x fa-chart-line deep-purple-text"></i>
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-10">
                                <h2 class="font-weight-bold mb-3 h2 coolText6">Financial Analysis</h2>
                                <p class="grey-text"> It is wise to conduct periodic review and analysis of your company’s financial performance. These reviews are typically called audits, and are an important part of regulatory compliance. Additionally, financial analysis can provide valuable insight into your company’s financial health which can help you make sound decisions for the future.</p>
                            </div>
                            <!-- Grid column -->

                        </div>
                        <!-- Grid row -->

                        <!-- Grid row -->
                        <div class="row mb-3">

                            <!-- Grid column -->
                            <div class="col-2">
                                <i class="fas fa-2x fa-tasks deep-purple-text"></i>
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-10">
                                <h2 class="font-weight-bold mb-3 h2 coolText6">Budgeting/Forecasting</h2>
                                <p class="grey-text mb-md-0">Budgeting can be essential to making sure an individual or company stays on the right track with expenses and revenue. Budgeting quantifies the expectation of revenue and expenses that a business wants to achieve for a future period. Forecasting estimates the number of revenue that will be achieved in future periods. </p>
                            </div>
                            <!-- Grid column -->

                        </div>
                        <!-- Grid row -->

                        <!-- Grid row -->
                        <div class="row mb-3">

                            <!-- Grid column -->
                            <div class="col-2">
                                <i class="fas fa-2x fa-file-contract deep-purple-text"></i>
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-10">
                                <h2 class="font-weight-bold mb-3 h2 coolText6">Form Creation</h2>
                                <p class="grey-text">Contract and receipt creation.</p>
                            </div>
                            <!-- Grid column -->

                        </div>
                        <!-- Grid row -->

                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row -->

            </div>
        </div>

        <div class="row">

            <div class="col-12 mb-4">

                <div class="d-flex flex-row align-items-center">
                    <h1 class="section-title text-center coolText6"><span>Mission</span></h1>
                </div>

            </div>

            <!--Grid column-->
            <div class="col-8 text-center z-depth-1 mx-auto mb-4">

                <p class="p-5">The mission at Pristine Accounting is to provide affordable professional financial services
                    to the community. While doing so we also focus on educating and enriching those about
                    financial decisions so that they can achieve their financial potential; not just short term,
                    but long term.
                </p>

            </div>
            <!--Grid column-->

        </div>

        <div class="row">

            <div class="col-12" id="">

                <!-- Jumbotron -->
                <div class="separtator jumbotron card card-image m-0  mt-3" style="background-image: url({{ asset('images/accounting_image4.jpg') }});">
                </div>
                <!-- Jumbotron -->
            </div>
        </div>

        <div class="row" id="consultation">

            <!-- Jumbotron -->
            <div class="jumbotron card card-image p-0 rounded-0" style="background-image: url({{ asset('images/accounting_image.jpg') }});">

                <div class="mask waves-effect waves-light rgba-indigo-light white-text text-center d-flex align-items-center flex-column justify-content-center px-2">

                    <div class="pt-3" id="">
                        <h1 class="h1 coolText6">Consultation</h1>
                    </div>

                    <div class="" id="">
                        <p>Send me your contact information and I will reach out to you to discuss a free consultation</p>
                    </div>

                    <div class="" id="">

                        {!! Form::open(['action' => 'HomeController@consult_request', 'method' => 'POST']) !!}

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
                                        <span class="text-danger">Email Address cannot be empty</span>
                                    @endif
                                </div>

                                <div class="form-group col-12">
                                    <select name="service" class="form-control browser-default custom-select" style="font-family:inherit;">
                                        <option value="" selected>Select A Service</option>
                                        <option value="bookkeeping">Bookkeeping</option>
                                        <option value="tax_prep">Tax Preparation</option>
                                        <option value="financial_ananlysis">Financial Analysis</option>
                                        <option value="budget">Budgeting/Forecasting</option>
                                        <option value="consulting">Consulting</option>
                                    </select>

                                    @if ($errors->has('email'))
                                        <span class="text-danger">Select A Type of Service</span>
                                    @endif
                                </div>

                                <div class="form-group col-12">
                                    <select name="type" class="form-control browser-default custom-select" style="font-family:inherit;">
                                        <option value="" selected>Select A Type</option>
                                        <option value="B">Business</option>
                                        <option value="P">Personal</option>
                                    </select>

                                    @if ($errors->has('email'))
                                        <span class="text-danger">Select A Type of Consultation</span>
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

        <div class="row mb-5">

            <div class="col-12 mb-4" id="contact">

                <div class="d-flex flex-row align-items-center">
                    <h1 class="section-title text-center coolText6"><span>Contact</span></h1>
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
                        <p>pristineaccting@gmail.com</p>
                    </li>
                </ul>
            </div>
            <!-- Grid column -->
        </div>
    </div>
@endsection