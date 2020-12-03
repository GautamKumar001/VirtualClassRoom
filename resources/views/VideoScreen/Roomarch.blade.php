
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/videoScreen2.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script >
         $(function(){
            $('#my_image').on({
    'click': function(){
          $('.girl15').attr('src','{{asset('Images/video.png')}}');
    }

                });
            });
    </script>
</head>

<body>

<div class="room">
    <div class="teacher">
        <img src="{{asset('Images/teacher.png')}}" alt="" class="teacher" id="my_image">
    </div>
    <div class="student">
        <img src="{{asset('Images/student.png')}}" alt="" class="student">
    </div>

    <div class="row2" id="video-div">
        <img src="{{asset('Images/Girl.png')}}" alt="" class="girl1">
        <img src="{{asset('Images/Boy.png')}}" alt="" class="boy1">
        <img src="{{asset('Images/Girl.png')}}" alt="" class="girl2">
        <img src="{{asset('Images/Boy.png')}}" alt="" class="boy2">
        <img src="{{asset('Images/Girl.png')}}" alt="" class="girl3">
        <img src="{{asset('Images/Boy.png')}}" alt="" class="boy3">
  </div>
<div class="row3">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl4">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy4">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl5">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy5">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl6">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy6">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl7">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy7">
</div>
<div class="row4">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl8">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy8">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl9">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy9">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl10">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy10">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl11">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy11">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl12">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy12">
</div>
<div class="row5">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl13">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy13">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl14">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy14">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl15">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy15">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl16">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy16">
    <img src="{{asset('Images/Girl.png')}}" alt="" class="girl17">
    <img src="{{asset('Images/Boy.png')}}" alt="" class="boy17">
</div>


</div>

</body>

</html>
