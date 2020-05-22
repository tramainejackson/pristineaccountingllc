@extends('layouts.app')

@section('content')

    <div class="container">

        <!--Section: Content-->
        <div class="row">

            <div class="col-12 text-center dark-grey-text" id="">
                <!-- Section heading -->
                <h3 class="font-weight-bold mb-4 pb-2">Testimonials</h3>
            </div>

            <div class="col">

                <section class="text-center dark-grey-text">

                    <div class="wrapper-carousel-fix">

                        <!-- Carousel Wrapper -->
                        <div id="carousel-example-1" class="carousel no-flex testimonial-carousel slide carousel-fade" data-ride="carousel" data-interval="false">

                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">

                                @foreach($recommendations as $recommendation)

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
                                            @for($x=0; $x < floor((int)$recommendation->rating); $x++)
                                                <i class="fas fa-star blue-text"> </i>
                                            @endfor

                                            @if(strlen($recommendation->rating) > 1)
                                                <i class="fas fa-star-half-alt blue-text"> </i>
                                            @endif
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
        </div>
        <!--Section: Content-->
    </div>

@endsection