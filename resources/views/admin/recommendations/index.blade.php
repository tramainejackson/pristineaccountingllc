@extends('layouts.app')

@section('content')

    <!-- Testimonial -->
    <div class="container text-center text-md-left">

        <!-- Grid row -->
        <div class="row">

            <div class="col-12 text-center" id="">
                <h1 class="h1">Testimonials</h1>
            </div>
        </div>

        <div class="row my-5" id="">

            @if($recommendations->count() < 1)
                <div class="col-12 text-center my-5" id="">
                    <h2 class="h2">You Do Not Currently Have Any Testimonials Yet. Click <a href="{{ route('consult_contacts.index') }}">here</a> to go to your contacts to send someone a testimonial to fill out</h2>
                </div>
            @else
                <div class="col-12 text-center" id="">
                    @foreach($recommendations as $recommendation)

                        @if($loop->first || $loop->iteration % 5 == 1)
                            <!-- Card deck -->
                            <div class="card-deck flex-column flex-lg-row">
                            @endif

                            <!-- Card -->
                                <div class="card mb-4">

                                    <div class="card-body">

                                        <h5 class="card-title d-flex align-items-center justify-content-between">{{ $recommendation->consultContact->full_name()  }} <a href="{{ route('consult_contacts.edit', ['consult_contact' => $recommendation->consultContact->id]) }}" class="btn-floating btn-sm btn-warning"><i class="fas fa-edit"></i></a></h5>
                                        <p class="card-text">{{ $recommendation->consultContact->email }}</p>
                                        <p class="card-text">{{ $recommendation->consultContact->phone }}</p>

                                    </div>
                                </div>

                                @if($loop->last || $loop->iteration % 5 == 0)
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

        </div>
        <!-- Grid row -->
    </div>
    <!-- Testimonial -->

@endsection