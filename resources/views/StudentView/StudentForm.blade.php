<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/student.css')}}">
    <title>Document</title>
</head>
<body>
    <h2>Student</h2>
    <img src="{{asset('Images/student2.png')}}" alt="">
<form action="/studentstore" method="post" class="formcontainer" enctype="multipart/form-data">
    <input type="text" name="Name" id="teacherinput" value={{$authname}} readonly>
    <div>{{$errors->first('Name')}}</div>
    <input type="text" name="email" id="teacherinput" value={{$authemail}} readonly>
    <div>{{$errors->first('email')}}</div>
    <input type="text" name="gender" id="teacherinput" placeholder="Enter your Gender">
    <div>{{$errors->first('gender')}}</div>
    <input type="text" name="age" id="teacherinput" placeholder="Enter your Age">
    <div>{{$errors->first('age')}}</div>
    <input type="text" name="institute" id="teacherinput" placeholder="Enter your Institute Name">
    <div>{{$errors->first('institute')}}</div>
    <input type="file" name="Identity" id="teacherinput" placeholder="Upload your Institute Identity Card Image">
    <div>{{$errors->first('Identity')}}</div>
    <input type="file" name="image" id="teacherinput" placeholder="Upload your Image">
    <div>{{$errors->first('image')}}</div>
    <input class="submitbtn"type="submit" value="submit" placeholder="Enter your name">
    @csrf
</form>
</body>
</html>
