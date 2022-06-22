<?php

namespace App\Support\View\TableConfig\Finance;

use App\Support\View\TableConfig\TableConfig;

class PriceListMailingTableConfig extends TableConfig
{
    public function __construct()
    {
        $this->searchUrl = route('priceList.mailingList');
        $this->createUrl = route('priceList.mailingForm');
    }

    protected function columns(): array
    {
        return [
            ['label' => 'Клиент', 'columnName' => 'user_id'],
            ['label' => 'Эл.почта', 'columnName' => 'user.email'],
            ['label' => 'Производители', 'columnName' => 'config.manufacturers'],
            ['label' => 'Периодичность', 'columnName' => 'interval'],
            ['label' => 'Тип цены', 'columnName' => 'config.withDiscount'],
            ['label' => 'Остатки по складам', 'columnName' => 'config.withRemains'],
        ];
    }
}