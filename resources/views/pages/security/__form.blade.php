<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('partials.input', ['input' => 'text', 'field' => "title", 'current_value' => $object->title, 'label' => trans('fields.title')])
        @include('partials.textarea', ['field' => "content", 'current_value' => $object->content])
        @include('partials.active')
        @include('partials.active', ['field' => 'in_footer', 'label' => trans('fields.in_footer'), 'id' => 'in_footer'])
    </tbody>
</table>