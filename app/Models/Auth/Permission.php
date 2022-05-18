<?php

namespace App\Models\Auth;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected $connection = 'mysql';

    public const MAKE_DISCOUNT = 'make discount';

}
