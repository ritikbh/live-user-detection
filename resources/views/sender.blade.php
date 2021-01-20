

<style>

video{
    width:380px !important;
  }

</style>


<div style="margin-top: 20px;margin-bottom: 20px;margin-right: 12px;">
<button id="btn-start-video">Start Live Video</button>

</div>


<script src="https://rtcmulticonnection.herokuapp.com/dist/RTCMultiConnection.min.js"></script>
<script src="https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js"></script>

<script>
    var roomid = "{{session('unique-id')}}";  // Room ID

var connection = new RTCMultiConnection();

connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';
connection.socketMessageEvent = "real-time-detection-{{session('unique-id')}}";

connection.enableFileSharing = false;
connection.session = {
    audio: true,
    video: true,
    data: true,
    oneway: true
};
connection.sdpConstraints.mandatory = {
    OfferToReceiveAudio: true,
    OfferToReceiveVideo: true
};
var btnStartClass = document.querySelector('#btn-start-video');
btnStartClass.onclick = function(event) {
    connection.open(roomid);

if(btnStartClass.innerHTML == "Stop Video")
{

    location.reload();
}
    btnStartClass.innerHTML = "Stop Video";

};


var video = document.querySelector('video');


</script>


