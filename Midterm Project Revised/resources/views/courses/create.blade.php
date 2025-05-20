@extends('layouts.app')

@section('title', 'Add Course')

@section('content')

    <div class="container p-5">
        <h1>Add Course</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <form action="{{ route('courses.insert') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label">Course Name</label>
                <input type="text" name="course_name" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="form-label">Course Code</label>
                <input type="text" name="course_code" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="form-label">Price</label>
                <input type="text" name="price" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="form-label">Units</label>
                <input type="number" name="units" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="form-label">Instructor</label>
                <select name="teacher_id" class="form-control" required>
                    <option value="">Select Instructor</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->fname }} {{ $teacher->lname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="form-label">Year</label>
                <input type="text" name="year" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="form-label">Semester</label>
                <input type="text" name="semester" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Course</button>
        </form>
    </div>
@endsection