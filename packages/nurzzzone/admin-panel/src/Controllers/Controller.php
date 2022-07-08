<?php

namespace Nurzzzone\AdminPanel\Controllers;

class Controller extends \Illuminate\Routing\Controller
{
    /**
     * @var string
     */
    protected $pageTitle;

    public function __construct()
    {
        \Illuminate\Support\Facades\View::share('pageTitle', $this->pageTitle);
    }
}
