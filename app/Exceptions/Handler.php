<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        $retval = parent::render($request, $exception);

        if (! config('app.debug') && $exception instanceof NotFoundHttpException) {
            $request->session()->flash('error', __('messages.404.body'));

            return redirect()->back();
        }

        if (! config('app.debug') && auth()->check() && $exception->getCode() == 0) {
            return redirect()->back();
        }

        return $retval;
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'message' => trans('validation.header'),
            'errors' => $exception->errors(),
        ], $exception->status);
    }
}
