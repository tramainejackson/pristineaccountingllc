@extends('layouts.app')

@section('content')

    @if(session('status'))
        @section('additional_scripts')
            <script type="text/javascript">
                toastr.success("Request Moved To Completed", "Success", {showMethod: 'slideDown'});
            </script>
        @endsection
    @endif

    <div class="container-fluid">

        <div class="row" id="">
            <div class="col-12 mb-3" id="">
                <button class='btn btn-light-green' type='button'>Create New Request</button>
            </div>
        </div>

        <div class="row" id="">

            <div class="col-12 col-md-6 border-right overflow-auto" id="">

                <div class="d-flex justify-content-between align-items-center" id="">
                    <h2 class="d-inline-block">Open Request</h2>

                    {!! $open_consults !== 0 ? "<span class='badge badge-pill badge-info'>" . $open_consults->count() . "</span>" : '' !!}
                </div>

                @if($open_consults !== 0)

                    <div class="list-group-flush">

                        @foreach($open_consults as $consult)

                            @if($consult->responded == 'N')

                                <div class="list-group-item">

                                    <div class="container-fluid" id="">

                                        <div class="row justify-content-between flex-column py-4" id="">

                                            <div class="text-center">
                                                <p class=""><i class="far fa-image fa-2x mr-4 grey p-3 white-text rounded-circle" aria-hidden="true"></i>{{ $consult->full_name() }}</p>
                                            </div>

                                            <div class="text-center">
                                                <p class="">Received - <span class='text-muted'>{{ $consult->created_at->format('m/d/Y') }}</span></p>
                                            </div>

                                            <table id="" class="table table-bordered table-responsive-xl">
                                                <thead class="info-color-dark white-text">
                                                    <tr>
                                                        <th class="th-sm">Received<i class="" aria-hidden="true"></i></th>
                                                        <th class="th-sm">Name<i class="" aria-hidden="true"></i></th>
                                                        <th class="th-sm">Type<i class="" aria-hidden="true"></i></th>
                                                        <th class="th-sm">Service<i class="" aria-hidden="true"></i></th>
                                                        <th class="th-sm">Email<i class="" aria-hidden="true"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $consult->created_at->format('m/d/Y') }}</td>
                                                        <td>{{ $consult->full_name() }}</td>
                                                        <td>{{ $consult->type == 'B' ? 'Business' : 'Personal' }}</td>
                                                        <td>{{ ucwords(str_ireplace("_", " ", $consult->service)) }}</td>
                                                        <td>{{ $consult->email }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="mb-2">
                                                <button class='btn btn-outline-amber btn-block' onclick="event.preventDefault(); document.getElementById('response-form').submit();">Respond</button>

                                                <form id="response-form" action="{{ route('consult_responses.store') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    <input type="number" name="consult_request" value="{{ $consult->id }}">
                                                </form>
                                            </div>

                                            <div class="mb-2">
                                                <button class='btn btn-outline-red btn-block'>Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif()
                        @endforeach
                    </div>
                @endif
            </div>

            <hr class="col-12 border-dark d-md-none" />

            <div class="col-12 col-md-6 border-left" id="">

                <div class="d-flex justify-content-between align-items-center" id="">
                    <h2 class="d-inline-block">Completed Request</h2>{!! $consults_responses->count() !== 0 ? "<span class='badge badge-pill badge-info'>" . $consults_responses->count() . "</span>" : '' !!}
                </div>

                @if($consults_responses->count() !== 0)

                    <div class="list-group-flush">

                        @foreach($consults_responses as $response)

                            <div class="list-group-item">

                                <div class="container-fluid" id="">

                                    <div class="row justify-content-between flex-column py-4" id="">

                                        <div class="text-center">
                                            <p class=""><i class="far fa-image fa-2x mr-4 grey p-3 white-text rounded-circle" aria-hidden="true"></i>{{ $response->consultRequest->full_name() }}</p>
                                        </div>

                                        <div class="text-center">
                                            <p class="">Responded - <span class='text-muted'>{{ $response->created_at->format('m/d/Y') }}</span></p>
                                        </div>

                                        <table id="" class="table table-bordered table-responsive-xl">

                                            <thead class="stylish-color-dark white-text">
                                                <tr>
                                                    <th class="th-sm">Received<i class="" aria-hidden="true"></i></th>
                                                    <th class="th-sm">Name<i class="" aria-hidden="true"></i></th>
                                                    <th class="th-sm">Type<i class="" aria-hidden="true"></i></th>
                                                    <th class="th-sm">Service<i class="" aria-hidden="true"></i></th>
                                                    <th class="th-sm">Email<i class="" aria-hidden="true"></i></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>{{ $response->consultRequest->created_at->format('m/d/Y') }}</td>
                                                    <td>{{ $response->consultRequest->full_name() }}</td>
                                                    <td>{{ $response->consultRequest->type == 'B' ? 'Business' : 'Personal' }}</td>
                                                    <td>{{ ucwords(str_ireplace("_", " ", $response->consultRequest->service)) }}</td>
                                                    <td>{{ $response->consultRequest->email }}</td>
                                                </tr>
                                            </tbody>

                                            <thead class="stylish-color white-text">
                                                <tr>
                                                    <th class="th-sm" colspan="5">Response<i class="" aria-hidden="true"></i></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td colspan="5">{{ $response->response }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="mb-2">
                                            <button class='btn btn-outline-green btn-block'>Draft A New Contract</button>
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
        </div>
    </div>
@endsection