
function onDateChange () {
    datestr = document.getElementById("datepicker").value + " " + document.getElementById("timepicker").value;
    //window.alert(datestr);
    date = new Date(datestr);
    lunarPhaseBase = new Date("2016/3/9 11:08:00");
    lunarPos = (date - lunarPhaseBase)/(27.321662*86400000) - (date - lunarPhaseBase)/(365.2421904*86400000);
    lunarPhase = (lunarPos - Math.floor(lunarPos));
    document.getElementById("lunarPhase").value = lunarPhase;
}

$(function() {
    $.datepicker.setDefaults( $.datepicker.regional[ "ja" ] );
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true
    });
});
  
$(function() {
  $('#timepicker').timepicker({ 'timeFormat': 'H:i:s' });
});


