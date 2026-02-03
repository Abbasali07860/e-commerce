@extends('layouts.app')

@section('title','Create Account')

@section('content')
<div class="d-flex justify-content-center align-items-center py-5" style="min-height: 80vh; background-color: #f8f9fa;">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 480px; width: 100%;">
        
        <!-- Header -->
        <div class="card-header bg-white text-center border-0 py-4">
            <h4 class="fw-bold text-dark mb-1">
                <i class="fas fa-user-plus text-primary me-2"></i> Create Account
            </h4>
            <p class="text-muted small mb-0">Join us today! Please fill in your details.</p>
        </div>

        <!-- Body -->
        <div class="card-body px-4 py-4">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Name</label>
                    <input id="name" type="text" 
                           class="form-control rounded-pill shadow-sm @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                           placeholder="Enter your full name">

                    @error('name')
                        <span class="invalid-feedback d-block mt-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input id="email" type="email" 
                           class="form-control rounded-pill shadow-sm @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email"
                           placeholder="Enter your email">

                    @error('email')
                        <span class="invalid-feedback d-block mt-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input id="password" type="password" 
                           class="form-control rounded-pill shadow-sm @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password"
                           placeholder="Create a password">

                    @error('password')
                        <span class="invalid-feedback d-block mt-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password-confirm" class="form-label fw-semibold">Confirm Password</label>
                    <input id="password-confirm" type="password" 
                           class="form-control rounded-pill shadow-sm"
                           name="password_confirmation" required autocomplete="new-password"
                           placeholder="Re-enter password">
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-pill shadow-sm fw-semibold py-2">
                        <i class="fas fa-user-check me-2"></i> Register
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="card-footer bg-light text-center rounded-bottom-4 py-3">
            <small class="text-muted">
                Already have an account? 
                <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none">Login</a>
            </small>
        </div>
    </div>
</div>
@endsection
