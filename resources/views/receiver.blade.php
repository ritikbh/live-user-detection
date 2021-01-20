<html>
<style>

video{
    width:400px !important;
  }

</style>

<div id="videoInput">
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
connection.socketMessageEvent = 'real-time-detection';

connection.enableFileSharing = false;
connection.session = {
    audio: false,
    video: false,
    data: true,
    oneway: false
};
connection.sdpConstraints.mandatory = {
    OfferToReceiveAudio: false,
    OfferToReceiveVideo: false
};
connection.dontCaptureUserMedia = true;
connection.onopen = function(event) {
    clearInterval(checkConnection);
    detectPerson();
 
    };

    checkConnection = setInterval(() => { 
    connection.join(roomid);

    }, 2000);

	var video = document.getElementById("videoInput");


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
console.log('User Exist')
  }
   if(predictions.length == 0)
  {
console.log('No user')
  }
  if(predictions.length > 1)
{

    console.log("Multiple Persons Detected");




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