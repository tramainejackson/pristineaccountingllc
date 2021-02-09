@extends('layouts.app')

@section('content')

    <!-- Testimonial -->
    <div class="container text-center text-md-left">

        <!-- Grid row -->
        <div class="row">

            <div class="col-12 text-center" id="">
                <h1 class="h1">Reviews</h1>

                @if(Auth::check())
                    <h5 class="h5 text-muted font-italic">Reviews Count: <span class="">{{ $recommendations->count() }}</span></h5>
                @endif
            </div>
        </div>

        <div class="row my-5" id="">


            @if(Auth::check())
                @if($recommendations->count() == 0)

                    <div class="col-12 text-center my-5" id="">
                        <h1 class="h1">You Do Not Currently Have Any Testimonials Yet. Click <a href="{{ route('consult_contacts.index') }}">here</a> to go to your contacts to send someone a testimonial to fill out</h1>
                    </div>

                @else

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3{{ $recommendations->count() < 4 ? '' : ' row-cols-xl-4' }} mx-auto" id="">

                        @foreach($recommendations as $recommendation)

                            <!-- Card deck -->
                            <div class="col text-center">

                                <!-- Card -->
                                <div class="card mb-4">

                                    <div class="card-body">

                                        <h5 class="card-title d-flex align-items-center justify-content-between{{ $recommendations->count() < 4 ? '': ' flex-xl-column-reverse' }}">
                                            <a href="{{ route('consult_contacts.edit', $recommendation->consultContact->id) }}">{{ $recommendation->consultContact->full_name() }}</a>
                                            <a href="{{ route('recommendations.edit', $recommendation->id) }}" class="btn-floating btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        </h5>
                                        <p class="card-text">{{ $recommendation->consultContact->email }}</p>
                                        <p class="card-text">{{ $recommendation->consultContact->phone }}</p>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                @if($get_show_recommendations->count() == 0)

                    <div class="col-12 text-center dark-grey-text" id="">
                        <!-- Section heading -->
                        <h4 class="font-weight-bold mb-4 pb-2 h4">We do not currently have any reviews to display. If you would like to leave a review, please fill out the form below.</h4>
                    </div>

                @else

                    <div class="col-12">

                        <section class="text-center dark-grey-text">

                            <div class="wrapper-carousel-fix">

                                <!-- Carousel Wrapper -->
                                <div id="carousel-example-1" class="carousel no-flex testimonial-carousel slide carousel-fade" data-ride="carousel" data-interval="false">

                                    <!--Slides-->
                                    <div class="carousel-inner" role="listbox">

                                        @foreach($get_show_recommendations as $recommendation)

                                            <!--Slide-->
                                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">

                                                <div class="testimonial">

                                                    <!--Avatar-->
                                                    <div class="avatar mx-auto mb-4">
                                                        <img src="{{ asset('storage/images/' . $recommendation->consultContact->avatar) }}" class="rounded-circle img-fluid" alt="First sample avatar image">
                                                    </div>
                                                    <!--Content-->
                                                    <p>
                                                        <i class="fas fa-quote-left"></i> {{ $recommendation->tell_someone }}.
                                                    </p>
                                                    <h4 class="font-weight-bold">{{ $recommendation->consultContact->full_name() }}</h4>

                                                    <!--Ratings-->
                                                    <div class="" id="">

                                                        @for($x=0; $x < floor((int)$recommendation->rating); $x++)
                                                            <i class="fas fa-star blue-text"> </i>
                                                        @endfor

                                                        @if(strlen($recommendation->rating) > 1)
                                                            <i class="fas fa-star-half-alt blue-text"> </i>
                                                        @endif
                                                    </div>

                                                    <!-- Loop Count -->
                                                    <div class="pt-5" id="">
                                                        <p class="text-muted">{{ $loop->iteration }} / {{ $loop->count }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Slide-->
                                        @endforeach

                                    </div>
                                    <!--Slides-->

                                    <!--Controls-->
                                    <a class="carousel-control-prev left carousel-control" href="#carousel-example-1" role="button"
                                       data-slide="prev">
                                        <span class="icon-prev" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next right carousel-control" href="#carousel-example-1" role="button"
                                       data-slide="next">
                                        <span class="icon-next" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                    <!--Controls-->
                                </div>
                                <!-- Carousel Wrapper -->
                            </div>
                        </section>
                        <!--Section: Content-->
                    </div>
                @endif
            @endif

            <div class="col-12 my-5" id="">
                <div class="divider-image" id=""></div>
            </div>

            <div class="col-12 my-5" id="">
                <h1 class="h1 text-center py-5">Please Leave A Review</h1>

                @include('content_parts.review_form')
            </div>
        </div>
        <!-- Grid row -->
    </div>
    <!-- Testimonial -->

@endsection