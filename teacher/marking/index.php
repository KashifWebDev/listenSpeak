<?php
require '../../app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('../../index.php');
}
function fetchCount($table, $column = null, $data = null): int{
    $s = (isset($column) && isset($data)) ?  "SELECT * FROM $table WHERE $column='$data'" : "SELECT * FROM $table";
    $res = mysqli_query($GLOBALS["con"], $s);
    return mysqli_num_rows($res);
}
if(isset($_POST["save"])){
    $grades = $_POST["grades"];
    $message = $_POST["message"];
    $structure = $_POST["structure"];
    $logic = $_POST["logic"];
    $fluency = $_POST["fluency"];
    $expression = $_POST["expression"];
    $projection = $_POST["projection"];
    $posture = $_POST["posture"];
    $eyeContact = $_POST["eyeContact"];
    $pause = $_POST["pause"];
    $connection = $_POST["connection"];
    $user_id = $_POST["user_id"];
    $activity_id = $_POST["activity_id"];
    $solutionID = $_POST["solutionID"];

    $s = "INSERT INTO listen_grades(user_id, activity_id, percentage, message, structure, logic, fluency, expression, projection, posture, eyeContact, pause, connection)
 VALUES ($user_id, $activity_id, $grades ,'$message', '$structure', '$logic', '$fluency', '$expression', '$projection', '$posture', '$eyeContact', '$pause', '$connection')";
    if(mysqli_query($GLOBALS['con'], $s)){
        $s = "UPDATE solutions SET graded=1 WHERE id = $solutionID";
        mysqli_query($GLOBALS['con'], $s);
        js_redirect('teacher_pendingSolutions.php?grade=done');
    }
}
$id = $_GET["id"];
$qry = "SELECT * FROM audio_responses WHERE response_id=$id";
$res = mysqli_query($GLOBALS['con'], $qry);
$row = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Marking"; $path = '../../'; require_once '../../app/head.php'; ?>
<body>

<!-- ======= Header ======= -->
<?php require_once '../../app/top_bar.php'; ?>

<!-- ======= Sidebar ======= -->
<?php require_once '../../app/teacher_side_bar.php'; ?>
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
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Grade Activity</h5>
                        <div class="row my-3 align-items-center">
                            <div class="col-md-4">
                                    <span class="m-0 me-2">Student's Response: </span>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <audio style="width: 100%;" controls src="../../recordedAudios/<?=$row["audio_url"]?>"></audio>
                                </div>
                            </div>
                        </div>
                        <form class="row g-3 mt-3" method="post" action="">
                            <input type="hidden" name="response_id" value="<?=$row["response_id"]?>">
                            <div class="d-flex my-3">
<!--                                <label for="inputText" class="col-form-label">Grades Percentage: </label>-->
<!--                                <div class="ms-3">-->
<!--                                    <input type="number" class="form-control" min="0" max="100" name="grades" required>-->
<!--                                </div>-->
                                <div class="row mb-3" style="width: auto">
                                    <label for="inputText" class="col-form-label col-sm-7">Grades Percentage: </label>
                                    <div class="col-sm-5 d-flex">
                                        <input type="number" id="percentage" class="form-control" placeholder="XX" name="percentage">
                                        <span class="input-group-text" id="basic-addon2">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label">Result Status</label>
                                <div class="col-sm-7">
                                    <select class="form-select" required name="status" id="status">
                                        <option selected="" value>-- SELECT --</option>
                                        <option value="Approved">Pass</option>
                                        <option value="Rejected">Fail</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5 col-form-label">Teacher's Response:</label>
                                <div class="col-sm-7">
                                    <div id="controls" >
                                        <button type="button" class="btn btn-primary rounded-pill" id="recordButton">
                                            <i class="bi bi-megaphone"></i>
                                            Record
                                        </button>
                                        <button type="button" class="btn btn-secondary rounded-pill" id="pauseButton" disabled>
                                            <i class="bi bi-pause-fill"></i>
                                            Pause
                                        </button>
                                        <button type="button" class="btn btn-danger rounded-pill" id="stopButton" disabled>
                                            <i class="bi bi-stop-fill"></i>
                                            Stop
                                        </button>
                                    </div><div ><br></div>
                                    <p><strong>Recordings:</strong></p>
                                    <ol id="recordingsList"></ol>
                                </div>
                            </div>


<!--                            <div class="text-center">-->
<!--                                <button type="submit" class="btn btn-primary w-50" name="save">-->
<!--                                    <i class="bi bi-check-circle"></i>-->
<!--                                    Save Grade-->
<!--                                </button>-->
<!--                            </div>-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php require_once '../../app/footer.php'; ?>
<!-- End Footer -->
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
        //upload.href="../submit/index.php?upload&activity=<?php //=$_GET["id"]?>//";
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
            fd.append("percentage", document.getElementById("percentage").value);
            fd.append("status", document.getElementById("status").value);
            <?php $_SESSION["response_id"] = $_GET['id']; ?>

            xhr.open("POST","record.php",true);
            xhr.send(fd);
            //fetch('http://ip-api.com/json', { method: "GET", mode: 'cors', headers: { 'Content-Type': 'application/json',}}).then(response => response.json())
            fetch(url,{ headers:{"sec-fetch-dest":"empty", "Access-Control-Allow-Origin":"*","sec-fetch-mode":"cors","sec-fetch-site":"same-origin"}})
                .then(response => response.blob())
                .then(blob => {
                    const fd = new FormData();
                    fd.append("fileName", blob, "file.wav"); // where `.ext` matches file `MIME` type
                    fd.append("percentage", document.getElementById("percentage").value);
                    fd.append("status", document.getElementById("status").value);

                    // fetch("record.php", {method:"POST", body:fd});

                    var xhr = new XMLHttpRequest();

                    xhr.open( 'POST', 'record.php', true );
                    xhr.onreadystatechange = function ( response ) {};
                    xhr.send( fd );
                    window.location.replace('<?=root()?>teacher/pendingSolutions/index.php?done=1');

                });


        })
        li.appendChild(document.createTextNode (" "))//add a space in between
        li.appendChild(upload)//add the upload link to li

        //add the li element to the ol
        recordingsList.appendChild(li);
    }
</script>

</body>

</html>