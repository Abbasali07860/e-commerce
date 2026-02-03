@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="d-flex justify-content-center align-items-center py-5" style="min-height: 80vh; background-color: #f8f9fa;">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 450px; width: 100%;">
        
        <!-- Header -->
        <div class="card-header bg-white text-center border-0 py-4">
            <h4 class="fw-bold text-dark mb-0">
                <i class="fas fa-unlock-alt text-primary me-2"></i> Reset Password
            </h4>
            <p class="text-muted small mb-0">Enter your email to get a password reset link</p>
        </div>

        <!-- Body -->
        <div class="card-body px-4 py-4">
            @if (session('status'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input id="email" type="email" 
                           class="form-control rounded-pill shadow-sm @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                           placeholder="Enter your registered email">

                    @error('email')
                        <span class="invalid-feedback d-block mt-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary rounded-pill shadow-sm fw-semibold py-2">
                        <i class="fas fa-paper-plane me-2"></i> Send Reset Link
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="card-footer bg-light text-center rounded-bottom-4 py-3">
            <small class="text-muted">
                Remembered your password? 
                <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none">Login</a>
            </small>
        </div>
    </div>
</div>
@endsection
