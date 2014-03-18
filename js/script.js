
function rnd (variants) { // целочисленный рандом с нуля до variants-1
  return Math.floor(Math.random()*variants);
}

function radioVal (name) { // возвращает значение чекбокса
  var radios = document.getElementsByName(name);
  for (var i = 0, length = radios.length; i < length; i++) {
    if (radios[i].checked) {
      return radios[i].value;
    }
  }
}

function $ (s) { // получить элемент по id, class, element
  var el = undefined;
  if (s[0]=='#') {
    s = s.substring(1);
    el = document.getElementById(s);
  } else if (s[0]=='.') {
    s = s.substring(1);
    el = document.getElementsByClassName(s);
  } else {
    el = document.getElementsByTagName(s);
  }
  return el;
}

function highlight (el, reg, block) {
  var text = el.innerHTML;
  var result = text.replace(reg, function(str) {
    if (block) /* display: block для того, чтобы переносы строк тоже обозначались в тексте */
      return '<span style="background: #fcc; display: block;">'+str+'</span>';
    else
      return '<span style="background: #fcc;">'+str+'</span>';
  });
  el.innerHTML = result;
}

// init
window.onload = function(){
  console.log('window loaded');
/*
  $("#emmanuele").innerHTML = $("#emmanuele").innerHTML.replace(/,\s?/g, " , "); // запятые нужно разделять пробелами и считать отдельными словами
  $("#emmanuele").innerHTML = $("#emmanuele").innerHTML.replace(/\.{2,}/g, "."); // убрать многоточия 
  $("#emmanuele").innerHTML = $("#emmanuele").innerHTML.replace(/\.\s?/g, " . "); // и разделить точки 
  $("#emmanuele").innerHTML = $("#emmanuele").innerHTML.replace(/\:\s?/g, " : "); // и двоеточия
  $("#emmanuele").innerHTML = $("#emmanuele").innerHTML.replace(/\!\s?/g, " ! "); // и двоеточия
  $("#emmanuele").innerHTML = $("#emmanuele").innerHTML.replace(/\?\s?/g, " ? "); // и двоеточия
  highlight($("#emmanuele"), /\n[–—\-]\s/g ); // диаложные тире
  highlight($("#emmanuele"), /\n/g, true ); // переносы строк
  highlight($("#emmanuele"), /[«»]/g ); // кавычки (также нужно учесть и неправильные, но только уже в php)
  highlight($("#emmanuele"), /\(.*?\)/g ); // содержимое скобок
  highlight($("#emmanuele"), /…/g ); // многоточия
  highlight($("#emmanuele"), /\s{2,}/g); // подряд идущие пробелы
*/
}