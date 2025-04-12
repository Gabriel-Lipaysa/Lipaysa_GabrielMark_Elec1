<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>Edit</title>
</head>
<body>
    <div class="container mt-5">
        <div class="container mt-5">
            <h1 class="mb-4">Edit Book</h1>
        
            <form action="{{ route('books.update', $book->id) }}" method="POST" class="border p-4 rounded shadow-sm">
                @csrf
                @method('PUT')
        
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" name="title" value="{{ $book->title }}" class="form-control" required>
                </div>
        
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" id="author" name="author" value="{{ $book->author }}" class="form-control" required>
                </div>
        
                <div class="mb-3">
                    <label for="published_date" class="form-label">Published Date</label>
                    <input type="date" id="published_date" name="published_date" value="{{ $book->published_date }}" class="form-control" required>
                </div>
        
                <button type="submit" class="btn btn-success">Save Changes</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">Back</a>
            </form>
        </div>    
    </div>    
</body>
</html>