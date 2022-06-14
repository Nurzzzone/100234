<?php

namespace App\Http\Controllers;

use App\Http\Requests\Partner\UpdatePartnerRequest;
use App\Jobs\SendPartnershipApplicationTo1cJob;
use App\Models\B2bClients;
use App\Models\PartnershipApplication;
use App\Repositories\PartnerApplicationsRepository;
use App\Support\View\TableConfig\PartnershipApplicationTableConfig;
use App\Traits\HasFlashMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class PartnerApplicationController extends Controller
{
    use HasFlashMessage;

    protected const MODEL = PartnershipApplication::class;

    protected $route;
    protected $object;

    public function __construct()
    {
        $this->route = 'partner';
        View::share('page_title', 'Подтверждение партнеров');
    }

    public function index(PartnerApplicationsRepository $repository, PartnershipApplicationTableConfig $tableConfig)
    {
        if (request()->ajax()) {
            return $repository->getPaginatedSearchResult();
        }

        return view("pages.index",
            [
                'objects' => $repository->getPaginatedResult(),
                'tableConfig' => $tableConfig,
                'route' => $this->route,
            ]);
    }

    public function create()
    {
        $model = self::MODEL;

        return view("pages.{$this->route}.create", [
            'object' => new $model(),
            'route' => $this->route,
        ]);
    }

    public function store($request)
    {
        try {
            (self::MODEL)::create($request->validated());
        } catch (Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "{$this->route}.index");
    }

    public function show(PartnershipApplication $partner)
    {
        return view("pages.{$this->route}.show", [
            'object' => $partner,
            'route' => $this->route
        ]);
    }

    public function edit(PartnershipApplication $partner)
    {
        return view("pages.{$this->route}.edit", [
            'object' => $partner,
            'route' => $this->route
        ]);
    }

    public function update(UpdatePartnerRequest $request, PartnershipApplication $partner)
    {
        if ($partner->is_confirmed_by_manager) {
            return $this->flashErrorMessage($request, new UnprocessableEntityHttpException, 'Заявка уже была обработана');
        }

        try {
            $partner->update($request->validated());
        } catch (Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }

        if (!$partner->is_sent) {
            SendPartnershipApplicationTo1cJob::dispatch($partner);
        }


        return $this->flashSuccessMessage($request, "{$this->route}.index");
    }

    public function destroy(B2bClients $partner, Request $request)
    {
        try {
            $partner->delete();
        } catch (Exception $exception) {
            return $this->flashErrorMessage($request, $exception);
        }
        return $this->flashSuccessMessage($request, "{$this->route}.index");
    }
}
