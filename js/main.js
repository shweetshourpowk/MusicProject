
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

            $("#descArea").html("<div id='desc'>" + song.Pic + "<h2>" + song.Title + "</h2>" + "<p>" + song.Artist + " " + song.Album + " " + song.Date + " " + song.Genre + "</p>" + "<p>"+ song.Desc + "</p>" +  "</div>");

        });

    })


});