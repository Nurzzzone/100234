<?php

namespace App\Models\Product;

use App\Models\Outside\Outside;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductRemain extends Outside
{
    use HasFactory;

    protected $table = '1c_products_remains';

    protected $primaryKey = 'product';

    public $timestamps = false;

    public $incrementing = false;

    public function stores(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store', 'GUID');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product');
    }

}
