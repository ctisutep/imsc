<html>
<head>


  <!--Load the AJAX API-->
  <script src="js/jquery.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script>

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(on);
  function on(){
    //dead
  }
  var rec;
  var rectangle;
  var map;
  var infoWindow;
  var selectedRec;
  var drawingManager;

  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 18,
      center: new google.maps.LatLng(31.31610138349565, -99.11865234375),
      mapTypeId: 'terrain'
    });

    infoWindow = new google.maps.InfoWindow;

    map.addListener('click', function(e) {
      // console.log(e.latLng.toString());
    });

    drawingManager = new google.maps.drawing.DrawingManager({
      drawingControl: true,
      drawingControlOptions: {
        position: google.maps.ControlPosition.TOP_CENTER,
        drawingModes: ['rectangle']
      },
      rectangleOptions: {
        draggable: true,
        clickable: true,
        editable: true,
        zIndex: 10
      }
    });

    drawingManager.setMap(map);

    google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
      drawingManager.setDrawingMode(null);
      drawingManager.setOptions({
        drawingControl: true,
        drawingControlOptions: {
          position: google.maps.ControlPosition.TOP_CENTER,
          drawingModes: ['']
        }
      });

      rec = e.overlay;
      rec.type = e.type;

      setSelection(rec);

      google.maps.event.addListener(rec, 'click', function() {
        //clickRec(rec);
        drawChart(rec);
      });

      google.maps.event.addListener(rec, 'bounds_changed', function() {
        showNewRect2(rec);
      });

    });

    google.maps.event.addDomListener(document.getElementById('draw'), 'click', drawAnotherRectangle);

    infoWindow = new google.maps.InfoWindow();
  }

  function drawAnotherRectangle(){
    if (selectedRec) {
      selectedRec.setMap(null);
      // To show:
      drawingManager.setOptions({
        drawingControl: true,
        drawingControlOptions: {
          position: google.maps.ControlPosition.TOP_CENTER,
          drawingModes: ['rectangle']
        },
        rectangleOptions: {
          draggable: true,
          clickable: true,
          editable: true,
          zIndex: 10
        }
      });
    }
  }

  function deleteSelectedShape() {
    if (selectedShape) {
      selectedShape.setMap(null);
      // To show:
      drawingManager.setOptions({
        drawingControl: true
      });
    }
  }

  function clearSelection() {
    if (selectedRec) {
      selectedRec.setEditable(false);
      selectedRec = null;
    }
  }

  function setSelection(shape) {
    clearSelection();
    selectedRec = shape;
    shape.setEditable(true);
    //selectColor(shape.get('fillColor') || shape.get('strokeColor'));
  }
  function clickRec(shape){
    var ne = shape.getBounds().getNorthEast();
    var sw = shape.getBounds().getSouthWest();
    var center = shape.getBounds().getCenter();
    var southWest = new google.maps.LatLng(sw.lat(), sw.lng());
    var northEast = new google.maps.LatLng(ne.lat(), ne.lng());
    var southEast = new google.maps.LatLng(sw.lat(), ne.lng());
    var northWest = new google.maps.LatLng(ne.lat(), sw.lng());
    var area = google.maps.geometry.spherical.computeArea([northEast, northWest, southWest, southEast]);
    area = parseInt(area);
    area = area.toLocaleString();
    var contentString = '<b>Rectangle clicked.</b><br>' + 'Area is: ' + area + ' m^2';
    var center = shape.getBounds().getCenter();

    // Set the info window's content and position.
    infoWindow.setContent(contentString);
    infoWindow.setPosition(center);

    infoWindow.open(map);
  }

  function showNewRect2(shape) {
    var ne = shape.getBounds().getNorthEast();
    var sw = shape.getBounds().getSouthWest();

    var contentString = '<b>Rectangle moved.</b><br>' +
    'New north-east corner: ' + ne.lat() + ', ' + ne.lng() + '<br>' +
    'New south-west corner: ' + sw.lat() + ', ' + sw.lng();

    // Set the info window's content and position.
    infoWindow.setContent(contentString);
    infoWindow.setPosition(ne);

    infoWindow.open(map);
  }

  function drawChart(shape) {

    var center = shape.getBounds().getCenter();
    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows([
      ['Mushrooms', 3],
      ['Onions', 1],
      ['Olives', 1],
      ['Zucchini', 1],
      ['Pepperoni', 2]
    ]);

    // Set chart options
    var options = {'title':'Pizza consumed here',
    //'width':600,
    //'height':600,
    'is3D': true
    };

    var node        = document.createElement('div'),
    //infoWindow  = new google.maps.InfoWindow(),
    chart       = new google.visualization.PieChart(node);

    chart.draw(data, options);
    infoWindow.setContent(node);
    infoWindow.setPosition(center);
    infoWindow.open(map);
  }

  </script>
  <style>
  #map {
    height: 50%;
    width: 50%;
  }
  </style>
</head>

<body>

  <div id="map"></div>
  <!--<div id="chart_div"></div>-->
  <button type="button" class="btn btn-default form-control" id="draw" onclick="drawAnotherRectangle();">Delete drawn area of interest</button>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY0B3_Fr1vRpgJDdbvNmrVyXmoOOtiq64&libraries=drawing&callback=initMap"async defer></script>
</body>
</html>
