@extends('layouts.app')

@section('content')

    @if(session('status'))
        @section('additional_scripts')
            <script type="text/javascript">
                toastr.success("Request Moved To Completed", "Success", {showMethod: 'slideDown'});
            </script>
        @endsection
    @endif

    <div class="container-fluid">

        <div class="row pb-5" id="">

            <div class="col-8 mx-auto" id="">

                <!--Section: Content-->
                <section class="text-center dark-grey-text mb-5">

                    <div class="card">
                        <div class="card-body rounded-top border-top p-5">

                            <!-- Section heading -->
                            <h3 class="font-weight-bold my-4">Create New Consult Request</h3>
                            <!-- Section description -->
                            <p class="font-weight-light mx-auto mb-4 pb-2">This will also add the user as a contact for your records.</p>

                            {!! Form::open(['action' => 'ConsultRequestController@store', 'method' => 'POST', 'class' => 'consult_request_form']) !!}

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <!-- Name -->
                                        <input type="text" id="first_name" class="form-control" placeholder="Enter First Name">

                                        @if ($errors->has('first_name'))
                                            <span class="text-danger">First Name cannot be empty</span>
                                        @endif

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <!-- Name -->
                                        <input type="email" id="last_name" class="form-control" placeholder="Enter Last Name">

                                        @if ($errors->has('last_name'))
                                            <span class="text-danger">Last Name cannot be empty</span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4">

                                        <!-- Email -->
                                        <input type="email" id="email" class="form-control" placeholder="Enter Email Address">

                                        @if ($errors->has('email'))
                                            <span class="text-danger">Email Address cannot be empty</span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4">

                                        <!-- Phone -->
                                        <input type="text" id="phone" class="form-control" placeholder="Enter Phone Number">

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <select name="service" class="form-control browser-default custom-select" style="font-family:inherit;">
                                            <option value="" selected disabled>Select A Service</option>
                                            <option value="bookkeeping">Bookkeeping</option>
                                            <option value="tax_prep">Tax Preparation</option>
                                            <option value="financial_ananlysis">Financial Analysis</option>
                                            <option value="budget">Budgeting/Forecasting</option>
                                            <option value="budget">Personal Budgeting/Money Management</option>
                                            <option value="invoicing">Invoice/Contract Management</option>
                                            <option value="consulting">Consulting</option>
                                        </select>

                                        @if ($errors->has('email'))
                                            <span class="text-danger">Select A Type of Service</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <select name="type" class="form-control browser-default custom-select" style="font-family:inherit;">
                                            <option value="" selected>Select A Type</option>
                                            <option value="B">Business</option>
                                            <option value="P">Personal</option>
                                        </select>

                                        @if ($errors->has('email'))
                                            <span class="text-danger">Select A Type of Consultation</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-info btn-rounded">Create Request</button>
                                        </div>

                                    </div>
                                </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </section>
                <!--Section: Content-->
            </div>
        </div>
    </div>
@endsection