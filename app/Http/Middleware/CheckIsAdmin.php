<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
            // Check if the authenticated user is an admin
            if (auth()->check() && auth()->user()->is_admin) {
                return $next($request);
            }
    
            // If not an admin, redirect or respond as needed
            return response('Unauthorized access',401);
       
    }
}
