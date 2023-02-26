<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    use ApiResponser;

    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role->value == $role) {
            return $next($request);
        } else {
            return $this->error_response(403, 'access is not allowed');
        }
    }
}
