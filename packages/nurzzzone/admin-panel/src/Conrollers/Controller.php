<?php

namespace Nurzzzone\AdminPanel\Controllers;

use Illuminate\Support\Facades\View;

class Controller extends \App\Http\Controllers\Controller
{
    /**
     * @var string
     */
    protected $pageTitle;

    public function __construct()
    {
        View::share('pageTitle', $this->pageTitle);
    }
}
