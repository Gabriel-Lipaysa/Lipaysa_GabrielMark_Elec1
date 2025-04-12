<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>Create</title>
</head>
<body class="container p-5">
    <h1 class="mb-4">Add New Book</h1>

    <form action="{{ route('books.store') }}" method="POST" class="border p-4 rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" id="author" name="author" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="published_date" class="form-label">Published Date</label>
            <input type="date" id="published_date" name="published_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">Back</a>
    </form>
</body>
</html>