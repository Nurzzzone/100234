<table class="table table-striped table-bordered datatable">
    <tbody>
    @include('partials.select', ['field' => "hierarchy_id", 'select_options' => $hierarchies, 'default' => $object->hierarchy_id, 'locale' => 'fields.category' ])
        @include('partials.active')
    </tbody>
</table>