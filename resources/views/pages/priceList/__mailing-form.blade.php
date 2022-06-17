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
    @include('partials.select', ['field' => "interval", 'select_options' => $intervals, 'default' => array_key_first($intervals), 'locale' => 'Периодичность'])
    @include('partials.select', ['field' => "withDiscount", 'select_options' => ['0' => 'Без Скидки', '1' => 'Со Скидкой'], 'default' => '0', 'locale' => 'Тип цены'])
    @include('partials.select', ['field' => "withRemains", 'select_options' => ['0' => 'Без остатков', '1' => 'С остатками'], 'default' => '0', 'locale' => 'Остатки'])
    @include('partials.select', ['field' => "withClientStores", 'select_options' => ['0' => 'По всем', '1' => 'Склады доступные для выбранного пользователя'], 'default' => '0', 'locale' => 'Склады'])
    </tbody>
</table>