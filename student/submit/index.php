<?php
require '../../app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('../../index.php');
}


if(isset($_POST["assign"])){
    $instructor_id = $_POST["instructor_id"] ?? null;
    $course_id = $_POST["course_id"] ?? null;

    $sql = "INSERT INTO teacher_courses(teacher_id, course_id) VALUES ($instructor_id, $course_id)";
    echo $sql;
    $res = mysqli_query($GLOBALS["con"],$sql);
    if($res){
        js_redirect("assign_instructors.php?success=1");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php $title = "My Progress"; $path = '../../'; require_once '../../app/head.php'; ?>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include Bootstrap and Select2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
<body>

<!-- ======= Header ======= -->
<?php require_once '../../app/top_bar.php'; ?>

<!-- ======= Sidebar ======= -->
<?php require_once '../../app/student_side_bar.php'; ?>
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
            <div class="col-lg-12">
                <?php
                if(isset($_GET["success"])){
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        Unit was Updated successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>
                <?php
                if(isset($_GET["error"])){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        Please select the required fields.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12 col-md-6 mx-md-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Activity Description:</h5>
                        <p>
                            <?php
                            $s = "SELECT * FROM units WHERE unit_id=".$_GET["id"];
                            $s1 = mysqli_query($GLOBALS['con'], $s);
                            $s2 = mysqli_fetch_array($s1);
                            $desc = isset($s2["content"]) ? $s2["content"] : '<i>No Description was added</i>';
                            echo '
                                <div class="activityContent">
                                    '.$desc.'
                                </div>
                            ';
                            ?>
                        </p>
                        <div class="form-check" id="textToSpeech">
                            <input class="form-check-input" type="checkbox" id="showDivCheckbox1">
                            <label class="form-check-label" for="showDivCheckbox1">
                                Text to Speech
                            </label>
                        </div>
                        <div class="mt-3" id="hiddenDiv1">
                            <div class="spinner-border" role="status" id="loadingDiv">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <audio id="audioPlayer" controls></audio>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="showDivCheckbox">
                            <label class="form-check-label" for="showDivCheckbox">
                                Translate the Activity Description?
                            </label>
                        </div>
                        <div class="mt-3" id="hiddenDiv">
                            <label class="mb-1">Select Language:</label>
                            <select class="form-select" id="languageSelect" style="width: 100%">
                                <?php
                                // Language codes and names
                                $languageCodesToNames = array(
                                    "af" => "Afrikaans",
                                    "am" => "Amharic",
                                    "ar" => "Arabic",
                                    "az" => "Azerbaijani",
                                    "be" => "Belarusian",
                                    "bg" => "Bulgarian",
                                    "bn" => "Bengali",
                                    "bs" => "Bosnian",
                                    "ca" => "Catalan",
                                    "ceb" => "Cebuano",
                                    "co" => "Corsican",
                                    "cs" => "Czech",
                                    "cy" => "Welsh",
                                    "da" => "Danish",
                                    "de" => "German",
                                    "el" => "Greek",
                                    "en" => "English",
                                    "eo" => "Esperanto",
                                    "es" => "Spanish",
                                    "et" => "Estonian",
                                    "eu" => "Basque",
                                    "fa" => "Persian",
                                    "fi" => "Finnish",
                                    "fr" => "French",
                                    "fy" => "Frisian",
                                    "ga" => "Irish",
                                    "gd" => "Scottish Gaelic",
                                    "gl" => "Galician",
                                    "gu" => "Gujarati",
                                    "ha" => "Hausa",
                                    "haw" => "Hawaiian",
                                    "hi" => "Hindi",
                                    "hmn" => "Hmong",
                                    "hr" => "Croatian",
                                    "ht" => "Haitian Creole",
                                    "hu" => "Hungarian",
                                    "hy" => "Armenian",
                                    "id" => "Indonesian",
                                    "ig" => "Igbo",
                                    "is" => "Icelandic",
                                    "it" => "Italian",
                                    "iw" => "Hebrew",
                                    "ja" => "Japanese",
                                    "jv" => "Javanese",
                                    "ka" => "Georgian",
                                    "kk" => "Kazakh",
                                    "km" => "Khmer",
                                    "kn" => "Kannada",
                                    "ko" => "Korean",
                                    "ku" => "Kurdish",
                                    "ky" => "Kyrgyz",
                                    "la" => "Latin",
                                    "lb" => "Luxembourgish",
                                    "lo" => "Lao",
                                    "lt" => "Lithuanian",
                                    "lv" => "Latvian",
                                    "mg" => "Malagasy",
                                    "mi" => "Maori",
                                    "mk" => "Macedonian",
                                    "ml" => "Malayalam",
                                    "mn" => "Mongolian",
                                    "mr" => "Marathi",
                                    "ms" => "Malay",
                                    "mt" => "Maltese",
                                    "my" => "Burmese",
                                    "ne" => "Nepali",
                                    "nl" => "Dutch",
                                    "no" => "Norwegian",
                                    "ny" => "Chichewa",
                                    "or" => "Oriya",
                                    "pa" => "Punjabi",
                                    "pl" => "Polish",
                                    "ps" => "Pashto",
                                    "pt" => "Portuguese",
                                    "ro" => "Romanian",
                                    "ru" => "Russian",
                                    "rw" => "Kinyarwanda",
                                    "sd" => "Sindhi",
                                    "si" => "Sinhala",
                                    "sk" => "Slovak",
                                    "sl" => "Slovenian",
                                    "sm" => "Samoan",
                                    "sn" => "Shona",
                                    "so" => "Somali",
                                    "sq" => "Albanian",
                                    "sr" => "Serbian",
                                    "st" => "Sesotho",
                                    "su" => "Sundanese",
                                    "sv" => "Swedish",
                                    "sw" => "Swahili",
                                    "ta" => "Tamil",
                                    "te" => "Telugu",
                                    "tg" => "Tajik",
                                    "th" => "Thai",
                                    "tk" => "Turkmen",
                                    "tl" => "Filipino",
                                    "tr" => "Turkish",
                                    "tt" => "Tatar",
                                    "ug" => "Uyghur",
                                    "uk" => "Ukrainian",
                                    "ur" => "Urdu",
                                    "uz" => "Uzbek",
                                    "vi" => "Vietnamese",
                                    "xh" => "Xhosa",
                                    "yi" => "Yiddish",
                                    "yo" => "Yoruba",
                                    "zh-CN" => "Chinese (Simplified)",
                                    "zh-TW" => "Chinese (Traditional)",
                                    "zu" => "Zulu"
                                );

                                // Generate options for the select dropdown
                                foreach ($languageCodesToNames as $code => $name) {
                                    echo "<option value='$code'>$name</option>";
                                }
                                ?>
                            </select>
                            <button id="translateBtn" type="button" class="btn btn-primary mt-2 ms-2">
                                <i class="bi bi-translate"></i>
                                <span id="trans_text">Translate Now</span>
                            </button>
                        </div>
                        <?php
                        if(!empty($s2["file"]))
                            echo '<a href="../../assets/img/units/'.$s2["file"].'" class="btn btn-primary mb-5"><i class="bi bi-download me-1"></i> Download File</a>';
                        ?>

                        <hr>
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
<?php require_once '../../app/footer.php'; ?>
<!-- End Footer -->



<script>
    document.getElementById("translateBtn").onclick = function () {
        $('.activityContent').text('----- Translating... -----');
        $('#trans_text').text("Translating...");
        const settings = {
            async: true,
            crossDomain: true,
            url: 'https://google-translate1.p.rapidapi.com/language/translate/v2',
            method: 'POST',
            headers: {
                'content-type': 'application/x-www-form-urlencoded',
                'Accept-Encoding': 'application/gzip',
                'X-RapidAPI-Key': '33531d20c8msh9b9efc2b4fafa93p116c3fjsnc274a24bf5a4',
                'X-RapidAPI-Host': 'google-translate1.p.rapidapi.com'
            },
            data: {
                q: '<?=$s2["content"]?>',
                target: $('#languageSelect').find(":selected").val(),
                source: 'en'
            }
        };

        $.ajax(settings).done(function (response) {
            $('#trans_text').text("Translate Now");
            $('.activityContent').text(response.data.translations[0].translatedText);
            console.log(response);
        });
    };
    document.getElementById("textToSpeech").onclick = function () {
        hitAPIs();
    };

    function hitAPIs() {
        console.log( "HITTIN GFIRST");
        const settings = {
            async: true,
            crossDomain: true,
            url: 'https://large-text-to-speech.p.rapidapi.com/tts',
            method: 'POST',
            headers: {
                'content-type': 'application/json',
                'X-RapidAPI-Key': '4e482e57f8msh1b3110cedc5e85bp1af4bajsn90ba2eaedd96',
                'X-RapidAPI-Host': 'large-text-to-speech.p.rapidapi.com'
            },
            processData: false,
            data: '{\r\n    "text": "<?=$desc?>"\r\n}'
        };

        $.ajax(settings).done(function (response) {
            hitSecondAPI(response.id);
        });
    }

    function hitSecondAPI(id) {
        const settings = {
            async: true,
            crossDomain: true,
            url: 'https://large-text-to-speech.p.rapidapi.com/tts?id='+id,
            method: 'GET',
            headers: {
                'X-RapidAPI-Key': '4e482e57f8msh1b3110cedc5e85bp1af4bajsn90ba2eaedd96',
                'X-RapidAPI-Host': 'large-text-to-speech.p.rapidapi.com'
            }
        };


        $.ajax(settings).done(function (response) {  setTimeout(() => {
            $.ajax(settings).done(function (response) {
                if (response.status === 'success') {
                    console.log(response);
                    $("#loadingDiv").hide();
                    $("#audioPlayer").show();
                    var audioPlayer = $('#audioPlayer');
                    audioPlayer.attr('src', response.url);
                    console.log(response);
                } else {
                    // Status is not success, retry the first API call
                    hitSecondAPI(id);
                }
            });
        }, 1500)
            // $("#loadingDiv").hide();
            // $("#audioPlayer").show();
            // var audioPlayer = $('#audioPlayer');
            // audioPlayer.attr('src', response.url);
            // console.log(response);
        });
    }





    // Initialize Select2
    $(document).ready(function() {
        $('#languageSelect').select2();
    });

    $("#hiddenDiv1").hide();
    $("#showDivCheckbox1").click(function() {
        if($(this).is(":checked")) {
            $("#hiddenDiv1").show(300);
        } else {
            $("#hiddenDiv1").hide(200);
        }
    });

    $("#hiddenDiv").hide();
    $("#showDivCheckbox").click(function() {
        if($(this).is(":checked")) {
            $("#hiddenDiv").show(300);
        } else {
            $("#hiddenDiv").hide(200);
        }
    });
    $("#audioPlayer").hide();
</script>



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
            fd.append("uid", <?=$_SESSION['id']?>);
            <?php $_SESSION["unit_id"] = $s2['unit_id']; ?>

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