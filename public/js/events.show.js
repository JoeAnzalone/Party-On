var loc = document.querySelector('.location').dataset.location;

var xhr = new XMLHttpRequest();
var map = L.map('map', {'maxZoom': 18});
xhr.onload = function(e){
    var place = JSON.parse(this.responseText)[0];
    var marker = L.marker([place.lat, place.lon]).addTo(map);
    map.setView([place.lat, place.lon]);
    map.scrollWheelZoom.disable();
    var bounds = L.latLngBounds(
        [place.boundingbox[1], place.boundingbox[3]],
        [place.boundingbox[0], place.boundingbox[2]]
    );
    map.fitBounds(bounds);
    var radius = L.latLng(place.lat, place.lon).distanceTo([place.lat, place.boundingbox[3]]);
    L.circle([place.lat, place.lon], radius, {color: "#0f0", weight: 1, fillOpacity: 0.1}).addTo(map);

    // https://wiki.openstreetmap.org/wiki/Mapquest#MapQuest-hosted_map_tiles
    L.tileLayer('http://otile1.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png', {
        attribution: 'Data, imagery and map information provided by <a href="http://www.mapquest.com/" target="_blank">MapQuest</a>, <a href="http://www.openstreetmap.org/copyright" target="_blank"> OpenStreetMap</a> and contributors, <a href="http://wiki.openstreetmap.org/wiki/Legal_FAQ#3a._I_would_like_to_use_OpenStreetMap_maps._How_should_I_credit_you.3F" target="_blank">ODbL</a>',
        maxZoom: 18
    }).addTo(map);
};
xhr.open("get", "http://open.mapquestapi.com/nominatim/v1/search.php?format=json&q=" + loc, true);
xhr.send();

fixDragging = function(){
    var mapWidth;
    var pageWidth;

    mapWidth  = document.querySelector('#map').offsetWidth
    pageWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0)

    var widthPercentage  = mapWidth / pageWidth * 100;

    if (widthPercentage > 80) {
        map.dragging.disable();
        if (map.tap) map.tap.disable();
    } else {
        map.dragging.enable();
        if (map.tap) map.tap.enable();
    }
};

fixDragging();
window.onresize = fixDragging;
