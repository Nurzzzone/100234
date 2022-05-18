<?php

namespace App\Models\Discount;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountLimit extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';
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
