<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>client gen test</title>
  <link rel="stylesheet" href="/css/style.css">
  <script src="js/jquery.js"></script>

<script>
function rand(min, max) {
  if (!max) {max = min; min = 0}
  return Math.floor(Math.random() * (max - min + 1)) + min;
}
function capitalize(s) {
  return s[0].toUpperCase() + s.slice(1);
}

function findWord (w, array) {
  for (var i = 0; i < words.length; i++) {
    if (words[i].word == w)
      return i;
  }
  return -1;
}

function processTxt(words) {
  var words_number = words.length;
  sentences = "";
  sentencesNumber = rand(8,16);
  for (var k = 0; k < 16; k++) {
    
    for (var i = 0; i < sentencesNumber; i++) {
      var nextIndex = rand(words_number-1);
      var next = words[nextIndex].word;
      sentences += capitalize(next) + ' ';
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

$(document).ready(function() {
  $("#msg").text("getting file...");
  $.post("/scripts/getjson.php", {
      'filename':'../words.json' 
    }, 
    function(json) {
      $("#msg").text("parsing json...");
      words = JSON.parse(json);
      $("#msg").text("words array ready, generating text...");
      $("#text").text(processTxt(words));
      if ($("#text").text() != "")
        $("#msg").text("here is the text").css("background", "#cfc");
      else
        $("#msg").text("something gone wrong").css("background", "#fcc");
    }
  );
});

</script>

</head>
<body>
<div class="content">
  <div id="msg"></div>
  <div id="text" class="text--mono"></div>
</div>
</body>
</html>