<?php

namespace App\Models\Orders;

use App\Models\Outside\Outside;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * Modules\Order\Entities\OrderProducts
 *
 * @property string $GUID
 * @property string $order ID заказа
 * @property string $product ID товара
 * @property int $status 0 - товар в заказе, 1 - Заявка на рекламацию, 2 - Заявка на возврат
 * @property float $quantity Кол-во товара
 * @property float $discount Процент скидки
 * @property float $price_without_discount Цена без скидки
 * @property float $price_with_discount Цена со скидкой
 */
class OrderProducts extends Outside
{
    use HasFactory;

    protected $table = 'order_products';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    public function products(): HasOne
    {
        return $this->hasOne(Product::class, 'GUID', 'product');
    }
}
