@extends('master')

@section('search')
    <div class="container mt-2">
        <form action="{{ route('students.index') }}" method="GET">
            <div class="row mb-3">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Search by name">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('content')
    <div class="container">
        <h1>Students</h1>
        <a href="{{ route('students.create') }}" class="btn btn-success mb-3">Add Student</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>QR Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->fname}} {{ $student->lname}}</td>
                        <td class="text-center">
                            {{ QR::size(60)->generate("Full name: " . $student->fname . " " . $student->lname . "\nAddress: " . $student->address . "\nEmail: " . $student->email . "\nBirthdate: " . $student->bdate) }}
                        </td>
                        <td>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
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