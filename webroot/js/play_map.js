$('document').ready(function() {

    // svg tornado marker
    var tornadoSVG = "<svg version='1.1' id='tornado' class='climacon climacon_tornado' viewBox='15 15 70 70'><g class='climacon_iconWrap climacon_iconWrap-tornado'><g class='climacon_componentWrap climacon_componentWrap-tornado'><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine'd='M68.997,36.459H31.002c-1.104,0-2-0.896-2-1.999c0-1.104,0.896-2,2-2h37.995c1.104,0,2,0.896,2,2C70.997,35.563,70.102,36.459,68.997,36.459z'></path><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine' d='M35.002,40.459h29.996c1.104,0,2,0.896,2,2s-0.896,1.999-2,1.999H35.002c-1.104,0-2-0.896-2-1.999C33.002,41.354,33.898,40.459,35.002,40.459z'></path><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine' d='M39.001,48.458h21.998c1.104,0,1.999,0.896,1.999,1.999c0,1.104-0.896,2-1.999,2H39.001c-1.104,0-1.999-0.896-1.999-2C37.002,49.354,37.897,48.458,39.001,48.458z'></path><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine' d='M47,64.456h5.999c1.104,0,2,0.896,2,1.999s-0.896,2-2,2H47c-1.104,0-2-0.896-2-2S45.896,64.456,47,64.456z'></path><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine'd='M40.869,58.456c0-1.104,0.896-1.999,2-1.999h13.998c1.104,0,2,0.896,2,1.999c0,1.104-0.896,2-2,2H42.869C41.765,60.456,40.869,59.561,40.869,58.456z'></path></g></g></svg>";

    // svg hail marker
    var hailSVG = "<svg version='1.1' id='cloudHailAlt' class='climacon climacon_cloudHailAlt' viewBox='15 15 70 70'><g class='climacon_iconWrap climacon_iconWrap-cloudHailAlt'><g class='climacon_wrapperComponent climacon_wrapperComponent-hailAlt'><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-left'><circle cx='42' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-middle'><circle cx='49.999' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-right'><circle cx='57.998' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-left'><circle cx='42' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-middle'><circle cx='49.999' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-right'><circle cx='57.998' cy='65.498' r='2'></circle></g></g><g class='climacon_wrapperComponent climacon_wrapperComponent-cloud'><path class='climacon_component climacon_component-stroke climacon_component-stroke_cloud' d='M63.999,64.941v-4.381c2.39-1.384,3.999-3.961,3.999-6.92c0-4.417-3.581-8-7.998-8c-1.602,0-3.084,0.48-4.334,1.291c-1.23-5.317-5.974-9.29-11.665-9.29c-6.626,0-11.998,5.372-11.998,11.998c0,3.549,1.55,6.728,3.999,8.924v4.916c-4.776-2.768-7.998-7.922-7.998-13.84c0-8.835,7.162-15.997,15.997-15.997c6.004,0,11.229,3.311,13.966,8.203c0.663-0.113,1.336-0.205,2.033-0.205c6.626,0,11.998,5.372,11.998,12C71.998,58.863,68.656,63.293,63.999,64.941z'></path></g></g></svg>";

    // svg wind marker
    var windSVG = "<svg version='1.1' id='wind' class='climacon climacon_wind' viewBox='15 15 70 70'><g class='climacon_iconWrap climacon_iconWrap-wind'><g class='climacon_wrapperComponent climacon_componentWrap-wind'><path class='climacon_component climacon_component-stroke climacon_component-wind climacon_component-wind_curl' d='M65.999,52L65.999,52h-3c-1.104,0-2-0.895-2-1.999c0-1.104,0.896-2,2-2h3c1.104,0,2-0.896,2-1.999c0-1.105-0.896-2-2-2s-2-0.896-2-2s0.896-2,2-2c0.138,0,0.271,0.014,0.401,0.041c3.121,0.211,5.597,2.783,5.597,5.959C71.997,49.314,69.312,52,65.999,52z'></path><path class='climacon_component climacon_component-stroke climacon_component-wind' d='M55.999,48.001h-2h-6.998H34.002c-1.104,0-1.999,0.896-1.999,2c0,1.104,0.895,1.999,1.999,1.999h2h3.999h3h4h3h3.998h2c3.313,0,6,2.688,6,6c0,3.176-2.476,5.748-5.597,5.959C56.271,63.986,56.139,64,55.999,64c-1.104,0-2-0.896-2-2c0-1.105,0.896-2,2-2s2-0.896,2-2s-0.896-2-2-2h-2h-3.998h-3h-4h-3h-3.999h-2c-3.313,0-5.999-2.686-5.999-5.999c0-3.175,2.475-5.747,5.596-5.959c0.131-0.026,0.266-0.04,0.403-0.04l0,0h12.999h6.998h2c1.104,0,2-0.896,2-2s-0.896-2-2-2s-2-0.895-2-2c0-1.104,0.896-2,2-2c0.14,0,0.272,0.015,0.403,0.041c3.121,0.211,5.597,2.783,5.597,5.959C61.999,45.314,59.312,48.001,55.999,48.001z'></path></g></g></svg>";

    // initializes game instructions
    var instructionsInit = function() {
        $('.scoring-btn').hide();
        $('.targeting').hide();
        $('.scoring-instructions-btn').click(function() {
            $('.scoring-instructions').hide();
            $('.scoring-btn').show();
            $('.targeting').show();
            $('.scoring-instructions-btn').hide();
            $('.skip-instructions').hide();
            $('.scoring-btn').appendTo('.modal-footer');
        });
        $('.scoring-btn').click(function() {
            $('.scoring').show();
            $('.scoring-btn').hide();
            $('.scoring-instructions').hide();
        });
    };
    instructionsInit();

    // Pending Forecast Layers
    var pendingIDs = JSON.parse($('#pendingIDs').val());
    var pendingLocations = JSON.parse($('#pendingLocations').val());
    var pendingEvents = JSON.parse($('#pendingEvents').val());
    var pendingEventTotals = JSON.parse($('#pendingEventTotals').val());
    var pendingDates = JSON.parse($('#pendingDates').val());
    var pendingDatesEnd = JSON.parse($('#pendingDatesEnd').val());
    var pendingRadius = JSON.parse($('#pendingRadius').val());
    var activeLocations = JSON.parse($('#activeLocations').val());
    var activeEvents = JSON.parse($('#activeEvents').val());
    var activeDates = JSON.parse($('#activeDates').val());
    var activeDatesEnd = JSON.parse($('#activeDatesEnd').val());
    var activeRadius = JSON.parse($('#activeRadius').val());
    var pending = [];
    var active = [];
    
    var circle;var tornadoCircle;var hailCircle;var windCircle;
    var lat;var lng;
    var offsetChoice = 0;
    var offsetTZ = [0,-4,-5,-6,-7];
    var offsetName = ['UTC','EST','CST','MST','PST'];
    var isEvent = "";
    var isLocation = "";
    var isColor = "white";
    var popup = L.popup({'className': 'forecastPopup', 'interactive': false});
    // get day
    var today = new Date(new Date().toUTCString().substr(0, 25)); //date object guaranteed UTC for current time
    var tomorrow = new Date(today.getTime() + (24 * 60 * 60 * 1000)); //date object for tomorrow
    var dateTwo = new Date(today.getTime() + (24 * 60 * 60 * 2000)); //date object for 2 days from today
    var utcHR = today.getHours(); //get an integer value of the current hour from the today date object
    if(utcHR < 20){ //if a forecast can still legally be made for today
        var days = [today.getDay()]; //insert today # into the array of legal forecast days
        var numDays = 4; //there will be 4 total days to forecast to
    } else { //if it's too late to make a forecast today
        var days = [tomorrow.getDay()]; //insert tomorrow # into array of legal forecast days
        var numDays = 3; //there will only be 3 days to forecast to until midnight UTC
    }
    for(var i=1; i<numDays; i++) { //complete the array of day #s
        if(days[i-1] == 6){ //wrap back to 0 after reaching Saturday (#6)
            days[i] = 0;
        } else {
            days[i] = days[i-1] + 1;
        }
    }
    var names = ["Sun", "Mon", "Tues", "Wed", "Thur", "Fri", "Sat"]; //array of abbreviated day names
    var times = ["00","01","02","03","04","05","06","07","08","09",10,11,12,13,14,15,16,17,18,19,20,21,22,23]; //array of 24, 2-character hours
    var moe = [1,2,3,4,5,6]; //array of time windows
    var dayNames = []; //initialize array to take day names
    var moveDay = 32; //initial position of day reel
    var moveTime = -175; //initial position of time reel
    var moveMoe = 4; //initial position of moe reel
    var dayChoice = 1; //initial user day value
    var timeChoice = 12; //initial user time value
    var moeChoice = 2; //initial user moe value
    var dayLength = days.length;
    var timeLength = times.length;
    var moeLength = moe.length;
    var isToday = false; //boolean indicating if selected day is today    
    var isTomorrow = days[dayChoice] == tomorrow.getDay() ? true : false; //boolean indicating if selected day is tomorrow
    var wasToday = false; //default false indication that the last day chosen was today
    var wasTomorrow = isTomorrow;
    var wasSoon = false; //default false indication that any of the moe options have already begun
    $(days).each(function( key, value ){ //based on provided day #s
       dayNames.push(names[value]); 
    });
    $(dayNames).each(function( key, value ){ //insert available day names into day reel
       $('#day-window > .day-options').append('<p>'+value+'</p>');
    });
    function timeReset() {
        $('#time-window > .time-options p').remove();
        $(times).each(function( key, value ){ //insert time options into time reel
            $('#time-window > .time-options').append('<p>'+value+':00Z</p>');
        });
    }
    timeReset();
    function moeReset() {
        $('#moe-window > .moe-options p').remove(); //remove all moe options
        $(moe).each(function( key, value ){ //insert allowed windows into moe reel
            $('#moe-window > .moe-options').append('<p><sup>+</sup>&frasl;<sub>-</sub> '+value+'hr'+((value == 1) ? '' : 's')+'</p>');
        });
    }
    moeReset();
    
    var isStart;var isEnd;
    function dateBuilder() {
        isStart = new Date();
        if(days[0] == today.getDay()) {
            isStart.setUTCDate(today.getDate() + dayChoice);
        } else {
            isStart.setUTCDate(today.getDate() + dayChoice + 1);
        }
        isEnd = new Date(isStart);
        isStart.setUTCHours(timeChoice - (moeChoice + 1),0,0,0);
        isEnd.setUTCHours(timeChoice + (moeChoice + 1),0,0,0);
        $("#event_date").val(isStart.toUTCString());
        $("#event_end").val(isEnd.toUTCString());
    }
    dateBuilder();
    
    function getDMS(val) {
        var valDeg, valMin, valSec, result;
        val = Math.abs(val);
        valDeg = Math.floor(val);
        result = valDeg+"&#176;";
        valMin = Math.floor((val - valDeg) * 60);
        result += ("0"+valMin+"'").slice(-3);
        valSec = Math.round((val - valDeg - valMin / 60) * 3600 * 1000).toString().slice(0,2);
        result += valSec+'"';
        return result;
    };
    
    function dmsFormat(lat, lng) {
        var la = parseFloat(lat); //ensure correct format
        var ln = parseFloat(lng);
        var latResult = (la >= 0)? 'N' : 'S'; //determine quadrant
        var lngResult = (ln >= 0)? 'E' : 'W';
        var latDMS = getDMS(la);
        var lngDMS = getDMS(ln);
        return '<span class="locDisplay">'+latResult+''+latDMS+'</span><span class="dateSpacer">,</span><span class="locDisplay">'+lngResult+''+lngDMS+'</span>';
    };
    
    function dateFormat(tempDate) {
        var oldDate = new Date(tempDate);
        oldDate.setHours(oldDate.getHours() + offsetTZ[offsetChoice]);
        oldDate = oldDate.toUTCString().replace('GMT',offsetName[offsetChoice]).replace(':00 ', ' ');
        var newDate = '<span class="forecastDisplay"><span class="dateTime">'+oldDate.slice(0,3)+'</span> <span class="dateTime">'+oldDate.slice(5,7)+'</span> <span class="dateTime">'+oldDate.slice(8,11)+'</span> <span class="dateTime">'+oldDate.slice(17,19)+'</span><span class="timeSpacer">:</span><span class="dateTime">'+oldDate.slice(20,22)+'</span> <span class="dateTime">'+oldDate.slice(23)+'</span></span>';
        return newDate;
    };
    
    function popupBuilder() {
        return '<div style="color:rgb(255,255,255)"><div class="row"><div class="col-md-12"><h4><strong>'+isEvent+' Forecast</strong></h4></div></div><div class="row"><div class="col-md-6 pull-left"><span>inside a perimeter of</span></div><div class="col-md-6"><strong><span class="dateTime pull-right">'+Math.round(Math.PI * radius * radius).toLocaleString()+' mi<sup>2</sup></span></strong></div></div><div class="row"><div class="col-md-4 pull-left"><span>centered at</span></div><div class="col-md-8"><strong><span class="pull-right">'+isLocation+'</span></strong></div></div><div class="row"><div class="col-md-4 pull-left"><span>between</span></div><div class="col-md-8"><strong><span class="pull-right">'+dateFormat(isStart)+'</span><i class="fa fa-refresh changeTZ" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Change Timezone"></i></strong></div></div><div class="row"><div class="col-md-4 pull-left">and</div><div class="col-md-8"><strong><span class="pull-right">'+dateFormat(isEnd)+'</span></strong></div></div></div>';
    };
    
    function reelNoColor() {
        $('.day-options p').eq(dayChoice).css('color', 'white');
        $('.time-options p').eq(timeChoice).css('color', 'white');
        $('.moe-options p').eq(moeChoice).css('color', 'white');
    };
    
    function reelColor() {
        $('.day-options p').eq(dayChoice).css('color', isColor);
        $('.time-options p').eq(timeChoice).css('color', isColor);
        $('.moe-options p').eq(moeChoice).css('color', isColor);
    };
    
    function popupBorderColor(){
        $(".forecastPopup").css({
            "borderColor": isColor,
            "borderWidth": '1px',
            "borderStyle": 'solid'
        });
        $(".forecastPopup .leaflet-popup-tip").css({
            "borderColor": isColor,
            "borderWidth": '1px',
            "borderStyle": 'solid'
        });
        $('.newForecast .leaflet-popup-content-wrapper').css({'borderColor': isColor});
        $('.newForecast .leaflet-popup-tip').css({'borderColor': isColor});
        $('.newForecast .clickedThru').css({'backgroundColor': ((isColor != 'white') ? isColor : '#1f1f1f')});
        $('.forecastPopup .btn').css({
            'backgroundColor': ((isColor != 'white') ? isColor : '#1f1f1f'),
        });
    };
    
    function datePrep() {
        reelColor();
        dateBuilder();
        var msg = popupBuilder;
        popup.setContent(msg);
    };

    var inserted = '';
    var popupTwo;var eventSVG;
    $.each(pendingLocations, function(i, v) {
        var stroke;
        var pendEvent = pendingEvents[i];
        if (pendEvent === 'Tornado') {
            eventSVG = tornadoSVG;
            stroke = 'rgb(255, 51, 51)';
        } else if (pendEvent === 'Hail') {
            eventSVG = hailSVG;
            stroke = 'rgb(61, 182, 239)'
        } else if (pendEvent === 'Wind') {
            eventSVG = windSVG;
            stroke = 'rgb(255, 165, 0)'
        }
        var rad = pendingRadius[i];
        var start = new Date(pendingDates[i]);
        var finish = new Date(pendingDatesEnd[i]);
        inserted += '<tr>'+
                '<td>'+eventSVG+'</td>'+
                '<td>'+v[0].toFixed(2)+','+v[1].toFixed(2)+'</td>'+
                '<td>'+rad+'mi</td>'+
                '<td>'+(start.getMonth()+1)+'/'+start.getDate()+' '+start.getHours()+':00Z</td>'+
                '<td>'+Math.round((Math.abs(finish - start) / 36e5))+'hrs</td>'+
                '<td><button class="pendDelete" style="background-color: '+stroke+'">Delete</button></td></tr><hidden></hidden>';
        popupTwo = L.popup({className: 'forecastPopup2'}).setContent('<div style="color:rgb(255,255,255)"><div class="row"><div class="col-md-12"><h4><strong>Pending '+pendEvent+' Forecast</strong></h4></div></div><div class="row"><div class="col-md-6 pull-left"><span>inside a perimeter of</span></div><div class="col-md-6"><strong><span class="dateTime pull-right">'+Math.round(Math.PI * rad * rad).toLocaleString()+' mi<sup>2</sup></span></strong></div></div><div class="row"><div class="col-md-4 pull-left"><span>centered at</span></div><div class="col-md-8"><strong><span class="pull-right">'+dmsFormat(v[0],v[1])+'</span></strong></div></div><div class="row"><div class="col-md-4 pull-left"><span>between</span></div><div class="col-md-8"><strong><span class="pull-right">'+dateFormat(start)+'</span></strong></div></div><div class="row"><div class="col-md-4 pull-left">and</div><div class="col-md-8"><strong><span class="pull-right">'+dateFormat(finish)+'</span></strong></div></div></div><div class="row"><div class="col-md-12"><input class="toDelete" name="toDelete" type="hidden" value="'+pendingIDs[i]+'"/><input class="btn btn-primary deletePending" type="submit" value="Delete" style="background-color: '+stroke+'"/></div></div>');
        pending.push(L.circle(v, (rad * 1609.344), {
            color: stroke,
            weight: 2,
            className: 'pendingPopup',
            fillColor: 'rgb(255,255,255)',
            fillOpacity: 0.45
        }).setStyle({className: 'clickThru'}).bindPopup(popupTwo).openPopup());
    });
    $('#pendingList').html(inserted);
    
    inserted = '';
    $.each(activeLocations, function(i, v) {
        var actEvent = activeEvents[i];
        if (actEvent === 'Tornado') {
            eventSVG = tornadoSVG;
            stroke = 'rgb(255, 51, 51)'
        } else if (actEvent === 'Hail') {
            eventSVG = hailSVG;
            stroke = 'rgb(61, 182, 239)'
        } else if (actEvent === 'Wind') {
            eventSVG = windSVG;
            stroke = 'rgb(255, 165, 0)'
        }
        var rad = activeRadius[i];
        var start = new Date(activeDates[i]);
        var finish = new Date(activeDatesEnd[i]);
        inserted += '<tr>'+
                '<td>'+eventSVG+'</td>'+
                '<td>'+v[0].toFixed(2)+','+v[1].toFixed(2)+'</td>'+
                '<td>'+rad+'mi</td>'+
                '<td>'+(start.getMonth()+1)+'/'+start.getDate()+' '+start.getHours()+':00Z</td>'+
                '<td>'+Math.round((Math.abs(finish - start) / 36e5))+'hrs</td></tr>';
        popupTwo = L.popup({className: 'forecastPopup2 actPop'}).setContent('<div style="color:rgb(255,255,255)"><div class="row"><div class="col-md-12"><h4><strong>Active '+actEvent+' Forecast</strong></h4></div></div><div class="row"><div class="col-md-6 pull-left"><span>inside a perimeter of</span></div><div class="col-md-6"><strong><span class="dateTime pull-right">'+Math.round(Math.PI * rad * rad).toLocaleString()+' mi<sup>2</sup></span></strong></div></div><div class="row"><div class="col-md-4 pull-left"><span>centered at</span></div><div class="col-md-8"><strong><span class="pull-right">'+dmsFormat(v[0],v[1])+'</span></strong></div></div><div class="row"><div class="col-md-4 pull-left"><span>between</span></div><div class="col-md-8"><strong><span class="pull-right">'+dateFormat(start)+'</span></strong></div></div><div class="row"><div class="col-md-4 pull-left">and</div><div class="col-md-8"><strong><span class="pull-right">'+dateFormat(finish)+'</span></strong></div></div></div><div class="row"><div class="col-md-12" style="text-align: center; padding: 7px 0 0 0">Awaiting results...</div></div>');
        active.push(L.circle(v, (rad * 1609.344), {
            color: stroke,
            weight: 2,
            fillColor: '#262626',
            fillOpacity: 0.8
        }).setStyle({className: 'clickThru'}).bindPopup(popupTwo).openPopup());
    });
    $('#activeList').html(inserted);

    var pending_layer = L.layerGroup(pending);
    var active_layer = L.layerGroup(active);
    var overlayMaps = {
        "Pending": pending_layer,
        "Active": active_layer
    };

    // Initialize map
    var map = new L.map('map', {
        center: [40.2226, -95.4395],
        zoom: 5,
        doubleClickZoom: false,
        layers: [active_layer, pending_layer],
        zoomControl: true
    }).on('popupopen', function(){
        $('.forecast-btn').appendTo('.forecastPopup .leaflet-popup-content-wrapper').css('display', 'block');
    })

    map.zoomControl.setPosition('topright'); // move zoom control to top right

    // .addControl(sidebar)
    L.control.layers(overlayMaps, null, { collapsed: false }).addTo(map);
    $('.leaflet-control-layers-selector').attr('type', 'checkbox').prop('checked', true);   
    
    $('.hamPending').appendTo('.leaflet-control-layers-base label:eq(0) div').css('display', 'inline-block');
    $('.hamActive').appendTo('.leaflet-control-layers-base label:eq(1) div').css('display', 'inline-block');
    $('.pendingMenu').appendTo('.hamPending hamburger');
    $('.activeMenu').appendTo('.hamActive');
    
    function pendHide() {
        $('.hamPending .hamburger').html('<i class="fa fa-bars" aria-hidden="true"></i>');
        $('.hamPending .hamburger').css('backgroundColor', '#ffffff');
    };
    function actHide() {
        $('.hamActive .hamburger').html('<i class="fa fa-bars" aria-hidden="true"></i>');
        $('.hamActive .hamburger').css('backgroundColor', '#ffffff');
    };
    function pendShow() {
        $('.hamPending .hamburger').html('<i class="fa fa-close" aria-hidden="true"></i>');
        $('.hamPending .hamburger').css('backgroundColor', 'rgb(61, 182, 239)');
    };
    function actShow() {
        $('.hamActive .hamburger').html('<i class="fa fa-close" aria-hidden="true"></i>');
        $('.hamActive .hamburger').css('backgroundColor', 'rgb(61, 182, 239)');
    };
    
    $('.hamburger').on('click', function(e) {
        e.preventDefault();
        if($(this).parent().hasClass('hamPending')) {
            $('.activeMenu').hide(actHide());
            if($(this).parent().children('.pendingMenu')[0].style.display == 'none') {
                $('.pendingMenu').show(pendShow());
            } else {
                $('.pendingMenu').hide(pendHide());
            }
        } else {
            $('.pendingMenu').hide(pendHide());
            if($(this).parent().children('.activeMenu')[0].style.display == 'none') {
                $('.activeMenu').show(actShow());
            } else {
                $('.activeMenu').hide(actHide());
            }
        }
    });
    
    // Set tile layer
    L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png', {}).addTo(map);
    $('#modalTrigger').appendTo('.leaflet-top.leaflet-right .leaflet-control-layers');
    
    // radius functionality
    var radiusInput = document.getElementById('radiusMask');
    var oldRadius = radiusInput.value;
    var leftMargin = 29;
    $("#radiusMask").change(function() {
        radius = radiusInput.value;
        leftMargin += radius - oldRadius;
        oldRadius = radius;
        $("#output").text(radius+'mi');
        $("#radius").val(radius);
        $('.radius label').animate({'marginLeft': leftMargin}, 0);
        $('.radius i').animate({'marginLeft': (leftMargin + 19)}, 0);
    });
    var radius = radiusInput.value;
        
    var eventCircle;
    function eventMarker() {
        $('#latlng').val(lat + ', ' + lng); // sets latlng input to value of lat + lng
        var radiusMeters = radius * 1609.344;
        var msg = popupBuilder();
        popup.setContent(msg).setLatLng([(lat + (radius / 100)), lng])
        if (eventCircle != undefined) {
            map.removeLayer(eventCircle);
        };
        eventCircle = L.circle([lat, lng], radiusMeters, {
            color: isColor,
            stroke: isColor,
            weight: 2,
            className: 'eventCircle'
        });
        eventCircle.addTo(map);
        popup.openOn(map);
        popupBorderColor();
    };
    
    function maxEvent(x) {
        if(pendingEventTotals[x] == 3) {
            if(x == 0) {
                var msg = 'Tornado';
            } else if(x == 1) {
                var msg = 'Hail';
            } else {
                var msg = 'Wind';
            }
            $('.pendingMenu').show(pendShow());
            $('.forecast-btn').prop('disabled', true);
            $('#error-message').html("You have reached your max of 3 pending "+msg+" forecasts! Please delete a pending "+msg+" forecast or choose a different event type.");
            $('.error-notification').css({'width': '500px', 'left': '50%', 'top': '65px'});
            $('.error-notification').show();
        } else {
            $('.forecast-btn').prop('disabled', false);
            $('.error-notification').hide();
            $('.pendingMenu').hide(pendHide());
        };
    };

    // tornado controller
    var tornadoControl = L.easyButton({
        states: [{
            stateName: 'tornado-control',
            icon: tornadoSVG,
            title: 'Make a Forecast for a Tornado',
            onClick: function(btn, map, e) {
                $('#tornado-event').prop('checked', true);
                $('.climacon_component-stroke_tornadoLine').css('fill', 'rgb(255, 51, 51)');
                $('.climacon_component-stroke_hailAlt, .climacon_component-stroke_cloud, .climacon_component-wind_curl, .climacon_component-wind').css('fill', 'rgb(255,255,255)');
                isEvent = "Tornado";
                isColor = "rgb(255, 51, 51)";
                reelColor();
                if(eventCircle != undefined) {
                    eventMarker();
                };
                popupBorderColor();
                $('#radiusMask').addClass('slideT');
                $('#radiusMask').removeClass('slideH');
                $('#radiusMask').removeClass('slideW');
                maxEvent(0);
            },

        }]
    });
    tornadoControl.addTo(map);

    // hail control
    var hailControl = L.easyButton({
        states: [{
            stateName: 'hail-control', // name the state
            icon: hailSVG, // and define its properties
            title: 'Make a forecast for Hail', // like its title
            onClick: function(btn, map, e) {
                $('#hail-event').prop('checked', true);
                $('.climacon_component-stroke_tornadoLine, .climacon_component-wind_curl, .climacon_component-wind').css('fill', 'rgb(255, 255, 255)');
                $('.climacon_component-stroke_hailAlt').css('fill', 'rgb(61, 182, 239)');
                $('.climacon_component-stroke_cloud').css('fill', 'rgb(61, 182, 239)');
                isEvent = "Hail";
                isColor = "rgb(61, 182, 239)";
                reelColor();
                if(eventCircle != undefined) {
                    eventMarker();
                };
                popupBorderColor();
                $('#radiusMask').addClass('slideH');
                $('#radiusMask').removeClass('slideT');
                $('#radiusMask').removeClass('slideW');
                maxEvent(1);
            },

        }]
    });
    hailControl.addTo(map);

    // wind control
    var windControl = L.easyButton({
        states: [{
            stateName: 'wind-control', // name the state
            icon: windSVG, // and define its properties
            title: 'Make a forecast for Wind', // like its title
            onClick: function(btn, map, e) {
                $('#wind-event').prop('checked', true);
                $('.climacon_component-stroke_tornadoLine, .climacon_component-stroke_hailAlt, .climacon_component-stroke_cloud').css('fill', 'rgb(255,255,255)');
                $('.climacon_component-wind_curl').css('fill', 'rgb(255, 165, 0');
                $('.climacon_component-wind').css('fill', 'rgb(255, 165, 0');           
                isEvent = "Wind";
                isColor = "rgb(255, 165, 0)";
                reelColor();
                if(eventCircle != undefined) {
                    eventMarker();
                };
                popupBorderColor();
                $('#radiusMask').addClass('slideW');
                $('#radiusMask').removeClass('slideH');
                $('#radiusMask').removeClass('slideT');
                maxEvent(2);
            },

        }]
    });
    windControl.addTo(map);

    radiusInput.onchange = function() { //when user slides radius slider
        radius = radiusInput.value;
        if(eventCircle != undefined) {
            eventMarker();
        };
    };
    
    map.on('click', function(e) { //when user clicks the map
        if (typeof(e) != 'undefined') {
            var clickPan = e.latlng;
            lat = clickPan.lat;
            lng = clickPan.lng;
            isLocation = dmsFormat(lat, lng);
            eventMarker();
            map.panTo(clickPan);
        };
    });
    
    function moeSet(gap) {
        if(gap < moeLength + 2) { //if gap is less than longest window
            $('#moe-window > .moe-options p').remove(); //remove all moe options
            wasSoon = true; //moe options have been removed
            for(var i=0; i<(gap - 2); i++) { //add back enabled moe options only
                $('#moe-window > .moe-options').append('<p><sup>+</sup>&frasl;<sub>-</sub> '+moe[i]+'hr'+((moe[i] == 1) ? '' : 's')+'</p>');
            };
            if(moeChoice > gap - 3) { //if user selected moe is disabled by user selecting today
                moveMoe += 28 * (moeChoice - (gap - 3)); //scroll reel to the next enabled option
                moeChoice = gap - 3; //user select that option
            };
        };
    };
    
    function timeSet(cutoff) {
        $('#time-window > .time-options p').remove(); //remove all options from time reel
        for(var i=0; i<(cutoff); i++) { //put in nbsp place holders for disabled options
            $('#time-window > .time-options').append('<p>&nbsp;</p>');
        };
        for(var i=(cutoff); i<24; i++) { //start from the first enabled option and finish displaying options
            $('#time-window > .time-options').append('<p>'+times[i]+':00Z</p>');
        };
        if(timeChoice < cutoff) { //if the current selected time is disabled by selecting today
            moveTime -= 30 * (cutoff - timeChoice); //scroll reel to next enabled option
            timeChoice = cutoff; //user select that option
        };
    };
    
    function todaySet() {
        wasToday = true;
        var cutoff = utcHR + 3;
        timeSet(cutoff);
        var gap = timeChoice - utcHR; //hours between user selected time and current time
        if(!wasSoon) { //if any of the moes should be disabled and haven't already been
            moeSet(gap);
        };
    };
    
    function tomorrowSet() {
        wasTomorrow = true;
        if(utcHR > 21) {
            var cutoff = utcHR - 21;
            timeSet(cutoff);
        };
        var gap = timeChoice + (24 - utcHR); //hours between user selected time and current time
        if(!wasSoon) { //if any of the moes should be disabled and haven't already been
            moeSet(gap);
        };
    };
    
    function dayUp() {
        isToday = days[dayChoice] == today.getDay(); //boolean indicating if selected day is today
        isTomorrow = days[dayChoice] == tomorrow.getDay(); //boolean indicating if selected day is tomorrow
        if(isToday && !wasToday) { //if today is selected and wasn't already selected
            todaySet();
        } else if(isTomorrow && utcHR > 16) { //if user selects tomorrow and it is later than 21Z tonight
            tomorrowSet();
        };
    };
    
    function dayDown() {
        isToday = false;
        if(wasToday) {
            wasToday = false;
            timeReset();
            if(wasSoon && utcHR > 16) {
                var gap = timeChoice + (24 - utcHR); //difference between current time and user selected time
                if(gap < moeLength + 2) { //if gap is less than longest window
                    moeSet(gap);
                } else {
                    wasSoon = false;
                    moeReset();
                };
            } else {
                moeReset();
            };
        } else if(wasTomorrow) {
            wasTomorrow = false;
            timeReset();
            if(wasSoon) {
                wasSoon = false;
                moeReset();
            };
        };
    };
    
    function timeUp() {
        if(isToday) { //if today is user selected
            var gap = timeChoice - utcHR; //difference between current time and user selected time
            moeSet(gap);
        } else if(isTomorrow && timeChoice < moeLength + 2 && utcHR > 16) {
            var gap = timeChoice + (24 - utcHR); //difference between current time and user selected time
            moeSet(gap);
        };
    };
    
    function timeDown() {
        if(isToday && wasSoon) {
            var gap = timeChoice - utcHR; //hours between user selected time and current time
            if(gap < moeLength + 2) { //if any of the moes should be disabled and haven't already been
                moeSet(gap);
            } else {
                wasSoon = false;
                moeReset();
            };
        } else if(isTomorrow && wasSoon) {
            var gap = timeChoice + (24 - utcHR); //difference between current time and user selected time
            if(gap < moeLength + 2) { //if gap is less than longest window
                moeSet(gap);
            } else {
                wasSoon = false;
                moeReset();
            };
        };
    };
    
    function reelAnimate(x) {
        $('.day-options').animate({top: moveDay}, x);
        $('.time-options').animate({top: moveTime}, x);
        $('.moe-options').animate({top: moveMoe}, x);
    };
    
    function reelUp(e) {
        if(e.target.id == "day-window" || $(e.target).hasClass("day-options") || $(e.target).parent().hasClass("day-options")) { //if scrolled down over day reel
            if(dayChoice > 0) { //if top choice not selected
                moveDay += 28; //set scroll for reel to one turn
                dayChoice--; //user selected day
                dayUp();
            };
        };
        if(e.target.id == "time-window" || $(e.target).hasClass("time-options") || $(e.target).parent().hasClass("time-options")) { //if scrolled down over time reel
            if((!isToday && !isTomorrow && timeChoice > 0) || (isToday && timeChoice > utcHR + 3) || (isTomorrow && ((utcHR < 22 && timeChoice > 0) || (utcHR > 21 && timeChoice > utcHR - 21)))) { //if today not selected and top option not selected or today selected and top enabled option not selected
                moveTime += 30; //scroll reel one turn
                timeChoice--; //user select time option
                timeUp();
            };
        };
        if(e.target.id == "moe-window" || $(e.target).hasClass("moe-options") || $(e.target).parent().hasClass("moe-options")) { //if user scrolls down over moe reel
            if(moeChoice > 0) {
                moveMoe += 28;
                moeChoice--;
            };
        };
    };
    
    function reelDown(e) {
        if(e.target.id == "day-window" || $(e.target).hasClass("day-options") || $(e.target).parent().hasClass("day-options")) { //if user scrolls up over moe reel
            if(dayChoice < (dayLength - 1)) {
                moveDay -= 28;
                dayChoice++;
                dayDown();
            };
        };
        if(e.target.id == "time-window" || $(e.target).hasClass("time-options") || $(e.target).parent().hasClass("time-options")) {
            if(timeChoice < timeLength - 1) {
                moveTime -= 30;
                timeChoice++;
                timeDown();
            };
        };
        if(e.target.id == "moe-window" || $(e.target).hasClass("moe-options") || $(e.target).parent().hasClass("moe-options")) {
            if(moeChoice < moeLength - 1 && ((!isToday && !isTomorrow) || (isToday && moeChoice < timeChoice - utcHR - 3) || (isTomorrow && moeChoice < timeChoice + (24 - utcHR) - 3))) {
                moveMoe -= 28;
                moeChoice++;
            };
        };
    };
    
    var lastExecution = 0; //initiate time object of last time function was run
    function MouseWheelHandler(e) { //handles mouse wheel scroll
        e.preventDefault(); //don't scroll page
        var now = Date.now(); //time now
        if (now - lastExecution < 23) return; // ~60Hz refresh rate on function
        lastExecution = now; //set last time function was run to right now
        isToday = days[dayChoice] == today.getDay(); //boolean indicating if selected day is today    
        isTomorrow = days[dayChoice] == tomorrow.getDay(); //boolean indicating if selected day is tomorrow
        reelNoColor();
        var delta = Math.max(false, Math.min(true, (e.wheelDelta || -e.detail))); //which direction was mouse wheel rotated
        if(!delta){ //if up
            reelUp(e);
        } else {
            reelDown(e);
        }
        reelAnimate(100);
        datePrep();
        return false;
    };
    
    var initialTouchPos = null;
    var lastTouchPos;
    var rafPending = false;
    var dayWindow = document.getElementById("day-window");
    var timeWindow = document.getElementById("time-window");
    var moeWindow = document.getElementById("moe-window");
    var toScroll;var topStart;var posChange;var topChange;
    
    function getGesturePointFromEvent(e) {
        var point = {};
        if(e.targetTouches) {
        // Prefer Touch Events
            point.x = e.targetTouches[0].clientX;
            point.y = e.targetTouches[0].clientY;
        } else {
            // Either Mouse event or Pointer Event
            point.x = e.clientX;
            point.y = e.clientY;
        };
        return point;
    };
    
    function onAnimFrame(e) {
        if(!rafPending) {
            return;
        };
        posChange = (topStart + lastTouchPos.y - initialTouchPos.y);
        toScroll.style.top = posChange+"px";
        rafPending = false;
    };
    
    // Handle end gestures
    this.handleGestureEnd = function(e) {
        e.preventDefault();
        if(e.touches && e.touches.length > 0) {
            return;
        }
        rafPending = false;
        isToday = days[dayChoice] == today.getDay(); //boolean indicating if selected day is today    
        isTomorrow = days[dayChoice] == tomorrow.getDay(); //boolean indicating if selected day is tomorrow
        reelNoColor();
        var changed = posChange - topStart;
        var newChoice = Math.round(changed / topChange);
        toScroll.style.top = topStart+"px";
        if(changed > 0) {
            for(var i = 0; i < newChoice; i++) {
                reelUp(e);
            };
        } else if(changed < 0) {
            for(var i = 0; i > newChoice; i--) {
                reelDown(e);
            };
        };
        reelAnimate(0);
        datePrep();
        // Remove Event Listeners
        if (window.PointerEvent) {
            e.target.releasePointerCapture(e.pointerId);
        } else {
            // Remove Mouse Listeners
            document.removeEventListener('mousemove', this.handleGestureMove, true);
            document.removeEventListener('mouseup', this.handleGestureEnd, true);
        }
        initialTouchPos = null;
    }.bind(this);
    
    this.handleGestureMove = function (e) {
        e.preventDefault();
        if(!initialTouchPos) {
            return;
        };
        lastTouchPos = getGesturePointFromEvent(e);
        if(rafPending) {
            return;
        };
        rafPending = true;
        onAnimFrame(e);
    }.bind(this);
    
    // Handle the start of gestures
    this.handleGestureStart = function(e) {
        e.preventDefault();
        if(e.touches && e.touches.length > 1) {
            return;
        };
        // Add the move and end listeners
        if (window.PointerEvent) {
            e.target.setPointerCapture(e.pointerId);
        } else {
            // Add Mouse Listeners
            document.addEventListener('mousemove', this.handleGestureMove, true);
            document.addEventListener('mouseup', this.handleGestureEnd, true);
        };
        initialTouchPos = getGesturePointFromEvent(e);
        if(e.currentTarget.id == 'day-window') {
            toScroll = document.getElementsByClassName('day-options')[0];
            topStart = moveDay;
            topChange = 28;
        } else if (e.currentTarget.id == 'time-window') {
            toScroll = document.getElementsByClassName('time-options')[0];
            topStart = moveTime;
            topChange = 30;
        } else if (e.currentTarget.id == 'moe-window') {
            toScroll = document.getElementsByClassName('moe-options')[0];
            topStart = moveMoe;
            topChange = 28;
        }
    }.bind(this);


    // IE9, Chrome, Safari, Opera
    dayWindow.addEventListener("mousewheel", MouseWheelHandler, false);
    // Firefox
    dayWindow.addEventListener("DOMMouseScroll", MouseWheelHandler, false);
    // Check if pointer events are supported.
    if (window.PointerEvent) {
        // Add Pointer Event Listener
        dayWindow.addEventListener('pointerdown', this.handleGestureStart, true);
        dayWindow.addEventListener('pointermove', this.handleGestureMove, true);
        dayWindow.addEventListener('pointerup', this.handleGestureEnd, true);
        dayWindow.addEventListener('pointercancel', this.handleGestureEnd, true);
    } else {
        // Add Touch Listener
        dayWindow.addEventListener('touchstart', this.handleGestureStart, true);
        dayWindow.addEventListener('touchmove', this.handleGestureMove, true);
        dayWindow.addEventListener('touchend', this.handleGestureEnd, true);
        dayWindow.addEventListener('touchcancel', this.handleGestureEnd, true);
        // Add Mouse Listener
        dayWindow.addEventListener('mousedown', this.handleGestureStart, true);
    }
    timeWindow.addEventListener("mousewheel", MouseWheelHandler, false);
    timeWindow.addEventListener("DOMMouseScroll", MouseWheelHandler, false);
    if (window.PointerEvent) {
        // Add Pointer Event Listener
        timeWindow.addEventListener('pointerdown', this.handleGestureStart, true);
        timeWindow.addEventListener('pointermove', this.handleGestureMove, true);
        timeWindow.addEventListener('pointerup', this.handleGestureEnd, true);
        timeWindow.addEventListener('pointercancel', this.handleGestureEnd, true);
    } else {
        // Add Touch Listener
        timeWindow.addEventListener('touchstart', this.handleGestureStart, true);
        timeWindow.addEventListener('touchmove', this.handleGestureMove, true);
        timeWindow.addEventListener('touchend', this.handleGestureEnd, true);
        timeWindow.addEventListener('touchcancel', this.handleGestureEnd, true);
        // Add Mouse Listener
        timeWindow.addEventListener('mousedown', this.handleGestureStart, true);
    }
    moeWindow.addEventListener("mousewheel", MouseWheelHandler, false);
    moeWindow.addEventListener("DOMMouseScroll", MouseWheelHandler, false);
    if (window.PointerEvent) {
        // Add Pointer Event Listener
        moeWindow.addEventListener('pointerdown', this.handleGestureStart, true);
        moeWindow.addEventListener('pointermove', this.handleGestureMove, true);
        moeWindow.addEventListener('pointerup', this.handleGestureEnd, true);
        moeWindow.addEventListener('pointercancel', this.handleGestureEnd, true);
    } else {
        // Add Touch Listener
        moeWindow.addEventListener('touchstart', this.handleGestureStart, true);
        moeWindow.addEventListener('touchmove', this.handleGestureMove, true);
        moeWindow.addEventListener('touchend', this.handleGestureEnd, true);
        moeWindow.addEventListener('touchcancel', this.handleGestureEnd, true);
        // Add Mouse Listener
        moeWindow.addEventListener('mousedown', this.handleGestureStart, true);
    }
    
    $("#day-window").on('click', ".day-options p", function(e) {
        reelNoColor();
        var selected = $(this).index();
        var turns = dayChoice - selected;
        dayChoice = selected;
        moveDay += turns * 28;
        if(turns > 0) { 
            dayUp();
        } else if(turns < 0) {
            dayDown();
        }
        reelAnimate();
        datePrep();
    });
    $("#time-window").on('click', ".time-options p", function(e) {
        if($(this).context.innerHTML != "&nbsp;"){
            reelNoColor();
            var selected = $(this).index();
            var turns = timeChoice - selected;
            timeChoice = selected;
            moveTime += turns * 30;
            if(turns > 0) { 
                timeUp();
            } else if(turns < 0) {
                timeDown();
            };
            reelAnimate();
        };
        datePrep();
    });
    $("#moe-window").on('click', ".moe-options p", function(e) {
        reelNoColor();
        var selected = $(this).index();
        var turns = moeChoice - selected;
        moeChoice = selected;
        moveMoe += turns * 28;
        reelAnimate();
        datePrep();
    });
    $("#up.timeShift").click(function(e) {
        if(timeChoice > 18) {
            var selected = 18;
        } else if(timeChoice > 12) {
            var selected = 12;
        } else if(timeChoice > 6) {
            var selected = 6;
        } else {
            var selected = 0;
        }
        if($(this).context.innerHTML != " "){
            reelNoColor();
            var turns = timeChoice - selected;
            timeChoice = selected;
            moveTime += turns * 30;
            timeUp();
            reelAnimate();
        };
        datePrep();
    });
    $("#down.timeShift").click(function(e) {
        if(timeChoice < 6) {
            var selected = 6;
        } else if(timeChoice < 12) {
            var selected = 12;
        } else if(timeChoice < 18) {
            var selected = 18;
        } else {
            var selected = 23;
        }
        reelNoColor();
        var turns = timeChoice - selected;
        timeChoice = selected;
        moveTime += turns * 30;
        timeDown();
        reelAnimate();
        datePrep();
    });
    $(document.body).on('click', '.changeTZ', function(e) {
        if(offsetChoice == 4) {
            offsetChoice = 0;
        } else {
            offsetChoice++;
        };
        var msg = popupBuilder;
        popup.setContent(msg);
    });
    
    var toDelete = 0;
    var storage = "";
    $(document.body).on('click', '.deletePending', function(e) {
        e.preventDefault();
        toDelete = $(this).parent().children('.toDelete').val();
        storage = $(this).parent().html();
        $(this).parent().html('Are you sure you want to delete this forecast?</br><button id="noDelete" class="btn btn-primary" style="float:left;margin-top:5px">No</button><button id="yesDelete" class="btn btn-primary" style="float:right;margin-top:5px">Yes</button>');
        $('.leaflet-popup-content-wrapper').css('height', '239px');
        $('.newForecast .leaflet-popup-content-wrapper').css('height', '54px');
        $('.error-notification').hide();
    });
    $(document.body).on('click', '#noDelete', function(e) {
        e.preventDefault();
        $(this).parent().html(storage);
        $('.leaflet-popup-content-wrapper').css('height', '218px');
        $('.newForecast .leaflet-popup-content-wrapper').css('height', '54px');
    });
    $(document.body).on('click', '#yesDelete', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/forecast_clash/forecasts/deletePending.json",
            dataType: 'json',
            data: {toDelete: toDelete},
            success : function(response) {
                window.location.href = response['url'];
            },
            error : function() {   
            }
        });
    });
    var latlng;
    var newPopup;
    $(window.map).on('click', '.clickThru', function(e) {
        var clickColor = e.target.attributes.stroke.value;
        latlng = map.mouseEventToLatLng(e.originalEvent);
        $('.forecastPopup2').css({'border': '1px solid '+clickColor});
        $('.forecastPopup2 .leaflet-popup-tip-container .leaflet-popup-tip').css({'border': '1px solid '+clickColor});
        newPopup = L.popup({className: 'newForecast', closeButton: false}).setContent('<button class="btn btn-primary clickedThru">New Forecast</button>').setLatLng(latlng);
        map.addLayer(newPopup);
        popupBorderColor();
        map.panTo(latlng);
    });  
    $(document.body).on('click', '.clickedThru', function(e) {
        e.preventDefault();
        lat = latlng.lat;
        lng = latlng.lng;
        isLocation = dmsFormat(lat, lng);
        popupBorderColor();
        eventMarker();
        map.removeLayer(newPopup);
    });
    $(window.map).on('click', '.pendDelete', function(e) {
        e.preventDefault();
        var checker = $('.leaflet-right .leaflet-control-layers-selector')[0];
        var circleSelect = $(this).index('.pendDelete');
        if(checker.checked == false) {
            checker.checked = true;
        }
        setTimeout(function(){
            var pendLayer = pending_layer._layers[circleSelect + 1];
            pendLayer.openPopup();
            var clickColor = pendLayer.options.color;
            $('.forecastPopup2').css({'border': '1px solid '+clickColor});
            $('.forecastPopup2 .leaflet-popup-tip-container .leaflet-popup-tip').css({'border': '1px solid '+clickColor});
            $('.pendingMenu').hide(pendHide());
            $('.deletePending').trigger('click');
            map.panTo(pendLayer._latlng);
            $('.error-notification').hide();
        },1);
    });
    $('.pendingMenu').click(function(e) {
        e.preventDefault();
    });
    map.invalidateSize();
});