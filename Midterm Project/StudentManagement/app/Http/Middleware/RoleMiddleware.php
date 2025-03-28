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
        $user = Session::get('auth_user');

        if (!$user || $user['role'] !== $role) {
            return redirect()->route('login')->withErrors(['email' => 'Unauthorized access']);
        }

        return $next($request);
    }
}
