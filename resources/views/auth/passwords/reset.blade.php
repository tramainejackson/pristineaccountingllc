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

    <div class="container">

        <div class="row">

            <div class="col-md-8 col-md-offset-2 ml-auto mb-5">

                <div class="panel panel-default">
                    <div class="panel-heading">Reset Password</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
