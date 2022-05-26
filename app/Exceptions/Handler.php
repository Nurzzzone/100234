<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
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

        if ($exception instanceof NotFoundHttpException) {
            return $this->redirectWithFlash($request, trans(('messages.404.body')));
        } elseif($exception instanceof AuthorizationException) {
            return $this->redirectWithFlash($request, trans(('messages.401.body')));
        }

        return $retval;
    }

    protected function redirectWithFlash($request, string $message)
    {
        $request->session()->flash('error', $message);

        return redirect()->back();
    }
}
