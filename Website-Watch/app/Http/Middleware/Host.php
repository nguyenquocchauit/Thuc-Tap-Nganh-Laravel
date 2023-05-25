<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Host
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard("admin")->check()) {
            if ((auth()->guard("admin")->user()->role == '2' )) {
                return $next($request);
            } else {
                return redirect('/admin/login');
            }
        } else {
            return Redirect('/admin/login');
        }
    }
}
