<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">All Books</h1>
            <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
        </div>
    
        @if($books->count())
            <div class="list-group">
                @foreach ($books as $book)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">{{ $book->title }}</h5>
                            <p class="mb-1 text-muted">by {{ $book->author }} | {{ $book->published_date }}</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">No books found.</div>
        @endif
    </div>    
</body>
</html>