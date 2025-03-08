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
            Transport No: 
            <input type="text" value="{{$transNo}}" readonly>
        </div>
        <div style="display: flexbox; flex-direction: row">
            Order No: 
            <input type="text" value="{{$orderNo}}" readonly>
        </div>
        <div style="display: flexbox; flex-direction: row">
            Item No: 
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
        <div style="display: flexbox; flex-direction: row">
            Quantity: 
            <input type="text" value="{{$qty}}" readonly>
        </div>
    </div>
</body>
</html>