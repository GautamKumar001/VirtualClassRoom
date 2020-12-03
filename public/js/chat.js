
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

                    $('.messenger').hide();
                    $('.user-wrapper').show();
                    $('.btn').show();
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

                        // alert(reciever_id);
                        $(this).val('');

                        var datastr = "reciever_id=" + reciever_id + "&message=" + message;
                        $.ajax({
                            type: "POST",
                            url: "message",
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

