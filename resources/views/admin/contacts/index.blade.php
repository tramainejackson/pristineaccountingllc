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

            <div class="row mb-5" id="">

                <div class="row row-cols-1{{ $contacts->count() < 2 ? '' : ' row-cols-md-2' }}{{ $contacts->count() <= 2 ? '' : ' row-cols-lg-3' }}{{ $contacts->count() < 4 ? '' : ' row-cols-xl-4' }} mx-auto mb-4" id="">
    
                    @foreach($contacts as $contact)

                        <!-- Card col -->
                        <div class="col text-center">
    
                            <!-- Card -->
                            <div class="card mb-4">
    
                                <div class="card-body">
    
                                    <h5 class="card-title d-flex align-items-center justify-content-between{{ $contacts->count() < 4 ? '' : ' flex-xl-column-reverse' }}">{{ $contact->full_name()  }} <a href="{{ route('consult_contacts.edit', ['consult_contact' => $contact->id]) }}" class="btn-floating btn-sm btn-warning"><i class="fas fa-edit"></i></a></h5>
                                    <p class="card-text">{{ $contact->email }}</p>
                                    <p class="card-text">{{ $contact->phone }}</p>
    
                                </div>
                            </div>

                        </div>
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
