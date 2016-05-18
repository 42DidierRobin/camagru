// pour les differents browser
navigator.getMedia = (
    navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia
);

if (navigator.getMedia) {
    navigator.getMedia(
        {video: true},
        function (localMediaStream) {
            var vid = document.getElementById('camera-stream');
            vid.src = window.URL.createObjectURL(localMediaStream);
        },
        function (err) {
            console.log('The following error occurred when trying to use getUserMedia: ' + err);
        });
} else {
    alert('Sorry, your browser does not support getUserMedia');
}



