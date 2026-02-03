@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4"
                 style="background: #fff;">

                <!-- Title -->
                <div class="card-header bg-white text-center border-0 py-4">
                    <h4 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-sign-in-alt text-primary me-2"></i> Login to Your Account
                    </h4>
                </div>

                <!-- Body -->
                <div class="card-body px-4 py-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input id="email" type="email"
                                   class="form-control rounded-pill shadow-sm @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autofocus
                                   placeholder="Enter your email">

                            @error('email')
                                <span class="invalid-feedback d-block mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password with toggle -->
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <input id="password" type="password"
                                       class="form-control rounded-pill shadow-sm pe-5 @error('password') is-invalid @enderror"
                                       name="password" required placeholder="Enter your password">
                                <button type="button" class="btn btn-light border-0 position-absolute end-0 top-50 translate-middle-y me-2"
                                        id="toggle-password" style="z-index: 10;">
                                    <i class="fas fa-eye text-muted"></i>
                                </button>
                            </div>

                            @error('password')
                                <span class="invalid-feedback d-block mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <button type="submit"
                                    class="btn btn-primary px-5 rounded-pill shadow-sm fw-semibold">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </button>

                            @if (Route::has('password.request'))
                                <a class="text-decoration-none small fw-semibold text-primary"
                                   href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="card-footer bg-light text-center rounded-bottom-4 py-3">
                    <small class="text-muted">
                        Don’t have an account? 
                        <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-none">Sign Up</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.getElementById('toggle-password').addEventListener('click', function() {
        let passwordInput = document.getElementById('password');
        let icon = this.querySelector('i');
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
@endpush
