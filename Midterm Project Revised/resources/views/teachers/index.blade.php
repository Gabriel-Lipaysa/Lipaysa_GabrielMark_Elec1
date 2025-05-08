@extends("layouts.app")

@section('title', 'Teachers List')

@section('content')
    <div class="container p-5">
        <h2>Teachers List</h2>

        @if (session('success'))
            <div class="alert alert-success mt-3">{{session('success')}}</div>
        @endif
        
        <div class="d-flex justify-content-between">
            <div>
                <a href="{{route('teachers.create')}}" class="btn btn-primary mb-3">Add New Teacher</a>
            </div>
            <div>
                <form method="GET" action="{{ route('teachers.index') }}" class="d-flex">
                    <input type="text" name="search" placeholder="Search teachers..." class="form-control me-2" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div> 

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->fname }} {{ $teacher->lname }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>{{ $teacher->department }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>
                            <a href="{{ route('teachers.details', $teacher->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
        {{ $teachers->links() }}
        </div>
    </div>
@endsection
