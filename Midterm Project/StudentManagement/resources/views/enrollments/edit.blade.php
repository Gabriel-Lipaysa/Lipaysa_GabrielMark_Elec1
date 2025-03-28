@extends('layouts.app')

@section('title', 'Add Enrollment')
@section('content')
<div class="container">
    <h2>Add Enrollment</h2>
    <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Student</label>
            <select name="student_id" class="form-control" aria-readonly="true">
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
            <input type="date" name="enrollment_date" class="form-control" value="{{$enrollment->enrollment_date}}">
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" >
                <option value="Active" {{$enrollment->status == 'Active' ? 'selected' : ''}}>Active</option>
                <option value="Dropped" {{$enrollment->status == 'Dropped' ? 'selected' : ''}}>Dropped</option>
                <option value="Completed" {{$enrollment->status == 'Completed' ? 'selected' : ''}}>Completed</option>
            </select>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{route('enrollments.index')}}" class="btn btn-secondary">Return</a>
        </div>
        
    </form>
</div>
@endsection