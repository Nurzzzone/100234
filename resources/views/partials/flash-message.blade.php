@if(Session::has('message'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success" role="alert">{{ Session::get('message') }}
                <button id="dismiss-success-button" type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif
@if(Session::has('error'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger" role="alert">{{ Session::get('error') }}
                <button id="dismiss-error-button" type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif

{{-- FLASH-MESSAGE для заказов --}}
<div class="row d-none" id="success-flash-alert">
    <div class="col-12">
        <div class="alert alert-success" role="alert">
            <button id="dismiss-success-button" type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
<div class="row d-none" id="error-flash-alert">
    <div class="col-12">
        <div class="alert alert-danger" role="alert">
            <button id="dismiss-error-button" type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
{{-- FLASH-MESSAGE для заказов --}}
