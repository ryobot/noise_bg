var step = 10;
var scale = 20;
var trans = 11;
var colorq = 3;
var colorqn = 6;
var colorh = 0;
var day = 0;
var season = 0;
var sat = 25;
var data = {};

var jsonhttp = new XMLHttpRequest();
jsonhttp.onreadystatechange = function () {
  if (jsonhttp.readyState == 4) {
    if (jsonhttp.status == 200) {
      data = JSON.parse(jsonhttp.responseText);
    }
  }
}
jsonhttp.open("GET", "./noise_bg.json");
jsonhttp.send();
