<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        // Check if the user is authenticated and has role_id of 1 (administrator)
        if (auth()->user()->role_id === 1) {
            return $next($request);
        }

        // If the user is not an administrator, return a 403 error response
        return abort(403, 'Alleen beheerders hebben toegang tot deze pagina');
    }

}
