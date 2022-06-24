
<h5 class="mb-3">Данные получателя</h5>

<table class="table table-striped table-bordered datatable">
    <tbody>
    @include('partials.tr-text', ['data' => $orderInfo['receiver']['name'], 'label' => trans('fields.name'), 'tr' => 'text'])
    @include('partials.tr-text', ['data' => $orderInfo['receiver']['phone'], 'label' => trans('fields.phone'), 'tr' => 'text'])
    @include('partials.tr-text', ['data' => $orderInfo['receiver']['email'], 'label' => trans('fields.email'), 'tr' => 'text'])
    @include('partials.tr-text', ['data' => $orderInfo['receiver']['bin'], 'label' => trans('fields.bin'), 'tr' => 'text'])
    @include('partials.tr-text', ['data' => $orderInfo['receiver']['is_partner'], 'label' => trans('fields.is_partner'), 'tr' => 'text'])
    </tbody>
</table>

<h5 class="mb-3">Данные о доставке</h5>

<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('partials.tr-text', ['data' => $orderInfo['delivery_data']['status_name'], 'label' => trans('fields.status'), 'tr' => 'text'])
        @include('partials.tr-text', ['data' => $orderInfo['delivery_data']['deliveryType'], 'label' => trans('fields.delivery'), 'tr' => 'text'])
        @include('partials.tr-text', ['data' => $orderInfo['delivery_data']['store_name'], 'label' => trans('fields.store'), 'tr' => 'text'])
        @include('partials.tr-text', ['data' => $orderInfo['delivery_data']['address'], 'label' => trans('fields.address'), 'tr' => 'text'])
    </tbody>
</table>


<h5 class="mb-3">Данные об оплате</h5>

<table class="table table-striped table-bordered datatable">
    <tbody>
    @include('partials.tr-text', ['data' => $orderInfo['payments']['type'], 'label' => trans('fields.payment'), 'tr' => 'text'])
    @include('partials.tr-text', ['data' => $orderInfo['payments']['product_count'], 'label' => trans('fields.product_count'), 'tr' => 'text'])
    @include('partials.tr-text', ['data' => $orderInfo['payments']['delivery'], 'label' => trans('fields.delivery'), 'tr' => 'text'])
    @include('partials.tr-text', ['data' => $orderInfo['payments']['pay_type'], 'label' => trans('fields.payment_type'), 'tr' => 'text'])
    </tbody>
</table>

