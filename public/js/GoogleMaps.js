var map;
var markers = [];

function initMap() {

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 56, lng: -96},
        zoom: 2
    });
}

function ShowMarker(coordinates) {
    deleteMarkers();
    showMarkers();
    var coordinatesArr = coordinates.split(',');

    var latlng = new google.maps.LatLng(parseFloat(coordinatesArr[0]), parseFloat(coordinatesArr[1]));
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,

    })
    var latlngbounds = new google.maps.LatLngBounds();
    latlngbounds.extend(marker.position);

    map.setCenter(latlngbounds.getCenter());
    //Zoom
    //map.fitBounds(latlngbounds);
    markers.push(marker);
}

function ShowMarkerByAddress(lat, lng) {
    deleteMarkers();
    showMarkers();

    var latlng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
    alert(latlng);

    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        center: latlng

    })
    markers.push(marker);
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
    setMapOnAll(null);
}

// Shows any markers currently in the array.
function showMarkers() {
    setMapOnAll(map);
}

// Delete any markers currently in the array
function deleteMarkers() {
    clearMarkers();
    markers = [];
}







