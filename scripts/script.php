<?php 

function check($text='') {
  return $text;
}

function nextWords($word, $allWords)
{
  $keys = array_keys($allWords, $word);
  $nextWords = array();
  for ($i=0; $i < count($keys); $i++) { 
    $nextKey = $keys[$i];
    $nextWord =  $allWords[$nextKey+1];
    array_push($nextWords, $nextWord);
  }
  return $nextWords;
}

function processTxt($path) {
  $txt = file_get_contents($path);
  $allWords = preg_split( "/( |,|\.|;|:|\?|\!|\n)+/", $txt);
  $words = array();

  for ($i=0; $i < count($allWords); $i++) { 
    $allWords[$i] = mb_strtolower($allWords[$i], "utf8");
  }

  print_r(nextWords("прекрасно", $allWords));  
  echo "\n\n";

  for ($i=0; $i < 10000; $i++) { 
    if (!array_key_exists($allWords[$i], $words)) {
      $words[$allWords[$i]] = nextWords($allWords[$i], $allWords);
    } 
    /*else {
      $words[$allWords[$i]] += 1;
    }*/
  }
  print_r($words);
}