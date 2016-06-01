
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


