<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ... $roles)
    {
         $userRole = Session::get('user_role');

        if (!$userRole || !in_array($userRole, $roles)) {
            return to_route('login')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
