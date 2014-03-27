function rnd(min, max) {
    if (!max) {max = min; min = 0}
    return Math.floor(Math.random() * (max - min + 1)) + min;
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