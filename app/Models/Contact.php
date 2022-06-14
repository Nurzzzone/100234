<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $table = 'contacts';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = 'false';

    protected $fillable = [
        'address',
        'longitude',
        'latitude',
        'email',
    ];

    public const UPDATED_AT = null;
    public const CREATED_AT = null;

    /** ============================================================================================================ */

    /** ========================================== START: RELATIONS ================================================ */

    public function parent(): BelongsTo
    {
        return $this->belongsTo(BusinessRegion::class, 'business_region', 'GUID');
    }

    public function phones(): HasMany
    {
        return $this->hasMany(FilialPhone::class, 'contact_id', 'GUID');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(FilialSchedule::class, 'contact_id', 'GUID')->orderByRaw('FIELD(type, 2)');
    }

    /** ========================================== END: RELATIONS ================================================== */

    /** ============================================================================================================ */
}
