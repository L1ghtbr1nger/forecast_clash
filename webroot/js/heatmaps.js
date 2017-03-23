// initialize leaflet map 
var map = L.map('map', {
    doubleClickZoom: false
});

map.setView([35.2226, -97.4395], 5);

L.tileLayer('http://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
}).addTo(map);

var legend2 = L.control({position: 'topright'}); 
legend2.onAdd = function (map) {        
    var div = L.DomUtil.create('div', 'info legend2 map-logo');
    div.innerHTML = '<img src="../img/logo-light-blue-sm.png" style="width:125px; ">';     
    return div;
};      
legend2.addTo(map);

//heatmap layer adder in leaderboard.js