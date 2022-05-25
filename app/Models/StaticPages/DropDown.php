<?php

namespace App\Models\StaticPages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropDown extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $table = 'drop_down';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [

    ];
}
