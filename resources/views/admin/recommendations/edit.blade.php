@extends('layouts.app')

@section('content')

    <!-- Testimonial -->
    <div class="container text-center text-md-left">

        <!-- Grid row -->
        <div class="row">

            <div class="col-12 text-center" id="">
                <h2 class>{{ $contact->full_name() }}'s Survey</h2>
            </div>

            <div class="col-12 my-4" id="">

                <div class="card mb-5" id="">

                    <div class="card-body" id="">

                        <!-- Testimonial Form -->
                        <form method="POST" action="{{ action('RecommendationController@update', $recommendation->id) }}" class="form">

                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-row" id="">
                                <!-- Grid column -->
                                <div class="col-12 col-lg-4">
                                    <!--Blue select-->
                                    <select name="meet_needs" class="mdb-select md-form">
                                        <option value="1" {{$recommendation->meet_needs == 1 ? 'selected' : ''}}>Yes</option>
                                        <option value="0" {{$recommendation->meet_needs == 0 ? 'selected' : ''}}>No</option>
                                    </select>
                                    <label class="mdb-main-label text-left" for="meet_needs">Did we meet all your expectations/accounting needs?</label>
                                    <!--/Blue select-->

                                    @if ($errors->has('meet_needs'))
                                        <span class="text-danger">{{ $errors->first('meet_needs') }}</span>
                                    @endif
                                </div>
                                <!-- Grid column -->

                                <!-- Grid column -->
                                <div class="col-12 col-lg-4">
                                    <!--Blue select-->
                                    <select name="recommend" class="mdb-select md-form">
                                        <option value="1" {{$recommendation->recommend == 1 ? 'selected' : ''}}>Yes</option>
                                        <option value="0" {{$recommendation->recommend == 0 ? 'selected' : ''}}>No</option>
                                    </select>
                                    <label class="mdb-main-label text-left" for="recommend">Would you recommend our service to others?</label>
                                    <!--/Blue select-->

                                    @if ($errors->has('recommend'))
                                        <span class="text-danger">{{ $errors->first('recommend') }}</span>
                                    @endif
                                </div>
                                <!-- Grid column -->

                                <!-- Grid column -->
                                <div class="col-12 col-lg-4">
                                    <!-- Material input -->
                                    <div class="md-form">
                                        <input name="rating" type="number" value="{{ $recommendation->rating }}" class="form-control" id="" step="0.5" min="0" max="5">
                                        <label for="rating">How would you rate us from 1-5? 5 being the best</label>
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
                                      <textarea name="suggestions" id="" class="md-textarea form-control" rows="5">{{ old('suggestions') ? old('suggestions') : $recommendation->suggestions }}</textarea>
                                      <label for="suggestions">Is there anything we could have done differently?</label>
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
                                      <textarea name="tell_someone" id="" class="md-textarea form-control" rows="5">{{ old('tell_someone') ? old('tell_someone') : $recommendation->tell_someone }}</textarea>
                                      <label for="tell_someone">In the below section please provide a review or comment.</label>
                                    </div>

                                    @if ($errors->has('tell_someone'))
                                        <span class="text-danger">{{ $errors->first('tell_someone') }}</span>
                                    @endif
                                </div>
                                <!-- Grid column -->

                                <div class="col-md-12">

                                    <div class="md-form" id="">

                                        <div class="form-inline pt-5 ml-0" id="">
                                            <div class="btn-group">
                                                <button type="button" class="btn activeYes showTestimonial{{ $recommendation->show_testimonial == true ? ' btn-success active' : ' btn-blue-grey' }}">
                                                    <input type="checkbox" name="show_testimonial" value="1" {{ $recommendation->show_testimonial == true ? 'checked' : '' }} hidden />Yes
                                                </button>
                                                <button type="button" class="btn activeNo showTestimonial{{ $recommendation->show_testimonial == false ? ' btn-danger active' : ' btn-blue-grey' }}">
                                                    <input type="checkbox" name="show_testimonial" value="0" {{ $recommendation->show_testimonial == false ? 'checked' : '' }} hidden />No
                                                </button>
                                            </div>
                                        </div>

                                        <label for="show_client">Show Survey Results</label>
                                    </div>
                                </div>

                                <!-- Grid column -->
                                <div class="col-12 mb-3">
                                    <button class='btn btn-outline-dark-green' type='submit'>Save <i class="fas fa-save"></i></button>
                                </div>
                                <!-- Grid column -->
                            </div>
                        </form>
                        <!-- Testimonial Form -->
                    </div>
                </div>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
    </div>
    <!-- Testimonial -->

@endsection