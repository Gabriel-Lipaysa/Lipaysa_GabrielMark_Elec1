<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <title>Login</title>
</head>
<body class="container-fluid">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">Login</h3>
    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
    
                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
    
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary rounded-pill w-50">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>