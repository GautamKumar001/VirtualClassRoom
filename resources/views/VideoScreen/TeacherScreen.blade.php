<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/videoScreen.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="backgrnd">
        <img class="left" src="{{asset('../../figma/videochat1.png')}}" alt="image" >

        </div>
<div class="input">

    <form action="/Create" method="post">
        <span>Create a room</span>
        <input type="text" name="roomName" id="roomname">
        <input type="submit" value="Go">
        @csrf
    </form>
</div>
<div
class="rooms">
    @if($rooms)
    @foreach ($rooms as $room)
        <a href="{{ url('joinRoom/'.$room) }}">{{ $room }}</a>
    @endforeach
    @endif
</div>

</body>
</html>
