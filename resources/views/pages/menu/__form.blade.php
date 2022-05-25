<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('partials.input', ['input' => 'text', 'field' => "name", 'current_value' => $object->name ?? null, 'label' => trans('fields.name')])
        @include('partials.input', ['input' => 'text', 'field' => "href", 'current_value' => $object->href ?? null, 'label' => trans('fields.uri')])
        @include('partials.input', ['input' => 'text', 'field' => "icon", 'current_value' => $object->icon ?? null, 'label' => trans('fields.icon')])
        @include('partials.select', ['field' => "parent_id", 'select_options' => $parents, 'default' => null, 'locale' => 'fields.parent' ])
        @include('partials.select', ['field' => "slug", 'select_options' => $slugs, 'default' => null, 'locale' => 'fields.type'])
        {{ Form::hidden('sequence', null, ['id' => 'menu-input-sequence']) }}
    </tbody>
</table>