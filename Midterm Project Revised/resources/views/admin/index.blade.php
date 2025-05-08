@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">User Management</h1>

    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4">
        <input type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}">
        <button type="submit">Search</button>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td><td>{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this user?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
