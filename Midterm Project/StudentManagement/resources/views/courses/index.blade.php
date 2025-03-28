@extends('layouts.app')

@section('title', 'Courses List')

@section('content')
    <div class="container p-5">
        <h1>Courses List</h1>
        <div class="d-flex justify-content-between">
            <div>
                <a href="{{ route('courses.create') }}" class="btn btn-primary">Add New Course</a>
            </div>
            <div>
                <form action="{{route('courses.index')}}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search by name or code" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </form>
            </div>
        </div>
        
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Units</th>
                <th>Instructor</th>
                <th>Year</th>
                <th>Semester</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->units }}</td>
                    <td>{{ $course->instructor }}</td>
                    <td>{{ $course->year }}</td>
                    <td>{{ $course->semester }}</td>
                    <td>
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $courses->links() }}
    </div>
    </div>
@endsection
