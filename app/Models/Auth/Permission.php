<?php

namespace App\Models\Auth;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected $connection = 'adkulan_dev';

    public const MAKE_DISCOUNT = 'make discount';

}
