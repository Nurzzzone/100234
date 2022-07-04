<?php

namespace App\Models\OnlinePayment;

use App\Models\Outside\Outside;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentType extends Outside
{
    use HasFactory;

    /** ========================================== START: ATTRIBUTES =============================================== */

    public const ONLINE = '62fa1465-238b-4125-ae2b-70673fadc074';

    protected $table = 'payment_type';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    public const UPDATED_AT = NULL;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at'
    ];

    /** ========================================== END: ATTRIBUTES ================================================= */

    /** ============================================================================================================ */
}
