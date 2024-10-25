@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Back Button for Blogs -->
        <div class="mb-4">
            <a href="{{ route('blogs.index') }}" class="inline-flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Blogs
            </a>
        </div>

        <h1 class="mb-4">Create Blog Post</h1>
        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required
                    placeholder="Enter blog title"
                    value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Featured Image</label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image" 
                       accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Content</label>
                <textarea class="form-control" id="description" name="description" rows="6" required
                    placeholder="Write your blog content here...">{{ old('description') }}</textarea>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="btn btn-primary">Create Blog Post</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
@endpush
