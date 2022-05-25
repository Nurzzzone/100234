<div class="modal fade text-left" id="update-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-footer">
                @php
                    $options = [
                        'method'      => 'PUT',
                        'id'          => 'editForm',
                        'data-url'    => $url
                    ];
                @endphp
                {{ Form::open($options) }}
                    <table class="table table-striped table-bordered datatable">
                        <tbody>
                        @include('partials.input', ['input' => 'text', 'field' => "name", 'current_value' => null, 'label' => trans('fields.name'), 'id' => 'menu-input-name'])
                        @include('partials.input', ['input' => 'text', 'field' => "href", 'current_value' => null, 'label' => trans('fields.uri'), 'id' => 'menu-input-link'])
                        @include('partials.input', ['input' => 'text', 'field' => "icon", 'current_value' => null, 'label' => trans('fields.icon'), 'id' => 'menu-input-icon'])
                        @include('partials.select', ['field' => "parent_id", 'select_options' => $parents, 'default' => null, 'locale' => 'fields.parent', 'id' => 'menu-input-parent' ])
                        @include('partials.select', ['field' => "slug", 'select_options' => $slugs, 'default' => null, 'locale' => 'fields.type', 'id' => 'menu-input-slug',])
                        {{ Form::hidden('sequence', null, ['id' => 'menu-input-sequence']) }}
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end align-content-center">
                        {{ Form::button( trans('buttons.close'), ['class' => 'btn btn-light', 'type' => 'button', 'data-dismiss'=>'modal']) }}
                        {{ Form::button( trans('buttons.save'), ['class' => 'btn btn-success ml-1', 'type' => 'submit', 'id' => 'submit-edit-form-button']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>