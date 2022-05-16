<table @class(['table-hover' => $objects->isNotEmpty(), 'table table-responsive-sm table-bordered border-top-0 mb-0'])>
    <thead>
    <tr>
        @foreach ($columns as $key => $column)
            <th class="border-bottom-0 align-middle">@lang("fields.$key")</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach ($objects as $object)
            <tr data-name="tableRow" data-href="{{ route("$route.show", $object->getKey()) }}">
                @foreach ($columns as $column)
                    <td>{!! $object->$column !!}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>