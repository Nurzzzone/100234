<?php

namespace App\Models\Discount;

use App\Models\Outside\Outside;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountInCart extends Outside
{
    use HasFactory;

    protected $fillable = [];

    protected $table = 'discount_in_carts';

}
