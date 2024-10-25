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

        <h1 class="mb-4">Edit User</h1>
        <form action="{{ route('users.update', $user) }}" method="POST" data-parsley-validate>
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required
                    placeholder="Enter user's full name"
                    data-parsley-required-message="Name is required">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}"
                    required data-parsley-type="email" data-parsley-required-message="Email is required"
                    placeholder="Enter email address">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
@endpush
