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

    public const HALYK = '770c11d0-e0a5-4d7d-a0a7-9de7da27bf14';
    public const FORTE = '547c5a63-89d5-4862-a391-ff43cd1dcfc8';
    public const KASPI_QR = '6a4ddda4-d984-459b-b3f4-f63c4b93ce32';

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

    public function isHalykBank(): bool
    {
        return $this->getKey() === self::HALYK;
    }

    public function isForteBank(): bool
    {
        return $this->getKey() === self::FORTE;
    }

    public function isKaspiQr(): bool
    {
        return $this->getKey() === self::KASPI_QR;
    }
}
