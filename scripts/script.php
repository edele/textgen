<?php
function clearTxt($path){
   $txt = file_get_contents($path);
   //$txt = preg_replace('/[^\p{L}\p{N}\s]/u', '', $txt);
   //$txt = preg_replace("/\r\n/u",' ',$txt);
   return $txt;
}
 

function cyr_json_encode($arr) {
  //convmap since 0x80 char codes so it takes all multibyte codes (above ASCII 127). So such characters are being "hidden" from normal json_encoding
  array_walk_recursive($arr, function (&$item, $key) { if (is_string($item)) $item = mb_encode_numericentity($item, array (0x80, 0xffff, 0, 0xffff), 'UTF-8'); });
  return mb_decode_numericentity(json_encode($arr, JSON_PRETTY_PRINT), array (0x80, 0xffff, 0, 0xffff), 'UTF-8'); 
}

/**
* 
*/
class WordsProcessor {

private $allWords;

public $wordsToProcess;

private function nextWords($word) {
  $keys = array_keys($this->allWords, $word);
  $nextWords = array();
  $keysCount = count($keys);
  for ($i=0; $i < $keysCount; $i++) { 
    $nextKey = $keys[$i];
    $nextWord = $this->allWords[$nextKey+1];
    if (!array_key_exists($nextWord, $nextWords)) {
      array_push($nextWords, $nextWord);
    }
    /* // подсчет количества слов
    if (!array_key_exists($nextWord, $nextWords)) {
      $nextWords[$nextWord] = 1; 
      // array_push($nextWords, $nextWord);
    } else {
      $nextWords[$nextWord] += 1;
    }
    /**/
  }
  return $nextWords;
}

private function processTxt($path) {
  $time_start = microtime(true);
  $txt = file_get_contents($path);
  // $txt = mb_strtolower($txt, "utf8");

  /* Here comes txt preprocessing

  return $txt;

  /**/

  $this->allWords = preg_split( "/( |,|\.|;|:|\?|\!|\n)+/", $txt);
  //$allWords = explode(" ", $txt);
  //$allWords = split(" ", $txt);
  /*
  for ($i=0; $i < count($allWords); $i++) {
    $allWords[$i] = mb_strtolower($allWords[$i], "utf8"); // strtolower не работает с кириллицей
    // а может свой tolower с блэкджеком и только для кириллицы?
  }
  /**/

  $convertMap = array(
    'А' => 'а',    'Б' => 'б',    'В' => 'в',    'Г' => 'д',    'Д' => 'д',    'Е' => 'е',
    'Ё' => 'ё',    'Ж' => 'ж',    'З' => 'з',    'И' => 'и',    'Й' => 'й',    'К' => 'к',
    'Л' => 'л',    'М' => 'м',    'Н' => 'н',    'О' => 'о',    'П' => 'п',    'Р' => 'р',
    'С' => 'с',    'Т' => 'т',    'У' => 'у',    'Ф' => 'ф',    'Х' => 'х',    'Ц' => 'ц',
    'Ч' => 'ч',    'Ш' => 'ш',    'Щ' => 'щ',    'Ы' => 'ы',    'Ь' => 'ь',    'Ъ' => 'ъ',
    'Э' => 'э',    'Ю' => 'ю',    'Я' => 'я');
  /*
  $countAllWords = count($allWords);
  for ($i=0; $i < $countAllWords; $i++) {
    if (array_key_exists(
      (($allWords[$i] && $allWords[$i][0] && $allWords[$i][1]) ? $allWords[$i][0] : ''),
      $convertMap)) {
        $allWords[$i] = $convertMap[$allWords[$i][0].$allWords[$i][1]].substr($allWords[$i], 2);
    }
  }
  /**/
  /*print_r(nextWords("прекрасно", $allWords));  */

  $countAllWords = count($this->allWords);
  $words = array();
  for ($i=0; $i < $this->wordsToProcess; $i++) { 
    if (!array_key_exists($this->allWords[$i], $words)) {
      $current = array(
        'word' => $this->allWords[$i],
        'nextWords' => $this->nextWords($this->allWords[$i])
        );
      array_push($words, $current);
      // $words[$allWords[$i]] = nextWords($allWords[$i], $allWords);
    } 
    /*else {
      $words[$allWords[$i]] += 1;
    }*/
  }

  $words_json = cyr_json_encode($words);
  file_put_contents('words.json', $words_json);

  $time_end = microtime(true);
  $time = $time_end - $time_start;
  $time_ms = round($time*1000);

  echo "processed ".$this->wordsToProcess." words in $time_ms ms"; // $words_json;

  /* // old text generation
  $sentences = "";
  for ($p=0; $p < 5; $p++) { 
    # p start
    $sentences_number = rand(5,16);
    for ($i=0; $i < $sentences_number; $i++) {
      $next = array_rand($words);
      $sentences .= mb_convert_case($next, MB_CASE_TITLE, 'UTF-8');
      for ($j=0; $j < 16; $j++) {
        if (!array_key_exists($next, $words)) 
          break;
        $sentences .= " ";
        $next = array_rand($words[$next]);
        $sentences .= $next;
      }
      $sentences .= ". ";
    }
    $sentences .= "\n\n";
    # p finish
  }

  return $sentences;
  /**/
}

function __construct($path, $wordsToProcess = 1500) {
  if ($wordsToProcess>0) { // TODO -1 to process all whole file 
    $this->wordsToProcess = $wordsToProcess;
  } else {
    echo 'negative $wordsToProcess';
  }
  $this->processTxt($path);
}
}