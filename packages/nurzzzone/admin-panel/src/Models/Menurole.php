<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @className Menurole
 * @package Nurzzzone\AdminPanel\Models
 */
class Menurole extends Model
{
    protected $table = 'menu_role';
    public $timestamps = false;

    protected $fillable = [
        'role_name',
        'menus_id'
    ];
}
