<!DOCTYPE html>
<html>
<head>
    <title>Weather Info</title>
    <style>
        .row {
            display: flex;
            justify-content: space-between;
        }
        .column {
            flex: 1;
            padding: 15px;
            border: 1px solid #ccc;
            margin: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center">Weather Information</h1>
    <div class="row">
        @foreach ($weatherData as $data)
            <div class="column">
                <h2>{{ $data['city'] }}</h2>
                @if(isset($data['error']))
                    <p style="color: red;">{{ $data['error'] }}</p>
                @else
                    <p><strong>Temperature:</strong> {{ $data['temperature'] }}°C</p>
                    <p><strong>Description:</strong> {{ $data['description'] }}</p>
                    <p><strong>Humidity:</strong> {{ $data['humidity'] }}%</p>
                @endif
            </div>
        @endforeach
    </div>
</body>
</html>
