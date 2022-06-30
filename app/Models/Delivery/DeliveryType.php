<?php

namespace App\Models\Delivery;

use App\Models\Outside\Outside;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Modules\Order\Entities\DeliveryType
 *
 * @property string $GUID ID способа доставки
 * @property string $name Наименование
 * @property float $cost Цена доставки
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class DeliveryType extends Outside
{
    use HasFactory;

    /** ========================================== START: ATTRIBUTES =============================================== */

    protected $table = 'delivery_type';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'cost'
    ];

    public const AIR_DELIVERY = '13812ee4-eb35-48d8-9eb6-31313be2b03c';
    public const AIR_DELIVERY_EXPRESS = '1dd6f796-d727-47a5-8d9a-b064b08902b9';

    /** ========================================== END: ATTRIBUTES ================================================= */

    /** ============================================================================================================ */

    /** ========================================== START: RELATIONS ================================================ */

}
