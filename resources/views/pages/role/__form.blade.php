<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('partials.input', ['input' => 'text', 'field' => "name", 'current_value' => $object->name, 'label' => trans('fields.name')])
    </tbody>
</table>