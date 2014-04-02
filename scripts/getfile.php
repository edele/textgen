<?php 
function getTxt($path){
   $txt = file_get_contents($path);
   return $txt;
}

echo getTxt($_POST['filename']);