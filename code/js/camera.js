// pour les differents browser
navigator.getMedia = (
    navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia
);

var video = document.getElementById("camera_stream");
var canvas = document.getElementById("canvas");
var button = document.getElementById("ouistiti");

if (navigator.getMedia) {
    navigator.getMedia(
        {video: true},
        function (localMediaStream) {
            video.src = window.URL.createObjectURL(localMediaStream);
        },
        function (err) {
            console.log('The following error occurred when trying to use getUserMedia: ' + err);
        });
} else {
    alert('Sorry, your browser does not support getUserMedia');
}

button.addEventListener('click', function(ev){
    takePicture();
    ev.preventDefault();
}, false);

function takePicture() {
    canvas.getContext("2d").drawImage(video, 0, 0, 300, 300, 0, 0, 300, 300);
    var img = canvas.toDataURL("image/png");
    console.log(img);
    alert('done');
}




