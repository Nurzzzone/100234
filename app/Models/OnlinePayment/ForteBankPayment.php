<?php

namespace App\Models\OnlinePayment;

use App\Models\Outside\Outside;
use App\Models\Traits\FormatDatetime;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

    public const PAYMENT_STATUS = [
        'APPROVED' => 'Оплачен',
        'CREATED' => 'Заказ создан',
        'DECLINED' => 'Отказ в оплате',
        'EXPIRED' => 'Время оплаты истекло',
        'CANCELED' => 'Заказ отменен',
        'ERROR' => 'Ошибка',
        'CONNECTION_ERROR' => 'Ошибка подключения к серверу',
    ];

    public function payment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function scopeTableQuery(Builder $query): Builder
    {
        return $query->with('payment')->orderByDesc('created_at');
    }
}
