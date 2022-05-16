<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('partials.input', ['input' => 'text', 'field' => "business_region", 'current_value' => $object->business_region, 'label' => trans('fields.business_region'), 'disabled' => true])
        @include('partials.input', ['input' => 'text', 'field' => "address", 'current_value' => $object->address, 'label' => trans('fields.address')])
        @include('partials.input', ['input' => 'email', 'field' => "email", 'current_value' => $object->email, 'label' => trans('fields.email')])
    </tbody>
</table>

<h5 class="mb-3">Номера телефонов</h5>

<table class="table table-striped table-bordered datatable">
    <tbody>
        @foreach($object->phones as $child)
            @include('partials.input', ['input' => 'text', 'field' => "phones[$child->GUID]", 'current_value' => $child->phone, 'label' => $child->type])
        @endforeach
    </tbody>
</table>

<h5 class="mb-3">График работы</h5>

<table class="table table-striped table-bordered datatable">
    <tbody>
        @foreach($object->schedules as $child)
            @include('partials.input', ['input' => 'time', 'field' => "schedules[$child->GUID][]", 'current_value' => $child->start, 'label' => $child->type])
            @include('partials.input', ['input' => 'time', 'field' => "schedules[$child->GUID][]", 'current_value' => $child->end, 'label' => ''])
        @endforeach
    </tbody>
</table>

<h5 class="mb-3">Местоположение</h5>

<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('partials.input-map', [
            'latitude' => $object->latitude,
            'longitude' => $object->longitude,
        ])
    </tbody>
</table>