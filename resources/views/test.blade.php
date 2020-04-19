<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
    <div class="video-wrap">
        <video id="video" playsinline autoplay></video>
    </div>
    
    <!-- Trigger canvas web API -->
    <div class="controller">
        <button id="snap">Capture</button>
    </div>
    
    <!-- Webcam video snapshot -->
    <canvas id="canvas" width="640" height="480"></canvas>
    <span id="errorMsg"></span>
  </body>
  <script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const snap = document.getElementById("snap");
    const errorMsgElement = document.querySelector('#errorMsg');

    const constraints = {
        audio: false,
        video: true,
    };

    // Access webcam
    async function init() {
        console.log(navigator)
        try {
            const stream = await navigator.mediaDevices.getUserMedia(constraints);
            handleSuccess(stream);
        } catch (e) {
            console.log(e);
        }
    }

    // Success
    function handleSuccess(stream) {
        window.stream = stream;
        video.srcObject = stream;
    }

    // Load init
    init();

    // Draw image
    var context = canvas.getContext('2d');
    snap.addEventListener("click", function() {
        console.log(video);
        context.drawImage(video, 0, 0, 640, 480);
    });
  </script>
</html>