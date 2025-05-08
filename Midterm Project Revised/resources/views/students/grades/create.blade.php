@extends('layouts.app')

@section('title', 'Add Grade')

@section('content')
<div class="container p-5 bg-primary text-white">
    <h2>Add Grade for Student</h2>
</div>

<div class="container shadow my-3 bg-body rounded mx-3 p-4">
    <form action="{{ route('students.grades.store', $studentId) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="course">Course</label>
            <input type="text" class="form-control" value="{{ $enrolledCourses[0]->course_name }} ({{ $enrolledCourses[0]->course_code }})" readonly>
            <input type="hidden" name="enrollment_id" value="{{ $enrolledCourses[0]->id }}">
        </div>

        <div class="form-group mt-3">
            <label for="grade">Grade</label>
            <input type="number" name="grade" class="form-control" step="0.5" min="1" max="5" required>
        </div>

        <div class="form-group mt-3">
            <label for="remarks">Remarks</label>
            <select name="remarks" class="form-control">
                <option value="Passed">Passed</option>
                <option value="Fail">Fail</option>
                <option value="Dropped">Dropped</option>
            </select>
        </div>
        
        <div class="col mt-3">
            <button type="submit" class="btn btn-primary">Add Grade</button>
            <a href="{{route('students.grades.index', [$studentId])}}" class="btn btn-secondary">Return</a>
        </div>
    </form>
</div>
@endsection
