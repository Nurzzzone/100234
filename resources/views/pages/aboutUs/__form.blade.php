<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('partials.input', ['input' => 'text', 'field' => "title", 'current_value' => $object->title, 'label' => trans('fields.title')])
        @include('partials.image-field', ['current_image' => $object->image])
        @include('partials.textarea', ['field' => "description",'current_value' => $object->description])
        @include('partials.active')
    </tbody>
</table>