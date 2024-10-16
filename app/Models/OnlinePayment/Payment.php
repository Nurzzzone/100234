<?php

namespace App\Models\OnlinePayment;

use App\Models\Outside\Outside;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Outside
{
    use HasFactory;

    protected $table = 'payments';

    protected $keyType = 'string';

    public $incrementing = false;

    /** @var string[]  */
    public static $types = [
        'PURCHASE'  => 'Покупка на сайте',
        'DEPOSIT'   => 'Пополнение счета',
        'DEPT'      => 'Погашение долга'
    ];

    public function getAmountAttribute(float $value): string
    {
        return number_format($value, 0, '.', ' ');
    }

    protected function getTypeAttribute(string $value): ?string
    {
        return static::$types[$value] ?? null;
    }
}
