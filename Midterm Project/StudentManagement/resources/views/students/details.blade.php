@extends('layouts.app')

@section('title', 'Student Details')

@section('content')

    <div class="container p-5 bg-primary text-white">
        <h2>Student Details</h2>
        <h4>View Profile</h4>
    </div>

    <div class="container shadow my-3 bg-body rounded mx-3 p-4">
        <div class="row">
            <div class="col">
                <h2 class="mb-4">{{$student->fname}} {{$student->mname}} {{$student->lname}}</h2>
            </div>
            <div class="col">
                <div class="d-flex justify-content-end">
                    <a href="{{route('students.edit', $student->id)}}" class="btn btn-warning me-2">Edit</a>
                    <a href="{{route('students.grades.index', $student->id)}}" class="btn btn-info ">View Reports</a>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="p-3 border rounded bg-light">
                    <h5 class="text-primary">Personal Information</h5>
                    <hr>
                    <div class="mb-2">
                        <strong>Gender:</strong>
                        <p class="text-muted">{{$student->sex}}</p>
                    </div>

                    <div class="mb-2">
                        <strong>Date of Birth:</strong>
                        <p class="text-muted">{{ date('F j, Y', strtotime($student->dob)) }}</p>
                    </div>

                    <div class="mb-2">
                        <strong>Phone:</strong>
                        <p class="text-muted">{{ $student->phone }}</p>
                    </div>  

                    <div class="mb-2">
                        <strong>Address:</strong>
                        <p class="text-muted">{{ $student->address }}</p>
                    </div>
                    
                    <div class="mb-2">
                        <strong>Email:</strong>
                        <p class="text-muted">{{ $student->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="p-3 border rounded bg-light">
                    <h5 class="text-primary">Guardian Information</h5>
                    <hr>
                    <div class="mb-2">
                        <strong>Guardian's Name:</strong>
                        <p class="text-muted">{{ $student->guardian_name }}</p>
                    </div>  

                    <div class="mb-2">
                        <strong>Guardian's Contact Number:</strong>
                        <p class="text-muted">{{ $student->guardian_phone }}</p>
                    </div>  
                </div>

                <!-- Status Section -->
                <div class="p-3 mt-3 border rounded bg-light">
                    <h5 class="text-primary">Status</h5>
                    <hr>
                    <div class="mb-2">
                        <strong>Current Status:</strong>
                        
                        @if(in_array($student->status, ['Active', 'Inactive', 'Graduated', 'Dropped']))
                            <span class="badge 
                                @if($student->status == 'Active') bg-success 
                                @elseif($student->status == 'Inactive') bg-secondary 
                                @elseif($student->status == 'Graduated') bg-warning 
                                @elseif($student->status == 'Dropped') bg-danger 
                                @endif">    
                                {{ $student->status }}
                            </span>
                        @else
                            <span class="badge bg-secondary">Unknown</span> 
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection
