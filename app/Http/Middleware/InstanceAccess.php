<?php

namespace App\Http\Middleware;

use App\Enums\Entities;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstanceAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->isEditor())
            return $next($request);


        if($request->route()->hasParameter('division'))
            $instance = $request->route()->parameter('division');
        elseif($request->route()->hasParameter('entity'))
            $instance = Entities::instance($request->route('entity'), $request->route('entity_id'));


        if(!$instance->users->contains(auth()->id()))
            abort(403, __('messages.403'));

        return $next($request);

    }
}
