<div>
    <div><h1>Money: <span style="color: {{$color}}">{{$ogAmount}}</span></h1></div>
    <div>
        <p>1000: {{$change[1000] ?? 0}}</p>
        <p>500: {{$change[500] ?? 0}}</p>
        <p>200: {{$change[200] ?? 0}}</p>
        <p>100: {{$change[100] ?? 0}}</p>
        <p>50: {{$change[50] ?? 0}}</p>
        <p>20: {{$change[20] ?? 0}}</p>
        <p>10: {{$change[10] ?? 0}}</p>
        <p>5: {{$change[5] ?? 0}}</p>
        <p>1: {{$change[1] ?? 0}}</p>
    </div>
    <div>
        <p>in words: {{$result}}</p>
    </div>
</div>