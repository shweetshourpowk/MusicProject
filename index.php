<?php
//start --or resume-- a session
session_start();

//$_SESSION["user_id"] is set by the log-in process
//if the value is un-set, or 0, then the user is not logged in

if(!isset($_SESSION["user_id"])){
    $_SESSION["user_id"] = 0;
}

include("php/connect.php");

//process any parameters sent in through the $_GET/$_POST array
//$_REQUEST will work for either a $_GET or $_POST variable
//isset() will be true if the parameter is present
if(isset($_REQUEST["main"])){
    //intval() will force the incoming value to be an integer -- important for security
    $main_menu = intval($_REQUEST["main"]);
}

//start the browser communication:
header("Content-Type: text/html");
header("Cache-Control: no-store");
header("Pragma: no-cache");

//start the html declratation	
$html = '<!DOCTYPE html>
	<html>';
//comment with file name
$html .= '
	<!-- BEGIN n413site_3.php -->';

//head tag with links and script tags
$html .= '
	<head lang="en">
    <meta charset="UTF-8">
    <title>Music Playa</title>
    <link rel="stylesheet" href="css/n413site_main.css">
    <link rel="stylesheet" href="lib/font-awesome-4.2.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/styles.css"/>

    <script type="text/javascript">

        var user_id = '.$_SESSION["user_id"].';

        function do_login(){
            $("#background_screen").remove();
            $("body").append("<div id=\"background_screen\" style=\"position:fixed;top:0;left:0;right:0;bottom:0;background-color:#888888;background-color:rgba(0,0,0,0.5);z-index:500;\"></div>");
            $("#login_window").remove();
            $("body").append("<div id=\"login_window\" style=\"position:absolute;top:15%;left:30%;width:40%;z-index:501;\"></div>");
            $.post("php/login.php",{},function(data){
                $("#login_window").html(data);
            },"text");
        }

        function close_login_window(){
            $("#background_screen").remove();
            $("#login_window").remove();
        }

        function check_login(){
            if(user_id > 0){ //user is logged in
                $("#log-in").html("Log-Out");
            }
        }
</script>

        </head>
<body>



<div id="container">
    <!-- This is the search area where you can search for songs, or artists, and maybe genres? -->
    <div id="title">
        <h1>Lotso Music</h1>
        <span id="login"><button onclick="do_login();">Log-in</button></span>
        <div id="searchArea" class="clearFix">
        <span id="searchBox"><input id="txtSearch"/></span>
        <span id="button"><button>Search</button></span>

    </div>
    </div>
    <!-- This is where the music player will be i.e. play button, scrubber, back and forward buttons -->
    <div id="playArea">

        <audio id="audio" controls="controls" class="clearFix">


        </audio>
        <div id="back"><i class="fa fa-fast-backward fa-4x fa-inverse"></i></div>
        <div id="playPause"><span id="play" class="playOff"><i class="fa fa-play fa-5x fa-inverse"></i></span><span id="pause" class="pauseOn"> <i class="fa fa-pause fa-5x fa-inverse"></i></span></div>
        <div id="forward"><i class="fa fa-fast-forward fa-4x fa-inverse"></i></div><br>
        <div id="timeLapse"></div>

    </div>

    <!-- This is the area under the playArea, it will tell the songs name, artist, genre, description, so on and so forth -->
    <div id="descArea">

    </div>

    <!-- This is where the search results will appear, it will be an area right under the search box. -->
    <div id="resultsArea" class="clearFix">

    </div>
    <!-- This is where the list of all of the songs will be, no matter the artist, genre, or album.-->
    <div id="listAll">

    </div>


</div>

<script src="lib/jquery-2.1.1.min.js"></script>
<script src="lib/handlebars-v2.0.0.js"></script>
<script src="lib/underscore/underscore-min.js"></script>
<script src="js/main.js"></script>
';


//closing tags
$html .= '
	</body>
	<!-- END n413site_3.php -->
</html>';
echo $html;

//close the session file  -- this updates the session file and makes it available for other scripts
session_write_close();
