<?php

namespace App\Models;

use App\Models\Outside\Outside;
use App\Models\Product\ProductRemain;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Outside
{
    use HasFactory;

    protected $table = '1c_products';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public function productRemains(): HasMany
    {
        return $this->hasMany(ProductRemain::class, 'product', 'GUID');
    }
}
