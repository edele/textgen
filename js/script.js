"use strict";

function rand(min, max) {
  if (!max) {max = min; min = 0}
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

/*
function highlight (el, reg, block) {
  var text = el.innerHTML;
  var result = text.replace(reg, function(str) {
    if (block) // display: block для того, чтобы переносы строк тоже обозначались в тексте
      return '<span style="background: #fcc; display: block;">'+str+'</span>';
    else
      return '<span style="background: #fcc;">'+str+'</span>';
  });
  el.innerHTML = result;
}
/**/

