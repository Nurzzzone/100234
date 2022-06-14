<?php

namespace App\Models\Discount;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountInCart extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $table = 'discount_in_carts';

}
