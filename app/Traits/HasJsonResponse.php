<?php

namespace App\Traits;

trait HasJsonResponse
{
    public function success($message = 'Операция прошла успешно!')
    {
        return response()->json(compact('message'), 200);
    }

    public function internalError(string $message = 'Произошла ошибка! Пожалуйста, попробуйте еще раз')
    {
        return response()->json(compact('message'), 500);
    }

    public function token(string $token, string $key = 'access_token')
    {
        return response()->json([$key => $token], 200);
    }

    public function unauthorized($message = 'unauthorized')
    {
        return response()->json(compact('message'), 401);
    }
}
