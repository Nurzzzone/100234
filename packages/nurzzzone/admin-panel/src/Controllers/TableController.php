<?php

namespace Nurzzzone\AdminPanel\Controllers;

use Nurzzzone\AdminPanel\Controllers\Contracts\FromTable;

abstract class TableController extends Controller implements FromTable
{
    public function index()
    {
        $table = $this->fromTable();

        if (! request()->ajax()) {
            return $table->render();
        }

        if (! $table->isPaginationEnabled()) {
            return $table->collection();
        }

        return $table->pagination();
    }
}