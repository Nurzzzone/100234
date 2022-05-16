<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessRegion extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';
    protected $table = '1c_business_regions';
    protected $primaryKey = 'GUID';
    protected $keyType = 'string';
    public $incrementing = false;
}
