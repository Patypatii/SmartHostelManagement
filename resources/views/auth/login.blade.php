@extends('layouts.webflow')

@section('title', 'Login')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-4">
            <h2 class="mb-2">Welcome Back</h2>
            <p class="text-muted">Please sign in to your account</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-group d-flex justify-content-between align-items-center">
                <label for="remember_me" class="d-flex align-items-center gap-2" style="cursor: pointer;">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span class="text-sm text-muted">Remember me</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a class="text-sm" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-100" style="width: 100%;">
                Log in
            </button>
            
            <div class="text-center mt-4">
                <p class="text-sm text-muted">
                    Don't have an account? <a href="{{ route('register') }}">Register</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
