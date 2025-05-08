@extends("layouts.app")

@section('title', 'Add New Teacher')

@section('content')
    <div class="container p-5">
        <h2>Add New Teacher</h2>

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
        
        <form action="{{route('teachers.insert')}}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="fname" class="form-control" value="{{old('fname')}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-control" value="{{old('lname')}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{old('phone')}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Department</label>
                <input type="text" name="department" class="form-control" value="{{old('department')}}" required>
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
            <button type="submit" class="btn btn-primary">Add Teacher</button>
        </form>
    </div>
@endsection
