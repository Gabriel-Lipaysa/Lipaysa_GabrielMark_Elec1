@extends('master')

@section('content')
    <div class="container">
        <h1>Add Student</h1>
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="fname" class="form-label">Name</label>
                <input type="text" name="fname" class="form-control" id="fname" required>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Name</label>
                <input type="text" name="lname" class="form-control" id="lname" required>
            </div>
            <div class="mb-3">
                <label for="bdate" class="form-label">Date of Birth</label>
                <input type="date" name="bdate" class="form-control" id="bdate" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="address" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
    </div>
@endsection