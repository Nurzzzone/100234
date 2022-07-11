<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @className Menu
 * @package Nurzzzone\AdminPanel\Models
 * @method static Builder dropdown()
 */
class Menus extends Model
{
    protected $table = 'menus';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'href',
        'icon',
        'sequence',
        'parent_id',
        'menu_id'
    ];

    public const MENU_ELEMENT_TYPES = [
        'link' => 'Ссылка',
        'dropdown' => 'Выпадающий список',
        'title' => 'Заголовок'
    ];

    public function scopeDropdown(Builder $query): Builder
    {
        return $query->where('slug', 'dropdown')->orderBy('name');
    }
}
