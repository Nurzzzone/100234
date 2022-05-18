<?php

namespace App\Http\Controllers\Discounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountLimit\CreateDiscountLimitRequest;
use App\Http\Requests\DiscountLimit\UpdateDiscountLimitRequest;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Discount\DiscountLimit;
use App\Models\Product\ProductManufacturer;
use App\Traits\HasFlashMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DiscountLimitOnPeriodController extends Controller
{
    use HasFlashMessage;

    protected const COLUMNS = [
        'manufacturer' => 'manufacturer',
        'sales_agent_discount_limit' => 'limit_' . Role::TRADE_REPRESENTATIVE_ID,
        'supervisor_discount_limit' => 'limit_' . Role::SUPERVISOR_ID,
        'filial_director_discount_limit' => 'limit_' . Role::FILIAL_DIRECTOR_ID,
        'product_manager_discount_limit' => 'limit_' . Role::PRODUCT_MANAGER_ID,
    ];
    protected const MODEL = DiscountLimit::class;
    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'discount.limit.periodic';
        View::share('page_title', 'Лимит скидок на период');
    }

    public function index()
    {
        $manufacturersWithRoleLimits = (self::MODEL)::leftJoin('1c_manufacturers', 'discount_limits.discountable_id', '1c_manufacturers.GUID')
            ->select('id', 'limit', 'role_id', '1c_manufacturers.name as manufacturer', 'discountable_id')
            ->with('roleLimits')
            ->groupBy('discountable_id')
            ->paginate(10);

        $manufacturersWithRoleLimits->getCollection()->transform(function ($value) {
            foreach ($value->roleLimits as $roleLimit){
                $value->{'limit_' . $roleLimit->role_id} = $roleLimit->limit;
            }
            return $value;
        });

        return view("pages.{$this->route}.index",
            [
                'objects' => $manufacturersWithRoleLimits,
                'columns' => self::COLUMNS,
                'route' => $this->route,
            ]);
    }

    public function create()
    {
        $model = self::MODEL;
        $discount_makers = optional(Permission::with('roles')
            ->where('name', Permission::MAKE_DISCOUNT)
            ->first())
            ->roles;

        return view("pages.{$this->route}.create", [
            'object' => new $model(),
            'route' => $this->route,
            'manufacturers' => ProductManufacturer::get()->pluck('name', 'GUID'),
            'discount_makers' => $discount_makers
        ]);
    }

    public function store(CreateDiscountLimitRequest $request)
    {
        $fields = $request->validated();

        try {
            foreach ($request->validated() as $key => $value) {
                if (mb_strpos($key, 'limit') !== false) {
                    $limit = (self::MODEL)::query()->updateOrCreate([
                        'discountable_id' => $fields['manufacturer'],
                        'type' => 'manufacturer',
                        'role_id' => explode('_', $key)[1],
                    ], [
                        'limit' => $value
                    ]);
                    $limit->save();
                }
            }
        } catch (Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }

        return $this->flashSuccessMessage($request, "{$this->route}.index");
    }

    public function show(DiscountLimit $discountLimit)
    {
        //TODO переписать
        //Получить роли которые могут ставить скидки
        $discount_makers = optional(Permission::with('roles')
            ->where('name', Permission::MAKE_DISCOUNT)
            ->first()
        )->roles;

        // Получить лимиты по этим ролям и заданному бренду
        foreach ($discount_makers as $discount_maker) {
            $discount_maker['limit'] = optional((self::MODEL)::where('role_id', $discount_maker->id)
                ->where('discountable_id', $discountLimit->discountable_id)
                ->first()
            )->limit;
        }
        return view("pages.{$this->route}.show", [
            'object' => $discountLimit,
            'route' => $this->route,
            'manufacturers' => ProductManufacturer::get()->pluck('name', 'GUID'),
            'discount_makers' => $discount_makers
        ]);
    }

    public function edit(DiscountLimit $discountLimit)
    {
        //TODO переделать
        //Получить роли которые могут ставить скидки
        $discount_makers = optional(Permission::with('roles')
            ->where('name', Permission::MAKE_DISCOUNT)
            ->first()
        )->roles;
        // Получить лимиты по этим ролям и заданному бренду
        foreach ($discount_makers as $discount_maker) {
            $discount_maker['limit'] = optional((self::MODEL)::where('role_id', $discount_maker->id)
                ->where('discountable_id', $discountLimit->discountable_id)
                ->first()
            )->limit;
        }

        return view("pages.{$this->route}.edit", [
            'object' => $discountLimit,
            'route' => $this->route,
            'manufacturers' => ProductManufacturer::get()->pluck('name', 'GUID'),
            'discount_makers' => $discount_makers
        ]);

    }

    public function update(UpdateDiscountLimitRequest $request, DiscountLimit $discountlimit)
    {
        $fields = $request->validated();
        try {
            foreach ($fields as $key => $value) {
                if (mb_strpos($key, 'limit') !== false) {
                    $limit = (self::MODEL)::query()->updateOrCreate([
                        'discountable_id' => $fields['manufacturer'],
                        'type' => 'manufacturer',
                        'role_id' => explode('_', $key)[1],
                    ], [
                        'limit' => $value
                    ]);
                    $limit->save();
                }
            }
        } catch (Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "{$this->route}.index");
    }

    public function destroy(DiscountLimit $discountLimit, Request $request)
    {
        try {
            DiscountLimit::where('discountable_id', $discountLimit->discountable_id)->delete();
        } catch (Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "{$this->route}.index");
    }
}
