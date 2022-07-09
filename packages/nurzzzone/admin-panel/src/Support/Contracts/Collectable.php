<?php

namespace Nurzzzone\AdminPanel\Support\Contracts;

use Illuminate\Support\Collection;

/**
 * @className Collectable
 * @package Nurzzzone\AdminPanel\Support\Contracts
 */
interface Collectable
{
    public function collection(): Collection;
}
