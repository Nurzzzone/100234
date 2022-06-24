<?php

namespace App\Models\Discount;

use App\Models\Users\B2bClients;
use App\Models\Product\ProductManufacturer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $fillable = [
        'client',
        'document_id',
        'discountable_id',
        'percent',
    ];


    public function manufacturer()
    {
        return $this->hasOne(ProductManufacturer::class, 'GUID', 'discountable_id' );
    }

    public function client()
    {
        return $this->hasOne(B2bClients::class, 'GUID', 'client_id');
    }
}
