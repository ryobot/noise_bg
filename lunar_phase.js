
function floatFormat( number, n ) {
    var _pow = Math.pow( 10 , n ) ;
    return Math.round( number * _pow ) / _pow ;
}

function onDateChange () {
    datestr = document.getElementById("datepicker").value + " " + document.getElementById("timepicker").value;
    //window.alert(datestr);
    date = new Date(datestr);
    lunarPhaseBase = new Date("2016/3/9 11:08:00");
    lunarPos = (date - lunarPhaseBase)/(27.321662*86400000) - (date - lunarPhaseBase)/(365.2421904*86400000);
    lunarPhase = floatFormat(lunarPos - Math.floor(lunarPos), 3);
    document.getElementById("lunarPhase").value = lunarPhase;

    earthPhaseBase = new Date("2016/6/23 3:12:08");
    earthPos = (date - earthPhaseBase)/(365.2421904*86400000);
    earthPhase = floatFormat(earthPos - Math.floor(earthPos), 3);
    document.getElementById("earthPhase").value = earthPhase;
    
    // for noise bg:
    day = Math.floor(lunarPhase*28);
    season = Math.floor(earthPhase*24) + 4;
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


