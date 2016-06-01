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
<script type="text/javascript" src="./noise_bg.js"></script>
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
