@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row" id="">
            <div class="col-12 mb-3" id="">
                <a href="{{ route('consults.create') }}" class="btn btn-light-green white-text">Create New Request</a>
            </div>
        </div>

        {{--Select Which Request To Display--}}
        <div class="row align-content-center justify-content-center my-4 flex-column flex-md-row" id="">
            <button class='btn btn-light-green col-6 col-lg-2 requestBtn openRequestBtn' type='button'>Open Request</button>
            <button class='btn btn-outline-orange col-6 col-lg-2 requestBtn closedRequestBtn' type='button'>Completed Request</button>
        </div>
    </div>

    <div class="container">

        <div class="row pb-5" id="open_request">

            <div class="col-12" id="">

                <div class="d-flex align-items-center" id="">
                    <h2 class="d-inline-block text-underline">Open Request</h2>

                    {!! $open_consults !== 0 ? "<span class='badge badge-pill badge-info ml-3'>" . $open_consults . "</span>" : '' !!}
                </div>

                @if($open_consults !== 0)

                    <div class="list-group-flush">

                        @foreach(App\ConsultRequest::leastRecent() as $consult)

                            @if($consult->responded == 'N')

                                <div class="list-group-item">

                                    <div class="container-fluid" id="">

                                        <div class="row justify-content-between flex-column py-4" id="">

                                            <div class="col modal-row" id="">

                                                <div class="text-center">
                                                    <p class="d-flex align-items-center justify-content-center flex-column">
                                                        {{-- Client Avatar --}}
                                                        <img src="{{ asset('storage/images/' . $consult->consultContact->avatar) }}" class="img-fluid img-thumbnail rounded-circle" width="200" alt="Contact Avatar" />

                                                        {{-- Contact Link--}}
                                                        <a href="{{ route('consult_contacts.edit', $consult->consultContact->id) }}">{{ $consult->full_name() }}</a>
                                                    </p>
                                                </div>

                                                <div class="text-center">
                                                    <p class="">Received - <span class='text-muted'>{{ $consult->created_at->format('m/d/Y') }}</span></p>
                                                </div>

                                                <table id="" class="table table-bordered table-responsive-sm newModalContent">
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
                                                    <button class='btn btn-outline-amber btn-block' id="consults_{{ $consult->id }}" type="button" data-toggle="modal" data-target="#confirm_modal" onclick="event.preventDefault(); confirmModalUpdate(this);">Complete</button>
                                                </div>

                                                <div class="mb-2">
                                                    <button class='btn btn-outline-red btn-block' id="consults_{{ $consult->id }}" type="button" data-toggle="modal" data-target="#delete_modal" onclick="event.preventDefault(); deleteModalUpdate(this);">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="text-center">
                        <h3 class="h3 text-center mt-5">You do not have any current request</h3>
                    </div>
                @endif
            </div>
        </div>

        <div class="row d-none pb-5" id="completed_request">

            <div class="col-12" id="">

                <div class="d-flex align-items-center" id="">
                    <h2 class="d-inline-block text-underline">Completed Request</h2>{!! $consults_responses->count() !== 0 ? "<span class='badge badge-pill badge-info ml-3'>" . $consults_responses->count() . "</span>" : '' !!}
                </div>

                @if($consults_responses->count() !== 0)

                    <div class="list-group-flush">

                        @foreach($consults_responses as $response)

                            <div class="list-group-item">

                                <div class="container-fluid" id="">

                                    <div class="row justify-content-between flex-column py-4" id="">

                                        <div class="col modal-row" id="">

                                            <div class="text-center">
                                                <p class="d-flex align-items-center justify-content-center flex-column">
                                                     {{-- Client Avatar--}}
                                                    <img src="{{ asset('storage/images/' . $response->consultRequest->consultContact->avatar) }}" class="img-fluid img-thumbnail rounded-circle" width="200" alt="Contact Avatar" />

                                                    {{-- Contact Link --}}
                                                    <a href="{{ route('consult_contacts.edit', $response->consultRequest->consultContact->id) }}">{{ $response->consultRequest->full_name() }}</a>
                                                </p>
                                            </div>

                                            <div class="text-center">
                                                <p class="">Responded - <span class='text-muted'>{{ $response->created_at->format('m/d/Y') }}</span></p>
                                            </div>

                                            <table id="" class="table table-bordered table-responsive-sm newModalContent">

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
                                                <a class='btn btn-outline-green btn-block' href="{{ route('consults.edit', $response->consultRequest->id) }}">Draft A New Contract</a>
                                            </div>

                                            <div class="mb-2">
                                                <button class='btn btn-outline-red btn-block' id="consultResponses_{{ $response->id }}" type="button" data-toggle="modal" data-target="#delete_modal" onclick="event.preventDefault(); deleteModalUpdate(this);">Remove</button>
                                            </div>
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

    @component('modals.delete_modal', ['title' => 'Delete Open Consult Request'])
        This will permanently delete this current consultation request or consultation response.
    @endcomponent

    @component('modals.confirm_modal', ['title' => 'Complete Open Consult Request'])
        This will move this current consultation request to the completed request.
    @endcomponent
@endsection