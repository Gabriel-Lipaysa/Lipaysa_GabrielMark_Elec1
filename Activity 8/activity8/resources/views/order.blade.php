<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=div, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
</head>
<body>
    <div class="container">
        <div class="row"><h1>Order Info</h1></div>
        <div style="display: flexbox; flex-direction: row">
            Customer ID: 
            <input type="text" value="{{$customerId}}" readonly>
        </div>
        <div style="display: flexbox; flex-direction: row">
            Name: 
            <input type="text" value="{{$name}}" readonly>
        </div>
        <div style="display: flexbox; flex-direction: row">
            Order No: 
            <input type="text" value="{{$orderNo}}" readonly>
        </div>
        <div style="display: flexbox; flex-direction: row">
            Date: 
            <input type="text" value="{{$date}}" readonly>
        </div>
    </div>
</body>
</html>