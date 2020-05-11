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
                            <h3 class="font-weight-bold my-4">Edit Contact</h3>

                            {!! Form::open(['action' => ['ConsultContactController@update', 'consult_contact' => $consult_contact->id], 'method' => 'PATCH', 'class' => 'update_consult_contact_form']) !!}

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
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-info btn-rounded">Update Contact</button>
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