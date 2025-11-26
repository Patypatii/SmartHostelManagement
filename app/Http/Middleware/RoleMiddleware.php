<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if (Auth::user()->role !== $role) {
            // Redirect to appropriate dashboard if role mismatch
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif (Auth::user()->role === 'staff') {
                return redirect()->route('staff.dashboard');
            } elseif (Auth::user()->role === 'student') {
                return redirect()->route('dashboard');
            }
            
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
