@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Back Button for Users -->
        <div class="mb-4">
            <a href="{{ route('users.index') }}" class="inline-flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Users
            </a>
        </div>

        <h1 class="mb-4">Create User</h1>
        <form action="{{ route('users.store') }}" method="POST" data-parsley-validate>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required
                    placeholder="Enter user's full name"
                    data-parsley-required-message="Name is required"
                    value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required 
                    placeholder="Enter email address"
                    data-parsley-type="email"
                    data-parsley-required-message="Email is required"
                    value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required
                    placeholder="Enter password (minimum 8 characters)"
                    data-parsley-minlength="8" 
                    data-parsley-required-message="Password is required">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required
                    placeholder="Confirm your password"
                    data-parsley-equalto="#password" 
                    data-parsley-required-message="Password confirmation is required">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="btn btn-primary">Create User</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
@endpush
