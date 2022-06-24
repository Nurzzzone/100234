<?php

namespace App\Models\Orders;

use App\Models\Delivery\Address;
use App\Models\Delivery\DeliveryType;
use App\Models\OnlinePayment\PaymentType;
use App\Models\Product;
use App\Models\Product\Store;
use App\Models\Users\B2bClients;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Order extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $table = 'orders';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $appends = [
        'editUrl'
    ];


    protected $fillable = [
        'receiver',
        'address',
        'status',
        'delivery',
        'payment',
        'number',
        'total_sum',
        'is_phys',
        'in_cash',
        'order_comment',
        'client_type',
        'delivery_sum'
    ];

    public function orderable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'client_type', 'client', 'GUID');
    }

    public function stores(): HasOne
    {
        return $this->hasOne(Store::class, 'GUID', 'store_id');
    }

    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class, 'payment', 'GUID');
    }

    public function addresses(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address', 'GUID');
    }

    public function receivers(): BelongsTo
    {
        return $this->belongsTo(B2bClients::class, 'client', 'GUID');
    }


    public function statuses(): HasOne
    {
        return $this->hasOne(OrdersHasStatuses::class, 'onec_status_id', 'status');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order', 'product', 'GUID', 'GUID')
            ->withPivot('GUID', 'quantity', 'price_with_discount', 'price_without_discount', 'discount');
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProducts::class, 'order', 'GUID');
    }

    public function deliveryType(): BelongsTo
    {
        return $this->belongsTo(DeliveryType::class, 'delivery', 'GUID');
    }


    public function isOnlinePayment()
    {
        return $this->payment == PaymentType::ONLINE;
    }

    protected function generateGUID()
    {
        $this->attributes['GUID'] = uuid4();
    }

    public function getCreatedAtAttribute($value): string
    {
        return Carbon::create($value)->toDateTimeString();
    }

    public function getDeliveryDateAttribute($value): string
    {
        return Carbon::create($value)->toDateTimeString();
    }

    public function getNumberAttribute($value): string
    {
        // TODO уточнить вариант номера заказа
        return str_pad((string) $value, 10, "0", STR_PAD_LEFT);
    }

    protected function getEditUrlAttribute(): ?string
    {
        return route('orders.edit', $this->getKey());
    }

}
