<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Student Management')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
</head>
<body class="vh-100 overflow-hidden">
    <div class="container-fluid h-100">
        <div class="row h-100">
            {{-- Sidebar --}}
            <div class="col-lg-2 bg-dark text-white d-flex flex-column p-3">
                <h4 class="text-center mt-4">Student Management</h4>
                <hr/>
                <ul class="nav flex-column mt-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('students.index')}}">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('courses.index')}}">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('enrollments.index')}}">Enrollments</a>
                    </li>
                </ul>
            </div>

            {{-- Main Content --}}
            <div class="col-lg-10 p-0 overflow-auto vh-100">
                @yield('content') 
            </div>
        </div>
    </div>
</body>
</html>
