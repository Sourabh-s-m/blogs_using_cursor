@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create New Category</a>
    <table id="categories-table" class="table table-striped">
        <thead>
            <tr>
                <th>Sl. No</th> <!-- Serial number header -->
                <th>Name</th>
                <th>Blog Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td> <!-- Display the serial number -->
                <td>{{ $category->name }}</td>
                <td>{{ $category->blogs_count }}</td>
                <td>
                    <!-- Replace text with Bootstrap icons -->
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i> <!-- Edit icon -->
                    </a>
                    <button 
                        class="btn btn-danger btn-sm delete-btn"
                        data-url="{{ route('categories.destroy', $category->id) }}"
                        data-id="{{ $category->id }}"
                        data-type="category"
                    >
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
</div>
@endsection
