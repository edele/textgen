"use strict";

function capitalize_fl(s) { // first letter
  return s[0].toUpperCase() + s.slice(1);
}

function findWord (w, array) {
  for (var i = 0; i < words.length; i++) {
    if (words[i].word == w)
      return i;
  }
  return -1;
}

// В общем кодировку и предобработку оставляем на сервер

function processTxt(txt) {
  startProcessingTime = new Date();
  var words = [];
  var allWords = [];
  txt = txt.toLowerCase();
  allWords = txt.split(/( |,|\.|;|:|\?|\!|\n)+/);
  // console.log(allWords); // очень дорогой console.log

  for (var i = 0; i < allWords.length; i++) {
    if (words.indexOf(allWords[i]) == -1) {
      words.push(allWords[i]);
    }
  };

  return words;
}

var text;
var startProcessingTime;
$(document).ready(function() {
  $("#msg").text("getting file...");

  $.post("/scripts/getfile.php", {
      'filename':'../master.txt' 
    }, 
    function(txt) {
      text = txt;
      var words = processTxt(text);
      var l = new Date() - startProcessingTime + " ms";
      $("#msg").text("text processed in "+l).css("background", "#cfc");
      //console.log(words);
    }
  ); // post
}); // document ready