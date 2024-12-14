<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginCheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('loggedInSuperAdmin')) {
            if ($request->path() != '/') {
                return redirect('/');
            }
        } else {
            if (strpos($request->path(), '/superAdmin/') === 0) {
                return back();
            }
        }

        return $next($request);
    }
}
