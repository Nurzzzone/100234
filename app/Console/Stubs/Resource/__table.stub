<table @class(['table-hover' => $objects->isNotEmpty(), 'table table-responsive-sm table-bordered border-top-0 mb-0'])>
    <thead>
    <tr>
        @foreach ($columns as $key => $column)
            <th class="border-bottom-0 align-middle">@lang("fields.$key")</th>
        @endforeach
        <th class="border-bottom-0 align-middle"></th>
    </tr>
    </thead>
    <tbody>
        @foreach ($objects as $object)
            <tr data-name="tableRow" data-href="{{ route("$route.show", $object->getKey()) }}">
                @foreach ($columns as $column)
                    <x-entity-column :object="$object" column="{{ $column }}"></x-entity-column>
                @endforeach
                <td>
                    <div class="btn-group d-flex">
                        <a href="{{ route("$route.edit", $object->getKey()) }}" class="btn btn-outline-dark">
                            @lang('buttons.edit')</a>
                        <button type="button" 
                            data-toggle="modal" 
                            data-name="deleteModalButton"
                            data-target="{{ $object->getKey() }}"
                            class="btn btn-outline-dark">@lang('buttons.delete')</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>