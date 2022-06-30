<?php

namespace App\Models\Delivery;

use App\Models\Outside\Outside;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Outside
{
    use HasFactory;

    /** ========================================== START: ATTRIBUTES =============================================== */

    protected $table = 'client_address';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    public const UPDATED_AT = NULL;

    protected $hidden = [
        'client_type',
        'created_at'
    ];

    protected $fillable = [
        'GUID',
        'name',
        'address',
        'additional_info',
        'longitude',
        'latitude',
        'client',
        'is_main',
        'comment'
    ];

    protected $casts = [
        'is_main' => 'boolean'
    ];


    /** ========================================== END: ATTRIBUTES ================================================= */

    /** ============================================================================================================ */

    /** ========================================== START: RELATIONS ================================================ */
}
