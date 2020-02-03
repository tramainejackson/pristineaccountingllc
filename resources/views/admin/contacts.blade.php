@extends('layouts.app')

@section('content')

    @if (session('status'))
        <script type="text/javascript">
            toastr.success("Calendar showing updated", "", {showMethod: 'slideDown'});
        </script>
    @endif

    <div class="container-fluid">

        <div class="row" id="">

            <div class="col-12" id="">
                <h2>Contacts</h2>
            </div>
        </div>

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

                                <h5 class="card-title d-flex align-items-center justify-content-between">{{ $contact->full_name()  }} <a href="/consults" class="btn-floating btn-sm btn-warning"><i class="fas fa-edit"></i></a></h5>
                                <p class="card-text">{{ $contact->email }}</p>

                            </div>
                        </div>

                    @if($loop->last || $loop->iteration % 5 == 0)
                    </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="row" id="">

            <div class="col-12 col-lg-8" id="">


            </div>
        </div>
    </div>
@endsection