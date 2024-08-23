var t = null;

function time() {
  var dt = new Date();
  var y = dt.getFullYear();
  var M = dt.getMonth() + 1;
  var d = dt.getDate();
  var h = dt.getHours();
  var m = dt.getMinutes();
  var s = dt.getSeconds();
  M = checkTime(M);
  d = checkTime(d);
  h = checkTime(h);
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('time').innerHTML = y + '-' + M + '-' + d + '&nbsp;' + h + ':' + m + ':' + s;
  t = setTimeout(time, 1000);
}

window.onload = function() {
  time();
}

function checkTime(i) {
  if (i < 10) {
    i = '0' + i;
  }
  return i;
}