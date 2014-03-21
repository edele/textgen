<?php 
function clearTxt($path){
   $txt = file_get_contents($path);
   //$txt = preg_replace('/[^\p{L}\p{N}\s]/u', '', $txt);
   //$txt = preg_replace("/\r\n/u",' ',$txt);
   return $txt;
}
 

function check($text='') {
  return $text;
}

function json_encode_cyr($str) {
  $arr_replace_utf = array('\u0410', '\u0430','\u0411','\u0431','\u0412','\u0432',
  '\u0413','\u0433','\u0414','\u0434','\u0415','\u0435','\u0401','\u0451','\u0416',
  '\u0436','\u0417','\u0437','\u0418','\u0438','\u0419','\u0439','\u041a','\u043a',
  '\u041b','\u043b','\u041c','\u043c','\u041d','\u043d','\u041e','\u043e','\u041f',
  '\u043f','\u0420','\u0440','\u0421','\u0441','\u0422','\u0442','\u0423','\u0443',
  '\u0424','\u0444','\u0425','\u0445','\u0426','\u0446','\u0427','\u0447','\u0428',
  '\u0448','\u0429','\u0449','\u042a','\u044a','\u042b','\u044b','\u042c','\u044c',
  '\u042d','\u044d','\u042e','\u044e','\u042f','\u044f', '\u2013', '\u00a0');
  $arr_replace_cyr = array('А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е',
  'Ё', 'ё', 'Ж','ж','З','з','И','и','Й','й','К','к','Л','л','М','м','Н','н','О','о',
  'П','п','Р','р','С','с','Т','т','У','у','Ф','ф','Х','х','Ц','ц','Ч','ч','Ш','ш',
  'Щ','щ','Ъ','ъ','Ы','ы','Ь','ь','Э','э','Ю','ю','Я','я', '–', ' ');
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
      $nextWords[$nextWord] = 1; 
      // array_push($nextWords, $nextWord);
    } else {
      $nextWords[$nextWord] += 1;
    }
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

  /*print_r(nextWords("прекрасно", $allWords));  */
  echo "\n\n";

  for ($i=0; $i < 10000; $i++) { 
    if (!array_key_exists($allWords[$i], $words)) {
      $words[$allWords[$i]] = nextWords($allWords[$i], $allWords);
    } 
    /*else {
      $words[$allWords[$i]] += 1;
    }*/
  }

  $words_json = json_encode_cyr($words);
  file_put_contents('words.json', $words_json);
  return $words_json;
}