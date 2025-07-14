<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type === 'customer') {
            return $next($request);
        }
        
        return redirect('/')->with('error', 'Acesso não autorizado.');
    }
}
