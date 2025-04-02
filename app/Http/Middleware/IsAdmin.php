<?php

namespace App\Http\Middleware;

use App\Enums\UserRoles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check())
            abort(403, "You are not authorized to access this page.");

        if(auth()->user()->role->level() < UserRoles::Admin->level() )
            abort(403, "Your access level is insufficient");

        return $next($request);
    }
}
