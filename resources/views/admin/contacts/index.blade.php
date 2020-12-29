@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row mb-5" id="">
            <div class="col-12 mb-3" id="">
                <button class='btn btn-light-green ml-0' type='button'><a href="{{ route('consult_contacts.create') }}" class="white-text">Create New Contact</a></button>
            </div>
        </div>

        <div class="row my-5" id="">
            <div class="col-12" id="">
                <h2>Contacts</h2>
            </div>
        </div>

        @if($contacts->isNotEmpty())
            <div class="row" id="">
    
                <div class="col-12" id="">
    
                    @foreach($contacts as $contact)
    
                        @if($loop->first || $loop->iteration % 5 == 1)
                        <!-- Card deck -->
                        <div class="card-deck flex-column flex-lg-row">
                        @endif
    
                            <!-- Card -->
                            <div class="card mb-4">
    
                                <div class="card-body">
    
                                    <h5 class="card-title d-flex align-items-center justify-content-between">{{ $contact->full_name()  }} <a href="{{ route('consult_contacts.edit', ['consult_contact' => $contact->id]) }}" class="btn-floating btn-sm btn-warning"><i class="fas fa-edit"></i></a></h5>
                                    <p class="card-text">{{ $contact->email }}</p>
                                    <p class="card-text">{{ $contact->phone }}</p>
    
                                </div>
                            </div>
    
                        @if($loop->last || $loop->iteration % 5 == 0)
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @else 

            <div class="row" id="">
    
                <div class="col-12 col-lg-8 text-center mx-auto" id="">
                    <h1>You do not have any current contacts listed</h1>
                </div>
            </div>
            
        @endif
    </div>
@endsection
