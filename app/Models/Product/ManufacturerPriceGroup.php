<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManufacturerPriceGroup extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $table =  'manufacturers_price_groups';

}
