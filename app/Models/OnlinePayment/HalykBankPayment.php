<?php

namespace App\Models\OnlinePayment;

use App\Models\Outside\Outside;
use App\Models\Traits\FormatDatetime;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HalykBankPayment extends Outside
{
    use HasFactory, FormatDatetime;

    protected $table = 'payments_halyk';

    public function payment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
