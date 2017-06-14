<body>
<div class="map_canvas"></div>
<!--<button id="printer" onClick="printMap()">PRINT TESTING</map>-->
<div class="container">
  <div class="row">
    <div class="col">
      1 of 2
    </div>
    <div class="col">
      2 of 2
    </div>
  </div>
</div>
</body>
<style>
   .map_canvas {
    margin-left: auto;
    margin-right: auto;
    padding: 0;
    width: 600px;
    height: 400px;
  }

  /*.map_canvas{
    width:  990px;
    height: 700px;
    margin: .4rem;;
  }*/

  body{
    margin: 8px;
  }

</style>

<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCY0B3_Fr1vRpgJDdbvNmrVyXmoOOtiq64"></script>
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY0B3_Fr1vRpgJDdbvNmrVyXmoOOtiq64&callback=initMap"></script>-->
<script src="js/jquery.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<!--<script src="js/ProjectedOverlay.js"></script>-->
<!--<script src="js/ZipFile.complete.js"></script>-->
<!--<script src="js/geoxml3.js"></script>-->
<!--<script src="js/geoxml3_gxParse_kmz.js"></script>-->
<script>
  var mylocation = {
    'latitude':  31.742985,
    'longitude': -106.431648
  };
  //var map;
  function initMap() {
    var myLatlng = new google.maps.LatLng( mylocation.latitude, mylocation.longitude );
    var mapContainer = $('.map_canvas');
    var map          = new google.maps.Map(mapContainer[0], {
      center: myLatlng,
      zoom  : 5
    });

    /*var mapContainer = $('.map_canvas');
    var map          = new google.maps.Map(mapContainer[0], {
      center: myLatlng,
      zoom  : 12,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });*/

    /*var mapOptions = {
      zoom: 12,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions); */
    // This needs to be the Full URL - not a relative URL
    //var myParser = new geoXML3.parser({map: map, zoom: true, processStyles:true, singleInfoWindow: true});
    //myParser.parse('KMZ/fremont.kml');
    var kmlPath = "http://ctis.utep.edu/secretsanta/elpaso.kmz"; //og: http://web-apprentice-demo.craic.com/assets/maps/fremont.kml
    // Add unique number to this url - as with images - to avoid caching issues during development
    //og: https://doc-04-20-docs.googleusercontent.com/docs/securesc/np0525du9ebvm8i97hojbopo85coiqgo/m3chdeu20aco2aho4o7kqihucid6l02q/1489456800000/11923168389958881286/11923168389958881286/0B7DSGxbE8dQTTktEb3NLM2xvQjQ?e=download&nonce=je1g0ilv8fo1u&user=11923168389958881286&hash=3h7ddgipl6nloeb399f4ndu7ij7plhaf
    //chicago: https://doc-10-20-docs.googleusercontent.com/docs/securesc/np0525du9ebvm8i97hojbopo85coiqgo/qm7vrcrnqljh3skuqn0e2eam8if9gi32/1489492800000/11923168389958881286/11923168389958881286/0B7DSGxbE8dQTb1lwV2ppdWdmYWs?e=download
    //found in the kml file from the kmz: http://casoilresource.lawr.ucdavis.edu/soil_web/kml/mapunits.kml
    var urlSuffix = (new Date).getTime().toString();
    //var layer = new google.maps.KmlLayer(myParser);
    var layer = new google.maps.KmlLayer(kmlPath + '?' + urlSuffix ); //og
    layer.setMap(map);
  }
  google.maps.event.addDomListener(window, 'load', initMap);
</script>
