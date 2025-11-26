@extends('layouts.webflow')

@section('title', 'Register')

@section('content')
<div class="container d-flex align-items-center justify-content-center py-5" style="min-height: 80vh;">
    <div class="card" style="width: 100%; max-width: 600px;">
        <div class="text-center mb-4">
            <h2 class="mb-2">Create Account</h2>
            <p class="text-muted">Join the Smart Hostel Management System</p>
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

            <div class="grid grid-2" style="gap: 16px;">
                <!-- Phone -->
                <div class="form-group mb-0">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input id="phone" class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Student ID -->
                <div class="form-group mb-0">
                    <label for="student_id" class="form-label">Student ID</label>
                    <input id="student_id" class="form-control @error('student_id') is-invalid @enderror" type="text" name="student_id" value="{{ old('student_id') }}" required>
                    @error('student_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="grid grid-2 mt-3" style="gap: 16px;">
                 <!-- Gender -->
                 <div class="form-group mb-0">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Year of Study -->
                <div class="form-group mb-0">
                    <label for="year_of_study" class="form-label">Year of Study</label>
                    <select id="year_of_study" class="form-control @error('year_of_study') is-invalid @enderror" name="year_of_study" required>
                        <option value="">Select Year</option>
                        <option value="1" {{ old('year_of_study') == '1' ? 'selected' : '' }}>Year 1</option>
                        <option value="2" {{ old('year_of_study') == '2' ? 'selected' : '' }}>Year 2</option>
                        <option value="3" {{ old('year_of_study') == '3' ? 'selected' : '' }}>Year 3</option>
                        <option value="4" {{ old('year_of_study') == '4' ? 'selected' : '' }}>Year 4</option>
                    </select>
                    @error('year_of_study')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Course -->
            <div class="form-group mt-3">
                <label for="course" class="form-label">Course</label>
                <input id="course" class="form-control @error('course') is-invalid @enderror" type="text" name="course" value="{{ old('course') }}" required>
                @error('course')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group mt-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100" style="width: 100%;">
                Register
            </button>
            
            <div class="text-center mt-4">
                <p class="text-sm text-muted">
                    Already have an account? <a href="{{ route('login') }}">Log in</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
