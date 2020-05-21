@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row pb-5" id="">

            <div class="col-8 mx-auto" id="">

                <!--Section: Content-->
                <section class="text-center dark-grey-text mb-5">

                    <div class="card">

                        <div class="card-body rounded-top border-top p-5">

                            <!-- Section heading -->
                            <h3 class="font-weight-bold my-4">Edit Contact</h3>

                            <form action="{{ action('ConsultContactController@update', $consult_contact->id) }}" class="update_consult_contact_form" method="POST">

                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}

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

                            <div class="row mt-5">

                                @if($consult_contact->recommendation->isNotEmpty())

                                    <div class="col-12" id="">
                                        <h3 class="h3">This contact has completed a survey. Click <a href="">here</a> to go to that survey</h3>
                                    </div>

                                    <div class="col-12">

                                        <div class="text-center">
                                            <a class="btn btn-info btn-rounded">Send Another Survey</a>
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

                            <div class="row position-absolute top right">
                                <div class="col-12" id="">
                                    <form action="{{ route('consult_contacts.destroy', $consult_contact->id) }}" method="POST">

                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class='btn btn-danger' type='submit'>DELETE CONTACT</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--Section: Content-->
            </div>
        </div>
    </div>
@endsection