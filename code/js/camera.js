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
var ListPictures;
var selectedPicture = null;


//Chargement des images
window.onload = function (e) {
    ListPictures = document.getElementById('picture_to_add_box');
    //on ajouter a chaque image son l'evenement on click
    for (i = 0; i < ListPictures.children.length; i++) {
        ListPictures.children[i].addEventListener('click', onClickPicture);
    }
};

function onClickPicture() {
    //on supprime les autres
    for (i = 0; i < ListPictures.children.length; i++) {
        ListPictures.children[i].className = "picture_to_add";
    }
    this.className += " selected";
    selectedPicture = this.id;
    button.disabled = "";
    button.className = "ouistiti";
    button.firstChild.data = "Ouistiti!";
};


//Following for camera
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
    var img_64 = document.createElement("input");
    img_64.setAttribute("type", "hidden");
    img_64.setAttribute("name", "picture");
    img_64.setAttribute("value", picture);
    var stamp = document.createElement("input");
    stamp.setAttribute("type", "hidden");
    stamp.setAttribute("name", "png");
    stamp.setAttribute("value", selectedPicture);
    form.appendChild(img_64);
    form.appendChild(stamp);
    console.log(form.children);
    document.body.appendChild(form);
    form.submit();
}




