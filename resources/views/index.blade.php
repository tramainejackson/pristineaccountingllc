@extends('layouts.app')

@section('content')

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

    <div class="container-fluid pt-5" id="services">

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
                                <h2 class="font-weight-bold mb-3 h2 coolText6">Consulting</h2>
                                <p class="grey-text">We can provide clients, such as companies and individuals, with services that help them analyze financial information so that they can make important business decisions.</p>
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
                                <h2 class="font-weight-bold mb-3 h2 coolText6">Financial Analysis</h2>
                                <p class="grey-text"> It is wise to conduct periodic review and analysis of your company’s financial performance. These reviews are typically called audits, and are an important part of regulatory compliance. Additionally, financial analysis can provide valuable insight into your company’s financial health which can help you make sound decisions for the future.</p>
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
                                <h2 class="font-weight-bold mb-3 h2 coolText6">Tax Preparation</h2>
                                <p class="grey-text">Yearly individual and commercial tax preparation can be extremely complex. Records and submissions must be prepared carefully in order to minimize your risk of unforeseen tax liabilities, fees, or audits. We can help prepare your taxes with easy from 1040s to 990s and everything in between.</p>
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
                                <p class="grey-text mb-md-0">Budgeting can be essential to making sure an individual or company stays on the right track with expenses and revenue. Budgeting quantifies the expectation of revenue and expenses that a business wants to achieve for a future period. Forecasting estimates the number of revenue that will be achieved in future periods.</p>
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
                                <h2 class="font-weight-bold mb-3 h2 coolText6">Personal Budgeting/Money Management</h2>
                                <p class="grey-text">Helping individuals prepare monthly budgets to maintain their personal expenses and monthly income.</p>
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
                                <h2 class="font-weight-bold mb-3 h2 coolText6">Invoice/Contract Managing</h2>
                                <p class="grey-text">Prepare monthly invoicing and contract preparation.</p>
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

        @include('content_parts.mission_statement')

        @include('content_parts.consult_form')

        @include('content_parts.contact_info')

    </div>

@endsection