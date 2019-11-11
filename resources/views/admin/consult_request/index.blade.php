@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row" id="">

            <div class="col-12 col-md-6 border-right overflow-auto" id="">

                <h2 class="">Open Request</h2>

                @if($open_consults !== 0)

                    <div class="list-group-flush">

                        @foreach($open_consults as $consult)

                            <div class="list-group-item">

                                <div class="container-fluid" id="">

                                    <div class="row justify-content-between flex-column" id="">

                                        <div class="text-center">
                                            <p class=""><i class="far fa-image fa-2x mr-4 grey p-3 white-text rounded-circle" aria-hidden="true"></i>{{ $consult->full_name() }}</p>
                                        </div>

                                        <div class="text-center">
                                            <p class="">Received - <span class='text-muted'>{{ $consult->created_at->format('m/d/Y') }}</span></p>
                                        </div>

                                        <div class="mb-2">
                                            <button class='btn btn-outline-amber btn-block'>Respond</button>
                                        </div>

                                        <div class="mb-2">
                                            <button class='btn btn-outline-red btn-block'>Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-12 col-md-6 border-left" id="">

                <h2 class="">Responded Request</h2>
            </div>
        </div>
    </div>
@endsection