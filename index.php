<?php
  //echo "self similarity drawing context."

/*
地相基準時刻 2016/6/23 3:12:08 (いて座Aスターへの最接近時刻)
月相基準時刻 2016/3/9 0:24:00 (皆既月食)
地球公転周期 365.2421904 日	
月公転周期	27.321662 日

月相：
{ (now - 月相基準時刻) / 月公転周期 - (now - 月相基準時刻) / 地球公転周期 } の小数点以下
地相：
{ (now - 地相基準時刻) / 地球公転周期 } の小数点以下
 */
$now = time();
$lunarPhaseBase = strtotime("2016/3/9 11:08:00");
$lunarPos = ($now - $lunarPhaseBase)/(27.321662*86400) - ($now - $lunarPhaseBase)/(365.2421904*86400);
$lunarPhase = ($lunarPos - floor($lunarPos));
$datestr = date("Y/m/d H:i:s", $now);

?>

<html lang="ja">
<head>
<meta charset="utf-8" />
<title>Noise Background Drawing Context</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script> -->
<script type="text/javascript" src="./jquery.timepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="./jquery.timepicker.css" />
<!--
<link rel="stylesheet" href="../jquery/jquery-ui.css" />
<script src="../jquery/jquery-1.8.3.js"></script>
<script src="../jquery/jquery-ui.js"></script>
-->
<link rel="stylesheet" href="noise_bg.css" />
<script type="text/javascript" src="./initvars.js"></script>
<script type="text/javascript" src="./lunar_phase.js"></script>
<script>
var resultImg = new Image();
resultImg.src = "step.php?step=10";
resultImg.onload = function () { resultLoaded(); }
var updated = false;
var timer = null;

function updateImg() {
    updated = true;
}
function doUpdateImg() {
    //document.getElementById("result_img").src = "template.php?step=" + step + "&scale=" + scale; 
    document.getElementById("result_div").style.backgroundImage = "url(" + "template.php?step=" + step + 
            "&scale=" + scale + 
            "&trans=" + trans +
            "&colorq=" + colorq +
            "&colorqn=" + colorqn +
            "&colorh=" + colorh +
            "&sat=" + sat +
            ")"; 
    updated = false;
}

onload = function() {
    window.clearInterval(timer);
    timer = window.setInterval(function(){
        if(updated){
            doUpdateImg();
        };
    }, 1000);
    onDateChange();
}
function resumeTrans () {
    trans = parseInt(20*(2*scale-step)*(2*scale-step)/(4*scale*scale));
    $( "#trans" ).val( trans );
    $( "#slider_trans" ).slider("value", trans);
}

function resumeDay () {
    step = sst[day].step;
    scale = sst[day].scale;
    trans = sst[day].trans;
    $( "#step" ).val( step );
    $( "#slider_step" ).slider("value", step);
    $( "#scale" ).val( scale );
    $( "#slider_scale" ).slider("value", scale);
    $( "#trans" ).val( trans );
    $( "#slider_trans" ).slider("value", trans);
    $( "#day" ).val( day );
    $( "#slider_day" ).slider("value", day);
}
function dayDesc () {
    day = day - 1;
    if ( day < 0 ) day += 28;
    resumeDay();
    updateImg();
}
function dayAsc () {
    day = day + 1;
    if ( day >= 28 ) day -= 28;
    resumeDay();
    updateImg();
}

function resumeSeason () {
    colorq = hueQSat[season].q;
    colorqn = hueQSat[season].qn;
    colorh = hueQSat[season].hue;
    sat = hueQSat[season].sat;
    $( "#colorq" ).val( colorq );
    $( "#slider_colorqn" ).slider("value", colorqn);
    $( "#colorqn" ).val( colorqn );
    $( "#slider_colorq" ).slider("value", colorq);
    $( "#colorh" ).val( colorh );
    $( "#slider_colorh" ).slider("value", colorh);
    $( "#sat" ).val( sat );
    $( "#slider_sat" ).slider("value", sat);
    $( "#season" ).val( season );
    $( "#slider_season" ).slider("value", season);
}
function seasonDesc () {
    season = season - 1;
    if ( season < 0 ) season += 24;
    resumeSeason();
    updateImg();
}
function seasonAsc () {
    season = season + 1;
    if ( season >= 24 ) season -= 24;
    resumeSeason();
    updateImg();
}

$(function() {
    //step:
    $( "#slider_step" ).slider({
        range: "min", min: 1, max: 200, value: 10,
        slide: function( event, ui ) {
            $( "#step" ).val( ui.value );
            if ( ui.value != step ) {
                step = ui.value;
                resumeTrans();
                updateImg();
            }
        }
    });
    $( "#step" ).val( $( "#slider_step" ).slider( "value" ) );

     //scale:
    $( "#slider_scale" ).slider({
        range: "min", min: 2, max: 200, value: 20,
        slide: function( event, ui ) {
            $( "#scale" ).val( ui.value );
            if ( ui.value != scale ) {
                scale = ui.value;
                resumeTrans();
                updateImg();
            }
        }
    });
    $( "#scale" ).val( $( "#slider_scale" ).slider( "value" ) );

    //trans:
    $( "#slider_trans" ).slider({
        range: "min", min: 0, max: 45, value: 11,
        slide: function( event, ui ) {
            $( "#trans" ).val( ui.value );
            if ( ui.value != trans ) {
                trans = ui.value;
                updateImg();
            }
        }
    });
    $( "#trans" ).val( $( "#slider_trans" ).slider( "value" ) );

    //colorh:
    $( "#slider_colorh" ).slider({
        range: "min", min: 0, max: 17, value: 0,
        slide: function( event, ui ) {
            $( "#colorh" ).val( ui.value );
            if ( ui.value != colorh ) {
                colorh = ui.value;
                updateImg();
            }
        }
    });
    $( "#colorh" ).val( $( "#slider_colorh" ).slider( "value" ) );

    //colorq:
    $( "#slider_colorq" ).slider({
        range: "min", min: 1, max: 3, value: 3, step: 1,
        slide: function( event, ui ) {
            $( "#colorq" ).val( ui.value );
            if ( ui.value != colorq ) {
                colorq = ui.value;
                updateImg();
            }
        }
    });
    $( "#colorq" ).val( $( "#slider_colorq" ).slider( "value" ) );

    //colorqn:
    $( "#slider_colorqn" ).slider({
        range: "min", min: 1, max: 6, value: 6, step: 1,
        slide: function( event, ui ) {
            $( "#colorqn" ).val( ui.value );
            if ( ui.value != colorqn ) {
                colorqn = ui.value;
                updateImg();
            }
        }
    });
    $( "#colorqn" ).val( $( "#slider_colorqn" ).slider( "value" ) );

    //saturation:
    $( "#slider_sat" ).slider({
        range: "min", min: 0, max: 25, value: 25, step: 1,
        slide: function( event, ui ) {
            $( "#sat" ).val( ui.value );
            if ( ui.value != sat ) {
                sat = ui.value;
                updateImg();
            }
        }
    });
    $( "#sat" ).val( $( "#slider_sat" ).slider( "value" ) );

    //day:
    $( "#slider_day" ).slider({
        range: "min", min: 0, max: 28, value: 0, step: 1,
        slide: function( event, ui ) {
            $( "#day" ).val( ui.value );
            if ( ui.value != day ) {
                day = ui.value;
                updateImg();
            }
        }
    });
    $( "#day" ).val( $( "#slider_day" ).slider( "value" ) );

    //season:
    $( "#slider_season" ).slider({
        range: "min", min: 0, max: 24, value: 0, step: 1,
        slide: function( event, ui ) {
            $( "#season" ).val( ui.value );
            if ( ui.value != season ) {
                season = ui.value;
                updateImg();
            }
        }
    });
    $( "#season" ).val( $( "#slider_season" ).slider( "value" ) );

});

</script>
</head>
<body>
<div class="contents">
<table>
    <!-- title -->
    <tr>
    <td colspan="2"><div class="board" style="background: #667; text-align: center;"><b>Noise Background Drawing Script</b></div></td>
    </tr>
    <!-- source -->
    <tr>
    <td><div class="board" style="background: #baa;"><b>bg params</b><table class="sliders">
        <tr>
            <td class="label"><label for="step">Step:</label></td>
            <td class="value"><input type="text" id="step" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_step"></div></td>
        </tr><tr>
            <td class="label"><label for="scale">Scale:</label></td>
            <td class="value"><input type="text" id="scale" style="border: 0; color: #931ff6; font-weight: bold;" size="3" /></td>
            <td><div id="slider_scale"></div></td>
        </tr><tr>
            <td class="label"><label for="scaling">Trans:</label></td>
            <td class="value"><input type="text" id="trans" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_trans"></div></td>
        </tr><tr>
            <td class="label"><label for="colorh">ColorHue:</label></td>
            <td class="value"><input type="text" id="colorh" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_colorh"></div></td>
        </tr><tr>
            <td class="label"><label for="colorq">ColorQ:</label></td>
            <td class="value"><input type="text" id="colorq" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_colorq"></div></td>
        </tr><tr>
            <td class="label"><label for="colorqn">ColorQN:</label></td>
            <td class="value"><input type="text" id="colorqn" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_colorqn"></div></td>
        </tr><tr>
            <td class="label"><label for="colorqn">Saturation:</label></td>
            <td class="value"><input type="text" id="sat" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_sat"></div></td>
        </tr>
    </table></div></td>
    <!-- result -->
    <td rowspan="2">
        <div class="board" id="result_div" style="padding: 30px;">
             <!-- <img id="result_img" src="template.php"> -->
            <h1>noise_bg</h1>
            <h2>Background Test</h2>
            <h3>Background Test</h3>
            <h4>Background Test</h4>
            <p>バックグラウンドのテストです。( ^^) _U~~</p>
        </div>
    </td>
    </tr>
    <!-- phase -->
    <tr>
    <td><div class="board" style="background: #aba;"><b>Phase</b><table class="sliders">
        <tr>
            <td class="label"><label for="day">Lunar:</label></td>
            <td class="value"><input type="text" id="day" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><button onClick="dayDesc();">&lt;</button><button onClick="dayAsc();">&gt;</button><div id="slider_day"></div></td>
        </tr><tr>
            <td class="label"><label for="pos_x">Earth:</label></td>
            <td class="value"><input type="text" id="season" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><button onClick="seasonDesc();">&lt;</button><button onClick="seasonAsc();">&gt;</button><div id="slider_season"></div></td>
        </tr>
    </table></div></td>
    </tr>
    <!-- date -->
    <tr>
    <td colspan = "2"><div class="board" style="background: #aab;"><b>date : </b>
        <input type="text" id="datepicker" value="<?php echo date('Y/m/d'); ?>" size="10" onchange="onDateChange()" />
        <input type="text" id="timepicker" class="time" value="<?php echo date('H:i:s'); ?>" size="10"  onchange="onDateChange()" />
        <table class="sliders"><tr>
        <td>Lunar Phase : <input type="text" id="lunarPhase" value="0" readonly size="6" /></td>
        <td>Earth Phase : <input type="text" id="earthPhase" value="0" readonly size="6" /></td>
        </tr></table>
    </td>
    </tr>
</table>

</div></body>
</html>
