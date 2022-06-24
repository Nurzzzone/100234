<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $table = '1c_managers';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    public const UPDATED_AT = NULL;

    protected $appends = [
        'editUrl',
    ];


    protected function getEditUrlAttribute(): ?string
    {
        return route('managers.edit', $this->getKey());
    }

}
