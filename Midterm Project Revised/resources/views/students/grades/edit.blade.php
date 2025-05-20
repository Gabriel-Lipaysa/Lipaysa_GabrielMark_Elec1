@extends('layouts.app')

@section('title', 'Update Grade')

@section('content')
    <div class="container p-5 bg-primary text-white">
        <h2>Update Grade for Student</h2>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container shadow my-3 bg-body rounded mx-3 p-4">
        <form action="{{ route('students.grades.update', ['studentId' => $studentId, 'gradeId' => $grade->id]) }}"
            method="POST">
            @csrf
            @method('PUT')

            <!-- Hidden field for enrollment_id -->
            <input type="hidden" name="enrollment_id" value="{{ $grade->enrollment_id }}">

            <div class="form-group">
                <label for="course">Course</label>
                <input type="text" class="form-control" value="{{ $grade->course_name }} ({{ $grade->course_code }})"
                    readonly>
            </div>

            <div class="form-group mt-3">
                <label for="grade">Grade</label>
                <input type="number" name="grade" class="form-control" value="{{ $grade->grade }}" step="0.5" min="1"
                    max="5" required>
            </div>

            <div class="form-group mt-3">
                <label for="remarks">Remarks</label>
                <select name="remarks" class="form-control">
                    <option value="Passed" {{ $grade->remarks == 'Passed' ? 'selected' : '' }}>Passed</option>
                    <option value="Fail" {{ $grade->remarks == 'Fail' ? 'selected' : '' }}>Fail</option>
                    <option value="Dropped" {{ $grade->remarks == 'Dropped' ? 'selected' : '' }}>Dropped</option>
                </select>
            </div>

            <div class="col mt-3">
                <button type="submit" class="btn btn-primary">Update Grade</button>
                <a href="{{route('students.grades.index', [$studentId])}}" class="btn btn-secondary">Return</a>
            </div>
        </form>
    </div>
@endsection