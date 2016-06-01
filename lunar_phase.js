
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

function floatFormat( number, n ) {
    var _pow = Math.pow( 10 , n ) ;
    return Math.round( number * _pow ) / _pow ;
}

function onDateChange () {
    datestr = document.getElementById("datepicker").value + " " + document.getElementById("timepicker").value;

    date = new Date(datestr);
    lunarPhaseBase = new Date(data.lunarPhaseBase);
    lunarPos = (date - lunarPhaseBase)/(data.lunarRevPeriod*86400000) - (date - lunarPhaseBase)/(data.earthRevPeriod*86400000);
    lunarPhase = floatFormat(lunarPos - Math.floor(lunarPos), 3);
    document.getElementById("lunarPhase").value = lunarPhase;

    earthPhaseBase = new Date(data.earthPhaseBase);
    earthPos = (date - earthPhaseBase)/(data.earthRevPeriod*86400000);
    earthPhase = floatFormat(earthPos - Math.floor(earthPos), 3);
    document.getElementById("earthPhase").value = earthPhase;
    
    // for noise bg:
    day = Math.floor(lunarPhase*28);
    season = Math.floor(earthPhase*24) + 6;
    if (season >= 24) season -= 24;
    resumeSeason();
    resumeDay();
    updateImg();
}

$(function() {
    //$.datepicker.setDefaults( $.datepicker.regional[ "ja" ] );
    $( "#datepicker" ).datepicker({
        dateFormat: "yy/mm/dd",
        changeMonth: true,
        changeYear: true
    });
});
  
$(function() {
  $('#timepicker').timepicker({ 'timeFormat': 'H:i:s' });
});


