<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>TX-IMSC, TESTING PRINT</title>
	<!-- Interactive Map for Soil Categorization -->

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/custom.css" rel="stylesheet" type="text/css">
	<link href="css/modern-business.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="css/font-awesome.css" rel="stylesheet" type="text/css">

	<!--switches-->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/css-toggle-switch/latest/toggle-switch.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
	#legend {
		font-family: Arial, sans-serif;
		background: #fff;
		padding: 10px;
		margin: 10px;
		border: 3px solid #000;
	}
	#legend h3 {
		margin-top: 0;
	}
	#legend img {
		vertical-align: middle;
	}

	</style>

</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="text-center" style='font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;'>
				<h3 style="color:#FF8000;margin-right:8%;padding-top:1%;">CENTER FOR TRANSPORTATION INFRASTRUCTURE SYSTEMS</h3>
				<h6><i style="color:white;margin-right:8%">"The Only Research Center in the Nation that is Designated as a Member of both National and Regional University Transportation Center"</i></h6>
			</div>

		</div>
		<!-- /.container -->
	</nav>

	<!-- Page Content -->

	<!-- Content Row -->
	<div>

		<div class="row">
			<div class="col-md-9">
				<div id="map"></div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<center><h3 class="panel-title">Toolbar</h3></center>
					</div>
					<div class="panel-body">

						<div class="row">
							<label>District:</label>
							<select id="target" class="form-control">
								<option value="32.43561304116276, -100.1953125" data-district="abeline">
									Abilene
								</option>
								<option value="35.764343479667176, -101.49169921875" data-district="amarillo">
									Amarillo
								</option>
								<option value="32.69651010951669, -94.691162109375" data-district="atlanta">
									Atlanta
								</option>
								<option value="30.25391637229704, -98.23212890625" data-district="austin">
									Austin
								</option>
								<option value="30.40211367909724, -94.39453125" data-district="beaumont">
									Beaumont
								</option>
								<option value="31.765537409484374, -99.140625" data-district="brownwood">
									Brownwood
								</option>
								<option value="30.894611546632302, -96.30615234375" data-district="bryan">
									Bryan
								</option>
								<option value="34.397844946449865, -100.37109375" data-district="childress">
									Childress
								</option>
								<option value="28.110748760633534, -97.71240234375" data-district="corpus">
									Corpus Christi
								</option>
								<option value="32.54681317351514, -96.85546875" data-district="dallas">
									Dallas
								</option>
								<option value="30.694611546632302, -104.52392578125" data-district="elPaso">
									El Paso
								</option>
								<option value="32.62087018318113, -97.75634765625" data-district="fortWorth">
									Fort Worth
								</option>
								<option value="29.661670115197377, -95.33935546875" data-district="houston">
									Houston
								</option>
								<option value="28.613459424004418, -99.90966796875" data-district="laredo">
									Laredo
								</option>
								<option value="33.43144133557529, -101.93115234375" data-district="lubbock">
									Lubbock
								</option>
								<option value="31.203404950917395, -94.7021484375" data-district="lufkin">
									Lufkin
								</option>
								<option value="31.203404950917395, -102.568359375" data-district="odessa">
									Odessa
								</option>
								<option value="33.43144133557529, -95.625" data-district="paris">
									Paris
								</option>
								<option value="26.951453083498258, -98.32763671875" data-district="pharr">
									Pharr
								</option>
								<option value="31.10819929911196, -100.48095703125" data-district="sanAngelo">
									San Angelo
								</option>
								<option value="29.13297013087864, -98.89892578125" data-district="sanAntonio">
									San Antonio
								</option>
								<option value="32.222095840502334, -95.33935546875" data-district="tyler">
									Tyler
								</option>
								<option value="31.403404950917395, -97.119140625" data-district="waco">
									Waco
								</option>
								<option value="33.77914733128647, -98.37158203125" data-district="wichitaFalls">
									Wichita Falls
								</option>
								<option value="29.05616970274342, -96.8115234375" data-district="yoakum">
									Yoakum
								</option>
							</select>
						</div>
						<p> </p> <!--sepator-->
						<div class="row"> <!--search-->
							<label> Search: </label>
						</div>
						<div class="row"> <!--search-->
							<div class="input-group">
								<span class="input-group-addon glyphicon glyphicon-search" id="basic-addon"></span>
								<input type="text" class="form-control" placeholder="Ground Property" aria-describedby="basic-addon" id="autocomplete" autocomplete="off">
							</div>
						</div>
						<div> <p> </p> </div> <!--separate-->
						<div class="row">
							<button class="btn btn-success form-control" type="button" id="run" onClick="getPolygons()">Run</button>
						</div>
						<p>  </p> <!--separator-->
						<div class="row">
							<button class="btn btn-warning form-control" type="button" id="clear" onClick="removePolygons()">Clear</button>
						</div>
						<p>  </p> <!--separator-->
						<button type="button" class="map-print" id="print" onClick="printMaps()">Print</button> <!-- to print map -->
					</div>
				</div>
				<div id="legend">
					<h3>Legend</h3>
					<div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.autocomplete.min.js"></script>
	<script src="js/properties.js"></script>
	<script>
	var app = {map:null, polygons:null, payload:{getMode:"polygons", property:null, district:null}};
	//var suggested = all the aliases of the properties, note: not all properties have an alias
	$(document).ready(function(){
		//start here, get the properties
		$.post('polygonHandler.php', {'columns': true}, function(result){
			//do stuff with the result
			var properties;
			if(result.hasOwnProperty('columns')){
				properties = $.map(result.columns, function(val, i){
					return {value: val[2], data: val[1], table: val[3]};
				});
			}
			//create the autocomplete with the data
			$('#autocomplete').autocomplete({
				lookup: properties,
				onSelect: function (suggestion) {
					app.payload.property = suggestion.data;
					app.payload.table = suggestion.table;
					app.payload.value = suggestion.value;
				}
			});
			$('#target').on('change', setDistrict);
		});
		app.payload.district = $('#target').children("option:selected").data('district');
	});
	function getPolygons(){
		if(app.payload.property && app.payload.district){
			//get the polygons
			// console.log(app.payload);
			var getparams = app.payload;
			var bounds = app.map.getBounds();
			getparams.NE = bounds.getNorthEast().toJSON(); //north east corner
			getparams.SW = bounds.getSouthWest().toJSON(); //north east corner
			$.get('polygonHandler.php', app.payload, function(data){
				//draw the stuff on the map
				if(data.hasOwnProperty('coords')){
					removePolygons();
					// GRAY, RED, SKY BLUE, BRIGHT GREEN, PURPLE, ORANGE, BRIGHT PINK, NAVY BLUE, LILAC, YELLOW
					shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
					shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
					colorSelector = 0;
					newzIndex = 0;
					legendText = "";
					for(key in data.coords){
						if(data.coords.hasOwnProperty(key)){
							var polyCoordis = [];
							if(app.payload.table == "chorizon_r"){
								legendText = "<img src='img/graysquare.png' height='10px'/> <= 0<br>\
															<img src='img/redsquare.png' height='10px'/>  1 to 20<br>\
															<img src='img/skybluesquare.png' height='10px'/> 21 to 40<br>\
															<img src='img/brightgreensquare.png' height='10px'/> 41 to 60<br>\
															<img src='img/purplesquare.png' height='10px'/> 61 to 80<br>\
															<img src='img/orangesquare.png' height='10px'/> 81 to 100";
								var amountIn = data.coords[key][app.payload.property];
								switch (true) {
									case (amountIn <= 0): // LESS THAN OR EQUAL TO 0
										colorSelector = 0;
										newzIndex = 0;
										break;
									case (amountIn > 0 && amountIn < 21): // BETWEEN 0 AND 21
										colorSelector = 1;
										newzIndex = 1;
										break;
									case (amountIn > 20 && amountIn < 41): // BETWEEN 21 AND 40
										colorSelector = 2;
										newzIndex = 2;
										break;
									case (amountIn > 40 && amountIn < 61): // BETWEEN 41 AND 60
										colorSelector = 3;
										newzIndex = 3;
										break;
									case (amountIn > 60 && amountIn < 81): // BETWEEN 61 AND 80
										colorSelector = 4;
										newzIndex = 4;
										break;
									case (amountIn > 80 && amountIn < 101): // BETWEEN 81 AND 100
										colorSelector = 5;
										newzIndex = 5;
										break;
								}
							}else if(app.payload.table == "chconsistence_r"){
								var description = data.coords[key][app.payload.property];

								if(app.payload.property == "plasticity"){
									legendText = "<img src='img/graysquare.png' height='10px'/> 0 or NULL or Empty String<br>\
																<img src='img/redsquare.png' height='10px'/>  Moderately Plastic<br>\
																<img src='img/skybluesquare.png' height='10px'/> Nonplastic<br>\
																<img src='img/brightgreensquare.png' height='10px'/> Slightly Plastic<br>\
																<img src='img/purplesquare.png' height='10px'/> Very Plastic";
								}

								if(app.payload.property == "stickiness"){
									legendText = "<img src='img/graysquare.png' height='10px'/> 0 or NULL or Empty String<br>\
																<img src='img/redsquare.png' height='10px'/>  Moderately Sticky<br>\
																<img src='img/skybluesquare.png' height='10px'/> Non Sticky<br>\
																<img src='img/brightgreensquare.png' height='10px'/> Slightly Sticky<br>\
																<img src='img/purplesquare.png' height='10px'/> Very Sticky";
								}

								if(app.payload.property == "rupresplate"){
									legendText = "<img src='img/graysquare.png' height='10px'/> 0 or NULL or Empty String<br>\
																<img src='img/redsquare.png' height='10px'/> Very Weak";
								}

								if(app.payload.property == "rupresblkmst"){
									legendText = "<img src='img/graysquare.png' height='10px'/> 0 or NULL or Empty String<br>\
																<img src='img/redsquare.png' height='10px'/>  Extremely Firm<br>\
																<img src='img/skybluesquare.png' height='10px'/> Firm<br>\
																<img src='img/brightgreensquare.png' height='10px'/> Friable<br>\
																<img src='img/purplesquare.png' height='10px'/> Loose<br>\
																<img src='img/orangesquare.png' height='10px'/> Very Firm<br>\
																<img src='img/brightpinksquare.png' height='10px'/> Very Friable";
								}

								if(app.payload.property == "rupresblkdry"){
									legendText = "<img src='img/graysquare.png' height='10px'/> 0 or NULL or Empty String<br>\
																<img src='img/redsquare.png' height='10px'/>  Extremely Hard<br>\
																<img src='img/skybluesquare.png' height='10px'/> Hard<br>\
																<img src='img/brightgreensquare.png' height='10px'/> Hard When Dry<br>\
																<img src='img/purplesquare.png' height='10px'/> Loose<br>\
																<img src='img/orangesquare.png' height='10px'/> Moderately Hard<br>\
																<img src='img/brightpinksquare.png' height='10px'/> Rigid<br>\
																<img src='img/navybluesquare.png' height='10px'/> Slightly Hard<br>\
																<img src='img/lilacsquare.png' height='10px'/> Soft<br>\
																<img src='img/yellowsquare.png' height='10px'/> Very Hard";
								}

								if(app.payload.property == "rupresblkcem"){
									legendText = "<img src='img/graysquare.png' height='10px'/> 0 or NULL or Empty String<br>\
																<img src='img/redsquare.png' height='10px'/>  Extremely Weakly Cemented<br>\
																<img src='img/skybluesquare.png' height='10px'/> Indurated<br>\
																<img src='img/brightgreensquare.png' height='10px'/> Moderately Cemented<br>\
																<img src='img/purplesquare.png' height='10px'/> Noncemented<br>\
																<img src='img/orangesquare.png' height='10px'/> Strongly Cemented<br>\
																<img src='img/brightpinksquare.png' height='10px'/> Very Strongly Cemented<br>\
																<img src='img/navybluesquare.png' height='10px'/> Weakly Cemented";
								}

								if(app.payload.property == "mannerfailure"){
									legendText = "<img src='img/graysquare.png' height='10px'/> 0 or NULL or Empty String<br>\
																<img src='img/redsquare.png' height='10px'/>  Brittle<br>\
																<img src='img/skybluesquare.png' height='10px'/> Deformable<br>\
																<img src='img/brightgreensquare.png' height='10px'/> Moderately Fluid<br>\
																<img src='img/purplesquare.png' height='10px'/> Nonfluid<br>\
																<img src='img/orangesquare.png' height='10px'/> Semideformable<br>\
																<img src='img/brightpinksquare.png' height='10px'/> Slightly Fluid<br>\
																<img src='img/navybluesquare.png' height='10px'/> Very Fluid";
								}


								switch (true) {
									// All properties in chconsistence_r have empty string values, in this case it will be colored and drew on the map
									case (description == ""):
										colorSelector = 0;
										newzIndex = 0;
										break;
									/* Since all properties in chconsistence_r have different descriptions we will group them by colors.
										 For instance, property rupresblkmst hast the following possible values: "" (empty string), Extremely firm,
										 Extremely firm*, Firm, Friable, Loose, Very firm, Very friable. Property rupresblkcem has "" (empty string),
										 Extremely weakly cemented, Indurated, Moderately cemented, Noncemented, Strongly cemented, Very Strongly cemented,
										 and Weakly cemented. So the first (after empty string) possible value for each property will be under the same color.
										 Since we only draw one property at a time this allows us to automate this as much as possible.
										 NOTE: property rupresblkmst has two repeated values with a slight variation (an asterisk); in this case or if it WHERE
										 to occur in another possible value, then just group it within the same condition.
									*/

									case (description == "Extremely firm" || description == "Extremely firm*" || description == "Extremely hard" || description == "Extremely weakly cemented" || description == "Very weak" || description == "Brittle" || description == "Moderately plastic" || description == "Moderately sticky"):
										colorSelector = 1;
										newzIndex = 1;
										break;
									case (description == "Firm" || description == "Hard" || description == "Indurated" || description == "Nonsticky" || description == "Deformable" || description == "Nonplastic"):
										colorSelector = 2;
										newzIndex = 2;
										break;
									case (description == "Friable" || description == "Hard when dry" || description == "Moderately cemented" || description == "Slightly sticky" || description == "Moderately fluid" || description == "Slightly plastic"):
										colorSelector = 3;
										newzIndex = 3;
										break;
									case (description == "Loose" || description == "Loose" || description == "Noncemented" || description == "Very sticky" || description == "Nonfluid" || description == "Very plastic"):
										colorSelector = 4;
										newzIndex = 4;
										break;
									case (description == "Very firm" || description == "Moderately hard" || description == "Strongly cemented" || description == "Semideformable"):
										colorSelector = 5;
										newzIndex = 5;
										break;
									case (description == "Very friable" || description == "Rigid" || description == "Very strongly cemented" || description == "Slightly fluid"):
										colorSelector = 6;
										newzIndex = 6;
										break;
									case (description == "Slightly hard" || description == "Weakly cemented" || description == "Very fluid"):
										colorSelector = 7;
										newzIndex = 7;
										break;
									case (description == "Soft"):
										colorSelector = 8;
										newzIndex = 8;
										break;
									case (description == "Very hard"):
										colorSelector = 9;
										newzIndex = 9;
										break;
								}
							}
							temp = wktFormatter(data.coords[key]['POLYGON']);
							for (var i = 0; i < temp.length; i++) {
								polyCoordis.push(temp[i]);
							}
							var polygon = new google.maps.Polygon({
								description: app.payload.value,
								description_value: data.coords[key][app.payload.property],
								paths: polyCoordis,
								strokeColor: shapeoutline[colorSelector],
								strokeOpacity: 0.8,
								strokeWeight: 2,
								fillColor: shapecolor[colorSelector],
								fillOpacity: 0.35
							});
							polygon.setOptions({ zIndex: newzIndex });
							polygon.addListener('click', polyInfo);

							app.polygons.push(polygon);
							polygon.setMap(app.map);
						}
					}
				}
			}).done(function(data){
				//draw the legend
				var div = document.createElement('div');
				// div.innerHTML = '<img src="img/redsquare.png" height="10px"/> ' + $('#autocomplete').val();;
				div.innerHTML = "<strong>" + $('#autocomplete').val() + "</strong><br>" + legendText;
				var legend = document.getElementById('legend');
				legend.appendChild(div);
			});
		}
		else{
			alert("Please select a property and a district.");
		}
	}
	function setDistrict(){
		app.payload.district = $('#target').children("option:selected").data('district');
		var pointStr = $('#target option:selected').val();
		var coords = pointStr.split(" ");
		panPoint = new google.maps.LatLng(parseFloat(coords[0]), parseFloat(coords[1]));
		app.map.panTo(panPoint);
		app.map.setZoom(10);
	}
	//this is the callback when the map loads
	function initMap() {
		app.map = new google.maps.Map(document.getElementById('map'), {
			zoom: 5,
			center: new google.maps.LatLng(31.31610138349565, -99.11865234375),
			mapTypeId: 'terrain'
		});
		app.infoWindow = new google.maps.InfoWindow;
		/*var testLayer = new google.maps.KmlLayer({ //var testLayer = new google.maps.KmlLayer({ //testing the kml layer, should draw colored lines for a transportation system route in chicago
	  		url: 'https://casoilresource.lawr.ucdavis.edu/soil_web/kml/SoilWeb.kmz', //url: 'https://casoilresource.lawr.ucdavis.edu/soil_web/kml/SoilWeb.kmz', //url: 'http://googlemaps.github.io/js-v2-samples/ggeoxml/cta.kml',
	      map: map
	   });
		testLayer.setMap(app.map); //testing layers 13/03/18*/
		app.map.addListener('click', function(e) {
			// console.log(e.latLng.toString());
		});
		//setDistrict();
	}
	function removePolygons(){
		if(app.polygons){
			for(var i = 0; i < app.polygons.length; i++){
				app.polygons[i].setMap(null);
			}
		}
		app.polygons = [];
		$('#legend').find('*').not('h3').remove();
	}

	function printMaps() { //testing printing a map
      var body               = $('body');
      var mapContainer       = $('#map');
      var mapContainerParent = mapContainer.parent();
      var printContainer     = $('<div>');

      printContainer
        .addClass('print-container')
        .css('position', 'relative')
        .height(mapContainer.height())
        .append(mapContainer)
        .prependTo(body);

      var content = body
        .children()
        .not('script')
        .not(printContainer)
        .detach();


      // Patch for some Bootstrap 3.3.x `@media print` styles. :|
      var patchedStyle = $('<style>')
        .attr('media', 'print')
        .text('img { max-width: none !important; }' +
              'a[href]:after { content: ""; }')
        .appendTo('head');

      window.print();

      body.prepend(content);
      mapContainerParent.prepend(mapContainer);

      printContainer.remove();
      patchedStyle.remove();
    }

	/*
	function insertPolygon(objectId){
	$.get('polygonHandler.php', {'district':objectId}).done(function(data){
	if(data.hasOwnProperty('coords')){
	var polygon = new google.maps.Polygon({
	paths: toLatLngLiteral(data.coords),
	strokeColor: '#FF0000',
	strokeOpacity: 0.8,
	strokeWeight: 2,
	fillColor: '#FF0000',
	fillOpacity: 0.35
});
polygon.setMap(app.map);
google.maps.event.addListener(polygon, 'click', function(e){
app.map.panTo(e.latLng);
app.map.setZoom(15);
});
}
});
}
*/

// ***********

function polyInfo(event){
	text = this.description + ": " + this.description_value;
	app.infoWindow.setContent(text);
	app.infoWindow.setPosition(event.latLng);

	app.infoWindow.open(app.map);
}

function wktFormatter(poly){
	new_poly = poly.slice(9,-2);
	new_poly = new_poly.split("),(");
	len = new_poly.length;
	shape_s = [];
	for (var j = 0; j < len; j++) {
		polyCoordi = [];
		polyTemp = new_poly[j].split(",");
		for(i = 0; i<polyTemp.length; i++){
			temp = polyTemp[i].split(" ");
			polyCoordi.push({lat: parseFloat(temp[1]), lng: parseFloat(temp[0])});
		}
		shape_s[j] = polyCoordi;
	}
	return shape_s;
}

// ***********
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY0B3_Fr1vRpgJDdbvNmrVyXmoOOtiq64&callback=initMap"></script>
</body>
</html>
