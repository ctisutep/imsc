<style>
/* Always set the map height explicitly to define the size of the div
* element that contains the map. */

#map {
  height: 100%;
}


/* Optional: Makes the sample page fill the window. */

html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#floating-panel {
  position: absolute;
  top: 8px;
  left: 6%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: 'Roboto', 'sans-serif';
  line-height: 30px;
  padding-left: 10px;
}

</style>
<div id="map"></div>
<div id="floating-panel">
  <input onclick="removeRectangle();" type=button value="Remove rectangle">
</div>
<!-- Replace the value of the key parameter with your own API key. -->
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkUOdZ5y7hMm0yrcCQoCvLwzdM6M8s5qk&callback=initMap"> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY0B3_Fr1vRpgJDdbvNmrVyXmoOOtiq64&libraries=drawing&callback=initMap"async defer></script>


</script>

<script>
// This example adds a user-editable rectangle to the map.
// When the user changes the bounds of the rectangle,
// an info window pops up displaying the new bounds.

var rectangle;
var map;
var infoWindow;

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: 31.770849, lng: -106.504583
    },
    zoom: 13
  });

  var drawingManager = new google.maps.drawing.DrawingManager({
    drawingControl: true,
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER,
      drawingModes: ['rectangle']
    },
    rectangleOptions: {
      draggable: true,
      clickable: true,
      editable: true
    }
  });

  drawingManager.setMap(map);

  google.maps.event.addListener(drawingManager, 'rectanglecomplete', function(e) {
    drawingManager.setDrawingMode(null);
    drawingManager.setOptions({
      drawingControl: true,
      drawingControlOptions: {
        position: google.maps.ControlPosition.TOP_CENTER,
        drawingModes: ['']
      }
    });
  });

  var bounds = {
    north: 31.7783,
    south: 31.7720,
    east: -106.4955,
    west: -106.5127
  };

  // Define the rectangle and set its editable property to true.
  rectangle = new google.maps.Rectangle({
    bounds: bounds,
    editable: true,
    draggable: true,
    clickable: true
  });

  rectangle.setMap(map);

  // Add an event listener on the rectangle.
  rectangle.addListener('bounds_changed', showNewRect);
  rectangle.addListener('click', clickRect);

  // Define an info window on the map.
  infoWindow = new google.maps.InfoWindow();
}
// Show the new coordinates for the rectangle in an info window.

/** @this {google.maps.Rectangle} */
function showNewRect(event) {
  var ne = rectangle.getBounds().getNorthEast();
  var sw = rectangle.getBounds().getSouthWest();

  var contentString = '<b>Rectangle moved.</b><br>' +
  'New north-east corner: ' + ne.lat() + ', ' + ne.lng() + '<br>' +
  'New south-west corner: ' + sw.lat() + ', ' + sw.lng();

  // Set the info window's content and position.
  infoWindow.setContent(contentString);
  infoWindow.setPosition(ne);

  infoWindow.open(map);
}

function clickRect(event) {
  var ne = rectangle.getBounds().getNorthEast();
  var sw = rectangle.getBounds().getSouthWest();
  var center = rectangle.getBounds().getCenter();
  var southWest = new google.maps.LatLng(sw.lat(), sw.lng());
  var northEast = new google.maps.LatLng(ne.lat(), ne.lng());
  var southEast = new google.maps.LatLng(sw.lat(), ne.lng());
  var northWest = new google.maps.LatLng(ne.lat(), sw.lng());
  var area = google.maps.geometry.spherical.computeArea([northEast, northWest, southWest, southEast]);
  area = parseInt(area);
  area = area.toLocaleString();
  var contentString = '<b>Rectangle clicked.</b><br>' + 'Area is: ' + area + ' m^2';

  // Set the info window's content and position.
  infoWindow.setContent(contentString);
  infoWindow.setPosition(center);

  infoWindow.open(map);
}

function removeRectangle() {
  rectangle.setMap(null);
}

</script>
