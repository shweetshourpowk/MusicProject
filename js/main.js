
var songs;
var show;

$(document).ready(function(){

    $.getJSON( "json/data.json", function(data){
        console.log(data);

        songs = data.music;

        for (var i = 0; i < data.music.length; i++) {
            $("#listAll").append("<ul> <li data-index='"+ i +"'><h2>" + data.music[i].Title + "</h2></li>" + "<ul><li data-index='" + i +"'><h3>" + data.music[i].Artist + "</h3></li></ul>" + "<ul id='descHide'><li data-index='" + i +"'>" + data.music[i].Album + "</li>" + "<li data-index='" + i +"'>" + data.music[i].Date + "</li>" + "<li data-index='" + i +"'>" + data.music[i].Desc + "</li>" + "<li data-index='" + i +"'>" + data.music[i].Genre + "</li>" + "<li data-index='" + i +"'>" + data.music[i].Pic + "</li></ul>" + "</ul>" );
        }

        $("li").click(function(){

            var clickedItem = $(this);

            var index = clickedItem.data("index");
            var song = songs[index];
            console.log(song);

            $("#descArea").html("<div id='desc'>" + song.Pic + "<h2>" + song.Title + "</h2>" + "<p>" + song.Artist + " " + song.Album + " " + song.Date + " " + song.Genre + "</p>" + "<p>"+ song.Desc + "</p>" + "</div>");

            //$("#audio").html("<source src='" + song.Song + "' type='audio/wav'>");

            var myAudio = document.querySelector("#audio");
            myAudio.src = song.Song;
            myAudio.addEventListener('canplay', function(event){
                myAudio.play();
            });
            myAudio.load();



            //var playing = false;
            //
            ////get dat sound
            //var source = $('source');
            //var musicProgress = document.getElementById('musicProgress');
            //var soundStatus = document.getElementById('soundStatus');
            //myAudio.addEventListener('ended', function(event) {
            //    soundStatus.innerHTML = "Not playing";
            //});
            //
            //var soundBtn = document.getElementById('index');
            //$(this)('click', function(event) {
            //    myAudio.play();
            //    playing = true;
            //});
            //
            ////waits until the audio is ready to play
            //myAudio.addEventListener('canplay', function(event) {
            //    //	myAudio.
            //});
            //
            //setInterval(function() {
            //    if(playing) {
            //        musicProgress.value = (myAudio.currentTime / myAudio.duration) * 100;
            //        console.log(myAudio.currentTime + "/" + myAudio.duration);
            //    }
            //}, 10);
            //
            //myAudio.addEventListener('ended', function(event) {
            //    musicProgress.value = 100;
            //    playing = false;
            //});
            //
            //
            //var changeSound = document.getElementById('changeSound');
            //changeSound.addEventListener('click', function(event) {
            //    myAudio.src= song.Song;
            //    myAudio.load();
            //})
        });



    })


});