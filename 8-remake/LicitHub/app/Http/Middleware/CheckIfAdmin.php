<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type === 'admin') {
            return $next($request);
        }
        
        return redirect('/dashboard')->with('error', 'Você não tem permissão para acessar esta área.');
    }
}
