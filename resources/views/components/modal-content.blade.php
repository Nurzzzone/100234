<div class="modal fade text-left" id="{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable {{ $class }}" role="document">
        <div class="modal-content">
            <div class="modal-footer">
                {{ Form::open(array_merge(['method' => $method, 'url' => $action], $options)) }}
                {{ $slot }}
                <div class="d-flex justify-content-end align-content-center">
                    {{ Form::button( trans('buttons.close'), ['class' => 'btn btn-light', 'type' => 'button', 'data-dismiss'=>'modal']) }}
                    {{ Form::button( trans('buttons.save'), ['class' => 'btn btn-success ml-1', 'type' => 'submit', 'id' => 'submit-edit-form-button']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>