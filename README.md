
## User Live Detection

Its a live user detection module which uses WebRTC and tensorflow libraries to detect user in a real time video stream 

## Installation - 
1. Clone the Project
2. Run composer install

## Usage - 
1. Laravel framework is only used to generate a unique Room ID and to store it in session. 
2. There are two main files in views folder - 
 i) sender.js
 ii) receiver.js
 
3. You can deploy your own RTC multiconnection node server from this link - https://www.npmjs.com/package/rtcmulticonnection

4. Tensorflow library is used to detect users in a live video stream
