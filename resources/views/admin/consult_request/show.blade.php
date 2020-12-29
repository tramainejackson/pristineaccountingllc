@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row" id="">
            <div class="col-12 mb-3" id="">
                <button class='btn btn-light-green ml-0' type='button'><a href="{{ route('consults.create') }}" class="white-text">Create New Request</a></button>
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
                                                <button class='btn btn-outline-red btn-block deleteBtn' type="button" data-toggle="modal" data-target="#delete_modal">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @component('modals.delete_modal', ['title' => 'Delete Open Consult Request', 'controller' => 'ConsultContactController@destroy', 'id' => $consult->id])
                                    This will permanently delete this current consultation request.
                                    <br/>Received - {{ $consult->created_at->format('m/d/Y') }}
                                    <br/>Name - {{ $consult->full_name() }}
                                    <br/>Type - {{ $consult->type == 'B' ? 'Business' : 'Personal' }}
                                    <br/>Service - {{ ucwords(str_ireplace("_", " ", $consult->service)) }}
                                    <br/>Email - {{ $consult->email }}
                                @endcomponent
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
                                            <form action="{{ action('AdminController@create_invoice', []) }}" method="POST" class="">
                                                {{ csrf_field() }}
                                                {{ method_field('POST') }}

                                                <button class='btn btn-outline-green btn-block'>Draft A New Contract</button>
                                            </form>
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