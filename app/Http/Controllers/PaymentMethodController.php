<?php

namespace App\Http\Controllers;

use App\Models\Finance\PaymentMethod;
use App\Repositories\BaseTableRepository;
use App\Support\View\TableConfig\Finance\PaymentMethodTableConfig;
use App\Support\View\TableConfig\TableConfig;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentMethodController extends TableController
{
    protected $route = 'paymentMethod';

    protected $pageTitle = 'Платежные системы';

    protected function getRepository(): BaseTableRepository
    {
        return new class extends BaseTableRepository {

            public function beforePaginateQuery(): Builder
            {
                return PaymentMethod::query();
            }
        };
    }

    protected function getTableConfig(): TableConfig
    {
        return new PaymentMethodTableConfig();
    }

    public function toggle(PaymentMethod $paymentMethod, Request $request): \Illuminate\Http\JsonResponse
    {
        if ($paymentMethod->isHalykBank() || $paymentMethod->isForteBank()) {
            $sql = 'UPDATE `payment_methods` SET `is_active` = NOT `is_active` WHERE `id` IN (\'%s\', \'%s\')';

            DB::connection('adkulan_dev')->statement(sprintf($sql, $paymentMethod::HALYK, $paymentMethod::FORTE));
        }

        else {
            $paymentMethod->update($request->validate([
                'is_active' => ['required', 'boolean']
            ]));
        }

        return response()->json(['message' => 'success']);
    }
}
