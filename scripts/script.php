<?php 

function check($text='') {
  return $text;
}

function processTxt($path) {
  $txt = file_get_contents($path);
  $allWords = preg_split( "/( |,|\.|;|:|\?|\!|\n)+/", $txt);
  $words = array();

  for ($i=0; $i < count($allWords); $i++) { 
    $allWords[$i] = mb_strtolower($allWords[$i], "utf8");
  }

  for ($i=0; $i < count($allWords); $i++) { 
    if (!array_key_exists($allWords[$i], $words)) {
      $words[$allWords[$i]] = 1;
    } else {
      $words[$allWords[$i]] += 1;
    }
  }
  print_r($words);
}