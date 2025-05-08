@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid p-5">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="bg-primary rounded p-3 text-white">
                    <h5>Total Enrollments</h5>
                    <h4>{{ $data['Total_Enrollment'] }}</h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-primary rounded p-3 text-white">
                    <h5>Total Students</h5>
                    <h4>{{ $data['Total_Students'] }}</h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-primary rounded p-3 text-white">
                    <h5>Total Courses</h5>
                    <h4>{{ $data['Total_Courses'] }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
