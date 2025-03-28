@extends('layouts.app')

@section('title', 'Student Grades')

@section('content')
<div class="container p-5 bg-primary text-white">
    <h2>Student Grades</h2>
</div>

<div class="container shadow my-3 bg-body rounded mx-3 p-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Units</th>
                <th>Grade</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $course)
            <tr>
                <td>{{ $course->course_code }}</td>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->units }}</td>
                <td>{{ $course->grade ?? 'N/A' }}</td>
                <td>{{ $course->remarks ?? 'Not Graded' }}</td>
                <td>
                    @php
                        // Check if the grade already exists
                        $existingGrade = DB::select("SELECT * FROM grades WHERE enrollment_id = ?", [$course->enrollment_id]);
                    @endphp
                    @if($existingGrade)
                        <!-- Navigate to the update grade view -->
                        <a href="{{ route('students.grades.edit', ['studentId' => $id, 'gradeId' => $existingGrade[0]->id]) }}" class="btn btn-warning btn-sm">Edit Grade</a>
                    @else
                        <!-- Navigate to the insert grade view -->
                        <a href="{{ route('students.grades.create', $id) }}" class="btn btn-success btn-sm">Add Grade</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
