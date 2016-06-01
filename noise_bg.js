
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
    step = data.sst[day].step;
    scale = data.sst[day].scale;
    trans = data.sst[day].trans;
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
    colorq = data.hueQSat[season].q;
    colorqn = data.hueQSat[season].qn;
    colorh = data.hueQSat[season].hue;
    sat = data.hueQSat[season].sat;
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
                resumeDay();
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
                resumeSeason();
                updateImg();
            }
        }
    });
    $( "#season" ).val( $( "#slider_season" ).slider( "value" ) );

});



