<table class="table table-bordered datatable">
    <tbody>
    <tr>
        <th class="align-middle">Пользователь</th>
        <td>
            <select class="selectpicker form-control" name="user_id" data-live-search="true" title="Выберите пользователя">
                @foreach($users as $id => $userEmail)
                    <option value="{{ $id }}">{{ $userEmail }}</option>
                @endforeach
            </select>
        </td>
    </tr>
    @include('partials.select', ['field' => "priceListType", 'select_options' => ['0' => 'По производителям', '1' => 'По ценовым группам'], 'default' => '0', 'locale' => 'Скачать по', 'id' => 'price-list-type'])
        <tr id="manufacturers">
            <th class="align-middle">Производители</th>
            <td>
                <select class="selectpicker form-control" name="manufacturers[]" data-actions-box="true" multiple data-live-search="true" title="Выберите производителя">
                    @foreach($manufacturers as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        @include('partials.select', ['field' => "priceGroup", 'select_options' => ['0' => 'Автозапчасти', '1' => 'Партнеры'], 'default' => '0', 'locale' => 'Ценовые группы', 'tr_id' => 'price-groups'])
        @include('partials.select', ['field' => "withDiscount", 'select_options' => ['0' => 'Без Скидки', '1' => 'Со Скидкой'], 'default' => '0', 'locale' => 'Тип цены'])
        @include('partials.select', ['field' => "withRemains", 'select_options' => ['0' => 'Без остатков', '1' => 'С остатками'], 'default' => '0', 'locale' => 'Остатки'])
        @include('partials.select', ['field' => "withClientStores", 'select_options' => ['0' => 'По всем', '1' => 'Склады доступные для выбранного пользователя'], 'default' => '0', 'locale' => 'Склады'])
    </tbody>
</table>