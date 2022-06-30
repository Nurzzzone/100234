<?php

namespace App\Models\Auth;

class Role extends \Spatie\Permission\Models\Role
{
    protected $connection = 'adkulan_dev';

    public const TRADE_REPRESENTATIVE_ID = 10;

    public const SUPERVISOR_ID = 11;

    public const FILIAL_DIRECTOR_ID = 2;

    public const PRODUCT_MANAGER_ID = 12;


}
