<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilialPhone extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'type',
        'phone'
    ];

    protected const FILIAL_DIRECTOR_MOBILE_PHONE = 1;
    protected const FILIAL_DIRECTOR_CITY_PHONE = 2;
    protected const AP_PHONE = 3;
    protected const MOBIL_PHONE = 4;

    /** ========================================== END: ATTRIBUTES ================================================= */

    /** ============================================================================================================ */

    /** ============================================================================================================ */

    protected function getTypeAttribute($value): string
    {
        switch ($value) {
            case self::FILIAL_DIRECTOR_CITY_PHONE:
            case self::FILIAL_DIRECTOR_MOBILE_PHONE:
                return 'Контакты';
            case self::AP_PHONE:
                return 'Автозапчасти';
            case self::MOBIL_PHONE:
                return 'Mobil';
            default:
                return $value;
        }
    }
}
