<?php

namespace App\Models\Product;

use App\Models\Outside\Outside;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManufacturerPriceGroup extends Outside
{
    use HasFactory;

    protected $fillable = [];

    protected $table =  'manufacturers_price_groups';

}
