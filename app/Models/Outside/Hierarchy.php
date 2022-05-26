<?php

namespace App\Models\Outside;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hierarchy extends Outside
{
    use HasFactory;

    protected $table = '1c_hierarchy';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $hidden = [
        'is_group',
        'is_visible_mainpage',
        'image_url',
        'code',
        'parent',
        'laravel_through_key'
    ];
}
