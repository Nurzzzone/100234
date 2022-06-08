@if ($errors->any())
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger">
                <button type="button" class="close ml-3" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
