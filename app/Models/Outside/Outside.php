<?php

namespace App\Models\Outside;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outside extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';
}
