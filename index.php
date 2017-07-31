<?php

session_start();
$session = 1;
if(isset($_SESSION['test_ID'])){
  $session = $_SESSION['test_ID'];
}


$names = array("Joe Bloggs", "Mary Bloggs", "Name #3", "Name #4", "Name #5", "Name #6");
$audioTrack = array("49.mp3", "50.mp3", "51.mp3", "52.mp3", "53.mp3", "54.mp3");

$audio_track = $audioTrack[$session-1];
$callerName = $names[$session-1];

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" href="style.css">
  <title>VoIP UI</title>
  <!-- iOS web app, delete if not needed. https://github.com/h5bp/mobile-boilerplate/issues/94 -->
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />


  <!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
  <meta http-equiv="cleartype" content="on">
  <meta name="viewport" content = "width = device-width, initial-scale = 1.0, minimum-scale = 1, maximum-scale = 1, user-scalable = no" />
  <!-- Mobile viewport optimization h5bp.com/ad -->
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width">

  <!-- App Shortcut Icon -->
    <!-- For third generation iPad Retina Display -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/img/touch/apple-touch-icon-144x144-precomposed.png" />
    <!-- For iPhone 4 with high-resolution Retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/img/touch/apple-touch-icon-114x114-precomposed.png" />
    <!-- For first-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/img/touch/apple-touch-icon-72x72-precomposed.png" />
    <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
    <link rel="apple-touch-icon-precomposed" href="/assets/img/touch/apple-touch-icon-57x57-precomposed.png" />
    <!-- For nokia devices: -->
    <link rel="shortcut icon" href="/assets/img/touch/apple-touch-icon.png" />


  <script type = 'text/javascript' src = "processing.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
  // The script prevents links from opening in mobile safari. https://gist.github.com/1042026
  (function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")
  $(document).ready(function(){
          // iOS web app full screen hacks.
          if(window.navigator.standalone == true) {
                  // make all link remain in web app mode.
                  $('a').click(function() {
                          window.location = $(this).attr('href');
              return false;
                  });
          }
  });

  </script>

  <script>
  function show(shown, hidden) {
    document.getElementById(shown).style.display='block';
    document.getElementById(hidden).style.display='none';

    return false;
  }




  </script>

</head>

<body>

<audio id="ringtone">
  <source src = "ringtone.mp3" type = "audio/mpeg">
</audio>

<audio id ="audioSample"
  ontimeupdate="document.getElementById('tracktime').innerHTML = '00 : ' + Math.floor(this.currentTime);">
    <source src="samples/<?php echo $audio_track; ?>" type="audio/mpeg">
</audio>

<center>
  <div id="start">

    <img id='avatar' src = 'img/avatar.png' width = '100' height = '100'>
    <p id="test_status">Test <?php echo $session; ?> of 6</p>

    <h5>Please listen to the following audio sample, and rate its quality on the scale provided</h5>
    <a href ='#' onclick="show('incoming','start'); ringtone.play(); return false;"><div id ='nextButton'><h5 class ='buttonLabel'>Begin Test</h5></div></a>

  </div>

  <div id="incoming" style="display:none">

    <img id='avatar' src = 'img/avatar.png' width = '100' height = '100'>
    <p id="name"><?=$callerName ?></p>

    <canvas data-processing-sources = 'processing_SignalBar.pde'></canvas>

    <a href ='#' onclick="show('call','incoming'); ringtone.pause(); audioSample.play(); return false;"><div id ="answerButton"><img class = "phone" src='img/phone_icon_answer.png'></div></a>
    <div id ="declineButton"><img class ='phone' src ='img/phone_icon_decline.png'></div>

  </div>

  <div id = "call" style="display:none">


    <img id='avatar' src = 'img/avatar.png' width = '100' height = '100'>
    <p id="test_status"><?php echo $callerName; ?></p>
    <p id = 'timer'><span id ="tracktime"></span></p>

    <canvas data-processing-sources = 'processing_SignalBar.pde'></canvas>
    <a href = '#' onclick="show('rate','call'); audioSample.pause(); return false;"><div id ="endCallButton"><img class = 'phone' src='img/phone_icon_decline.png'></div></a>


  </div>

  <div id = "rate" style="display:none">

    <img id='avatar' src = 'img/avatar.png' width = '100' height = '100'>
    <p id="test_status"><?php echo $callerName; ?></p>

    <h5>Please use the scale provided to rate the quality of this sample. Click Next to proceed to the next sample.</h5>

    <a href = 'newIndex.php'><div id ="nextButton"><h5 class ='buttonLabel'><?php
                                            if($session == 6)
                                            {
                                              unset($_SESSION['test_ID']);
                                              echo 'Finish Test';
                                            }
                                            else
                                            {
                                              $_SESSION['test_ID'] = $_SESSION['test_ID'] + 1;
                                              echo'Next Sample';
                                            } ?></h5></div></a>


  </div>

</center>

</body>
</html>
