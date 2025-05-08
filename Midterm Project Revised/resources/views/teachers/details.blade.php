@extends("layouts.app")

@section('title', 'Teacher Details')

@section('content')
    <div class="container p-5">
        <h2>Teacher Details</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Name: {{ $teacher->fname }} {{ $teacher->lname }}</h5>
                <p><strong>Phone:</strong> {{ $teacher->phone }}</p>
                <p><strong>Department:</strong> {{ $teacher->department }}</p>
                <p><strong>Email:</strong> {{ $teacher->email }}</p>
                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning">Edit Teacher</a>
            </div>
        </div>
    </div>
@endsection
