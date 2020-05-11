@extends('layouts.app')

@section('addt_style')
    <style type="text/css">
        #error_404 {

        }
    </style>
@endsection

@section('content')
    <div id="error_404" class="container-fluid mt-5 pt-5">
        <div class="row my-5 py-5">
            <div class="col-8 text-center mx-auto">
                 <h1 class="p-4 red accent-1 white-text">This page is not available. Please go back to previous page or select a viewable page.</h1>
            </div>
        </div>
    </div>
@endsection

