@extends('master')

@section('content')
    <div class="container">
        <h1>Edit Student</h1>
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" name="fname" class="form-control" id="fname" value="{{ $student->fname }}" required>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-control" id="lname" value="{{ $student->lname }}" required>
            </div>
            <div class="mb-3">
                <label for="bdate" class="form-label">Date of Birth</label>
                <input type="date" name="bdate" class="form-control" id="bdate" value="{{ $student->bdate }}" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="address" value="{{ $student->address }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ $student->email }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Student</button>
        </form>
    </div>
@endsection