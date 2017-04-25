$('document').ready(function() {

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
    }

    instructionsInit();

    // Pending Forecast Layers

    var pendingIDs = JSON.parse($('#pendingIDs').val());
    var pendingLocations = JSON.parse($('#pendingLocations').val());
    var pendingEvents = JSON.parse($('#pendingEvents').val());
    var pendingDates = JSON.parse($('#pendingDates').val());
    var pendingRadius = JSON.parse($('#pendingRadius').val());
    var activeLocations = JSON.parse($('#activeLocations').val());
    var activeEvents = JSON.parse($('#activeEvents').val());
    var activeDates = JSON.parse($('#activeDates').val());
    var activeRadius = JSON.parse($('#activeRadius').val());
    var pending = [];
    var active = [];

    $.each(pendingLocations, function(i, v) {

        var stroke;
        if (pendingEvents[i] === 'Tornado') {
            stroke = 'rgb(255, 51, 51)'
        } else if (pendingEvents[i] === 'Hail') {
            stroke = 'rgb(61, 182, 239)'
        } else if (pendingEvents[i] === 'Wind') {
            stroke = 'rgb(255, 165, 0)'
        }

        pending.push(L.circle(v, (pendingRadius[i] * 1609.344), {
            color: stroke,
            fillColor: 'rgb(255,255,255)'
        }).bindPopup('Pending ' + pendingEvents[i] + ' Forecast at <br><strong> ' + v[0] + ',' + v[1] + '</strong> starting</br>' + pendingDates[i] + ' UTC</br><a style="color:blue" id="deletePending" href="">Delete<input id="toDelete" name="toDelete" type="hidden" value="'+pendingIDs[i]+'"></a>').openPopup());
    });

    $.each(activeLocations, function(i, v) {

        if (activeEvents[i] === 'Tornado') {
            stroke = 'rgb(255, 51, 51)'
        } else if (activeEvents[i] === 'Hail') {
            stroke = 'rgb(61, 182, 239)'
        } else if (activeEvents[i] === 'Wind') {
            stroke = 'rgb(255, 165, 0)'
        }

        active.push(L.circle(v, (activeRadius[i] * 1609.344), {
            color: stroke,
            fillColor: 'rgb(255, 255, 255)'
        }).bindPopup('Active ' + activeEvents[i] + ' Forecast at <br><strong> ' + v[0] + ',' + v[1] + '</strong></br>Awaiting results...').openPopup());
    });

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
        layers: [active_layer, pending_layer]
    })

    // .addControl(sidebar)
    L.control.layers(overlayMaps, null, { collapsed: false }).addTo(map);

    $('.leaflet-control-layers-selector').attr('type', 'checkbox').prop('checked', true);

    // Set tile layer
    L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png', {}).addTo(map);



    var circle;
    var lat;
    var lng;


    function tornadoMarker(e) {
        if (typeof(e) != 'undefined') {
            lat = e.latlng.lat;
            lng = e.latlng.lng;
        }

        // sets lat/lng to 5 decimal places
        var latToFixed = lat.toString().match(/^-?\d+(?:\.\d{0,5})?/)[0];
        var lngToFixed = lng.toString().match(/^-?\d+(?:\.\d{0,5})?/)[0];

        // sets latlng input to value of lat + lng
        $('#latlng').val(lat + ', ' + lng);
        var radiusMiles = radius * 1609.344;
        if (typeof(tornadoCircle) === 'undefined') {

            tornadoCircle = L.circle([lat, lng], radiusMiles, {
                color: 'rgb(255, 51, 51)',
                stroke: 'rgb(255, 51, 51)',
                className: 'tornadoCircle'
            });

            tornadoCircle.addTo(map);
            tornadoCircle.bindPopup("<h4><strong>Tornado</strong></h4> Lat, Lon : " + latToFixed + ", " + lngToFixed).openPopup();

        } else {
            tornadoCircle.setRadius(radiusMiles);
            tornadoCircle.setLatLng([lat, lng]);
            tornadoCircle.bindPopup("<h4><strong>Tornado</strong></h4> Lat, Lon : " + latToFixed + ", " + lngToFixed).openPopup();
            tornadoCircle.addTo(map);
        }

    };

    function hailMarker(e) {
        if (typeof(e) != 'undefined') {
            lat = e.latlng.lat;
            lng = e.latlng.lng;
        }

        // sets lat/lng to 5 decimal places
        var latToFixed = lat.toString().match(/^-?\d+(?:\.\d{0,5})?/)[0];
        var lngToFixed = lng.toString().match(/^-?\d+(?:\.\d{0,5})?/)[0];

        // sets latlng input to value of lat + lng
        $('#latlng').val(lat + ', ' + lng);
        var radiusMiles = radius * 1609.344;
        if (typeof(hailCircle) === 'undefined') {

            hailCircle = new L.circle([lat, lng], radiusMiles, {
                color: 'rgb(61, 182, 239)',
                stroke: 'rgb(61, 182, 239)',
                className: 'hailCircle',
                draggable: true
            });

            hailCircle.addTo(map);
            hailCircle.bindPopup("<h4><strong>Hail</strong></h4> Lat, Lon : " + latToFixed + ", " + lngToFixed).openPopup();

            //var radius = hailCircle.getRadius();

        } else {
            hailCircle.setRadius(radiusMiles);
            hailCircle.setLatLng([lat, lng]);
            hailCircle.bindPopup("<h4><strong>Hail</strong></h4> Lat, Lon : " + latToFixed + ", " + lngToFixed).openPopup();
            hailCircle.addTo(map);
        }

    };

    function windMarker(e) {
        if (typeof(e) != 'undefined') {
            lat = e.latlng.lat;
            lng = e.latlng.lng;
        }

        // sets lat/lng to 5 decimal places
        var latToFixed = lat.toString().match(/^-?\d+(?:\.\d{0,5})?/)[0];
        var lngToFixed = lng.toString().match(/^-?\d+(?:\.\d{0,5})?/)[0];

        // sets latlng input to value of lat + lng
        $('#latlng').val(lat + ', ' + lng);
        var radiusMiles = radius * 1609.344;
        if (typeof(windCircle) === 'undefined') {

            windCircle = L.circle([lat, lng], radiusMiles, {
                color: 'rgb(255, 165, 0)',
                stroke: 'rgb(255, 165, 0)',
                className: 'windCircle',
                draggable: 'true'
            });

            windCircle.addTo(map);
            windCircle.bindPopup("<h4><strong>Wind</strong></h4> Lat, Lon : " + latToFixed + ", " + lngToFixed).openPopup();

            //var radius = windCircle.getRadius();

        } else {
            windCircle.setRadius(radiusMiles);
            windCircle.setLatLng([lat, lng]);
            windCircle.bindPopup("<h4><strong>Wind</strong></h4> Lat, Lon : " + latToFixed + ", " + lngToFixed).openPopup();
            windCircle.addTo(map);
        }

    };

    // svg tornado marker
    var tornadoSVG = "<svg version='1.1' id='tornado' class='climacon climacon_tornado leaflet-marker-icon leaflet-zoom-animated leaflet-interactive leaflet-marker-draggable' viewBox='15 15 70 70'><g class='climacon_iconWrap climacon_iconWrap-tornado'><g class='climacon_componentWrap climacon_componentWrap-tornado'><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine'd='M68.997,36.459H31.002c-1.104,0-2-0.896-2-1.999c0-1.104,0.896-2,2-2h37.995c1.104,0,2,0.896,2,2C70.997,35.563,70.102,36.459,68.997,36.459z'></path><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine' d='M35.002,40.459h29.996c1.104,0,2,0.896,2,2s-0.896,1.999-2,1.999H35.002c-1.104,0-2-0.896-2-1.999C33.002,41.354,33.898,40.459,35.002,40.459z'></path><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine' d='M39.001,48.458h21.998c1.104,0,1.999,0.896,1.999,1.999c0,1.104-0.896,2-1.999,2H39.001c-1.104,0-1.999-0.896-1.999-2C37.002,49.354,37.897,48.458,39.001,48.458z'></path><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine' d='M47,64.456h5.999c1.104,0,2,0.896,2,1.999s-0.896,2-2,2H47c-1.104,0-2-0.896-2-2S45.896,64.456,47,64.456z'></path><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine'd='M40.869,58.456c0-1.104,0.896-1.999,2-1.999h13.998c1.104,0,2,0.896,2,1.999c0,1.104-0.896,2-2,2H42.869C41.765,60.456,40.869,59.561,40.869,58.456z'></path></g></g></svg>";

    // tornado controller
    var tornadoControl = L.easyButton({
        states: [{
            stateName: 'tornado-control',
            icon: tornadoSVG,
            title: 'Make a Forecast for a Tornado',
            onClick: function(btn, map, e) {
                $('#tornado-event').prop('checked', true);
                $('.climacon_component-stroke_tornadoLine').css('fill', 'rgb(255, 51, 51)');
                $('.climacon_component-stroke_hailAlt').css('fill', 'rgb(255,255,255)');
                $('.climacon_component-stroke_cloud').css('fill', 'rgb(255,255,255)');
                $('.climacon_component-wind_curl').css('fill', 'rgb(255,255,255)');
                $('.climacon_component-wind').css('fill', 'rgb(255,255,255)');

                $('.tornadoCircle').css({
                    stroke: 'rgb(255, 51, 51)',
                    fill: 'rgb(255, 51, 51)'
                });
                $('.hailCircle').css({
                    stroke: 'rgb(255, 51, 51)',
                    fill: 'rgb(255, 51, 51)'
                });
                $('.windCircle').css({
                    stroke: 'rgb(255, 51, 51)',
                    fill: 'rgb(255, 51, 51)'
                });

                $('.leaflet-popup-content strong').html('Tornado');

                map.on('click', function(e) {
                    tornadoMarker(e);
                });

                radiusInput.onchange = function() {
                    radius = radiusInput.value,
                        tornadoMarker();
                    $('.windCircle').hide();
                    $('.hailCircle').hide();
                    $('.tornadoCircle').show();
                }
            },

        }]
    });

    tornadoControl.addTo(map);

    // svg hail marker
    var hailSVG = "<svg version='1.1' id='cloudHailAlt' class='climacon climacon_cloudHailAlt' viewBox='15 15 70 70'><g class='climacon_iconWrap climacon_iconWrap-cloudHailAlt'><g class='climacon_wrapperComponent climacon_wrapperComponent-hailAlt'><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-left'><circle cx='42' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-middle'><circle cx='49.999' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-right'><circle cx='57.998' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-left'><circle cx='42' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-middle'><circle cx='49.999' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-right'><circle cx='57.998' cy='65.498' r='2'></circle></g></g><g class='climacon_wrapperComponent climacon_wrapperComponent-cloud'><path class='climacon_component climacon_component-stroke climacon_component-stroke_cloud' d='M63.999,64.941v-4.381c2.39-1.384,3.999-3.961,3.999-6.92c0-4.417-3.581-8-7.998-8c-1.602,0-3.084,0.48-4.334,1.291c-1.23-5.317-5.974-9.29-11.665-9.29c-6.626,0-11.998,5.372-11.998,11.998c0,3.549,1.55,6.728,3.999,8.924v4.916c-4.776-2.768-7.998-7.922-7.998-13.84c0-8.835,7.162-15.997,15.997-15.997c6.004,0,11.229,3.311,13.966,8.203c0.663-0.113,1.336-0.205,2.033-0.205c6.626,0,11.998,5.372,11.998,12C71.998,58.863,68.656,63.293,63.999,64.941z'></path></g></g></svg>";

    // hail control
    var hailControl = L.easyButton({
        states: [{
            stateName: 'hail-control', // name the state
            icon: hailSVG, // and define its properties
            title: 'Make a forecast for Hail', // like its title
            onClick: function(btn, map, e) {
                $('#hail-event').prop('checked', true);
                $('.climacon_component-stroke_tornadoLine').css('fill', 'rgb(255, 255, 255)');
                $('.climacon_component-stroke_hailAlt').css('fill', 'rgb(61, 182, 239)');
                $('.climacon_component-stroke_cloud').css('fill', 'rgb(61, 182, 239)');
                $('.climacon_component-wind_curl').css('fill', 'rgb(255,255,255)');
                $('.climacon_component-wind').css('fill', 'rgb(255,255,255)');
                $('.hailCircle').css({
                    stroke: 'rgb(61, 182, 239)',
                    fill: 'rgb(61, 182, 239)'
                });
                $('.tornadoCircle').css({
                    stroke: 'rgb(61, 182, 239)',
                    fill: 'rgb(61, 182, 239)'
                });
                $('.windCircle').css({
                    stroke: 'rgb(61, 182, 239)',
                    fill: 'rgb(61, 182, 239)'
                });

                $('.leaflet-popup-content strong').html('Hail');

                map.on('click', function(e) {
                    hailMarker(e);
                });

                radiusInput.onchange = function() {
                    radius = radiusInput.value,
                        hailMarker();
                    $('.tornadoCircle').hide();
                    $('.windCircle').hide();
                    $('.hailCircle').show();

                }
            },

        }]
    });

    hailControl.addTo(map);

    // svg wind marker
    var windSVG = "<svg version='1.1' id='wind' class='climacon climacon_wind' viewBox='15 15 70 70'><g class='climacon_iconWrap climacon_iconWrap-wind'><g class='climacon_wrapperComponent climacon_componentWrap-wind'><path class='climacon_component climacon_component-stroke climacon_component-wind climacon_component-wind_curl' d='M65.999,52L65.999,52h-3c-1.104,0-2-0.895-2-1.999c0-1.104,0.896-2,2-2h3c1.104,0,2-0.896,2-1.999c0-1.105-0.896-2-2-2s-2-0.896-2-2s0.896-2,2-2c0.138,0,0.271,0.014,0.401,0.041c3.121,0.211,5.597,2.783,5.597,5.959C71.997,49.314,69.312,52,65.999,52z'></path><path class='climacon_component climacon_component-stroke climacon_component-wind' d='M55.999,48.001h-2h-6.998H34.002c-1.104,0-1.999,0.896-1.999,2c0,1.104,0.895,1.999,1.999,1.999h2h3.999h3h4h3h3.998h2c3.313,0,6,2.688,6,6c0,3.176-2.476,5.748-5.597,5.959C56.271,63.986,56.139,64,55.999,64c-1.104,0-2-0.896-2-2c0-1.105,0.896-2,2-2s2-0.896,2-2s-0.896-2-2-2h-2h-3.998h-3h-4h-3h-3.999h-2c-3.313,0-5.999-2.686-5.999-5.999c0-3.175,2.475-5.747,5.596-5.959c0.131-0.026,0.266-0.04,0.403-0.04l0,0h12.999h6.998h2c1.104,0,2-0.896,2-2s-0.896-2-2-2s-2-0.895-2-2c0-1.104,0.896-2,2-2c0.14,0,0.272,0.015,0.403,0.041c3.121,0.211,5.597,2.783,5.597,5.959C61.999,45.314,59.312,48.001,55.999,48.001z'></path></g></g></svg>";

    // wind control
    var windControl = L.easyButton({
        states: [{
            stateName: 'wind-control', // name the state
            icon: windSVG, // and define its properties
            title: 'Make a forecast for Wind', // like its title
            onClick: function(btn, map, e) {
                $('#wind-event').prop('checked', true);
                $('.climacon_component-stroke_tornadoLine').css('fill', 'rgb(255, 255, 255)');
                $('.climacon_component-stroke_hailAlt').css('fill', 'rgb(255,255,255)');
                $('.climacon_component-stroke_cloud').css('fill', 'rgb(255,255,255)');
                $('.climacon_component-wind_curl').css('fill', 'rgb(255, 165, 0');
                $('.climacon_component-wind').css('fill', 'rgb(255, 165, 0');

                $('.windCircle').css({
                    stroke: 'rgb(255, 165, 0)',
                    fill: 'rgb(255, 165, 0)'
                });

                $('.tornadoCircle').css({
                    stroke: 'rgb(255, 165, 0)',
                    fill: 'rgb(255, 165, 0)'
                });

                $('.hailCircle').css({
                    stroke: 'rgb(255, 165, 0)',
                    fill: 'rgb(255, 165, 0)'
                });

                $('.leaflet-popup-content strong').html('Wind');

                map.on('click', function(e) {
                    windMarker(e);
                });

                radiusInput.onchange = function() {
                    radius = radiusInput.value,
                        windMarker();
                    $('.tornadoCircle').hide();
                    $('.hailCircle').hide();
                    $('.windCircle').show();
                }

            },

        }]
    });

    windControl.addTo(map);

    // range

    // get day
    var today = new Date();
    var currentDay = today.getDay();
    var currentDayTwo = today.getDay() + 1;

    var currentDayThree = today.getDay() + 2;
    var currentDayFour = today.getDay() + 3;

    var dayName = ["Sun", "Mon", "Tues", "Wed", "Thur", "Fri", "Sat"];


    var currentDayName = currentDay = dayName[currentDay];
    var currentDayTwoName = currentDayTwo = dayName[currentDayTwo];
    var currentDayThreeName = currentDayThree = dayName[currentDayThree];
    var currentDayFourName = currentDayFour = dayName[currentDayFour];

    var tomorrow = new Date(today.getTime() + (24 * 60 * 60 * 1000));
    var dateTwo = new Date(today.getTime() + (24 * 60 * 60 * 2000));



    $(document).ready(function() {


        // Set html for day of the weeks
        $('#first-date .day').html(currentDay);
        $('#second-date .day').html(currentDayTwo);
        $('#fourth-date .day').html(currentDayThree);
        $('#fifth-date .day').html(currentDayFour);

        // set time inputs

        // Get hr
        var hr = today.getUTCHours();
        if (hr >= 6) {
            //turn off first option
            $('#first-date').css({
                'cursor': 'not-allowed',
            });

            $('#first-date').click(function() {
                return false;
            });

        } else if (hr < 6) {
            $('#first-date').click(function() {
                // $('#am').prop('checked', true);
                $('#event_date').val(today.toISOString().slice(0, 10) + ' ' + '18:00');
            });
        }

        $('#second-date').click(function() {
            // $('#pm').prop('checked', true);
            $('#event_date').val(tomorrow.toISOString().slice(0, 10) + ' ' + '06:00');
        });

        $('#third-date').click(function() {
            // $('#am').prop('checked', true);
            $('#event_date').val(tomorrow.toISOString().slice(0, 10) + ' ' + '18:00');
        });

        $('#fourth-date').click(function() {
            // $('#pm').prop('checked', true);
            $('#event_date').val(dateTwo.toISOString().slice(0, 10) + ' ' + '06:00');
        });

        $('#fifth-date').click(function() {
            // $('#am').prop('checked', true);
            $('#event_date').val(dateTwo.toISOString().slice(0, 10) + ' ' + '18:00');
        });
    });


    var rangeSlider = L.control({ position: 'topleft' });
    rangeSlider.onAdd = function(map) {
        var div = L.DomUtil.create('div', 'range-slider-container');
        L.DomEvent.disableClickPropagation(div);
        div.innerHTML = '<div class=toggle_radio><input class=toggle_option id=first_toggle name=toggle_option type=radio> <input class=toggle_option id=second_toggle name=toggle_option type=radio checked> <input class=toggle_option id=third_toggle name=toggle_option type=radio> <input class=toggle_option id=fourth_toggle name=toggle_option type=radio> <input class=toggle_option id=fifth_toggle name=toggle_option type=radio><label id="first-date" for=first_toggle><span class=description>18Z - 6Z</span><p class=day></p></label><label id="second-date" for=second_toggle><span class=description>6Z - 18Z</span><p class=day></p></label><label id="third-date" for=third_toggle><span class=description>18Z - 6Z</span><p class=day></p></label><label id="fourth-date" for=fourth_toggle><span class=description>6Z - 18Z</span><p class=day></p></label><label id="fifth-date" for=fifth_toggle><span class=description>18Z - 6Z</span><p class=day></p></label><div class=toggle_option_slider></div>';
        return div;
    };


    rangeSlider.addTo(map);


    $('.radius').prependTo('.range-slider-container');
    $('.sidebar-footer').appendTo('.range-slider-container');

    // disable map dragging on input container
    rangeSlider.getContainer().addEventListener('mouseover', function() {
        map.dragging.disable();
    });

    // enable map dragging on input container
    rangeSlider.getContainer().addEventListener('mouseout', function() {
        map.dragging.enable();
    });
    
    var toDelete = 0;
    var storage = "";
    $(document.body).on('click', '#deletePending', function(e){
        e.preventDefault();
        toDelete = $(this).children('#toDelete').val();
        storage = $(this).parent().html();
        $(this).parent().html('Are you sure you want to delete this forecast?</br><button id="noDelete" class="btn btn-primary" style="float:left;margin-top:5px">No</button><button id="yesDelete" class="btn btn-primary" style="float:right;margin-top:5px">Yes</button><div style="width:100%;height:40px;visibility:hidden">Clear</div>');
    });
    $(document.body).on('click', '#noDelete', function(e){
        e.preventDefault();
        $(this).parent().html(storage);
    });
    $(document.body).on('click', '#yesDelete', function(e){
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

    $("#radiusMask").change(function() {
        $("#output").text('(' + $("#radiusMask").val() + ' miles)');
        $("#radius").val($("#radiusMask").val());

    });
    // radius functionality
    var radiusInput = document.getElementById('radiusMask');
    var radius = radiusInput.value;
});
