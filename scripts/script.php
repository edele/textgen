<?php 

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}


function clearTxt($path){
   $txt = file_get_contents($path);
   //$txt = preg_replace('/[^\p{L}\p{N}\s]/u', '', $txt);
   //$txt = preg_replace("/\r\n/u",' ',$txt);
   return $txt;
}
 

function check($text='') {
  return $text;
}

function mikhalych_json_encode($arr) {
  //convmap since 0x80 char codes so it takes all multibyte codes (above ASCII 127). So such characters are being "hidden" from normal json_encoding
  array_walk_recursive($arr, function (&$item, $key) { if (is_string($item)) $item = mb_encode_numericentity($item, array (0x80, 0xffff, 0, 0xffff), 'UTF-8'); });
  return mb_decode_numericentity(json_encode($arr, JSON_PRETTY_PRINT), array (0x80, 0xffff, 0, 0xffff), 'UTF-8'); 
}

function json_encode_cyr($str) {
  $arr_replace_utf = array('\u0410', '\u0430','\u0411','\u0431','\u0412','\u0432',
  '\u0413','\u0433','\u0414','\u0434','\u0415','\u0435','\u0401','\u0451','\u0416',
  '\u0436','\u0417','\u0437','\u0418','\u0438','\u0419','\u0439','\u041a','\u043a',
  '\u041b','\u043b','\u041c','\u043c','\u041d','\u043d','\u041e','\u043e','\u041f',
  '\u043f','\u0420','\u0440','\u0421','\u0441','\u0422','\u0442','\u0423','\u0443',
  '\u0424','\u0444','\u0425','\u0445','\u0426','\u0446','\u0427','\u0447','\u0428',
  '\u0448','\u0429','\u0449','\u042a','\u044a','\u042b','\u044b','\u042c','\u044c',
  '\u042d','\u044d','\u042e','\u044e','\u042f','\u044f', '\u2013', '\u00a0', '\ufeff', 
  '\u2026', '\u00bb', '\u00ab');
  $arr_replace_cyr = array('А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е',
  'Ё', 'ё', 'Ж','ж','З','з','И','и','Й','й','К','к','Л','л','М','м','Н','н','О','о',
  'П','п','Р','р','С','с','Т','т','У','у','Ф','ф','Х','х','Ц','ц','Ч','ч','Ш','ш',
  'Щ','щ','Ъ','ъ','Ы','ы','Ь','ь','Э','э','Ю','ю','Я','я', '–', ' ', 
  '', '.', '');
  $str1 = json_encode($str, JSON_PRETTY_PRINT);
  $str2 = str_replace($arr_replace_utf,$arr_replace_cyr,$str1);
  return $str2;
}

function nextWords($word, $allWords)
{
  $keys = array_keys($allWords, $word);
  $nextWords = array();
  $keysCount = count($keys);
  for ($i=0; $i < $keysCount; $i++) { 
    $nextKey = $keys[$i];
    $nextWord =  $allWords[$nextKey+1];
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

function processTxt($path) {
  $time_start = microtime(true);

  $txt = file_get_contents($path);
  $allWords = preg_split( "/( |,|\.|;|:|\?|\!|\n)+/", $txt);

  $words = array();
  for ($i=0; $i < count($allWords); $i++) {
    $allWords[$i] = mb_strtolower($allWords[$i], "utf8");
  }

  /*print_r(nextWords("прекрасно", $allWords));  */
  echo "\n\n";

  $words = array();
  for ($i=0; $i < 1000; $i++) { 
    if (!array_key_exists($allWords[$i], $words)) {
      $current = array(
        'word' => $allWords[$i],
        'nextWords' => nextWords($allWords[$i], $allWords)
        );
      array_push($words, $current);
      // $words[$allWords[$i]] = nextWords($allWords[$i], $allWords);
    } 
    /*else {
      $words[$allWords[$i]] += 1;
    }*/
  }

  $words_json = mikhalych_json_encode($words);
  file_put_contents('words.json', $words_json);

  $time_end = microtime(true);
  $time = $time_end - $time_start;

  return "ready in $time"; // $words_json;

  /*
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