<?php
  //echo "self similarity drawing context."

/*
地相基準時刻 2016/6/23 3:12:08 (いて座Aスターへの最接近時刻)
月相基準時刻 2016/3/9 0:24:00 (皆既月食)
地球公転周期 365.2421904 日	
月公転周期	27.321662 日

月相：
{ (now - 月相基準時刻) / 月公転周期 - (now - 地相基準時刻) / 地球公転周期 } の小数点以下
地相：
{ (now - 地相基準時刻) / 地球公転周期 } の小数点以下
 */

?>

<html lang="ja">
<head>
<meta charset="utf-8" />
<title>Noise Background Drawing Context</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<!--
<link rel="stylesheet" href="../jquery/jquery-ui.css" />
<script src="../jquery/jquery-1.8.3.js"></script>
<script src="../jquery/jquery-ui.js"></script>
-->
<link rel="stylesheet" href="noise_bg.css" />
<script>
var step = 20;
var scale = 30;
var trans = 20;
var colorq = 3;
var colorqn = 6;
var colorh = 0;

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
}

$(function() {
    //step:
    $( "#slider_step" ).slider({
        range: "min", min: 1, max: 50, value: 20,
        slide: function( event, ui ) {
            $( "#step" ).val( ui.value );
            if ( ui.value != step ) {
                step = ui.value;
                updateImg();
            }
        }
    });
    $( "#step" ).val( $( "#slider_step" ).slider( "value" ) );

     //scale:
    $( "#slider_scale" ).slider({
        range: "min", min: 2, max: 100, value: 30,
        slide: function( event, ui ) {
            $( "#scale" ).val( ui.value );
            if ( ui.value != scale ) {
                scale = ui.value;
                updateImg();
            }
        }
    });
    $( "#scale" ).val( $( "#slider_scale" ).slider( "value" ) );

    //trans:
    $( "#slider_trans" ).slider({
        range: "min", min: 0, max: 40, value: 20,
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

    //dist rotate:
    $( "#slider_dist_rotate" ).slider({
        range: "min", min: -90, max: 90, value: 45, step: 3,
        slide: function( event, ui ) {
            $( "#dist_rotate" ).val( ui.value );
            if ( ui.value != dist_rotate ) {
                dist_rotate = ui.value;
                updateImg();
            }
        }
    });
    $( "#dist_rotate" ).val( $( "#slider_dist_rotate" ).slider( "value" ) );

    //pos_x:
    $( "#slider_pos_x" ).slider({
        range: "min", min: -100, max: 100, value: 0, step: 2,
        slide: function( event, ui ) {
            $( "#pos_x" ).val( ui.value );
            if ( ui.value != pos_x ) {
                pos_x = ui.value;
                updateImg();
            }
        }
    });
    $( "#pos_x" ).val( $( "#slider_pos_x" ).slider( "value" ) );

    //pos_y:
    $( "#slider_pos_y" ).slider({
        range: "min", min: -100, max: 100, value: 0, step: 2,
        slide: function( event, ui ) {
            $( "#pos_y" ).val( ui.value );
            if ( ui.value != pos_y ) {
                pos_y = ui.value;
                updateImg();
            }
        }
    });
    $( "#pos_y" ).val( $( "#slider_pos_y" ).slider( "value" ) );

    //steps:
    $( "#slider_steps" ).slider({
        range: "min", min: 2, max: 20, value: 10,
        slide: function( event, ui ) {
            $( "#steps" ).val( ui.value );
            if ( ui.value != steps ) {
                steps = ui.value;
                //updateResult();
            }
        }
    });
    $( "#steps" ).val( $( "#slider_steps" ).slider( "value" ) );
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
    <!-- scaling -->
    <tr>
    <td><div class="board" style="background: #aba;"><b>date</b><table class="sliders">
        <tr>
            <td class="label"><label for="dist_rotate">Rotate2:</label></td>
            <td class="value"><input type="text" id="dist_rotate" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_dist_rotate"></div></td>
        </tr><tr>
            <td class="label"><label for="pos_x">Pos. X:</label></td>
            <td class="value"><input type="text" id="pos_x" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_pos_x"></div></td>
        </tr><tr>
            <td class="label"><label for="pos_y">Pos. Y:</label></td>
            <td class="value"><input type="text" id="pos_y" style="border: 0; color: #931ff6; font-weight: bold;" size="4" /></td>
            <td><div id="slider_pos_y"></div></td>
        </tr>
    </table></div></td>
    </tr>
</table>

</div></body>
</html>
