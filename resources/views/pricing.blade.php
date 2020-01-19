@extends('layouts.app')

@section('content')

    <div class="container">

        <!--Section: Content-->
        <div class="row">

            <!-- Grid column -->
            <div class="col-lg-4 col-md-12 mb-lg-0 mb-4">

                <!-- Pricing card -->
                <div class="card pricing-card white-text">

                    <!-- Price -->
                    <div class="aqua-gradient rounded-top">
                        <h4 class="option">Accounting/Bookkeping</h4>
                    </div>

                    <!-- Features -->
                    <div class="card-body striped green-striped card-background px-5">

                        <h2 class="my-4 pb-3 h1">${{ $setting->accounting_rate }}</h2>
                        <ul>
                            <li>
                                <p><strong>1</strong> project</p>
                            </li>
                            <li>
                                <p><strong>100</strong> components</p>
                            </li>
                            <li>
                                <p><strong>150</strong> features</p>
                            </li>
                            <li>
                                <p><strong>200</strong> members</p>
                            </li>
                        </ul>
                        <button class="mb-3 mt-3 btn aqua-gradient btn-rounded waves-effect waves-light">Buy now</button>

                    </div>
                    <!-- Features -->

                </div>

                <!-- Pricing card -->

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-lg-4 col-md-6 mb-md-0 mb-4">

                <!-- Pricing card -->
                <div class="card pricing-card white-text">

                    <!-- Price -->
                    <div class="peach-gradient rounded-top">
                        <h4 class="option">Personal Budgeting</h4>
                    </div>

                    <!-- Features -->
                    <div class="card-body striped orange-striped card-background px-5">

                        <h2 class="my-4 pb-3 h1">${{ $setting->budgeting_rate }}</h2>
                        <ul>
                            <li>
                                <p><strong>1</strong> project</p>
                            </li>
                            <li>
                                <p><strong>100</strong> components</p>
                            </li>
                            <li>
                                <p><strong>150</strong> features</p>
                            </li>
                            <li>
                                <p><strong>200</strong> members</p>
                            </li>
                        </ul>
                        <button class="mb-3 mt-3 btn peach-gradient btn-rounded waves-effect waves-light">Buy now</button>

                    </div>
                    <!-- Features -->

                </div>
                <!-- Pricing card -->

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-lg-4 col-md-6">

                <!-- Pricing card -->
                <div class="card pricing-card white-text">

                    <!-- Price -->
                    <div class="purple-gradient rounded-top">
                        <h4 class="option">Tax Preparation</h4>
                    </div>

                    <!-- Features -->
                    <div class="card-body striped purple-striped card-background px-5">

                        <h2 class="my-4 pb-3 h1">${{ $setting->tax_prep_rate }}</h2>
                        <ul>
                            <li>
                                <p><strong>1</strong> project</p>
                            </li>
                            <li>
                                <p><strong>100</strong> components</p>
                            </li>
                            <li>
                                <p><strong>150</strong> features</p>
                            </li>
                            <li>
                                <p><strong>200</strong> members</p>
                            </li>
                        </ul>
                        <button class="mb-3 mt-3 btn purple-gradient btn-rounded waves-effect waves-light">Buy now</button>

                    </div>
                    <!-- Features -->

                </div>
                <!-- Pricing card -->

            </div>
            <!-- Grid column -->

        </div>
        <!--Section: Content-->
    </div>

@endsection