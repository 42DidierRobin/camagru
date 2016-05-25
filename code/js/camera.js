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
var width = video.offsetWidth;
var height = 0;
var streaming = false;

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

//redimentionner la video
video.addEventListener('canplay', function (ev) {
    if (!streaming) {
        height = video.videoHeight / (video.videoWidth / width);
        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);
        streaming = true;
    }
}, false);

button.addEventListener('click', function (ev) {
    takePicture();
    ev.preventDefault();
}, false);

function takePicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext("2d").drawImage(video, 0, 0, width, height);
    var img = canvas.toDataURL("image/png");
    picture_submit(window.location.href, img);
}

function picture_submit(url, picture) {
    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", url);
    var hiddenInput = document.createElement("input");
    hiddenInput.setAttribute("type", "hidden");
    hiddenInput.setAttribute("name", "picture");
    hiddenInput.setAttribute("value", picture);
    form.appendChild(hiddenInput);
    document.body.appendChild(form);
    form.submit();
}




