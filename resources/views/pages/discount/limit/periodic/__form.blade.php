<table class="table table-striped table-bordered datatable">
    <tbody>
    @include('partials.select', ['input' => 'text', 'label' => 'Производитель','field' => "manufacturer", 'select_options' => $manufacturers, 'locale' => trans('fields.manufacturer'), 'default' => $object->discountable_id ])

    @foreach($discount_makers  as $discount_maker)
        @include('partials.input', [
            'input' => 'number',
            'label' => $discount_maker->name,
            'field' => 'limit_' . $discount_maker->id,
            'current_value' => $discount_maker->limit,
            'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"
            ])
    @endforeach

    </tbody>
</table>
