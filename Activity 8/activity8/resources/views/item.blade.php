<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=div, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Item</title>
</head>
<body>
    <div class="container">
        <div class="row"><h1>Item Info</h1></div>
        <div style="display: flexbox; flex-direction: row">
            Item ID: 
            <input type="text" value="{{$itemNo}}" readonly>
        </div>
        <div style="display: flexbox; flex-direction: row">
            Name: 
            <input type="text" value="{{$name}}" readonly>
        </div>
        <div style="display: flexbox; flex-direction: row">
            Price: 
            <input type="text" value="{{$price}}" readonly>
        </div>
    </div>
</body>
</html>