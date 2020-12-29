@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row pb-5" id="">

            <div class="col-12 mx-auto my-3" id="consultation_information">
                <h2 class="">Consultation Information</h2>

                <div class="" id="">
                    <table id="" class="table table-bordered table-responsive-sm">
                        <thead class="info-color-dark white-text">
                        <tr>
                            <th class="th-sm">Received<i class="" aria-hidden="true"></i></th>
                            <th class="th-sm">Name<i class="" aria-hidden="true"></i></th>
                            <th class="th-sm">Type<i class="" aria-hidden="true"></i></th>
                            <th class="th-sm">Service<i class="" aria-hidden="true"></i></th>
                            <th class="th-sm">Email<i class="" aria-hidden="true"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $consult->created_at->format('m/d/Y') }}</td>
                            <td>{{ $consult->full_name() }}</td>
                            <td>{{ $consult->type == 'B' ? 'Business' : 'Personal' }}</td>
                            <td>{{ ucwords(str_ireplace("_", " ", $consult->service)) }}</td>
                            <td>{{ $consult->email }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 col-md-5 order-1 order-md-0 mx-auto" id="">
                <img class="mw-100" src="{{ asset('storage/images/invoice_template_image.png') }}" alt="Invoice Template Image">
            </div>

            <div class="col-12 col-md-7 mx-auto" id="">

                <!--Section: Content-->
                <section class="text-center dark-grey-text mb-5">

                    <div class="card">
                        <div class="card-body rounded-top border-top p-5">

                            <!-- Section heading -->
                            <h3 class="font-weight-bold my-4">Draft New Contract</h3>
                            <!-- Section description -->
                            <p class="font-weight-light mx-auto mb-4 pb-2">The following form will populate the values into your prepared contract template.</p>

                            <form action="{{ action('ConsultRequestController@create_invoice', $consult) }}" method="POST" class="">

                                {{ csrf_field() }}
                                {{ method_field('POST') }}

                                <div class="row">
                                    <div class="md-form col-md-6 mb-4">

                                        <!-- Company Name -->
                                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter Company Name" value="{{ old('company_name') ? old('company_name') : '' }}">
                                        <label for="company_name">Company Name</label>

                                        @if ($errors->has('company_name'))
                                            <span class="text-danger">Company Name cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Company Payor Name -->
                                        <input type="text" name="owner_name" id="owner_name" class="form-control" placeholder="Enter Company Payor Name" value="{{ old('owner_name') ? old('owner_name') : $consult->full_name() }}">
                                        <label for="owner_name">Company Payor Name</label>

                                        @if ($errors->has('owner_name'))
                                            <span class="text-danger">Company Payor Name cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Company Address -->
                                        <input type="text" name="company_address" id="company_address" class="form-control" placeholder="Enter Company Address" value="{{ old('company_address') ? old('company_address') : '' }}">
                                        <label for="company_address">Company Address</label>

                                        @if ($errors->has('company_address'))
                                            <span class="text-danger">Company Address cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Payee Name -->
                                        <input type="text" name="payee" id="payee" class="form-control" placeholder="Enter Remit To Name" value="{{ old('payee') ? old('payee') : 'Ashley Clark-Jackson' }}">
                                        <label for="payee">Remit To:</label>

                                        @if ($errors->has('payee'))
                                            <span class="text-danger">Remit To Name cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Payee Address -->
                                        <input type="text" name="payee_address" id="payee_address" class="form-control" placeholder="Enter Address" value="{{ old('payee_address') ? old('payee_address') : '' }}">
                                        <label for="payee_address">Payee Address</label>

                                        @if ($errors->has('payee_address'))
                                            <span class="text-danger">Address cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Payment Method -->
                                        <input type="text" name="payee_payment_method" id="payee_payment_method" class="form-control" placeholder="Enter Payment Method" value="{{ old('payee_payment_method') ? old('payee_payment_method') : '' }}">
                                        <label for="payee_payment_method">Payment Method</label>

                                        @if ($errors->has('payee_payment_method'))
                                            <span class="text-danger">Payment Method cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Payee Name -->
                                        <input type="text" name="payee_contact_name" id="payee_contact_name" class="form-control" placeholder="Enter Contact Name" value="{{ old('payee_contact_name') ? old('payee_contact_name') : 'Ashley Clark-Jackson' }}">
                                        <label for="payee_contact_name">Contact Name</label>

                                        @if ($errors->has('payee_contact_name'))
                                            <span class="text-danger">Contact Name cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Payee Phone -->
                                        <input type="text" name="payee_contact_phone" id="payee_contact_phone" class="form-control" placeholder="Enter Contact Phone" value="{{ old('payee_contact_phone') ? old('payee_contact_phone') : '267-506-1143' }}">
                                        <label for="payee_contact_phone">Contact Phone</label>

                                        @if ($errors->has('payee_contact_phone'))
                                            <span class="text-danger">Contact Phone cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Email -->
                                        <input type="email" name="payee_contact_email" id="payee_contact_email" class="form-control" placeholder="Enter Contact Email" value="{{ old('payee_contact_email') ? old('payee_contact_email') : 'pristineaccting@gmail.com' }}">
                                        <label for="payee_contact_email">Contact Email</label>

                                        @if ($errors->has('payee_contact_email'))
                                            <span class="text-danger">Contact Email cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Invoice Date -->
                                        <input type="text" name="invoice_date" id="invoice_date" class="form-control" placeholder="Enter Invoice Date" value="{{ old('invoice_date') ? old('invoice_date') : '' }}">
                                        <label for="invoice_date">Invoice Date</label>

                                        @if ($errors->has('invoice_date'))
                                            <span class="text-danger">Invoice Date cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Invoice Reason -->
                                        <input type="text" name="invoice_reason" id="invoice_reason" class="form-control" placeholder="Enter Invoice Reason" value="{{ old('invoice_reason') ? old('invoice_reason') : '' }}">
                                        <label for="invoice_reason">Invoice Reason</label>

                                        @if ($errors->has('invoice_reason'))
                                            <span class="text-danger">Invoice Reason cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Invoice Number -->
                                        <input type="text" name="invoice_number" id="invoice_number" class="form-control" placeholder="Enter Invoice Number" value="{{ old('invoice_number') ? old('invoice_number') : $invoice_number }}">
                                        <label for="invoice_number">Invoice Number</label>

                                        @if ($errors->has('invoice_number'))
                                            <span class="text-danger">Invoice Number cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Invoice Terms -->
                                        <input type="text" name="invoice_terms" id="invoice_terms" class="form-control" placeholder="Enter Invoice Terms" value="{{ old('invoice_terms') ? old('invoice_terms') : '' }}">
                                        <label for="invoice_terms">Invoice Terms</label>

                                        @if ($errors->has('invoice_terms'))
                                            <span class="text-danger">Invoice Terms cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Invoice Due Date -->
                                        <input type="text" name="invoice_due_date" id="invoice_due_date" class="form-control" placeholder="Enter Invoice Due Date" value="{{ old('invoice_due_date') ? old('invoice_due_date') : '' }}">
                                        <label for="invoice_due_date">Invoice Due Date</label>

                                        @if ($errors->has('invoice_due_date'))
                                            <span class="text-danger">Invoice Due Date cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Invoice Amount -->
                                        <input type="number" name="invoice_amount" id="invoice_amount" class="form-control" placeholder="Enter Invoice Amount" value="{{ old('invoice_amount') ? old('invoice_amount') : '' }}">
                                        <label for="invoice_amount">Invoice Amount</label>

                                        @if ($errors->has('invoice_amount'))
                                            <span class="text-danger">Invoice Amount cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Project Period -->
                                        <input type="text" name="project_period" id="project_period" class="form-control" placeholder="Enter Project Period" value="{{ old('project_period') ? old('project_period') : '' }}">
                                        <label for="project_period">Project Period</label>

                                        @if ($errors->has('project_period'))
                                            <span class="text-danger">Project Period cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Project Name -->
                                        <input type="text" name="project_name" id="project_name" class="form-control" placeholder="Enter Project Name" value="{{ old('project_name') ? old('project_name') : '' }}">
                                        <label for="project_name">Project Name</label>

                                        @if ($errors->has('project_name'))
                                            <span class="text-danger">Project Name cannot be empty</span>
                                        @endif

                                    </div>

                                    <div class="md-form col-12 col-md-6 mb-4">

                                        <!-- Description of Services -->
                                        <input type="text" name="description_of_services" id="description_of_services" class="form-control" placeholder="Enter Description of Services" value="{{ old('description_of_services') ? old('description_of_services') : '' }}">
                                        <label for="description_of_services">Description of Services</label>

                                        @if ($errors->has('description_of_services'))
                                            <span class="text-danger">Description of Services cannot be empty</span>
                                        @endif

                                    </div>
                                
                                    <div class="col-12">

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-info btn-rounded">Draft Contract</button>
                                        </div>

                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </section>
                <!--Section: Content-->
            </div>
        </div>
    </div>
@endsection