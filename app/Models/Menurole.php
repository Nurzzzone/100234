<?php

namespace App\Models;

use App\Models\Outside\Outside;

class Menurole extends Outside
{
    protected $table = 'menu_role';
    public $timestamps = false;

    protected $fillable = [
        'role_name',
        'menus_id'
    ];
}
