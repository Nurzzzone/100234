<?php

namespace App\Models\Product;

use App\Models\Outside\Outside;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductRemain extends Outside
{
    use HasFactory;

    protected $table = '1c_products_remains';

    protected $primaryKey = 'product';

    public $timestamps = false;

    public $incrementing = false;

    public function productStore()
    {
        return $this->belongsTo(Store::class, 'store', 'GUID');
    }
}
