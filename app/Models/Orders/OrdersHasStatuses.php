<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Modules\Order\Entities\Statuses
 *
 * @property int $id
 * @property int $site_status_id
 * @property int $onec_status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class OrdersHasStatuses extends Model
{

    protected $connection = 'adkulan_dev';

    protected $table = 'order_status_1c';

    public function hasStatus(): HasOne
    {
        return $this->hasOne(OrderStatus::class, 'id', 'site_status_id');
    }
}
