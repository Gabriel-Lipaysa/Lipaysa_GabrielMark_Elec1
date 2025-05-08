@extends('layouts.app')

@section('title', 'Students List')

@section('content')
    <div class="container p-5">
        <h1>Student List</h1>

        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        
        <div class="d-flex justify-content-between">
            @if(session('user_role')==="admin")
            <div>
                <a href="{{route('students.create')}}" class="btn btn-primary mb-3">Add New Student</a>
            </div>
            @endif
                <div>
                    <form action="{{ route('students.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search by name or email" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-secondary">Search</button>
                    </form>
                </div>
            </div> 
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                        <td>{{$student->id}}</td>
                        <td>{{$student->lname}}, {{$student->fname}} {{$student->mname}}</td>
                        <td>{{$student->email}}</td>
                       
                        <td>
                            <a href="{{route('students.details',$student->id)}}" class="btn btn-info btn-sm">View</a>
                            @if(session('user_role')==="admin")
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $students->links() }}
        </div>
    </div>
@endsection