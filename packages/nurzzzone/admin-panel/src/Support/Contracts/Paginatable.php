<?php

namespace Nurzzzone\AdminPanel\Controllers\Contracts;

use Illuminate\Pagination\AbstractPaginator;

/**
 * @className Paginatable
 * @package Nurzzzone\AdminPanel\Support\Contracts
 */
interface Paginatable
{
    public function pagination(): AbstractPaginator;
}