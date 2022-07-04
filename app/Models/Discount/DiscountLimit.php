<?php

namespace App\Models\Discount;

use App\Models\Outside\Outside;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountLimit extends Outside
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'discountable_id',
        'type',
        'role_id',
        'limit',
    ];


    public function roleLimits()
    {
        return $this->hasMany(self::class, 'discountable_id', 'discountable_id');
    }



//    public function discount_object(){
//        return $this->(self::class, 'discountable_id', 'discountable_id');
//
//    }

}
