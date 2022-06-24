<?php

namespace App\Models\Delivery;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
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
