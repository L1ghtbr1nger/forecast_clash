// initialize leaflet map 
var map = L.map('map', {
    doubleClickZoom: true,
    scrollWheelZoom: false
});

map.once('focus', function() { map.scrollWheelZoom.enable(); });

map.on('click', function() {
    map.scrollWheelZoom.enable();
});

map.setView([35.2226, -97.4395], 5);

L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
}).addTo(map);

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

//heatmap layer adder in leaderboard.js
