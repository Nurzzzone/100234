<?php

namespace App\Traits;

trait HasFlashMessage
{
    public function flashSuccessMessage($request, $route = null, $message = null)
    {
        $request->session()->flash('message', $message ?? "Операция выполнена успешно!");
        if ($route !== null) {
            return redirect()->route($route);
        }
        return redirect()->back();
    }

    public function flashErrorMessage($request, $exception, $message = null)
    {
        if (!config('app.debug')) {
            $request->session()->flash('message', "Произошла ошибка!");
            return redirect()
                ->back();
        }
        throw new \Exception($exception->getMessage());
    }
}
