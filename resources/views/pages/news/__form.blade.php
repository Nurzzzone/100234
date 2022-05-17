<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('partials.input', ['input' => 'text', 'field' => "title", 'current_value' => $object->title, 'label' => trans('fields.title')])
        @include('partials.input', ['input' => 'text', 'field' => "description", 'current_value' => $object->description, 'label' => trans('fields.description')])
        @include('partials.image-field', ['current_image' => $object->image])
        @include('partials.textarea', ['field' => "content", 'current_value' => $object->content])
        @include('partials.active')
        @include('partials.active', ['field' => 'is_new', 'label' => trans('fields.is_new'), 'id' => 'is_new'])
        @include('partials.active', ['field' => 'in_main_page', 'label' => trans('fields.in_main_page'), 'id' => 'in_main_page'])
    </tbody>
</table>