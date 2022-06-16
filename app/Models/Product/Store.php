<?php

namespace App\Models\Product;

use App\Models\Outside\Outside;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Outside
{
    use HasFactory;

    protected $table = '1c_stores';
    protected $primaryKey = 'GUID';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'is_our' => 'boolean',
        'is_allow_order_other_regions' => 'boolean',
        'is_allow_pickup' => 'boolean',
        'is_allow_delivery' => 'boolean',
        'is_sale' => 'boolean',
    ];
}
