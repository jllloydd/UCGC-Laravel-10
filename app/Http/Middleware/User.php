<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::user()->usertype == 'admin'){
            return redirect('admin/dashboard');
        }

        if(Auth::user()->usertype == 'superadmin'){
            return redirect('superadmin/dashboard');
        }
        return $next($request);
    }
}
