<html>
<style>

video{
    width:400px !important;
  }

html,body{
width: 100%;
height: 100%;
}
#circle {
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%,-50%);
width: 150px;
height: 150px;	
}
.loader {
width: calc(100% - 0px);
height: calc(100% - 0px);
border: 8px solid #ffff;
border-top: 8px solid #09f;
border-radius: 50%;
animation: rotate 5s linear infinite;
}
@keyframes rotate {
100% {transform: rotate(360deg);}
} 
</style>

<div class="col" style="display:block" id="animate-loader">
<div id="circle">
<div class="loader">
<div class="loader">
<div class="loader">
</div>
</div>
</div>
</div> 
</div>

<div class="col d-flex justify-content-center" style="display:none" id="user-status">
<h1>User Status</h1><br>
<span id="user-change-status"></span>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>

<script src="https://rtcmulticonnection.herokuapp.com/dist/RTCMultiConnection.min.js"></script>
<script src="https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js"></script>

<script>
    var roomid = "{{session('unique-id')}}";  // Room ID
console.log(roomid);
var joinClassInterval;
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
    OfferToReceiveAudio: false,
    OfferToReceiveVideo: false
};
connection.dontCaptureUserMedia = true;
connection.onopen = function(event) {
    clearInterval(checkConnection);
    detectPerson();
    setTimeout(function(){ 

      $('#animate-loader').css('display','none');
 $('#user-status').css('display','block');

     }, 10000);




    };

    checkConnection = setInterval(() => { 
    connection.join(roomid);

    }, 2000);



</script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs/dist/tf.min.js"> </script>

<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/blazeface"></script>

<script>

const detectPerson = () =>{

setTimeout(() => {

const video = $('video')[0];



var modelHasLoaded = false;
var model = undefined;



blazeface.load().then(function (loadedModel) {
  model = loadedModel;
  modelHasLoaded = true;



function handleClick(event) {
  if (!modelHasLoaded) {
    return;
  }
  
}


function hasGetUserMedia() {
  return !!(navigator.mediaDevices &&
    navigator.mediaDevices.getUserMedia);
}

var children = [];


function predictWebcam() {

model.estimateFaces(video).then(function (predictions) {
  if(predictions.length == 1)
  {
    $('#user-change-status').html('<img src="/images/right.jpg"width="50" height="50"><h3>User Exists</h3>')
  }

   if(predictions.length == 0)
  {
    $('#user-change-status').html('<img src="/images/wrong.png"width="50" height="50"><h3>No User</h3>')
  }
  if(predictions.length > 1)
{

  $('#user-change-status').html('<h3>Multiple Users</h3>')

}



});
}







setInterval(() => {
  window.requestAnimationFrame(predictWebcam);

}, 1000);

// Enable the live webcam view and start classification.
function enableCam(event) {
  if (!modelHasLoaded) {
    return;
  }
  // Hide the button.
  event.target.classList.add('removed');  
  
  // getUsermedia parameters.
  const constraints = {
    video: true
  };

  // Activate the webcam stream.
  navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
    video.srcObject = stream;
    video.addEventListener('loadeddata', predictWebcam);

  });


}


});


}, 5000);


}


</script>

</html>