@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
    <div class="container p-5">
        <h2>Edit Student</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="fname" value="{{ $student->fname }}" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Middle Name</label>
                <input type="text" name="mname" value="{{ $student->mname }}" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label>Last Name</label>
                <input type="text" name="lname" value="{{ $student->lname }}" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Sex</label>
                <select name="sex" class="form-control">
                    <option value="Male" {{ $student->sex == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $student->sex == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" value="{{ $student->dob }}" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ $student->phone }}" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" value="{{ $student->address }}" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Guardian Name</label>
                <input type="text" name="guardian_name" value="{{$student->guardian_name}}" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Guardian Phone</label>
                <input type="text" name="guardian_phone" value="{{$student->guardian_phone}}" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="Active" {{ $student->status == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ $student->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="Graduated" {{ $student->status == 'Graduated' ? 'selected' : '' }}>Graduated</option>
                    <option value="Dropped" {{ $student->status == 'Dropped' ? 'selected' : '' }}>Dropped</option>
                </select>
            </div>

            {{-- <div class="form-group mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ $student->email }}" class="form-control">
            </div> --}}
            <div class="col">
                <button type="submit" class="btn btn-success">Update Student</button>
                <a href="{{url()->previous()}}" class="btn btn-secondary">Back to Index</a>
            </div>

        </form>
    </div>
@endsection