<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->isAdmin) {
            return response()->json('Your account is inactive');
        }
        return $next($request);

    }
}
