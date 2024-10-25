@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Edit Category</h4>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i>Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category) }}" method="POST" data-parsley-validate>
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required
                        data-parsley-required-message="Category name is required">
                </div>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
