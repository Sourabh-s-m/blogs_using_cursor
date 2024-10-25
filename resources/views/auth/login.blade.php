@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-md-6 d-none d-md-flex bg-image"></div>
            <div class="col-md-6 bg-light">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-xl-7 mx-auto">
                                <h3 class="display-4 mb-3">Welcome Back!</h3>
                                <p class="text-muted mb-4">Please login to your account.</p>
                                <form method="POST" action="{{ route('login') }}" data-parsley-validate>
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input id="email" type="email" placeholder="Email address" required autofocus
                                            class="form-control rounded-pill border-0 shadow-sm px-4 @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" autocomplete="email"
                                            data-parsley-type="email" data-parsley-trigger="change">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="password" type="password" placeholder="Password" required
                                            class="form-control rounded-pill border-0 shadow-sm px-4 text-primary @error('password') is-invalid @enderror"
                                            name="password" autocomplete="current-password" data-parsley-trigger="change">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input id="remember" type="checkbox" class="custom-control-input" name="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember" class="custom-control-label">Remember me</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm login-btn">
                                        Sign in
                                    </button>
                                    <div class="text-center d-flex justify-content-between mt-4">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="font-italic text-muted">
                                                Forgot Your Password?
                                            </a>
                                        @endif
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="font-italic text-muted">
                                                Need an account? Sign up
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .login,
        .image {
            min-height: 100vh;
        }

        .bg-image {
            background-image: url('{{ asset('images/login.jpeg') }}');
            background-size: cover;
            background-position: center;
        }

        .login-heading {
            font-weight: 300;
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .btn-primary {
            background-color: #4a90e2 !important;
            border-color: #4a90e2 !important;
        }

        .btn-primary:hover {
            background-color: #3a7bc8 !important;
            border-color: #3a7bc8 !important;
        }

        .text-primary {
            color: #4a90e2 !important;
        }

        .login-btn {
            background: linear-gradient(to right, #4a90e2, #5cb3ff);
            border: none;
            color: white;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: linear-gradient(to right, #3a7bc8, #4a90e2);
        }
    </style>
@endpush
