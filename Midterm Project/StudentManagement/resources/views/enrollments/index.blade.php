@extends('layouts.app')

@section('title', 'Enrollments')

@section('content')
<div class="container p-5">
    <h1>Enrollments</h1>
    
    <div class="d-flex justify-content-between">
        <div>
            <a href="{{ route('enrollments.create') }}" class="btn btn-primary">Add Enrollment</a>
        </div>
        <div>
            <form action="{{route('enrollments.index')}}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by name or code" value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary">Search</button>
            </form>
        </div>
    </div>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Course</th>
                <th>Enrollment Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->id }}</td>
                    <td>{{ $enrollment->fname }} {{ $enrollment->lname }}</td>
                    <td>{{ $enrollment->course_name }}</td>
                    <td>{{ $enrollment->enrollment_date }}</td>
                    <td>{{ $enrollment->status }}</td>
                    <td>
                        <a href="{{route('enrollments.edit', $enrollment->id)}}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{route('enrollments.destroy', $enrollment->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $enrollments->links() }}
    </div>
</div>
@endsection