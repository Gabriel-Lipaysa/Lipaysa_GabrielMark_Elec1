@extends('layouts.app')

@section('title', 'Add Enrollment')
@section('content')
<div class="container p-5">
    <h2>Add Enrollment</h2>

    {{-- Show error for duplicate --}}
    @if ($errors->has('duplicate'))
        <div class="alert alert-danger">{{ $errors->first('duplicate') }}</div>
    @endif

    {{-- Select Student --}}
    <form method="GET" action="{{ route('enrollments.create') }}" class="mb-3">
        <label class="form-label">Student</label>
        <select name="student_id" class="form-control" onchange="this.form.submit()">
            <option value="">-- Select Student --</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}" {{ isset($selectedStudentId) && $selectedStudentId == $student->id ? 'selected' : '' }}>
                    {{ $student->fname }} {{ $student->lname }}
                </option>
            @endforeach
        </select>
    </form>

    @if (!empty($selectedStudentId))
    {{-- Main Enrollment Form --}}
    <form action="{{ route('enrollments.insert') }}" method="POST">
        @csrf
        <input type="hidden" name="student_id" value="{{ $selectedStudentId }}">

        <div class="mb-3">
            <label class="form-label">Course</label>
            <select name="course_id" class="form-control" required>
                @if (count($courses))
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                    @endforeach
                @else
                    <option value="">All courses already enrolled</option>
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="Active">Active</option>
                <option value="Dropped">Dropped</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{url()->previous()}}" class="btn btn-secondary">Back</a>
    </form>
    @endif
</div>
@endsection
