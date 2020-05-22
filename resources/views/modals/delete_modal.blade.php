<div class="modal fade" id="delete_modal" role="dialog" aria-hidden="true" tabindex="1">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body text-dark">

                <div class="">
                    <p class="ml-2 text-muted"><u>{{ $title }}</u></p>
                    <p class="ml-4">{{ $slot }}</p>
                </div>

                <form action="{{ action($controller, $id) }}" method="POST" class="">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="form-group d-flex align-items-center justify-content-center">
                        <button class="btn btn-danger" type="submit">Delete</button>
                        <button class="btn btn-warning cancelBtn" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>