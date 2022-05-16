<table @class(['table-hover' => $objects->isNotEmpty(), 'table table-responsive-sm table-bordered border-top-0 mb-0'])>
    <thead>
    <tr>
        @foreach ($columns as $translation => $column)
            <th class="border-bottom-0 align-middle">@lang("fields.$translation")</th>
        @endforeach
        <th class="border-bottom-0 align-middle"></th>
    </tr>
    </thead>
    <tbody>
        @foreach ($objects as $object)
            <tr data-name="tableRow" data-href="{{ route("$route.show", $object->GUID) }}">
                @foreach ($columns as $column)
                    <td>{!! $object->$column !!}</td>
                @endforeach
                <td>
                    <div class="btn-group d-flex">
                        <a href="{{ route("$route.edit", $object->GUID) }}" class="btn btn-outline-dark">
                            @lang('buttons.edit')
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>