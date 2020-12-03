<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<script type="text/javascript">
$(function () {
    "use strict";
    $(".pCard_add").click(function () {
      $(".pCard_card").toggleClass("pCard_on");
      $(".pCard_add i").toggleClass("fa-minus");
    });
  });

</script>

    <link rel="stylesheet" href="{{ asset('css/teacherpro.css') }}">
</head>

<body>
    <div>
        @include('Navbar')
    </div>
    <div class="lefttab">
         <div class="demo0">
            <div class="pimage"></div>
            <img src="{{asset('figma/profilestand.png')}}" alt="" class="pstand">
                <form action="/Tprofile" method="post" enctype="multipart/form-data" class="p-5">
                    <div class="form-group">
                        <label for="exampleFormControlFile3" class="PPadd-btn PPaddbtn-1">  <i class="fa fa-cloud-upload "></i></label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile3" name="Pimage">
                        <div class="PPerror">{{$errors->first('Pimage')}}</div>
                    </div>
                    @csrf
                    <button  type="submit"  class="Uadd-btn Uaddbtn-1">Update</button>
                </form>
         </div>

        <div class="demo3">
            <div class="input">
                <form action="/Create" method="post">
                    <input type="text" name="roomName" id="roomname" placeholder="Enter ClassRoom Name">
                    <input type="submit" value="Create ClassRoom" class="Vadd-btn Vaddbtn-1">
                    @csrf
                </form>
            </div>
        <img src="{{asset('figma/pablo-class.png')}}" alt="" class="classroom">
    </div>
        <div class="demo4">
            <img src="{{asset('icon/chatting.png')}}" alt="" class="chatroom">
        <div class="frame1">
            <button class="Cadd-btn Caddbtn-1">CHAT<div class="dot"></div></button>
        </div>
        </div>
    </div>
    <div class="center">
        <div class="teacher">
<div class="profile">

    <img src="{{asset('storage/app/public/uploads/5oe4uxu1ELxJtLYtya6y1BwUcUYqK2reCTr4NdqB.png')}}"
    alt="Tecaher Id" class="profileimg">
</div>
<div class="details">
    <div class="name">
Teacher Name
    </div>
        <div class="quote">
            <div class="left">❝</div>
            <blockquote>
              The deeds you do may be the only sermon some persons will hear today.
            </blockquote>
            <div class="right">❞</div>
        </div>

    <footer class="fotter">
        <div class="footer-social-icons">
            <ul class="social-icons">
                <li><a href="javascript:fbShare('http://short.url', 'This is the header text for the URL', 'This is the description text.', 'http://facebook-thumb.url', 300, 300)"  class="facebook social-icon"> <i class="fa fa-facebook"></i></a></li>
                <li><a class="twitter popup social-icon" href="http://twitter.com/intent/tweet?text=This+is+the+text+of+the+tweet+http://short.url+%23hash+%23tags" ><i class="fa fa-twitter"></i></a></li>
                <li><a href="" class="social-icon"> <i class="fa fa-youtube"></i></a></li>
                <li><a href="" class="social-icon"> <i class="fa fa-github"></i></a></li>
                <li><a href="javascript:fbShareinst('http://short.url', 'This is the header text for the URL', 'This is the description text.', 'http://instagram-thumb.url/', 300, 300)"class="social-icon"> <i class="fa fa-instagram"></i></a></li>
            </ul>
        </div>
    </footer>
</div>
<div class="frame2">
    <button class="custom-btn2 btn-2">Send A Message<div class="dot1"></div></button>
</div>
        </div>
        <div class="teaschdule">
            <div class="frame1">
                <button class="add-btn addbtn-1"><div class="dot">+</div></button>
            </div>
            <div class="schdule">
                <p>dfzdrxgbcfvhnfhjm</p>
                <div class="date"><p>24/10/1989</p></div>
                <div class="time"><p>8:30 AM</p></div>
            </div>
            <div class="schdule">
                <p>dfzdrxgbcfvhnfhjm</p>
                <div class="date"><p>24/10/1989</p></div>
                <div class="time"><p>8:30 AM</p></div>
            </div>
            <div class="schdule">
                <p>dfzdrxgbcfvhnfhjm</p>
                <div class="date"><p>24/10/1989</p></div>
                <div class="time"><p>8:30 AM</p></div>
            </div>
            <div class="schdule">
                <p>dfzdrxgbcfvhnfhjm</p>
                <div class="date"><p>24/10/1989</p></div>
                <div class="time"><p>8:30 AM</p></div>
            </div>
        </div>
        <div class="plus">
            <div class="panel">
                <form action="/Tschedule" class="form" method="POST" enctype="multipart/form-data">
                    <input name="Schdule" placeholder='Schdule Description' type="text" id ="schedule">
                    <div class="Scherror">{{$errors->first('Schdule')}}</div>
                    <input name="DateTime" type="text" class="datetimepicker" placeholder='Enter DateTime' id ="DT">
                   <div class="DTerror">{{$errors->first('DateTime')}}</div>
                    @csrf
                    <button class="login">ADD SCHEDULE</div>

                </form>

            </div>
        </div>

        <div class="interest2"></div>
        <div class="interest3"></div>
        <div class="studentlist">
            <img src="{{asset('figma/teacherr.png')}}" alt="" class="tright">
            <div class="frame1">
                <input class="custom-in in-1" placeholder="Search student...."><div class="dot"></div>
            </div>
            <div class="xc">1</div>
            <div class="xc">2</div>
            <div class="xc">3</div>
            <div class="xc">4</div>
            <div class="xc">5</div>
            <div class="xc">6</div>
            <div class="xc">7</div>
            <div class="xc">8</div>
            <div class="xc">9</div>
            <div class="xc">10</div>
            <div class="xc">6</div>
            <div class="xc">7</div>
            <div class="xc">8</div>
            <div class="xc">9</div>
            <div class="xc">10</div>
            <img src="{{asset('figma/teacherl.png')}}" alt="" class="tleft">
        </div>
        <div class="pCard_card">
            <div class="pCard_up">
               <div class="pCard_text">
                  <h2>Van Goggles</h2>
                  <p>UI/UX Designer &amp; UI Developer</p>
               </div>
               <div class="pCard_add"><i class="fa fa-plus"></i></div>
            </div>
            <div class="pCard_down">
               <div>
                  <p>Projects</p>
                  <p>126</p>
               </div>
               <div>
                  <p>Views</p>
                  <p>21,579</p>
               </div>
               <div>
                  <p>Likes</p>
                  <p>1,976</p>
               </div>
            </div>
            <div class="pCard_back">
              <a href=""> <i class="fa fa-facebook fa-2x fa-fw"></i></a>
              <a href="http://twitter.com/intent/tweet?text=This+is+the+text+of+the+tweet+http://short.url+%23hash+%23tags" ><i class="fa fa-twitter fa-2x fa-fw"></i></a>
              <a href=""> <i class="fa fa-youtube fa-2x fa-fw"></i></a>
              <a href=""> <i class="fa fa-github fa-2x fa-fw"></i></a>
              <a href="javascript:fbShareinst('http://short.url', 'This is the header text for the URL', 'This is the description text.', 'http://instagram-thumb.url/', 300, 300)"class="social-icon"> <i class="fa fa-instagram fa-2x fa-fw"></i></a>
              <a href=""> <i class="fa fa-facebook fa-2x fa-fw"></i></a>
              <a href="http://twitter.com/intent/tweet?text=This+is+the+text+of+the+tweet+http://short.url+%23hash+%23tags" ><i class="fa fa-twitter fa-2x fa-fw"></i></a>
              <a href=""> <i class="fa fa-youtube fa-2x fa-fw"></i></a>
              <a href=""> <i class="fa fa-github fa-2x fa-fw"></i></a>
              <a href="javascript:fbShareinst('http://short.url', 'This is the header text for the URL', 'This is the description text.', 'http://instagram-thumb.url/', 300, 300)"class="social-icon"> <i class="fa fa-instagram fa-2x fa-fw"></i></a>
               <p>Follow Me!</p>
            </div>
         </div>
    </div>
    <div class="right1">
        @for ($i =0 ; $i <20 ; $i++) <div class="wrapper  ">
            <div class="img-area ">

                <img src="{{asset('storage/app/public/uploads/5oe4uxu1ELxJtLYtya6y1BwUcUYqK2reCTr4NdqB.png')}}"
                    alt="image" height="100" width="100">

            </div>

    </div>
    @endfor

    <div class="frame1">
        <button class="Badd-btn Baddbtn-1">+<div class="dot"></div></button>
    </div>
    </div>
    <div class="Bookplus">
        <div class="Bpanel">
            <div class="state"><br><i class="fa fa-unlock-alt"></i><br><h3>ADD BOOK</h3></div>
            <form action="/TBookStore" method="post" enctype="multipart/form-data" class="p-5">
                <div class="form-group">
                    <input type="text"  class="BNadd-btn BNaddbtn-1"  name="Bname" placeholder="Enter Book Name">
                    <div class="BNerror">{{$errors->first('Bname')}}</div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile2" class="BCadd-btn BCaddbtn-1">  <p id="Book1">Choose Book cover</p> </i></label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile2" name="Bimage">
                    <div class="BIerror">{{$errors->first('Bimage')}}</div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1" class="BPadd-btn BPaddbtn-1">  <p id="Book2">Choose Book</p> </i></label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="Bpdf">
                    <div class="BPerror">{{$errors->first('Bpdf')}}</div>
                </div>
                @csrf
                <button type="submit" class="BBadd-btn BBaddbtn-1">Submit</button>
            </form>
        </div>

    </div>
    <div class="right2">
        @for ($i =0 ; $i <20 ; $i++) <div class="wrapper2  ">
            <div class="img-area2 ">

                <img src="{{asset('storage/app/public/uploads/5oe4uxu1ELxJtLYtya6y1BwUcUYqK2reCTr4NdqB.png')}}"
                    alt="image" height="100" width="100">

            </div>

    </div>
    @endfor
    <div class="frame1">
        <button class="Nadd-btn Naddbtn-1">+<div class="dot"></div></button>
    </div>

    </div>
    <div class="Noteplus">
        <div class="Npanel">
            <div class="state"><br><i class="fa fa-unlock-alt"></i><br><h3>ADD NOTES</h3></div>
            <form action="/TNoteStore" method="post" enctype="multipart/form-data" class="p-5">
                <div class="form-group">
                    <input type="text"  class="NNadd-btn NNaddbtn-1"  name="Nname" placeholder="Enter Note Name">
                    <div class="NNerror">{{$errors->first('Nname')}}</div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile2" class="NCadd-btn NCaddbtn-1">   <p id="Note1">Upload Note cover</p> </i></label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile2" name="Nimage">
                    <div class="NIerror">{{$errors->first('Nimage')}}</div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1" class="NPadd-btn NPaddbtn-1">   <p id="Note2">Upload Notes</p> </i></label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="Npdf">
                    <div class="NPerror">{{$errors->first('Npdf')}}</div>
                </div>
                @csrf
                <button type="submit" class="NBadd-btn NBaddbtn-1">Submit</button>
            </form>

        </div>
    </div>


    <script type="text/javascript">
        $(function () {
            $('.datetimepicker').datetimepicker();
        });
    </script>
</body>

</html>
