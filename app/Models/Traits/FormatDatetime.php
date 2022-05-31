<?php

namespace App\Models\Traits;

use Carbon\Carbon;

trait FormatDatetime
{
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('H:i:s d-m-Y');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('H:i:s d-m-Y');
    }
}