@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row" id="">

            <div class="col-12" id="">
                <h2>Welcome Back {{ $admin->name }}</h2>
            </div>

            <div class="col-12" id="">
                <h2>Consult Request {{ $consults->count() }}</h2>
            </div>
        </div>
    </div>
@endsection