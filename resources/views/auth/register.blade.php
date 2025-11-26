@extends('layouts.guest')

@section('title', 'Register')

@section('content')
    <div class="text-center mb-4">
        <h2 class="mb-2">Create Account</h2>
        <p class="text-muted">Join SmartHostel today</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name" class="form-label">Full Name</label>
            <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Role Selection -->
        <div class="form-group">
            <label for="role" class="form-label">I am a...</label>
            <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                <option value="student">Student</option>
                <option value="staff">Staff Member</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <div style="position: relative;">
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password" style="padding-right: 40px;">
                <span onclick="togglePassword('password', 'toggleIcon1')" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #666;">
                    <i id="toggleIcon1" class="fas fa-eye"></i>
                </span>
            </div>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <div style="position: relative;">
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" style="padding-right: 40px;">
                <span onclick="togglePassword('password_confirmation', 'toggleIcon2')" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #666;">
                    <i id="toggleIcon2" class="fas fa-eye"></i>
                </span>
            </div>
        </div>

        <script>
            function togglePassword(inputId, iconId) {
                const input = document.getElementById(inputId);
                const icon = document.getElementById(iconId);
                
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            }
        </script>

        <button type="submit" class="btn btn-primary w-100" style="width: 100%;">
            Register
        </button>
        
        <div class="text-center mt-4">
            <p class="text-sm text-muted">
                Already have an account? <a href="{{ route('login') }}">Log in</a>
            </p>
        </div>
    </form>
@endsection
