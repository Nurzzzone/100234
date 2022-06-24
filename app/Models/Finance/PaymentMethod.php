<?php

namespace App\Models\Finance;

use App\Models\Outside\Outside;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Outside
{
    use HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $appends = [
        'updateToggleUrl'
    ];

    protected $fillable = [
        'is_active'
    ];

    protected function getUpdateToggleUrlAttribute(): string
    {
        return route('paymentMethod.updateToggle', $this->getKey());
    }
}
