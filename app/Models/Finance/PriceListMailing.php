<?php

namespace App\Models\Finance;

use App\Models\Outside\Outside;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceListMailing extends Outside
{
    use HasFactory;

    public const UPDATED_AT = null;

    protected $table = 'price_list_mailing';

    protected $casts = [
        'config' => 'array'
    ];

    protected $appends = [
        'editUrl'
    ];

    protected $fillable = [
        'user_id',
        'payload',
        'config',
        'interval',
        'mail_at',
        'mailed_at',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'GUID');
    }

    protected function getEditUrlAttribute(): string
    {
        return route('priceList.edit', $this->getKey());
    }
}
