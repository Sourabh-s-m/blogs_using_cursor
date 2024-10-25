@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Users</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create New User</a>
        <table id="users-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Sl. No</th> <!-- Serial number header -->
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr id="row-{{ $user->id }}">
                        <td>{{ $loop->iteration }}</td> <!-- Display the serial number -->
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> <!-- Edit icon -->
                            </a>
                            <button class="btn btn-danger btn-sm delete-btn"
                                data-url="{{ route('users.destroy', $user->id) }}" data-id="{{ $user->id }}"
                                data-type="user" data-blogs-count="{{ $user->blogs_count }}"
                                {{ $user->id === auth()->id() ? 'disabled' : '' }}
                                title="{{ $user->id === auth()->id() ? 'You cannot delete your own account' : 'Delete this user' }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $users->links() }} --}}
    </div>
@endsection
