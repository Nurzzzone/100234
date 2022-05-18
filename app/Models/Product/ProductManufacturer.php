<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Modules\Catalog\Models\ProductManufacturer
 *
 * @property string $GUID GUID элемента иерархии
 * @property string $name название производителя
 */
class ProductManufacturer extends Model
{
    use HasFactory;

    /** ========================================== START: ATTRIBUTES =============================================== */

    protected $connection = 'adkulan_dev';
    protected $table = '1c_manufacturers';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    /** ========================================== END: ATTRIBUTES ================================================= */

    /** ============================================================================================================ */
}
