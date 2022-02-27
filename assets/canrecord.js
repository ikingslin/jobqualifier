const mediaSelector = "video";

let qid = "";
const webCamContainer = document.getElementById("web-cam-container");
let selectedMedia = "vid";
let chunks = [];
const videoMediaConstraints = {
	audio: true,
	video: true,
};
function timer(timereq)
{
	var timeleft = timereq;
	var downloadTimer = setInterval(function(){
	if(timeleft <= 0){
    clearInterval(downloadTimer);
	if(timereq==15)
	{
		startRecording();
		document.getElementById('counter').className = "btn btn-danger";
		document.getElementById('status').className = "btn btn-danger";
		document.getElementById('status').innerHTML = "Recording";
	}
	else{
		stopRecording();
	}
	}
	document.getElementById('counter').innerHTML =  timeleft;
	timeleft -= 1;
}, 1000);
}
function startRecording() {
	document.getElementById('nextbtn').disabled = false;
	navigator.mediaDevices.getUserMedia(videoMediaConstraints)
		.then((mediaStream) => {
		const mediaRecorder = new MediaRecorder(mediaStream);
		window.mediaStream = mediaStream;
		window.mediaRecorder = mediaRecorder;
		mediaRecorder.start();
		mediaRecorder.ondataavailable = (e) => {
			chunks.push(e.data);
		};
		timer(60);
		mediaRecorder.onstop = () => {
			const blob = new Blob(
				chunks, {
					type: "video/mp4"
				});
			chunks = [];
			console.log(blob);
			upload(blob);
		};
		webCamContainer.srcObject = mediaStream;
	});
}

function stopRecording() {
	window.mediaRecorder.stop();
	window.mediaStream.getTracks()
	.forEach((track) => {
		track.stop();
	});
}
function upload(blob)
{
	var fd = new FormData();
	fd.append('videofile', blob);
    fd.append('qid', qid);
	
	$.ajax({
		url: 'vidupload.php',
		type: 'POST',
		data: fd,
		processData: false,
		contentType: false
	}).done(function(datum) {
		//console.log(datum);
		window.location.href="/jobqualifier/candidate/questions.php";
	});
	
}

function warning()
{
	
}