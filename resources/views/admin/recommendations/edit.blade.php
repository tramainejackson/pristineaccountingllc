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

                <!-- Testimonial Form -->
                <form method="POST" action="{{ action('RecommendationController@store') }}" class="form">

                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="form-row" id="">
                        <!-- Grid column -->
                        <div class="col-4">
                            <!--Blue select-->
                            <select name="meet_needs" class="mdb-select md-form">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <label class="mdb-main-label" for="meet_needs">Did we meet all of your needs?</label>
                            <!--/Blue select-->

                            @if ($errors->has('meet_needs'))
                                <span class="text-danger">{{ $errors->first('meet_needs') }}</span>
                            @endif
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-4">
                            <!--Blue select-->
                            <select name="recommend" class="mdb-select md-form">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <label class="mdb-main-label" for="recommend">Would you recommend us to someone else?</label>
                            <!--/Blue select-->

                            @if ($errors->has('recommend'))
                                <span class="text-danger">{{ $errors->first('recommend') }}</span>
                            @endif
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-4">
                            <!-- Material input -->
                            <div class="md-form">
                                <input name="rating" type="number" class="form-control" id="" step="0.5" min="0" max="5">
                                <label for="rating" >How would you rate us from 1-5?</label>
                            </div>

                            @if ($errors->has('rating'))
                                <span class="text-danger">{{ $errors->first('rating') }}</span>
                            @endif
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-12 mb-3">
                            <!--Material textarea-->
                            <div class="md-form">
                              <textarea name="suggestions" id="" class="md-textarea form-control" rows="5">{{ old('suggestions') ? old('suggestions') : '' }}</textarea>
                              <label for="suggestions">What could we have done differently?</label>
                            </div>

                            @if ($errors->has('suggestions'))
                                <span class="text-danger">{{ $errors->first('suggestions') }}</span>
                            @endif
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-12 mb-3">
                            <!--Material textarea-->
                            <div class="md-form">
                              <textarea name="tell_someone" id="" class="md-textarea form-control" rows="5">{{ old('tell_someone') ? old('tell_someone') : '' }}</textarea>
                              <label for="tell_someone">What would you tell someone who's considering our business?</label>
                            </div>

                            @if ($errors->has('tell_someone'))
                                <span class="text-danger">{{ $errors->first('tell_someone') }}</span>
                            @endif
                        </div>
                        <!-- Grid column -->

                        <!-- Hidden Field-->
                        <input type="text" name="survey_id" class="hide" value="" hidden />

                        <!-- Grid column -->
                        <div class="col-12 mb-3">
                            <button class='btn btn-outline-dark-green' type='submit'>Send <i class="fas fa-paper-plane"></i></button>
                        </div>
                        <!-- Grid column -->
                    </div>
                </form>
                <!-- Testimonial Form -->
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
    </div>
    <!-- Testimonial -->

@endsection