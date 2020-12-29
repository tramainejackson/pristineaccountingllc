@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row pb-5" id="">
            <div class="col-8 mx-auto" id="">
                <a href="{{ route('consult_contacts.index') }}" class="btn btn-warning">All Contacts</a>
            </div>
        </div>

        <div class="row pb-5" id="">

            <div class="col-8 mx-auto" id="">

                <!--Section: Content-->
                <section class="text-center dark-grey-text mb-5">

                    <div class="card">

                        <div class="card-body rounded-top border-top p-5">

                            <!-- Section heading -->
                            <h3 class="font-weight-bold my-4">Edit Contact</h3>

                            <form action="{{ action('ConsultContactController@update', $consult_contact->id) }}" class="update_consult_contact_form" method="POST" enctype="multipart/form-data">

                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}

                                <!-- Client Default Image -->
                                <div class="row contactImg mb-3">
                                    <div class="view mx-auto" id="">
                                        <img class="hoverable" src="{{ asset('storage/images/' . $consult_contact->avatar) }}" alt="Member Image" width="300">

                                        <div class="mask d-flex justify-content-center">
                                            <button type="button" class="btn align-self-end m-0 p-1 white">Change Image</button>
                                            <input type="file" class="hidden" name="avatar" hidden />
                                        </div>
                                    </div>

                                    @if ($errors->has('avatar'))
                                        <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <!-- Name -->
                                        <input type="text" id="first_name" class="form-control" name='first_name' value='{{ $consult_contact->first_name }}' placeholder="Enter First Name">

                                        @if ($errors->has('first_name'))
                                            <span class="text-danger">First Name cannot be empty</span>
                                        @endif

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <!-- Name -->
                                        <input type="text" id="last_name" class="form-control" name='last_name' value='{{ $consult_contact->last_name }}' placeholder="Enter Last Name">

                                        @if ($errors->has('last_name'))
                                            <span class="text-danger">Last Name cannot be empty</span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4">

                                        <!-- Email -->
                                        <input type="email" id="email" class="form-control" name='email' value='{{ $consult_contact->email }}' placeholder="Enter Email Address">

                                        @if ($errors->has('email'))
                                            <span class="text-danger">Email Address cannot be empty</span>
                                        @endif

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4">

                                        <!-- Phone -->
                                        <input type="number" id="phone" class="form-control" name='phone' value='{{ $consult_contact->phone }}' placeholder="Enter Phone Number">

                                    </div>

                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-info btn-rounded">Update Contact</button>
                                        </div>

                                    </div>
                                </div>
                            </form>

                            <div class="row my-5">

                                @if($recommendations->isNotEmpty())

                                    <div class="col-12" id="">
                                        <h3 class="h3">This contact has completed a survey.</h3>
                                    </div>

                                    <div class="col-12 text-left">
                                        @foreach($recommendations as $recommendation)
                                            <a class="btn btn-outline-blue-grey" href="{{ route('recommendations.edit', $recommendation->id) }}">See survey - {{ $recommendation->id }}</a>
                                        @endforeach
                                    </div>

                                    <div class="col-12">

                                        <div class="text-center">
                                            <a class="btn btn-info btn-rounded">Send Another Survey Email</a>
                                        </div>

                                    </div>
                                @else
                                    <div class="col-12" id="">
                                        <h3 class="h3">This contact has not completed a survey</h3>
                                    </div>

                                    <div class="col-12">

                                        <div class="text-center">
                                            <a href="{{ action('RecommendationController@send_survey', $consult_contact) }}" class="btn btn-mdb-color btn-rounded">Send Survey</a>
                                        </div>

                                    </div>
                                @endif
                            </div>

                            {{-- Show invoices --}}
                            @if($invoices->isNotEmpty())
                                <div class="row mt-5" id="invoices">
                                    <div class="col-12">
                                        <h3 class="">This contact has {{ $invoices->count() }} invoice(s).</h3>
                                    </div>

                                    <div class="col-12 text-left">
                                        @foreach($invoices as $invoice)
                                            <a class="btn btn-outline-blue-grey" href="{{ asset('storage/documents/' . $invoice->file_name . '.docx') }}" download="{{ $consult_contact->full_name() . ' Invoice - ' . $invoice->invoice_number }}">Download Invoice - {{ $invoice->invoice_number < 10 ? '00' .$invoice->invoice_number : '0' . $invoice->invoice_number }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="row position-absolute top right">
                                <div class="col" id="">
                                    <button class="btn btn-danger d-block mt-2 deleteBtn" id="consultContacts_{{ $consult_contact->id }}" type="button" data-toggle="modal" data-target="#delete_modal" onclick="event.preventDefault(); deleteModalUpdate(this);">DELETE CONTACT</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--Section: Content-->
            </div>
        </div>
    </div>

    @component('modals.delete_modal', ['title' => 'Delete Contact'])
        Contact name - {{ $consult_contact->full_name() }}
    @endcomponent
@endsection