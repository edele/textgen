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

function generateSentences(words) {
  startProcessingTime = new Date();
  var words_number = words.length;
  var sentences = "";
  var sentencesNumber = rand(8,16);
  for (var k = 0; k < 16; k++) {
    
    for (var i = 0; i < sentencesNumber; i++) {
      var nextIndex = rand(words_number-1);
      var next = words[nextIndex].word;
      sentences += capitalize_fl(next) + ' ';
      nextIndex = findWord(next, words);
      for (var j = 0; j < 16; j++) {
        if (nextIndex == -1)
          break;
        sentences += " ";
        var nextWords = words[nextIndex].nextWords;
        next = nextWords[rand(nextWords.length-1)];
        nextIndex = findWord(next, words);
        sentences += next;
        //var nextWord = nextWords[rand(nextWords.length-1)];

      };
      sentences += ". ";
    };
    sentences += "\n\n";
  };
  return sentences;
}

var words;
var startProcessingTime;
$(document).ready(function() {
  $("#msg").text("getting file...");
  $.post("/scripts/getfile.php", {
      'filename':'../words.json' 
    }, 
    function(json) {
      $("#msg").text("parsing json...");
      words = JSON.parse(json);
      $("#msg").text("words array ready, generating text...");
      $("#text").text(generateSentences(words));
      if ($("#text").text() != "") {
        var l = new Date() - startProcessingTime + " ms";
        $("#msg").text("text processed in "+l).css("background", "#cfc");
      }
      else
        $("#msg").text("something gone wrong").css("background", "#fcc");
    }
  ); // post
}); // document ready