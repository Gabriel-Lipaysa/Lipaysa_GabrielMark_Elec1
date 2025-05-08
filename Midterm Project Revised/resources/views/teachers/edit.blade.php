@extends("layouts.app")

@section('title', 'Edit Teacher')

@section('content')
    <div class="container p-5">
        <h2>Edit Teacher</h2>

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
        
        <form action="{{route('teachers.update', $teacher->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="fname" class="form-control" value="{{old('fname', $teacher->fname)}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-control" value="{{old('lname', $teacher->lname)}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{old('phone', $teacher->phone)}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Department</label>
                <input type="text" name="department" class="form-control" value="{{old('department', $teacher->department)}}" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{old('email', $teacher->email)}}" required>
                @error('email') <small class="text-danger">{{$message}}</small>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Teacher</button>
        </form>
    </div>
@endsection
