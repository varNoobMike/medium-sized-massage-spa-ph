<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedByRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (! Auth::check()) {
            return $next($request);
        }

        return match (Auth::user()->role) {
            'Admin'  => redirect()->route('admin.dashboard.index'),
            'Client' => redirect()->route('client.home.index'),
            default  => redirect('/'),
        };

    }
}
