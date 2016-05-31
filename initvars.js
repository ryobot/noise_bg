var step = 10;
var scale = 20;
var trans = 11;
var colorq = 3;
var colorqn = 6;
var colorh = 0;
var day = 0;
var season = 0;
var sat = 25;

var sst = [];
sst.push({ step:10, scale:20, trans:18 }); // 00
sst.push({ step:15, scale:30, trans:14 }); // 01
sst.push({ step:15, scale:40, trans:13 }); // 02
sst.push({ step:20, scale:50, trans:12 }); // 03
sst.push({ step:25, scale:60, trans:12 }); // 04
sst.push({ step:30, scale:70, trans:12 }); // 05
sst.push({ step:40, scale:80, trans:11 }); // 06
sst.push({ step:50, scale:90, trans:10 }); // 07
sst.push({ step:60, scale:100, trans:8 }); // 08
sst.push({ step:70, scale:100, trans:7 }); // 09
sst.push({ step:80, scale:100, trans:6 }); // 10
sst.push({ step:90, scale:100, trans:5 }); // 11
sst.push({ step:95, scale:100, trans:4 }); // 12
sst.push({ step:115, scale:120, trans:3 }); // 13
sst.push({ step:150, scale:150, trans:3 }); // 14
sst.push({ step:150, scale:140, trans:3 }); // 15
sst.push({ step:120, scale:110, trans:3 }); // 16
sst.push({ step:90, scale:80, trans:3 }); // 17
sst.push({ step:70, scale:60, trans:3 }); // 18
sst.push({ step:60, scale:50, trans:3 }); // 19
sst.push({ step:50, scale:40, trans:3 }); // 20
sst.push({ step:40, scale:35, trans:3 }); // 21
sst.push({ step:30, scale:30, trans:4 }); // 22
sst.push({ step:25, scale:25, trans:5 }); // 23
sst.push({ step:20, scale:20, trans:5 }); // 24
sst.push({ step:15, scale:15, trans:6 }); // 25
sst.push({ step:10, scale:10, trans:8 }); // 26
sst.push({ step:10, scale:15, trans:15 }); // 27

var hueQSat = [];
hueQSat.push({ hue: 0, q:3, sat:25, qn:5 }); // 01
hueQSat.push({ hue: 1, q:2, sat:25, qn:4 }); // 02
hueQSat.push({ hue: 2, q:1, sat:25, qn:3 }); // 03
hueQSat.push({ hue: 3, q:1, sat:25, qn:4 }); // 04
hueQSat.push({ hue: 4, q:1, sat:25, qn:5 }); // 05
hueQSat.push({ hue: 5, q:1, sat:25, qn:6 }); // 06
hueQSat.push({ hue: 6, q:1, sat:25, qn:5 }); // 07
hueQSat.push({ hue: 7, q:1, sat:25, qn:4 }); // 08
hueQSat.push({ hue: 8, q:1, sat:25, qn:3 }); // 09
hueQSat.push({ hue: 9, q:1, sat:25, qn:4 }); // 10
hueQSat.push({ hue:10, q:1, sat:25, qn:5 }); // 11
hueQSat.push({ hue:11, q:1, sat:25, qn:6 }); // 12
hueQSat.push({ hue:12, q:2, sat:25, qn:5 }); // 13
hueQSat.push({ hue:13, q:2, sat:25, qn:4 }); // 14
hueQSat.push({ hue:14, q:2, sat:25, qn:3 }); // 15
hueQSat.push({ hue:15, q:3, sat:25, qn:4 }); // 16
hueQSat.push({ hue:16, q:3, sat:20, qn:4 }); // 17
hueQSat.push({ hue:17, q:3, sat:15, qn:3 }); // 18
hueQSat.push({ hue: 0, q:3, sat:10, qn:3 }); // 19
hueQSat.push({ hue: 0, q:3, sat:5, qn:3 }); // 20
hueQSat.push({ hue: 0, q:3, sat:0, qn:4 }); // 21
hueQSat.push({ hue: 0, q:3, sat:10, qn:5 }); // 22
hueQSat.push({ hue: 0, q:3, sat:20, qn:6 }); // 23
hueQSat.push({ hue: 0, q:3, sat:25, qn:6 }); // 24

