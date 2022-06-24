<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('partials.tr-text', ['data' => $object->GUID, 'label' => trans('fields.id'), 'tr' => 'text'])
        @include('partials.tr-text', ['data' => $object->FIO, 'label' => trans('fields.FIO'), 'tr' => 'text'])
        @include('partials.tr-text', ['data' => $object->email, 'label' => trans('fields.email'), 'tr' => 'text'])
        @include('partials.tr-text', ['data' => $object->phone, 'label' => trans('fields.phone'), 'tr' => 'text'])
        @include('partials.tr-text', ['data' => optional($object->b2bInfo)->bin, 'label' => trans('fields.bin'), 'tr' => 'text'])
    </tbody>
</table>
