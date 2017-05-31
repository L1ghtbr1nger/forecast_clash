// Pending Forecast Layers

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
    }).bindPopup('Pending ' + pendingEvents[i] + ' Forecast at <br><strong> ' + v[0] + ',' + v[1] + '</strong> starting</br>' + pendingDates[i] + ' UTC').openPopup());
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
// initialize leaflet map 
var map = L.map('map', {
    doubleClickZoom: true,
    scrollWheelZoom: false,
    layers: [active_layer, pending_layer]
});

map.once('focus', function() { map.scrollWheelZoom.enable(); });

map.on('click', function() {
    map.scrollWheelZoom.enable();
});

map.setView([35.2226, -97.4395], 5);
L.control.layers(overlayMaps, null, { collapsed: false }).addTo(map);
L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
}).addTo(map);

var overlayMaps = {
    "Pending": pending_layer,
    "Active": active_layer
};

var logo = L.control({ position: 'topright' });
logo.onAdd = function(map) {
    var div = L.DomUtil.create('div', 'info legend2 map-logo');
    div.innerHTML = '<img src="/forecast_clash/webroot/img/logo-light-blue-sm.png" style="width:175px;">';
    return div;
};
logo.addTo(map);

var output_form = L.control({ position: 'bottomright' });
output_form.onAdd = function(map) {
    var div = L.DomUtil.create('div', 'output-form');
    div.innerHTML = '';
    return div;
};
output_form.addTo(map);

var paramsHM = {};
var locations = [];
var heatmap;

function callAjaxHM(filters) {
    $.ajax({ //ajax call to get DB data for the leaderboard
        type: "POST",
        url: "/forecast_clash/historical-forecasts/heat.json",
        dataType: 'json',
        data: filters,
        success: function(response) {
            locations = response['heatmap'];
            // Heatmap Layers
            if (typeof heatmap !== 'undefined') {
                map.removeLayer(heatmap);
            }
            heatmap = L.heatLayer(locations, { radius: 25 }).addTo(map);
        },
        error: function() {

        }
    });
};

function dateHM() {
    if (from_value == null && to_value == null) {
        paramsHM.range = [];
    } else {
        if (from_value !== null) {
            paramsHM.range[0] = from_value;
        }
        if (to_value !== null) {
            paramsHM.range[1] = to_value;
        }
    }
    callAjaxHM(paramsHM);
}

$(document).ready(function() {
    //Heatmap    
    function tabsHM() { //which tab is active
        var tab = $('.current_hm').attr('id');
        if (tab === 'all_hm') {
            paramsHM.players = 2; //all players
        } else if (tab === 'team_hm') {
            paramsHM.players = 1; //players on user's team
        } else if (tab === 'self_hm') {
            paramsHM.players = 0; //only user
        }
    };

    function experienceHM() { //which experience toggles are checked
        if ($('#amateur_hm').prop('checked') && $('#mets_hm').prop('checked')) {
            paramsHM.experience = 2; //amateur: checked, meteorologist: checked
        } else if ($('#mets_hm').prop('checked')) {
            paramsHM.experience = 1; //amateur: unchecked, meteorologist: checked
        } else if ($('#amateur_hm').prop('checked')) {
            paramsHM.experience = 0; //amateur: checked, meteorologist: unchecked
        } else {
            paramsHM.experience = 3; //amateur: unchecked, meteorologist: unchecked
        }
    };

    function forecastHM() { //which experience toggles are checked
        if ($('#correct_hm').prop('checked') && $('#incorrect_hm').prop('checked')) {
            paramsHM.correct = 2; //amateur: checked, meteorologist: checked
        } else if ($('#correct_hm').prop('checked')) {
            paramsHM.correct = 1; //amateur: unchecked, meteorologist: checked
        } else if ($('#incorrect_hm').prop('checked')) {
            paramsHM.correct = 0; //amateur: checked, meteorologist: unchecked
        } else {
            paramsHM.correct = 3; //amateur: unchecked, meteorologist: unchecked
        }
    };

    function weatherHM() { //which experience toggles are checked
        paramsHM['events'] = [-1];
        if ($('#tornado_hm').prop('checked')) {
            paramsHM['events'].push(1); //tornado: checked
        }
        if ($('#hail_hm').prop('checked')) {
            paramsHM['events'].push(2); //hail: checked
        }
        if ($('#wind_hm').prop('checked')) {
            paramsHM['events'].push(3); //wind: checked
        }
    };

    $('.whom_hm').click(function() { //run tabs when tab is selected
        if (!$(this).hasClass('current_hm')) {
            $('.current_hm').toggleClass('current_hm');
            $(this).addClass('current_hm');
            tabsHM();
            callAjaxHM(paramsHM);
        }
    });
    $('.exp_hm').change(function() { //run experience when experience filters are adjusted
        experienceHM();
        callAjaxHM(paramsHM);
    });
    $('.forecast_hm').change(function() { //run forecastHM when correct/incorrect filters are adjusted
        forecastHM();
        callAjaxHM(paramsHM);
    });
    $('.event_hm').change(function() { //run weatherHM when weather event filters are adjusted
        weatherHM();
        callAjaxHM(paramsHM);
    });

    tabsHM(); //run tabs with default tab
    experienceHM(); //run experience with default filters
    forecastHM(); //run filter for correct or incorrect
    weatherHM(); //run weather events filter
    dateHM();
    callAjaxHM(paramsHM);
})
