<?php
require 'app/app.php';
if(!isset($_SESSION["id"])){
    js_redirect('index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<?php $title = "All Activities"; require_once 'app/head.php'; ?>
<script src="assets/js/recorder.js"></script>
<style type="text/css">
    .parentDiv {
        position: absolute;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        height: 100%;
        width: 100%;
        margin: 0;
    }
    .holder {
        background-color: #4c474c;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#4c474c), to(#141414));
        background-image: -o-linear-gradient(bottom, #4c474c 0%, #141414 100%);
        background-image: linear-gradient(0deg, #4c474c 0%, #141414 100%);
        border-radius: 50px;
    }
    [data-role="controls"] > button {
        margin: 50px auto;
        outline: none;
        display: block;
        border: none;
        background-color: #D9AFD9;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#D9AFD9), to(#97D9E1));
        background-image: -o-linear-gradient(bottom, #D9AFD9 0%, #97D9E1 100%);
        background-image: linear-gradient(0deg, #D9AFD9 0%, #97D9E1 100%);
        width: 100px;
        height: 100px;
        border-radius: 50%;
        text-indent: -1000em;
        cursor: pointer;
        -webkit-box-shadow: 0px 5px 5px 2px rgba(0,0,0,0.3) inset,
        0px 0px 0px 30px #fff, 0px 0px 0px 35px #333;
        box-shadow: 0px 5px 5px 2px rgba(0,0,0,0.3) inset,
        0px 0px 0px 30px #fff, 0px 0px 0px 35px #333;
    }
    [data-role="controls"] > button:hover {
        background-color: #ee7bee;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#ee7bee), to(#6fe1f5));
        background-image: -o-linear-gradient(bottom, #ee7bee 0%, #6fe1f5 100%);
        background-image: linear-gradient(0deg, #ee7bee 0%, #6fe1f5 100%);
    }
    [data-role="controls"] > button[data-recording="true"] {
        background-color: #ff2038;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#ff2038), to(#b30003));
        background-image: -o-linear-gradient(bottom, #ff2038 0%, #b30003 100%);
        background-image: linear-gradient(0deg, #ff2038 0%, #b30003 100%);
    }
    [data-role="recordings"] > .row {
        width: auto;
        height: auto;
        padding: 20px;
    }
    [data-role="recordings"] > .row > audio {
        outline: none;
    }
    [data-role="recordings"] > .row > a {
        display: inline-block;
        text-align: center;
        font-size: 20px;
        line-height: 50px;
        vertical-align: middle;
        width: 50px;
        height: 50px;
        border-radius: 20px;
        color: #fff;
        font-weight: bold;
        text-decoration: underline;
        background-color: #0093E9;
        background-image: -webkit-gradient(linear, left bottom, left top, from(#0093E9), to(#80D0C7));
        background-image: -o-linear-gradient(bottom, #0093E9 0%, #80D0C7 100%);
        background-image: linear-gradient(0deg, #0093E9 0%, #80D0C7 100%);
        float: right;
        margin-left: 20px;
        cursor: pointer;
    }
    [data-role="recordings"] > .row > a:hover {
        text-decoration: none;
    }
    [data-role="recordings"] > .row > a:active {
        background-image: -webkit-gradient(linear, left top, left bottom, from(#0093E9), to(#80D0C7));
        background-image: -o-linear-gradient(top, #0093E9 0%, #80D0C7 100%);
        background-image: linear-gradient(180deg, #0093E9 0%, #80D0C7 100%);
    }
</style>
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
          <li class="breadcrumb-item"><a href="./teacherDashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item active"><?= $title ?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <iframe src="record.php" width="100%" height="100%" style="height: 50vh;"></iframe>
                <div class="d-flex w-100 justify-content-center">
                    <a type="button" class="btn btn-primary rounded-pill">
                        <i class="bi bi-check-lg"></i>
                        Submit Your Audio
                    </a>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php require_once 'app/footer.php'; ?>
  <!-- End Footer -->https://www.facebook.com/ABCInternationalEnglish/
  <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
  <script src="https://markjivko.com/dist/recorder.js"></script>
  <script>
      if (typeof browser === "undefined") {
          var browser = chrome;
      }
      var myFileLink = '';
      jQuery(document).ready(function () {
          var $ = jQuery;
          var myRecorder = {
              objects: {
                  context: null,
                  stream: null,
                  recorder: null
              },
              init: function () {
                  if (null === myRecorder.objects.context) {
                      myRecorder.objects.context = new (
                          window.AudioContext || window.webkitAudioContext
                      );
                  }
              },
              start: function () {
                  var options = {audio: true, video: false};
                  navigator.mediaDevices.getUserMedia(options).then(function (stream) {
                      myRecorder.objects.stream = stream;
                      myRecorder.objects.recorder = new Recorder(
                          myRecorder.objects.context.createMediaStreamSource(stream),
                          {numChannels: 1}
                      );
                      myRecorder.objects.recorder.record();
                  }).catch(function (err) {});
              },
              stop: function (listObject) {
                  if (null !== myRecorder.objects.stream) {
                      myRecorder.objects.stream.getAudioTracks()[0].stop();
                  }
                  if (null !== myRecorder.objects.recorder) {
                      myRecorder.objects.recorder.stop();

                      // Validate object
                      if (null !== listObject
                          && 'object' === typeof listObject
                          && listObject.length > 0) {
                          // Export the WAV file
                          myRecorder.objects.recorder.exportWAV(function (blob) {
                              var url = (window.URL || window.webkitURL)
                                  .createObjectURL(blob);
                              myFileLink = url;
                              console.log(url);
                              // console.log(myFileLink);


                              var filename = "test.wav";
                              var data = new FormData();
                              data.append('file', url);

                              $.ajax({
                                  url :  "vocal_render.php",
                                  type: 'POST',
                                  data: data,
                                  contentType: false,
                                  processData: false,
                                  success: function(data) {
                                  },
                                  error: function() {
                                      alert("not so boa!");
                                  }
                              });

// `blobURL` : `"blob:http://example.com/7737-4454545-545445"`
                              fetch(url).then(response => response.blob())
                                  .then(blob => {
                                      const fd = new FormData();
                                      fd.append("fileName", blob, "file.wav"); // where `.ext` matches file `MIME` type
                                      return fetch("vocal_render.php", {method:"POST", body:fd})
                                  })
                                  .then(response => response.ok)
                                  .then(res => console.log(res))
                                  .catch(err => console.log(err));



                              // Prepare the playback
                              var audioObject = $('<audio controls></audio>')
                                  .attr('src', url);

                              // Prepare the download link
                              var downloadObject = $('<a>&#9660;</a>')
                                  .attr('href', url)
                                  .attr('download', new Date().toUTCString() + '.wav');

                              // Wrap everything in a row
                              var holderObject = $('<div class="row"></div>')
                                  .append(audioObject)
                                  .append(downloadObject);

                              // Append to the list
                              listObject.append(holderObject);
                          });

                      }
                  }
              }
          };

          // Prepare the recordings list
          var listObject = $('[data-role="recordings"]');

          // Prepare the record button
          $('[data-role="controls"] > button').click(function () {
              // Initialize the recorder
              myRecorder.init();

              // Get the button state
              var buttonState = !!$(this).attr('data-recording');

              // Toggle
              if (!buttonState) {
                  $(this).attr('data-recording', 'true');
                  myRecorder.start();
              } else {
                  $(this).attr('data-recording', '');
                  myRecorder.stop(listObject);
              }
          });
      });
  </script>
</body>

</html>