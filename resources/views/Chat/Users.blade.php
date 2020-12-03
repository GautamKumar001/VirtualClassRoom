
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/Agents.css')}}" />
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/slide.css')}}" />
    <link rel="stylesheet" href="{{asset('css/chats.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700i" rel="stylesheet">

</head>
    <body>
        <div class="backgrnd">
            <img class="left" src="{{asset('../../figma/chatui1.png')}}" alt="image" >
            <img class="right" src="{{asset('../../figma/chatui2.png')}}" alt="">
            </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="user-wrapper">
                        <ul class="users">
                            @foreach ($users as $user)
                            <li class="user" id="{{$user->id}}">
                                @if($user->unread)
                                <span class="pending">
                                    {{$user->unread}}
                                </span>
                                @endif
                                <div class="media">
                                    <div class="media-left">
                                        <img src="{{$user->avatar}}" alt="" class="media-object">
                                    </div>
                                  </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="search">
                    <input type="text" name="search" placeholder="search" class="in">
                </div>
                <div class="col-md-8" id="messages">
                </div>
                <div class="col-md-8" id="messages2">
                </div>
            </div>
        </div>
        <div class="messenger">
            <img src="../Images/chat-icon-low-polygonal-abstract-chat-sign-speech-bubble-message-symbol_127544-93.jpg"
                alt="" class="fa">
        </div>


        <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            var reciever_id = '';
            var status='off';
            var my_id = "{{Auth::id()}}";
            var status="{{Auth::user()->status}}";

            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                console.log(status);
                // Enable pusher logging - don't include this in production
                Pusher.logToConsole = true;

                var pusher = new Pusher('001a953514d3d7eff8e3', {
                    cluster: 'ap2'
                });

                var channel = pusher.subscribe('my-channel');
                channel.bind('my-event', function (data) {
                    if (my_id == data.from) {
                        $('#' + data.to).click();

                    } else if (my_id == data.to) {
                        if (reciever_id == data.from) {
                            $('#' + data.from).click();
                        } else {
                            var pending = parseInt($('#' + data.from).find('.pending').html());

                            if (pending) {
                                $('#' + data.from).find('.pending').html(pending + 1);
                            } else {
                                $('#' + data.from).append('<span class="pending">1</span>')
                                $('#' + data.from).append('<span class="status"></span>')

                            }
                        }
                    }
                });
                $('.messenger').click(function () {

                    $('.right').hide();
                    $('.messenger').hide();
                    $('.user-wrapper').show();
                })
                $('.btn').click(function () {
                    $('.in').show();
                    var name = $('.user').val();

                    //alert(name);
                    /*if(name!='')
                    {
                        $.ajax({
                                type:"get",
                                url:"getname/"+name,
                                data:"",
                                cache:false,
                                success:function(data)
                                {
                                    $('#messages').html(data);
                                 scrollToBottomFunc();
                                },

                            })
                    }*/
                })
                $(document).on('keyup', '.in', function (e) {

                    var name = $('.in').val();


                    if (e.keyCode == 13 && name != '') {
                        //alert(name);
                        $.ajax({
                            type: "get",
                            url: "getname/" + name,
                            data: "",
                            cache: false,
                            success: function (data) {
                                $(".user-wrapper").remove();
                                $(document).ready(function()
            {

                $('.messenger').hide();
                $(".user-wrapper").show();
            })
            $('#messages2').html(data);
                               // $(".messenger").remove();

                                //scrollToBottomFunc();
                            },

                        })
                    }
                })

                $('.user').click(function () {
                    $('.user').removeClass('active');
                    $(this).addClass('active');
                    $(this).find('.pending').remove();

                    $reciever_id = $(this).attr('id');

                    // alert($reciever_id)

                    $.ajax({
                        type: "get",
                        url: "message/" + $reciever_id,
                        data: "",
                        cache: false,
                        success: function (data) {
                            //alert(data);
                            $('#messages').html(data);
                            scrollToBottomFunc();
                        }
                    });
                });
                $('.media-left').click(function () {
                    // alert('lets chane image');
                });


                $(document).on('keyup', '.input-text input', function (e) {
                    var message = $(this).val();

                    var reciever_id = $reciever_id;

                    if (e.keyCode == 13 && message != '' && reciever_id != '') {

                         //alert(reciever_id);
                         //alert(message);
                        $(this).val('');

                        var datastr = "reciever_id=" + reciever_id + "&message=" + message;
                        $.ajax({
                            type: "post",
                            url: "sendmessage",
                            data: datastr,
                            cache: false,
                            success: function (data) {

                            },
                            error: function (jqXHR, status, err) {

                            },
                            complete: function () {
                                scrollToBottomFunc();

                            }
                        });
                    }
                });
            });

            function scrollToBottomFunc() {
                $('.message-wrapper').animate({
                    scrollTop: $('.message-wrapper').get(0).scrollHeight

                }, 50);
            }
        </script>


    </body>

    </html>

