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

                <form class="consult_request_form" action="{{ action('ConsultRequestController@store') }}" method="POST">

                    {{ method_field('POST') }}
                    {{ csrf_field() }}

                    <div class="form-row">

                        <div class="form-group col-6">
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="Enter A Fistname" {{ old('first_name') ? 'autofocus' : '' }} />

                            @if ($errors->has('first_name'))
                                <span class="text-danger white rounded px-2">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-6">
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Enter A Lastname"{{ old('last_name') ? 'autofocus' : '' }} />

                            @if ($errors->has('last_name'))
                                <span class="text-danger white rounded px-2">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-12">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter A Email"{{ old('email') ? 'autofocus' : '' }} />

                            @if($errors->has('email'))
                                @foreach($errors->get('email') as $value)
                                    <span class="text-danger white rounded px-2">{{ $value }}</span>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group col-12">
                            <select name="service" class="form-control browser-default custom-select" style="font-family:inherit;" {{ old('service') ? 'autofocus' : '' }}>
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
                                <span class="text-danger white rounded px-2">Select A Type of Service</span>
                            @endif
                        </div>

                        <div class="form-group col-12">
                            <select name="type" class="form-control browser-default custom-select" style="font-family:inherit;" {{ old('type') ? 'autofocus' : '' }}>
                                <option value="" selected>Select A Type</option>
                                <option value="B">Business</option>
                                <option value="P">Personal</option>
                            </select>

                            @if ($errors->has('type'))
                                <span class="text-danger white rounded px-2">Select A Type of Consultation</span>
                            @endif
                        </div>

                        <div class="form-group col-12">
                            <textarea name="message" class="form-control md-textarea" cols="30" rows="5" placeholder="Enter A Brief Description of the Service Needed" {{ old('message') ? 'autofocus' : '' }}>{{ old('message') }}</textarea>

                            @if ($errors->has('message'))
                                <span class="text-danger white rounded px-2">The description of your request is required</span>
                            @endif
                        </div>

                        <div class="form-group col-12">
                            <button class='btn btn-primary btn-rounded' type='submit'>Send Consult Request</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Jumbotron -->
</div>