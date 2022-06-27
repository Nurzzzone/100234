<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        if (! in_array('Администратор', explode(',', $request->user()->menuroles))) {
            abort(401);
        }

        return $next($request);
    }
}
