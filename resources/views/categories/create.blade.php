@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Back Button for Categories -->
        <div class="mb-4">
            <a href="{{ route('categories.index') }}"
                class="inline-flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Categories
            </a>
        </div>

        <h1 class="mb-4">Create Category</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" required
                    placeholder="Enter category name" value="{{ old('name') }}">
            </div>
            {{-- <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    placeholder="Enter category description">{{ old('description') }}</textarea>
            </div> --}}
            <div class="flex items-center justify-between">
                <button type="submit" class="btn btn-primary">Create Category</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
@endpush
