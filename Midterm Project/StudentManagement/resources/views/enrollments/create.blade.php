@extends('layouts.app')

@section('title', 'Add Enrollment')
@section('content')
<div class="container">
    <h2>Add Enrollment</h2>
    <form action="{{ route('enrollments.insert') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Student</label>
            <select name="student_id" class="form-control">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->fname }} {{ $student->lname }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Course</label>
            <select name="course_id" class="form-control">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Enrollment Date</label>
            <input type="date" name="enrollment_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="Active">Active</option>
                <option value="Dropped">Dropped</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection