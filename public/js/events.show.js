var loc = document.querySelector('.location').dataset.location;

var xhr = new XMLHttpRequest();
xhr.onload = function(e){
    var place = JSON.parse(this.responseText)[0];
    var map = L.map('map', {'maxZoom': 18}).setView([place.lat, place.lon]);
    var marker = L.marker([place.lat, place.lon]).addTo(map);

    var bounds = L.latLngBounds(
        [place.boundingbox[1], place.boundingbox[3]],
        [place.boundingbox[0], place.boundingbox[2]]
    );
    map.fitBounds(bounds);
    L.rectangle(bounds, {color: "#0f0", weight: 1, fillOpacity: 0.1}).addTo(map);
    console.log(bounds);

    // https://wiki.openstreetmap.org/wiki/Mapquest#MapQuest-hosted_map_tiles
    L.tileLayer('http://otile1.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png', {
        attribution: 'Data, imagery and map information provided by <a href="http://www.mapquest.com/" target="_blank">MapQuest</a>, <a href="http://www.openstreetmap.org/copyright" target="_blank"> OpenStreetMap</a> and contributors, <a href="http://wiki.openstreetmap.org/wiki/Legal_FAQ#3a._I_would_like_to_use_OpenStreetMap_maps._How_should_I_credit_you.3F" target="_blank">ODbL</a>',
        maxZoom: 18
    }).addTo(map);
};
xhr.open("get", "http://open.mapquestapi.com/nominatim/v1/search.php?format=json&q=" + loc, true);
xhr.send();
