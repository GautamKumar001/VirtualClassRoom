<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/videoScreen.css') }}">
    <script src="//media.twiliocdn.com/sdk/js/video/v1/twilio-video.min.js"></script>
    <script>
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
            console.log(`Connected to the Room as LocalParticipant "${localParticipant.identity}"`);
            let count=0;
            room.participants.forEach(participant => {
                count++;
                console.log(`Participant "${participant.identity}" is connected to the Room`);
                participantConnected(participant, room,count);
            });
            room.participants.forEach(participantConnected);

            var previewContainer = document.getElementById(room.localParticipant.sid);
            if (!previewContainer || !previewContainer.querySelector('video')) {
                participantConnected(room.localParticipant, room);
            }

            room.on('participantConnected', function (participant) {
                count++;
                console.log("Participant count " +count );
                console.log("Joining:");
                participantConnected(participant, room,count);
            });

            room.on('participantDisconnected', function (participant) {
                console.log("Disconnected: ");
                participantDisconnected(participant, room);
            });
        });
        // additional functions will be added after this point
        function participantConnected(participant, room,count) {
            console.log("Participant count " +count );
            console.log('Participant connected' + participant);
            console.log('Room deatils' + room);
            const localParticipant = room.localParticipant;
            if (participant == localParticipant) {
                console.log("localParticipant count " +count );
                console.log('Participant connected is local' + participant);
                const div = document.createElement('div');
                div.id = participant.sid;
                div.setAttribute("style",
                    "position: absolute;height:300px;width:300px;background-color:burlywood ;border:2px solid black;border-radius: 50%;right:403px;"
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
                console.log("Remote Participant count" + count );

                let counts=count-1;
                console.log("Remote Participant count:=" + counts );

                console.log(`Participant "${participant.identity}" is connected to the Room`);
                const div = document.getElementById('video-div');
                // When a Participant joins the Room, log the event.
               // When a Participant adds a Track, attach it to the DOM.
   participant.on('trackAdded', function (track) {
if(counts==undefined)
{
    exit();

}
            else{
                console.log("Remote Participant count2=" + counts );
                    div.appendChild(track.attach());
                    var video = div.getElementsByTagName("video")[counts];
                        if (video) {
                            console.log("video is displaying");
                            video.id=track.id;
                            video.setAttribute("style","height: 100px;width: 220px;");
                        }
                    document.getElementById('media-container').appendChild(div);
            }
                });
                // Attach the Tracks of the Room's Participants.
                participant.tracks.forEach(function (track) {
                    console.log("Remote Participant count1=" + counts );
                    console.log('trackid:=>'+track.id);
if(counts==undefined)
{
    return;
}
else{
    div.appendChild(track.attach());
                      var video = div.getElementsByTagName("video")[counts];
                        if (video) {
                            video.id=track.id;
                            video.setAttribute("style", "height: 100px;width: 220px;");
                        }
                    document.getElementById('media-container').appendChild(div);
}


                });

                participant.on('trackRemoved', trackRemoved);
            }
        }

        function participantDisconnected(participant, room) {
            console.log('Participant disconnected' + participant);

            participant.tracks.forEach(trackRemoved);
            //document.getElementsById(trackRemoved.id).remove();
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
                video.setAttribute("style", "position: relative; height: 300px;width: 300px;border-radius: 60%;");
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
    <div class="content">
        <div class="title m-b-md">
            Video Chat Rooms
            <p>{{ $accessToken }}</p>
            <p>{{ $roomName }}</p>
        </div>

        <div id="media-container">
            <div id="video-div">


            </div>

        </div>
    </div>

</body>

</html>
