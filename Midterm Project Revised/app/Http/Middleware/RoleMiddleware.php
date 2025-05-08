<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Session::has('user_role') || Session::get('user_role') !== $role) {
            print(Session::get('user_role'));
            
            return to_route('login')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
