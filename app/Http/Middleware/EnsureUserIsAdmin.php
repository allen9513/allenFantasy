<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->admin) {
                return $next($request);
            }
        }

        return back()->withErrors([
            'errorMessage' => 'You dont have access to this',
        ]);
    }
}
