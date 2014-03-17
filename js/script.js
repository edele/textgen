
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

// init
window.onload = function(){
  console.log('window loaded');
}