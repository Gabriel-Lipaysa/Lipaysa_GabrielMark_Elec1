<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>QR Code</title>
</head>
<body>
    <div class="bg-primary p-2 d-flex justify-content-between align-items-center">
        <div>
            <h4><a href="{{route('students.index')}}" class="text-white text-decoration-none">QR Code Generator</a></h4>
        </div>
        <div>@yield('search')</div>
    </div>
    <div class="container py-5">
        @yield('content')
    </div>
</body>
</html>