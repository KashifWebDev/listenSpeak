<?php
require '../../app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('../../index.php');
}

if(isset($_POST["addUnit"])){
    $unitType = !empty($_POST["unitType"]) ? $_POST["unitType"] : null;
    $link = !empty($_POST["link"]) ? $_POST["link"] : null;
    $unitName = !empty($_POST["unitName"]) ? $_POST["unitName"] : null;
    $course = !empty($_POST["course"]) ? $_POST["course"] : null;
    $subject = !empty($_POST["subject"]) ? $_POST["subject"] : null;
    $content = !empty($_POST["content"]) ? $_POST["content"] : null;
    $picture = null;

    if(!empty($_FILES['image']['name'])){
        $banner=$_FILES['image']['name'];
        $expbanner=explode('.',$banner);
        $bannerexptype=$expbanner[1];
        $date = date('m/d/Yh:i:sa', time());
        $rand=rand(10000,99999);
        $encname=$date.$rand;
        $picture=md5($encname).'.'.$bannerexptype;
        $bannerpath="../../assets/img/units/".$picture;
        move_uploaded_file($_FILES["image"]["tmp_name"],$bannerpath);
    }

    $sql = "INSERT INTO units(unit_name, subject_id, content,file, type, link) 
            VALUES ('$unitName', $subject, '$content', '$picture', '$unitType', '$link')";
    $res = mysqli_query($GLOBALS["con"],$sql);
    if($res){
        js_redirect("add_unit.php?success=1");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "Add New Unit"; $path = '../../'; require_once '../../app/head.php'; ?>
<body>

<!-- ======= Header ======= -->
<?php require_once '../../app/top_bar.php'; ?>

<!-- ======= Sidebar ======= -->
<?php require_once '../../app/manager_side_bar.php'; ?>
<!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <?php
                if(isset($_GET["success"])){
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        Unit was added successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Introduce new Unit</h5>
                        <?php
                        if (isset($_GET['course'])) {
                            $course = $_GET['course'];

                            // Fetch subjects based on the selected course
                            $subjects = fetchSubjects($course);

                            // Return the subjects as JSON response
                            echo json_encode($subjects);
                        }

                        // Function to fetch subjects based on the selected course
                        function fetchSubjects($course) {
                            global $connection;
                            $subjects = [];

                            // Fetch subjects from the database based on the selected course
                            $query = "SELECT subject_id, subject_name FROM subjects WHERE course_id = (SELECT course_id FROM courses WHERE course_name = '$course')";
                            $result = mysqli_query($connection, $query);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $subjects[$row['subject_id']] = $row['subject_name'];
                                }
                            }

                            return $subjects;
                        }


                        // Fetch courses from the database
                        $courses = [];
                        $query = "SELECT course_name FROM courses";
                        $result = mysqli_query($GLOBALS["con"], $query);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $courses[] = $row['course_name'];
                            }
                        }

                        // Function to fetch subjects based on the selected course

                        // Fetch subjects from the database
                        $subjects = [];
                        $query = "SELECT subject_name FROM subjects";
                        $result = mysqli_query($GLOBALS["con"], $query);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $subjects[] = $row['subject_name'];
                            }
                        }

                        function fetchCourses() {
                            $courses = [];

                            // Fetch courses from the database
                            $query = "SELECT course_id, course_name FROM courses";
                            $result = mysqli_query($GLOBALS["con"], $query);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $courses[$row['course_id']] = $row['course_name'];
                                }
                            }

                            return $courses;
                        }
                        $courses = fetchCourses();


                        ?>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="unitType">Lesson Type</label>
                                <select class="form-control" id="unitType" name="unitType" onchange="toggleFormFields()" required>
                                    <option value>Select Lesson Type</option>
                                    <option value="Unit">Unit</option>
                                    <option value="Assessment">Activity</option>
                                </select>
                            </div>
                            <div id="mustHave" style="display: none">
                                <div class="form-group mb-3">
                                    <label for="unitName">Unit Name</label>
                                    <input type="text" class="form-control" id="unitName" name="unitName" placeholder="Enter unit name" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="course">Course</label>
                                    <select class="form-control" id="course" name="course" onchange="fetchSubjects()" required>
                                        <option value="">Select a course</option>
                                        <?php
                                        // Fetch courses from the database
                                        $courseQuery = "SELECT * FROM courses";
                                        $courseResult = mysqli_query($GLOBALS['con'], $courseQuery);

                                        // Loop through the courses and generate options
                                        while ($courseRow = mysqli_fetch_assoc($courseResult)) {
                                            echo '<option value="' . $courseRow['course_id'] . '">' . $courseRow['course_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3" id="subjectDiv" style="display: none;">
                                    <label for="subject">Subject</label>
                                    <select class="form-control" id="subject" name="subject" required>
                                        <option value="">Select a subject</option>
                                    </select>
                                </div>
                                <div class="form-group my-3">
                                    <label for="description">Additional Resources</label>
                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>
                                <div class="form-group my-3">
                                    <label for="description">Unit/Activity Description:</label>
                                    <textarea name="content" class="form-control" placeholder="Notes For Students.." id="floatingTextarea" style="height: 150px;"></textarea>
                                </div>
                            </div>
                            <div id="unitFields" style="display: none;">
                            </div>
                            <div id="assessmentFields" style="display: none;">
                                <div class="form-group mb-3">
                                    <label for="link">Activity Link</label>
                                    <input type="text" class="form-control" id="link" name="link" placeholder="Website OR Youtube Link">
                                </div>
                            </div>
                            <div>
                                <label for="description" class="my-2">Audio description:</label>
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
                            <div class="row mb-3">
                                <div class="col-12 justify-content-center d-flex">
                                    <button type="submit" class="btn btn-primary" name="addUnit">
                                        <i class="bi bi-plus"></i>
                                        Add Unit
                                    </button>
                                </div>
                            </div>
                        </form>



                        <script>
                            function toggleFormFields() {
                                var unitType = document.getElementById("unitType").value;
                                var unitFields = document.getElementById("unitFields");
                                var assessmentFields = document.getElementById("assessmentFields");
                                var mustHave = document.getElementById("mustHave");

                                mustHave.style.display = "block";

                                if (unitType === "Unit") {
                                    unitFields.style.display = "block";
                                    assessmentFields.style.display = "none";
                                } else if (unitType === "Assessment") {
                                    unitFields.style.display = "none";
                                    assessmentFields.style.display = "block";
                                } else {
                                    unitFields.style.display = "none";
                                    assessmentFields.style.display = "none";
                                }
                            }

                            function fetchSubjects() {
                                var courseID = document.getElementById("course").value;

                                if (courseID !== "") {
                                    var xhr = new XMLHttpRequest();
                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                            if (xhr.status === 200) {
                                                // Update the subject dropdown with the fetched subjects
                                                document.getElementById("subjectDiv").style.display = "block";
                                                document.getElementById("subject").innerHTML = xhr.responseText;
                                            } else {
                                                console.error("Error: " + xhr.status);
                                            }
                                        }
                                    };

                                    // Send the AJAX request to fetch subjects for the selected course
                                    xhr.open("GET", "<?=root().'/app'?>/__api_fetch_subjects.php?courseID=" + courseID, true);
                                    xhr.send();
                                } else {
                                    // Hide the subject dropdown if no course is selected
                                    document.getElementById("subjectDiv").style.display = "none";
                                }
                            }
                        </script>
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
            // fd.append("fileName",url);
            // fd.append("unitType", document.getElementById("unitType").value);
            // fd.append("unitName", document.getElementById("unitName").value);
            // fd.append("course", document.getElementById("course").value);
            // fd.append("subject", document.getElementById("subject").value);
            // fd.append("attachment", document.getElementById("formFile").files[0]);
            // fd.append("desc", document.getElementById("floatingTextarea").value);
            // fd.append("link", document.getElementById("link").value);

            xhr.open("POST","record.php",true);
            xhr.send(fd);
            //fetch('http://ip-api.com/json', { method: "GET", mode: 'cors', headers: { 'Content-Type': 'application/json',}}).then(response => response.json())
            fetch(url,{ headers:{"sec-fetch-dest":"empty", "Access-Control-Allow-Origin":"*","sec-fetch-mode":"cors","sec-fetch-site":"same-origin"}})
                .then(response => response.blob())
                .then(blob => {
                    const fd = new FormData();
                    fd.append("fileName", blob, "file.wav"); // where `.ext` matches file `MIME` type
                    fd.append("unitType", document.getElementById("unitType").value);
                    fd.append("unitName", document.getElementById("unitName").value);
                    fd.append("course", document.getElementById("course").value);
                    fd.append("subject", document.getElementById("subject").value);
                    fd.append("attachment", document.getElementById("formFile").files[0]);
                    fd.append("desc", document.getElementById("floatingTextarea").value);
                    fd.append("link", document.getElementById("link").value);

                    // fetch("record.php", {method:"POST", body:fd});

                    var xhr = new XMLHttpRequest();

                    xhr.open( 'POST', 'record.php', true );
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Handle the response here
                            var jsonResponse = JSON.parse(xhr.responseText);
                            if(jsonResponse.status){
                                window.location.replace('<?=root()?>student/progress/index.php?uploaded=1');
                            }
                        }
                    };
                    xhr.send( fd );

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