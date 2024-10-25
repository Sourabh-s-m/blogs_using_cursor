@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{ __('Dashboard') }}</h1>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            @if (Auth::user()->role === 'admin')
                <div class="col-md-4 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h2 class="display-4 mb-0">{{ $userCount }}</h2>
                            <p class="mb-0">Users</p>
                        </div>
                        <a href="{{ route('users.index') }}" class="card-footer d-flex text-white text-decoration-none">
                            View Details
                            <span class="ms-auto">
                                <i class="bi bi-chevron-right"></i>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h2 class="display-4 mb-0">{{ $categoryCount }}</h2>
                            <p class="mb-0">Categories</p>
                        </div>
                        <a href="{{ route('categories.index') }}"
                            class="card-footer d-flex text-white text-decoration-none">
                            View Details
                            <span class="ms-auto">
                                <i class="bi bi-chevron-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            @endif
            <div class="col-md-4 mb-4">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h2 class="display-4 mb-0">{{ $blogCount }}</h2>
                        <p class="mb-0">Blogs</p>
                    </div>
                    <a href="{{ route('blogs.index') }}" class="card-footer d-flex text-white text-decoration-none">
                        View Details
                        <span class="ms-auto">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
