<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SalesAgent extends Model
{

    /** ========================================== START: ATTRIBUTES =============================================== */
    protected $connection = 'adkulan_dev';

    protected $table = '1c_sales_agents';

    protected $primaryKey = 'manager';

    protected $keyType = null;

    public $incrementing = false;

    public const UPDATED_AT = null;

    protected $hidden = [
        'pivot',
    ];

    /** ========================================== END: ATTRIBUTES ================================================= */

    /** ============================================================================================================ */

    /** ========================================== START: RELATIONS ================================================ */


    /** ========================================== END: RELATIONS ================================================== */

    /** ============================================================================================================ */
}
