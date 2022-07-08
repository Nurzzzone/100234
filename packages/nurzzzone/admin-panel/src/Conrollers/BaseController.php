<?php

namespace Nurzzzone\AdminPanel\Controllers;

use Illuminate\Support\Facades\View;
use Nurzzzone\AdminPanel\Support\Component;

abstract class BaseController
{
    protected $pageTitle;

    public function __construct()
    {
        View::share('pageTitle', $this->pageTitle);
    }

    abstract protected function component(): Component;

    final protected function handleIndex()
    {
        if (request()->ajax()) {
            return $this->component()->handleAjaxRequest();
        }

        return $this->component()->getViewFilePath();
    }

    final protected function handleCreate()
    {
        //
    }

    final protected function handleEdit()
    {
        //
    }

    final protected function handleDelete()
    {
        //
    }
}
