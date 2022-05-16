<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilialSchedule extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $table = 'filial_schedule';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'type',
        'start',
        'end'
    ];

    protected const WEEKDAYS = 1;
    protected const WEEKENDS = 2;

    /** ========================================== END: ATTRIBUTES ================================================= */

    /** ============================================================================================================ */

    /** ============================================================================================================ */

    protected function getTypeAttribute($value): string
    {
        switch ($value) {
            case self::WEEKDAYS:
                return "Пн-Пт";
            case self::WEEKENDS:
                return "Сб-Вс";
            default:
                return $value;
        }
    }

    protected function getStartAttribute($value)
    {
        return Carbon::create($value)->format('H:i');
    }

    protected function getEndAttribute($value)
    {
        return Carbon::create($value)->format('H:i');
    }
}
