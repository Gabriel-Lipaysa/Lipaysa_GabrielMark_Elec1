@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
    <div class="container p-5">
        <h2>Edit Course</h2>
        <form action="{{route('courses.update', $course->id)}}" method="POST" >
            @csrf
            <div class="form-group mb-3">
                <label class="form-label">Course Name</label>
                <input type="text" name="course_name" class="form-control" value="{{$course->course_name}}">
            </div>
            <div class="form-group mb-3">
                <label for="form-label">Course Code</label>
                <input type="text" name="course_code"  class="form-control" value="{{$course->course_code}}">
            </div>
            <div class="form-group mb-3">
                <label for="form-label">Price</label>
                <input type="text" name="price"  class="form-control" value="{{$course->price}}">
            </div>
            <div class="form-group mb-3">
                <label for="form-label">Units</label>
                <input type="number" name="units"  class="form-control" value="{{$course->units}}">
            </div>
            <div class="form-group mb-3">
                <label for="form-label">Instructor</label>
                <input type="text" name="instructor"  class="form-control" value="{{$course->instructor}}">
            </div>
            <div class="form-group mb-3">
                <label for="form-label">Year</label>
                <input type="text" name="year"  class="form-control" value="{{$course->year}}">
            </div>
            <div class="form-group mb-3">
                <label for="form-label">Semester</label>
                <input type="text" name="semester" class="form-control" value="{{$course->semester}}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{route('courses.index')}}" class="btn btn-secondary">Return</a>
            </div>
        </form>
    </div>
@endsection