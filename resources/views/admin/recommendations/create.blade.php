@extends('layouts.app')

@section('content')

    <!-- Testimonial -->
    <div class="container text-center text-md-left">

        <!-- Grid row -->
        <div class="row">

            <div class="col-12 text-center" id="">
                <h2 class>Please Take Our Quick Survey</h2>
            </div>

            <div class="col-12 my-4" id="">
                <p>As a startup company, feedback from our customers are extremely important for us to make sure we are on the right path. Please take my quick survey so I know how we are doing.</p>
            </div>

            <div class="col-12 my-4" id="">

                @include('content_parts.review_form')

            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
    </div>
    <!-- Testimonial -->

@endsection