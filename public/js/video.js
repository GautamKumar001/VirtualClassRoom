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
        var Temail = json($teacheremail);
        for (i = 0; i < Temail.length; i++) {
            if (Temail[i] == participant.identity) {
                window.localteacher = Temail[i]
            }
        }
        //console.log("remotetech2:=>" + techremote);
        console.log("localParticipant count " + count);
        console.log('Participant connected is local:=>' + participant);
        console.log('Participant connected has ID:=>' + participant.sid);
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
        console.log("teacherlocalid=", localteacher);
        //console.log("remotetech3:=>" + techremote);
        var Temail = json($teacheremail);
        for (i = 0; i < Temail.length; i++) {
            if (Temail[i] == participant.identity) {
                console.log(Temail[i] + ":=>Connected to the Room as Teacher")
                console.log(participant.sid + ":=>Connected to the Room as Teacher")
                window.teachersid = Temail[i];
                console.log("teacherid=", teachersid);
                const div = document.createElement('div');
                div.id = participant.sid;
                div.setAttribute("style",
                    "position: absolute;height:300px;width:300px;background-color:burlywood ;border:2px solid black;border-radius: 50%;right:303px;"
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
        }
         else {
            console.log("teacherid=", teachersid);
            console.log("teacherlocalid=", localteacher);
            //console.log("remotetech5:=>" + techremote);
            console.log('Participant connected is Remote' + participant.identity);
            console.log('Participant connected has ID:=>' + participant.sid);
            console.log("Remote Participant count:=" + count);
            console.log("local:=>" + localParticipant.identity);
            let counts = null;
            if (count === {}) {
                count = 1;
                console.log("Remote Participant countnan:=" + count);
            }
            if (localParticipant.identity == localteacher) {
                counts = count-1;
            }
            else{
                counts = count - 2;
            }
            console.log("Remote Participant counts:=" + counts);

            console.log(`Participant "${participant.identity}" is connected to the Room`);
            const div = document.getElementById('video-div');
            const profile = document.createElement('button');
            profile.id = participant.sid;
            profile.setAttribute("style",
                "position: relative; height:40px ; width:40px ;float: left;   left:10px;  top:-70px; border-radius:50% ;background-color: chartreuse;"
            );
            const endcall = document.createElement('button');
            endcall.id = participant.sid;
            endcall.setAttribute("style",
                " position: relative; height:40px ; width:40px ;float: right; top:-70px;right:-92px; border-radius:50% ; background-color:rgb(222, 135, 164);"
            );
            const container = document.createElement('div');
            const x = 100 + "px";
            container.id = participant.sid;
            container.setAttribute("style",
                "position: relative;height:var(x);width:130px; left:-10px; display:inline-block; margin-left:0px;"
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
                            "position: relative; height: 100px;width:250px;top:0px;left:-8px;");
                    }
                } else if (counts > 0) {
                    var video = div.getElementsByTagName("video")[counts];
                    if (video) {
                        container.style.marginLeft = mleft + "px";
                        container.appendChild(profile);
                        container.appendChild(endcall);
                        video.id = track.id;
                        video.setAttribute("style",
                            "position: relative; height: 100px;width:250px;top:0px;left:-8px;");
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
                        "position: relative; height: 100px;width:250px;top:0px;left:-8px;");
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
        video.setAttribute("style", "position: relative; height: 300px;width: 300px;border-radius: 60%;");
    }
}

function trackRemoved2(track) {
    track.detach().forEach(function (element) {
        element.remove()
    });
}
