<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Login</title>
</head>

<body class="container-fluid">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">Login</h3>

                    {{-- Display success message if user logs out --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Display validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary rounded-pill w-50">Login</button>
                        </div>
                    </form>

                    {{-- Prevent logged-in users from accessing login page --}}
                    @if(session('user_role'))
                        <script>
                            @if(session('user_role') === 'admin')
                                window.location.href = "{{ route('admin.dashboard') }}";
                            @elseif(session('user_role') === 'teacher')
                                window.location.href = "{{ route('students.index') }}";
                            @elseif(session('user_role') === 'student')
                                window.location.href = "{{ route('students.details', ['id' => session('student_id')]) }}";
                            @endif
                        </script>
                    @endif


                </div>
            </div>
        </div>
    </div>
</body>

</html>