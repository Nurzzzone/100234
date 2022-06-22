<?php

namespace App\Models\Finance;

use App\Models\Outside\Outside;
use App\Models\User;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceListMailing extends Outside
{
    use HasFactory;

    public const UPDATED_AT = null;

    protected $table = 'price_list_mailing';

    protected $casts = [
        'config' => 'array'
    ];

    protected $hidden = [
        'payload'
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

    public static function getIntervals()
    {
        return (new PriceListMailing)->intervals();
    }

    protected function intervals()
    {
        return [
            CarbonInterval::day()->totalMinutes => 'раз в день (в 9:00)',
            CarbonInterval::days(2)->totalMinutes => 'раз в два дня (в 09:00 и 14:00)',
            CarbonInterval::week()->totalMinutes => 'раз в неделю (в понедельник в 9:00)',
            CarbonInterval::month()->totalMinutes => 'раз в месяц (один раз в месяц, с момента создания рассылки в 9:00)'
        ];
    }

    public function getIntervalAttribute($value): ?string
    {
        if (!is_null($value) && array_key_exists($value, $intervals = $this->intervals())) {
            return $intervals[$value];
        }

        return $value;
    }
}
