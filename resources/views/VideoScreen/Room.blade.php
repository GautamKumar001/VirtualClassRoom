<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/videoScreen2.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//media.twiliocdn.com/sdk/js/video/v1/twilio-video.min.js"></script>
    <script type="text/javascript">
        var teachersid;
        var localteacher;
        Twilio.Video.createLocalTracks({
            audio: true,
            video: true
        }).then(function (localTracks) {
            return Twilio.Video.connect('{{ $accessToken }}', {
                name: '{{ $roomName }}',
                tracks: localTracks,
            });
        }).then(function (room) {
            console.log(`Connected to Room: ${room.name}`);
            const localParticipant = room.localParticipant;
            //const remoteParticipant = room.remoteParticipant;
            console.log(`Connected to the Room as LocalParticipant "${localParticipant.identity}"`);
            //console.log(`Connected to the Room as RemoteParticipant "${remoteParticipant.identity}"`);
            let count = 0;
            const user = "{{Auth::user()->email}}";

            room.participants.forEach(participant => {
                count++;
                console.log(`Participant "${participant.identity}" is connected to the Room`);
                participantConnected(participant, room, count);
            });
            var previewContainer = document.getElementById(room.localParticipant.sid);
            if (!previewContainer || !previewContainer.querySelector('video')) {
                participantConnected(room.localParticipant, room);
            }

            room.on('participantConnected', function (participant) {
                count++;
                console.log("Participant count " + count);
                console.log("Joining:");
                participantConnected(participant, room, count);
            });

            room.on('participantDisconnected', function (participant) {
                console.log("Disconnected: ");
                participantDisconnected(participant, room);
            });
        });
        // additional functions will be added after this point
        function participantConnected(participant, room, count) {
            console.log("Participant count " + JSON.stringify(count));
            console.log('Participant connected' + participant.sid);
            console.log('Room deatils' + room);
            const localParticipant = room.localParticipant;
            if (participant == localParticipant) {
                var Temail = @json($teacheremail);
                for (i = 0; i < Temail.length; i++) {
                    if (Temail[i] == participant.identity) {
                        window.localteacher = Temail[i]
                    }
                }
                //console.log("remotetech2:=>" + techremote);
                console.log("localParticipant count " + count);
                console.log('Participant connected is local:=>' + participant);
                console.log('Participant connected has ID:=>' + participant.sid);
                //const teacherimg = document.getElementsByClassName('teacher');
                //teacherimg.remove();
                $(function(){
                    $('.student').remove();
                });

               const div=document.createElement('div');
                div.id = participant.sid;
                div.setAttribute("style",
                    "position: absolute;height:150px;width:250px;right:-520px; top:-30px"
                );
                div.innerHTML = "<div></div>";

                participant.tracks.forEach(function (track) {
                    trackAdded2(div, track)
                });

                participant.on('trackAdded', function (track) {
                    trackAdded2(div, track)
                });
                participant.on('trackRemoved', trackRemoved);

                document.getElementById('media-container').appendChild(div);

            } else {
                console.log("teacherlocalid=", localteacher);
                //console.log("remotetech3:=>" + techremote);
                var Temail = @json($teacheremail);
                for (i = 0; i < Temail.length; i++) {
                    if (Temail[i] == participant.identity) {
                        $(function(){
                    $('.teacher').remove();
                });
                        console.log(Temail[i] + ":=>Connected to the Room as Teacher")
                        console.log(participant.sid + ":=>Connected to the Room as Teacher")
                        window.teachersid = Temail[i];
                        console.log("teacherid=", teachersid);
                        const div = document.createElement('div');
                        div.id = participant.sid;
                        div.setAttribute("style",
                        "position: absolute;height:150px;width:250px;left:10px; top:-30px"
                        );
                        div.innerHTML = "<div></div>";

                        participant.tracks.forEach(function (track) {
                            //console.log("trackids:+>"+track.id);
                            trackAdded2(div, track);
                        });

                        participant.on('trackAdded', function (track) {
                            console.log("trackids:+>" + track.id);
                            trackAdded2(div, track)
                        });
                        participant.on('trackRemoved', trackRemoved);

                        document.getElementById('media-container').appendChild(div);
                    }
                    console.log("teacherid=", teachersid);
                    console.log("teacherlocalid=", localteacher);
                    //console.log("trackid:=>"+trackid);
                }
                const tdiv = document.getElementById(participant.sid);
                if (tdiv) {
                    console.log('count:=>' + count);
                    return;
                } else {
                    console.log("teacherid=", teachersid);
                    console.log("teacherlocalid=", localteacher);
                    //console.log("remotetech5:=>" + techremote);
                    console.log('Participant connected is Remote' + participant.identity);
                    var partiarr=[];
                     partiarr.push(participant.identity);
                     for (let index = 0; index < partiarr.length; index++) {
                        console.log("total paricipent:=",partiarr[index]);
                     }
                    console.log('Participant connected has ID:=>' + participant.sid);
                    console.log("Remote Participant count:=" + count);
                    console.log("local:=>" + localParticipant.identity);
                    let counts = null;
                    if (count === {}) {
                        count = 1;
                        console.log("Remote Participant countnan:=" + count);
                    }
                    if (localParticipant.identity == localteacher) {
                        counts = count - 1;
                        var partno=count;
                        var male = @json($male);
                        var female = @json($female);
                        var gname = ".girl" + partno;
                        console.log("girl:",partno);
                        var bname = ".boy" + partno;
                        console.log("boy:",partno);
                        for (let index = 0; index < male.length; index++) {
                            //console.log(male[i]);
                            if (male[index] == participant.identity) {
                                console.log("logged participent is female:",male[index]);

                                $(function()
                        {
                            $(bname).attr('src','{{asset('Images/vf5.png')}}');
                            console.log('changed');

                        })
                            }

                        }
                        for (let index = 0; index<female.length; index++) {
                            if (female[index] === participant.identity) {
                                console.log("logged participent is female:",female[index]);
                                $(function()
                        {
                            $(gname).attr('src','{{asset('Images/vf5.png')}}');
                            console.log('changed');

                        })
                            }
                            //console.log(female[index]);
                        }


                    } else {
                        counts = count - 2;
                        var partno2=count-1;
                        $(function()
                        {
                            $('.girl1').attr('src','{{asset('Images/vf5.png')}}');
                            console.log('changed');

                        })
                    }
                    console.log("Remote Participant counts:=" + counts);

                    console.log(`Participant "${participant.identity}" is connected to the Room`);
                    const div = document.getElementById('video-div');
                    /*div.setAttribute("style",
                        "position: relative;height: 100px;width: 933px; background-color: burlywood;  margin-top: 20px; border-radius: 6px; left: 300px;  box-shadow: 0 15px 80px 2px burlywood ;     margin-left: 10px;  text-align: center;"
                        );*/
                    const profile = document.createElement('button');
                    profile.id = participant.sid;
                    profile.setAttribute("style",
                        "position: absolute; height:40px ; width:40px ;float: left;   left:10px;  top:-70px; border-radius:50% ;background-color: chartreuse;"
                    );
                    const endcall = document.createElement('button');
                    endcall.id = participant.sid;
                    endcall.setAttribute("style",
                        " position: absolute; height:40px ; width:40px ;float: right; top:-70px;right:-92px; border-radius:50% ; background-color:rgb(222, 135, 164);"
                    );
                    const container = document.createElement('div');
             //const x = 100 + "px";
                    container.id = participant.sid;
                    container.setAttribute("style",
                        "position: absolute;height:100px;width:130px; left:355px; display:inline-block; top:10px"
                    );
                    // When a Participant joins the Room, log the event.
                    // When a Participant adds a Track, attach it to the DOM.
                    participant.on('trackAdded', function (track) {
                        container.appendChild(track.attach())
                        div.appendChild(container);
                        var mleft = 82;
                        //document.querySelector('div.content').style.top = Math.round( screen.height * percent)+'px';
                        if (counts == 0) {
                            var video = div.getElementsByTagName("video")[counts];
                            if (video) {
                                container.appendChild(profile);
                                container.appendChild(endcall);
                                video.id = track.id;
                                video.setAttribute("style",
                                    "position: absolute; height: 101px;width:259px;top:1px;left:-1px;");
                            }
                        } else if (counts > 0) {
                            var video = div.getElementsByTagName("video")[counts];
                            if (video) {
                                container.style.marginLeft = mleft + "px";
                                container.appendChild(profile);
                                container.appendChild(endcall);
                                video.id = track.id;
                                video.setAttribute("style",
                                    "position: absolute; height: 101px;width:259px;top:0px;left:-11px;");
                            }
                        }
                        /* var video = div.getElementsByTagName("video")[counts];
                         if (video) {
                             container.style.marginLeft=mleft+"px";
                             container.appendChild(profile);
                             container.appendChild(endcall);
                             video.id = track.id;
                             video.setAttribute("style",
                                 "position: relative; height: 100px;width:250px;top:0px;left:-8px;");
                         }*/
                        document.getElementById('media-container').appendChild(div)

                    });
                    // Attach the Tracks of the Room's Participants.
                    participant.tracks.forEach(function (track) {
                        // const container = document.getElementById('container');
                        container.appendChild(track.attach())
                        div.appendChild(track.attach());
                        var video = div.getElementsByTagName("video")[counts];
                        if (video) {
                            video.id = track.id;
                            video.setAttribute("style",
                                "position: absolute; height: 100px;width:250px;top:0px;left:0px;");
                            container.appendChild(profile);
                            container.appendChild(endcall);
                        }
                        document.getElementById('media-container').appendChild(div)
                    });
                    participant.on('trackRemoved', trackRemoved);
                }
            }


        }

        function participantDisconnected(participant, room) {
            console.log('Participant disconnected:=>' + participant.sid);
            console.log('Participant disconnected' + participant);
            const localParticipant = room.localParticipant;
            if (participant == localParticipant) {
                console.log('localParticipant disconnected:=>' + participant.sid);
                participant.tracks.forEach(trackRemoved);
                document.getElementById(participant.sid).remove();
            } else {
                console.log('RemoteParticipant disconnected:=>' + participant.sid);
                participant.tracks.forEach(trackRemoved);
                document.getElementById(participant.sid).remove();
            }

        }

        function trackRemoved(track) {
            track.detach().forEach(function (element) {
                element.remove()
            });
        }

        function trackAdded2(div, track) {
            div.appendChild(track.attach());
            var video = div.getElementsByTagName("video")[0];
            if (video) {
                video.setAttribute("style", "position: relative; height: 250px;width: 250px;border-radius: 30%;");
            }
        }

        function trackRemoved2(track) {
            track.detach().forEach(function (element) {
                element.remove()
            });
        }
    </script>
</head>

<body>

    <div class="room" id="media-container">

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
        <img src="{{asset('Images/Boy.png')}}" alt="" class="girl15">
        <img src="{{asset('Images/Girl.png')}}" alt="" class="boy15">
        <img src="{{asset('Images/Boy.png')}}" alt="" class="girl16">
        <img src="{{asset('Images/Girl.png')}}" alt="" class="boy16">
        <img src="{{asset('Images/Boy.png')}}" alt="" class="girl17">
        <img src="{{asset('Images/Girl.png')}}" alt="" class="boy17">
    </div>

    </div>

    </body>

</html>
