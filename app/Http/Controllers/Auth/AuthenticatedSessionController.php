<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        Log::info('Login attempt', ['email' => $request->email, 'ip' => $request->ip()]);

        try {
            $request->authenticate();

            $request->session()->regenerate();

            Log::info('Login successful', ['user_id' => $request->user()->id, 'role' => $request->user()->role]);

            if ($request->user()->role === 'admin') {
                return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Welcome back, Admin!');
            } elseif ($request->user()->role === 'staff') {
                return redirect()->route('staff.dashboard')->with('success', 'Welcome back, Staff!');
            }

            return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Welcome back!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Login failed: Invalid credentials', ['email' => $request->email]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Login error', ['error' => $e->getMessage()]);
            return back()->with('error', 'An unexpected error occurred during login.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
