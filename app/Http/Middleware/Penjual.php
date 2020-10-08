<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Penjual
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->level == 'admin') {
            return redirect()->route('dashboardAdmin');
        }

        if (Auth::user()->level == 'penjual') {
            return $next($request);
        }
    }
}
