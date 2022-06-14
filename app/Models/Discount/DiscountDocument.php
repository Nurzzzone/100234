<?php

namespace App\Models\Discount;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Catalog\Entities\ProductManufacturer;

class DiscountDocument extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';
    protected $fillable = [
        'type',
        'initiator_id',
        'is_active',
        'start_date',
        'end_date',
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($user) {
            $user->discounts()->delete();
        });
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class, 'document_id', 'id');
    }


}
