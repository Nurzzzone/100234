<?php

namespace Nurzzzone\AdminPanel\Support\Contracts;

use Illuminate\Pagination\AbstractPaginator;

/**
 * @className Paginatable
 * @package Nurzzzone\AdminPanel\Support\Contracts
 */
interface Paginatable
{
    public function pagination(): AbstractPaginator;
}
