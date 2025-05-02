<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Image Upload (Single + Multiple)</title>
</head>
<body>
    <h1>Single Image Upload</h1>
    <form action="{{ route('single.image.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" required>
        <button type="submit">Upload</button>
    </form>

    <h1>Multiple Image Upload</h1>
    <form action="{{ route('multiple.image.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="images[]" multiple required>
        <button type="submit">Upload</button>
    </form>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <h3>Uploaded Images</h3>
    @if($photos->count())
        <div style="display: flex; flex-wrap: wrap; gap: 15px; align-content: center;">
            @foreach($photos as $photo)
                <div style="border: 1px solid #ccc; padding: 10px;">
                    <img src="{{ asset('images/' . $photo->image) }}" alt="Uploaded Image" width="150">
                    <form action="{{ route('photo.destroy', $photo) }}" method="POST" style="margin-top: 5px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: red;">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 20px;">
            {{ $photos->links() }}
        </div>
    @else
        <p>No photos uploaded yet.</p>
    @endif
</body>
</html>
