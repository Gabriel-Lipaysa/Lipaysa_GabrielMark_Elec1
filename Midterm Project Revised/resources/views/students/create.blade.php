@extends("layouts.app")

@section('title', 'Create Form')

@section('content')
    <div class="container p-5">
        <h2>Add New Student</h2>

        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{route('students.insert')}}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="fname" class="form-control" value="{{old('fname')}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Middle Name</label>
                <input type="text" name="mname" class="form-control" value="{{old('mname')}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-control" value="{{old('lname')}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Gender</label>
                <select name="sex" class="form-control" value="{{old('sex')}}" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" value="{{old('dob')}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" value="{{old('phone')}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="{{old('address')}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Guardian Name</label>
                <input type="text" name="guardian_name" class="form-control" value="{{old('guardian_name')}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Guardian Phone</label>
                <input type="text" name="guardian_phone" class="form-control" value="{{old('guardian_phone')}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                    <option value="Graduated">Graduated</option>
                    <option value="Dropped">Dropped</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{old('email')}}" required>
                @error('email') <small class="text-danger">{{$message}}</small>@enderror
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="pwd" class="form-control" value="{{old('pwd')}}" required>
                @error('pwd') <small class="text-danger">{{$message}}</small>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
    </div>
@endsection