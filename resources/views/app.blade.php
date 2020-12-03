<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    <link rel="stylesheet" href="{{asset('css/nav.css')}}">
    </head>
    <body>
       <div id="root"></div>
       <div class="navigation">
           <a href="/TeacherUi" class="teacher">TeacherShow</a>
           <a href="/studentUi" class="student">StudentSHow</a>
           <a href="/teachershow" class="teacher">Teacherprofile</a>
           <a href="/studentshow" class="student">Studentprofile</a>
           <a href="/teacherindex" class="teacher">TeacherForm</a>
           <a href="/studentindex" class="student">StudentForm</a>
           <a href="/home" class="student">Home</a>
           <a href="/roomarch" class="Room">ROOM</a>
       </div>
    <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
