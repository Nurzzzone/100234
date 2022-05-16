<div class="modal fade text-left" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="myModalLabel120">{{ trans('messages.delete.header') }}</h5>
            </div>
            <div class="modal-body">@lang('messages.delete.body')</div>
            <div class="modal-footer">
                @php
                    $options = [
                        'method'      => 'DELETE',
                        'data-name'   => 'deleteForm',
                        'data-url'    => $url
                    ];
                @endphp
                {{ Form::open($options) }}
                {{ Form::button( trans('buttons.close'), ['class' => 'btn btn-light', 'type' => 'button', 'data-dismiss'=>'modal']) }}
                {{ Form::button( trans('buttons.delete'), ['class' => 'btn btn-danger ml-1', 'type' => 'submit', 'id' => 'delete-member']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
