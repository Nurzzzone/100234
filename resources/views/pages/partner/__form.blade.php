<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('partials.tr-text', ['data' => $object->GUID, 'label' => trans('fields.id'), 'tr' => 'text'])
        @include('partials.tr-text', ['data' => $object->FIO, 'label' => trans('fields.FIO'), 'tr' => 'text'])
        @include('partials.tr-text', ['data' => $object->email, 'label' => trans('fields.email'), 'tr' => 'text'])
        @include('partials.tr-text', ['data' => $object->phone, 'label' => trans('fields.phone'), 'tr' => 'text'])
        @include('partials.tr-text', ['data' => $object->bin, 'label' => trans('fields.bin'), 'tr' => 'text'])
        @include('partials.tr-text', ['data' => $object->is_sent ? 'да' : 'нет', 'label' => trans('fields.is_sent'), 'tr' => 'text'])
        @include('partials.tr-text', ['data' => $object->is_confirmed_1c ? 'да' : 'нет', 'label' => trans('fields.is_confirmed_1c'), 'tr' => 'text'])
        @include('partials.active', ['field' => 'is_confirmed_by_manager', 'label' => trans('fields.is_confirmed_site'), 'id' => 'is_confirmed_by_manager'])
    </tbody>
</table>
