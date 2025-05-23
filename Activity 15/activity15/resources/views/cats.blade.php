<!DOCTYPE html>
<html>
<head>
    <title>Cat Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Cat Gallery</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($cats as $cat)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $cat['url'] }}" class="card-img-center" alt="Cat">
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-warning text-center" role="alert">
                        No cats available at the moment.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>
