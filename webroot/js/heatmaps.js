// initialize leaflet map 
var map = L.map('map', {
    doubleClickZoom: false
});

map.setView([35.2226, -97.4395], 5);

L.tileLayer('http://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
}).addTo(map);

//heatmap layer adder in leaderboard.js