<?php
require 'app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
if(isset($_GET["upload"])){
    $uid = $_SESSION["id"];
    $activity = $_GET["activity"];
    $audio = $_SESSION["fileName"];
    $created_date = date("Y-m-d H:i:s");
    $s = "INSERT INTO solutions (user_id, activity_id, audio, date_time) VALUES ($uid, $activity, '$audio', '$created_date')";
    if(mysqli_query($con, $s)){
        js_redirect('student_allActivities.php?uploaded=1');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "All Activities"; require_once 'app/head.php'; ?>

<script>
    alert("Click on the button to start recording your answer!");
</script>
<body>

  <!-- ======= Header ======= -->
  <?php require_once 'app/top_bar.php'; ?>

  <!-- ======= Sidebar ======= -->
  <?php require_once 'app/student_side_bar.php'; ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?= $title ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
          <li class="breadcrumb-item active"><?= $title ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="container">
                    <h3>Activity Description:</h3>
                    <p>
                        <?php
                            $s = "SELECT * FROM activities WHERE id=".$_GET["id"];
                            $s1 = mysqli_query($con, $s);
                            $s2 = mysqli_fetch_array($s1);
                            echo isset($s2["description"]) ? $s2["description"] : '<i>NIL</i>';
                        ?>
                    </p>
                    <?php
                        if(!empty($s2["file"]))
                            echo '<a href="assets/files/'.$s2["file"].'" class="btn btn-primary mb-5"><i class="bi bi-download me-1"></i> Download File</a>';
                    ?>
                </div>
					 <div id="controls" >
  	 <button id="recordButton">Record</button>
  	 <button id="pauseButton" disabled>Pause</button>
  	 <button id="stopButton" disabled>Stop</button>
    </div><div ><br></div>
    <div id="formats">Format:start recording to see sample rate</div>
  	<p><strong>Recordings:</strong></p>
  	<ol id="recordingsList"></ol>
    <!-- inserting these scripts at the end to be able to use all the elements in the DOM -->
 
                <!----iframe src="record.php"  width="100%" height="100%" style="height: 50vh;" allow="microphone"></iframe>
                <div class="d-flex w-100 justify-content-center">
                    <a type="button" class="btn btn-primary rounded-pill" href="student_UploadAudio.php?upload&activity=<?=$_GET["id"]?>">
                        <i class="bi bi-check-lg"></i>
                        Submit Your Audio
                    </a>
                </div>!--->
            </div>
        </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php require_once 'app/footer.php'; ?>

</body>
 <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://markjivko.com/dist/recorder.js"></script>
    <script>
	//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording

// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record

var recordButton = document.getElementById("recordButton");
var stopButton = document.getElementById("stopButton");
var pauseButton = document.getElementById("pauseButton");

//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);
pauseButton.addEventListener("click", pauseRecording);

function startRecording() {
	console.log("recordButton clicked");

	/*
		Simple constraints object, for more advanced audio features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/
    
    var constraints = { audio: true, video:false }

 	/*
    	Disable the record button until we get a success or fail from getUserMedia() 
	*/

	recordButton.disabled = true;
	stopButton.disabled = false;
	pauseButton.disabled = false

	/*
    	We're using the standard promise based getUserMedia() 
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/
console.log('test');
	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();

		//update the format 
		document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

		/*  assign to gumStream for later use  */
		gumStream = stream;
		
		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);

		/* 
			Create the Recorder object and configure to record mono sound (1 channel)
			Recording 2 channels  will double the file size
		*/
		rec = new Recorder(input,{numChannels:1})

		//start the recording process
		rec.record()

		console.log("Recording started");

	}).catch(function(err) {
	  	//enable the record button if getUserMedia() fails

        console.log('test failed');
    	recordButton.disabled = false;
    	stopButton.disabled = true;
    	pauseButton.disabled = true
	});
}

function pauseRecording(){
	console.log("pauseButton clicked rec.recording=",rec.recording );
	if (rec.recording){
		//pause
		rec.stop();
		pauseButton.innerHTML="Resume";
	}else{
		//resume
		rec.record()
		pauseButton.innerHTML="Pause";

	}
}

function stopRecording() {
	console.log("stopButton clicked");

	//disable the stop button, enable the record too allow for new recordings
	stopButton.disabled = true;
	recordButton.disabled = false;
	pauseButton.disabled = true;

	//reset button just in case the recording is stopped while paused
	pauseButton.innerHTML="Pause";
	
	//tell the recorder to stop the recording
	rec.stop();

	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//create the wav blob and pass it on to createDownloadLink
	rec.exportWAV(createDownloadLink);
}

function createDownloadLink(blob) {
	
	var url = URL.createObjectURL(blob);
	var au = document.createElement('audio');
	var li = document.createElement('li');
	var link = document.createElement('a');

	//name of .wav file to use during upload and download (without extendion)
	var filename = new Date().toISOString();

	//add controls to the <audio> element
	au.controls = true;
	au.src = url;

	//save to disk link
	link.href = url;
	link.download = filename+".wav"; //download forces the browser to donwload the file using the  filename
	link.innerHTML = "Save to disk";
	link.className="btn btn-";

	//add the new audio element to li
	li.appendChild(au);
	
	//add the filename to the li
	li.appendChild(document.createTextNode(filename+".wav "))

	//add the save to disk link to li
	li.appendChild(link);
	
	//upload link
	var upload = document.createElement('a');
	upload.href="student_UploadAudio.php?upload&activity=<?=$_GET["id"]?>";
	upload.innerHTML = "Submit Audio";
	upload.className="btn btn-primary";
	upload.addEventListener("click", function(event){
		  var xhr=new XMLHttpRequest();
		  xhr.onload=function(e) {
		      if(this.readyState === 4) {
		          console.log("Server returned: ",e.target.responseText);
		      }
		  };
		  var fd=new FormData();
		  //fd.append("audio_data",blob, filename);
		  var url = (window.URL || window.webkitURL)
                                    .createObjectURL(blob);
                                myFileLink = url;
                                console.log(url);
                                // console.log(myFileLink);


                                var filename = "test.wav";
		  fd.append("file",url);
		 
		  xhr.open("POST","record.php",true);
		  xhr.send(fd);
		  //fetch('http://ip-api.com/json', { method: "GET", mode: 'cors', headers: { 'Content-Type': 'application/json',}}).then(response => response.json())
		      fetch(url,{ headers:{"sec-fetch-dest":"empty", "Access-Control-Allow-Origin":"*","sec-fetch-mode":"cors","sec-fetch-site":"same-origin"}})
				  .then(response => response.blob())
						.then(blob => {
							const fd = new FormData();
							fd.append("fileName", blob, "file.wav"); // where `.ext` matches file `MIME` type
							// fetch("record.php", {method:"POST", body:fd});
							
							  var xhr = new XMLHttpRequest();

    xhr.open( 'POST', 'record.php', true );
    xhr.onreadystatechange = function ( response ) {};
    xhr.send( fd );
							
						});
						

		})
	li.appendChild(document.createTextNode (" "))//add a space in between
	li.appendChild(upload)//add the upload link to li

	//add the li element to the ol
	recordingsList.appendChild(li);
}
	</script>
</html>