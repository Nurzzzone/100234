<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Modules\Order\Entities\OrderStatus
 *
 * @property string $GUID
 * @property string $name
 * @property string $color
 * @property string $description
 * @property int $group_id
 * @property \Illuminate\Support\Carbon $created_at
 */
class OrderStatus extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $table = 'order_status';

    protected $primaryKey = 'GUID';

    public $incrementing = false;
}
