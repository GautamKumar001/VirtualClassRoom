<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<form action="/store" method="post" enctype="multipart/form-data" class="p-5">
    <div class="form-group">
        <label for="exampleFormControlFile1">Upload Book Cover</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
        <div>{{$errors->first('image')}}</div>
    </div>
    @csrf
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>
