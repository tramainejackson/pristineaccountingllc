@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <!-- Grid row -->
        <div class="row">
            <div class="col mb-3" id="">
                <a href="{{ route('consults.index') }}" class="btn btn-warning">All Consult Request</a>
            </div>
        </div>

        <div class="row pb-5" id="">

            <div class="col-8 mx-auto" id="">

                <!--Section: Content-->
                <section class="text-center dark-grey-text mb-5">

                    <div class="card">
                        <div class="card-body rounded-top border-top p-5">

                            <!-- Section heading -->
                            <h3 class="font-weight-bold my-4">Create New Consult Request</h3>
                            <!-- Section description -->
                            <p class="font-weight-light mx-auto mb-4 pb-2">You can only add new consult request to existing contacts. To add a new contact select <a href="{{ route('consult_contacts.create') }}">here</a>.</p>

                            <form class="consult_request_form" action="{{ action('ConsultRequestController@store') }}" method="POST">

                                {{ method_field('POST') }}
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <select name="contact_id" class="form-control browser-default custom-select" style="font-family:inherit;">
                                            <option value="" selected disabled>Select A Contact</option>

                                            @foreach($contacts as $contact)
                                                <option value="{{ $contact->id }}">{{ $contact->full_name() }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('contact_id'))
                                            <span class="text-danger">{{ $errors->first('contact_id') }}</span>
                                        @endif
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

                                        @if ($errors->has('service'))
                                            <span class="text-danger">{{ $errors->first('service') }}</span>
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

                                        @if ($errors->has('type'))
                                            <span class="text-danger">{{ $errors->first('type') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row" id="">
                                    <div class="form-group col-12">
                                        <textarea name="message" class="form-control md-textarea" cols="30" rows="5" placeholder="Enter A Brief Description of the Service Needed">{{ old('message') }}</textarea>

                                        @if ($errors->has('message'))
                                            <span class="text-danger">{{ $errors->first('message') }}</span>
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
                            </form>
                        </div>
                    </div>
                </section>
                <!--Section: Content-->
            </div>
        </div>
    </div>
@endsection