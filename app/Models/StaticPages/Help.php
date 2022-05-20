<?php

namespace App\Models\StaticPages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $table = 'help';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    public function dropdown()
    {
        return $this->hasMany(DropDown::class, 'page_id', 'GUID');
    }
}
