@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Blogs</h1>
        <a href="blogs/create" class="btn btn-primary mb-3">Create New Blog</a>
        <table id="blogs-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Sl. No</th> <!-- Serial number header -->
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $loop->iteration }}</td> <!-- Display the serial number -->
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->user->name }}</td>
                        <td>{{ $blog->category->name }}</td>
                        <td>
                            <!-- Add View button with icon -->
                            <a href="{{ route('blogs.show', $blog) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> <!-- View icon -->
                            </a>
                            <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> <!-- Edit icon -->
                            </a>
                            <!-- Delete button -->
                            <button class="btn btn-danger btn-sm delete-btn"
                                data-url="{{ route('blogs.destroy', $blog->id) }}" data-id="{{ $blog->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $blogs->links() }} --}}
    </div>
@endsection
