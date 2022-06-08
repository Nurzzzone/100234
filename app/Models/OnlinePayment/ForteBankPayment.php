<?php

namespace App\Models\OnlinePayment;

use App\Models\Outside\Outside;
use App\Models\Traits\FormatDatetime;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForteBankPayment extends Outside
{
    use HasFactory, FormatDatetime;

    /**
     * @var string
     */
    protected $table = 'payments_forte';

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var bool
     */
    public $incrementing = false;

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
