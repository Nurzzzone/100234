<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartnershipApplication extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'GUID',
        'contragent_name',
        'bin',
        'name',
        'phone',
        'email',
        'business_region',
        'is_phys',
        'is_sent',
        'FIO',
        'is_confirmed',
        'is_confirmed_by_manager',
        'is_processed'
    ];

    protected $casts = [
        'cooperation_areas' => 'array',
        'is_sent' => 'boolean',
        'is_phys' => 'boolean'
    ];

    protected $appends = [
        'editUrl',
    ];
    /** ========================================== END: ATTRIBUTES ================================================= */

    /** ============================================================================================================ */

    /** ========================================== START: RELATIONS ================================================ */


//    /**
//     * Направления сотрудничества
//     *
//     * @return BelongsToMany
//     */
//    public function areas(): BelongsToMany
//    {
//        return $this->belongsToMany(CooperationArea::class, 'client_has_cooperation_areas', 'client', 'area', 'GUID', 'GUID');
//    }
    protected function getEditUrlAttribute(): ?string
    {
        return route('partner.edit', $this->getKey());
    }


    /** ========================================== END: RELATIONS ================================================== */

    /** ============================================================================================================ */
}
