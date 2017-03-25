$('document').ready(function() {

    // initializes game instructions

    var instructionsInit = function() {

        $('.scoring-btn').hide();
        $('.targeting').hide();


        $('.scoring-instructions-btn').click(function() {
            $('.scoring-instructions').hide(500);
            $('.scoring-btn').show(500);
            $('.targeting').show(500);
            $('.scoring-instructions-btn').hide();
            $('.scoring-btn').appendTo('.modal-footer');
        });

        $('.scoring-btn').click(function() {
            $('.scoring').show(500);
            $('.scoring-btn').hide(500);
            $('.scoring-instructions').hide(500);

        });
    }

    instructionsInit();

    // initializes sidebar
    var sidebar = L.control.sidebar('play-sidebar', {
        closeButton: true,
    });

    // Show sidebar after .5s
    setTimeout(function() {
        sidebar.show();
    }, 500);

    // Initialize map
    var map = new L.map('map', {
        center: [40.2226, -95.4395],
        zoom: 5,
        doubleClickZoom: false
    })

    .addControl(sidebar)

    // on map click
    .on('click', function(e) {

    })

    // Set tile layer
    L.tileLayer('http://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
    }).addTo(map);

    // close button
    $('.close').click(function() {

        // L.easyButton('Test', function(btn, map) {
        // sidebar.show();
        // this.removeFrom(map);
        // }).addTo(map);


        // tornado controller
        var openSidebarControl = L.easyButton({
            states: [{
                stateName: 'sidebar-closed',
                icon: tornadoSVG,
                title: 'Make a Forecast for a Tornado',
                onClick: function(btn, map, e) {
                    console.log('open sidebar');
                    sidebar.show();
                    this.removeFrom(map);
                },

            }]
        });

        openSidebarControl.addTo(map);
        $('.sidebar-closed-active').html('<h5>Open Sidebar</h5');
        $('.sidebar-closed-active h5').css({
            'color': '#fff',
            'text-transform': 'uppercase'
        });
    });

    // radius functionality
    var radiusInput = document.getElementById('radius');
    var radius = radiusInput.value;

    var circle;
    var lat;
    var lng;

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
                $('.climacon_component-stroke_tornadoLine').css('fill', 'rgb(61, 182, 239)');
                $('.climacon_component-stroke_hailAlt').css('fill', 'rgb(255,255,255)');
                $('.climacon_component-stroke_cloud').css('fill', 'rgb(255,255,255)');
                $('.climacon_component-wind_curl').css('fill', 'rgb(255,255,255)');
                $('.climacon_component-wind').css('fill', 'rgb(255,255,255)');
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
            title: 'Make a forecast for wind', // like its title
            onClick: function(btn, map, e) {
                $('#wind-event').prop('checked', true);
                $('.climacon_component-stroke_tornadoLine').css('fill', 'rgb(255, 255, 255)');
                $('.climacon_component-stroke_hailAlt').css('fill', 'rgb(255,255,255)');
                $('.climacon_component-stroke_cloud').css('fill', 'rgb(255,255,255)');
                $('.climacon_component-wind_curl').css('fill', 'rgb(61, 182, 239)');
                $('.climacon_component-wind').css('fill', 'rgb(61, 182, 239)');

            },

        }]
    });

    windControl.addTo(map);

    function cMarker(e) {
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
        if (typeof(circle) === 'undefined') {
            circle = new L.circle([lat, lng], radiusMiles, {
                color: 'rgb(61, 182, 239)',
                fillColor: '#fff',
                fillOpacity: 0.5
            });
            circle.addTo(map);
            circle.bindPopup("Lat, Lon : " + latToFixed + ", " + lngToFixed).openPopup();

            //var radius = circle.getRadius();

        } else {
            circle.setRadius(radiusMiles);
            circle.setLatLng([lat, lng]);
            circle.bindPopup("Lat, Lon : " + latToFixed + ", " + lngToFixed).openPopup();
            circle.addTo(map);
        }

    };


    map.on('click', function(e) {
        cMarker(e);
    });

    radiusInput.onchange = function() {
        radius = radiusInput.value,
            cMarker();
    }


});
