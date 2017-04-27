<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>TX-IMSC</title>
	<!-- Interactive Map for Soil Categorization -->

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">


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
							</div> <br>
							<label> Depth: </label> <br>
							<p> Top = <input type="text" value="" id="depth_top" placeholder="...inches" style="color: black;"></p>
							<p> Bottom = <input type="text" value="" id="depth_bottom" placeholder="...inches" style="color: black;"></p>
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
				<!--<div id="legend"> -->
				<!--<h3>Legend</h3> -->
				<div id="legend" style='visibility: hidden'>
					<h3 style="text-align: center;">Legend: </h3>
					<div>
						<!-- just for division -->
					</div>
				</div>
			</div> <!-- end for class "col-md-3" -->
			<div class="col-md-9">
				<div id="description">
				</div>
			</div>
		</div>
	</div>
	<p></p>
	<!--Description text, TESTING scrollable autocomplete-->
	<div class="row">
        <div class="ui-widget">
          <label for="tags">Tags: </label>
          <input id="tags">
        </div>
	</div>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.autocomplete.min.js"></script> <!--este es el causante-->
	<script src="js/properties.js"></script>

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



	<script>
	/* want to modify search method to dropdown
	<div> <p> </p> </div> <!--separate-->
	<div class="row"> <!--search-->
		<label> Search: </label>
	</div>
	<div class="row"> <!--search-->
		<div class="input-group">
			<span class="input-group-addon glyphicon glyphicon-search" id="basic-addon"></span>
			<select type="text" class="form-control" placeholder="Ground Property" aria-describedby="basic-addon" id="autocomplete" autocomplete="off">
				<option value="gypsum_r">
					Gypsum
				</option>
			</select>
		</div>
	</div>
	<div> <p> </p> </div> <!--separate-->
	*/

	/* original search method
	<div class="row"> <!--search-->
		<label> Search: </label>
	</div>
	<div class="row"> <!--search-->
		<div class="input-group">
			<span class="input-group-addon glyphicon glyphicon-search" id="basic-addon"></span>
			<input type="text" class="form-control" placeholder="Ground Property" aria-describedby="basic-addon" id="autocomplete" autocomplete="off">
		</div>
	</div>
	*/
	var app = {map:null, polygons:null, payload:{getMode:"polygons", property:null, district:null}};
	//var suggested = all the aliases of the properties, note: not all properties have an alias




	$(document).ready(function(){//esto pasa recien cargada la pagina
		//start here, get the properties

		$.post('polygonHandler.php', {'columns': true}, function(result){//esto pasa recien cargada la pagina tambien

			//do stuff with the result
			var properties;
			if(result.hasOwnProperty('columns')){
				properties = $.map(result.columns, function(val, i){
					return {value: val[2], data: val[1], table: val[3]};
				});
			}

      var test = [
        "ActionScript",
        "AppleScript",
        "BabyScript",
        "JesusScript",
        "LolScript",
        "Asp",
        "BASIC",
        "C",
        "C++",
        "Clojure",
        "COBOL",
        "ColdFusion",
        "Erlang",
        "Fortran",
        "Groovy",
        "Haskell",
        "Java",
        "JavaScript",
        "Lisp",
        "Perl",
        "PHP",
        "Python",
        "Ruby",
        "Scala",
        "Scheme"
      ];

      $('#tags').autocomplete({
				source: test,
        autoFocus: true,
        delay: 2,
        minLength: 2
				/*onSelect: function (suggestion) {
					//console.log(suggestion.data + "  " + suggestion.table + "  " + suggestion.value);
					app.payload.property = suggestion.data;
					app.payload.table = suggestion.table;
					app.payload.value = suggestion.value;
				}*/
			});


			//create the autocomplete with the data
			$('#autocomplete').autocomplete({
				source: properties,
				select: function(properties, ui){
					console.log(properties.data + "  " + ui.table + "  " + event.value);
					app.payload.property = suggestion.data;
					app.payload.table = suggestion.table;
					app.payload.value = suggestion.value;
				}
				/*
				onSelect: function (suggestion) {
					console.log(suggestion.data + "  " + suggestion.table + "  " + suggestion.value);
					app.payload.property = suggestion.data;
					app.payload.table = suggestion.table;
					app.payload.value = suggestion.value;
				}*/
			});

			$('#target').on('change', setDistrict);

		});
		app.payload.district = $('#target').children("option:selected").data('district');
	});
	function getPolygons(){//this is run button

		//Ricardo
		//Valores de depth top y depth bottom
		var depth_t = document.getElementById("depth_top").value;

		var depth_b = document.getElementById("depth_bottom").value;



		if(app.payload.property){//to make sure a property is selected
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
					//               0           1           2          3          4         5          6           7         8          9
					//              GRAY,       RED,     SKY BLUE, BRIGHT GREEN, PURPLE,   ORANGE,  BRIGHT PINK,NAVY BLUE,  LILAC,     YELLOW
					shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
					shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
					colorSelector = 0;
					newzIndex = 0;
					legendText = "";
					for(key in data.coords){
						if(data.coords.hasOwnProperty(key)){
							var polyCoordis = [];
							if(app.payload.table == "chorizon_r"){
								//console.log("Testing new legend: "+app.payload.property);
								if(app.payload.property == "caco3_r"){ //Testing legend and logic for drawing for this specific property
									//console.log(app.payload.property);
									//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
									//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
									//colorSelector = 0;
									//newzIndex = 0;
									legendText = "<img src='img/graysquare.png' height='10px'/> <= 7<br>\
									<img src='img/redsquare.png' height='10px'/>  > 7 and <= 17<br>\
									<img src='img/skybluesquare.png' height='10px'/> > 17 and <= 36<br>\
									<img src='img/brightgreensquare.png' height='10px'/> > 36 and <= 55<br>\
									<img src='img/purplesquare.png' height='10px'/> > 55 and <= 65<br>\
									<img src='img/whitesquare.png' height='10px'/> Not rated or not available";
									var amountIn = parseFloat(data.coords[key][app.payload.property]);
									//console.log(amountIn);
									//var amountIn = data.coords[key][app.payload.property];
									//console.log(amountIn);
									switch (true) {
										case (amountIn <= 7): // LESS THAN OR EQUAL TO 0
										colorSelector = 1; //not black or gray
										newzIndex = 1;
										break;
										case (amountIn > 7 && amountIn <= 17): // BETWEEN 0 AND 21
										colorSelector = 2;
										newzIndex = 2;
										break;
										case (amountIn > 17 && amountIn <= 36): // BETWEEN 21 AND 40
										colorSelector = 3;
										newzIndex = 3;
										break;
										case (amountIn > 36 && amountIn <= 55): // BETWEEN 41 AND 60
										colorSelector = 4;
										newzIndex = 4;
										break;
										case (amountIn > 55 && amountIn <= 65): // BETWEEN 61 AND 80
										colorSelector = 5;
										newzIndex = 5;
										break;
										case (amountIn > 80 && amountIn < 101): // BETWEEN 81 AND 100
										colorSelector = 6;
										newzIndex = 6;
										break;
									}
								}
								else if(app.payload.property == "sandtotal_r"){ //Testing legend and logic for drawing for this specific property
									//console.log(app.payload.property);
									//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
									//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
									//colorSelector = 0;
									//newzIndex = 0;
									legendText = "<img src='img/graysquare.png' height='10px'/> <= 11.8<br>\
									<img src='img/redsquare.png' height='10px'/>  > 11.8 and <= 26.1<br>\
									<img src='img/skybluesquare.png' height='10px'/> > 26.1 and <= 39.3<br>\
									<img src='img/purplesquare.png' height='10px'/> > 39.3 and <= 57.8<br>\
									<img src='img/whitesquare.png' height='10px'/> > 57.8 and <= 90.2<br>\
									<img src='img/blacksquare.png height='10px'/> Not rated or not available ";
									var amountIn = parseFloat(data.coords[key][app.payload.property]);
									//console.log(amountIn);
									//var amountIn = data.coords[key][app.payload.property];
									//console.log(amountIn);
									switch (true) {
										case (amountIn <= 11.8): // LESS THAN OR EQUAL TO 0
										colorSelector = 1; //not black or gray
										newzIndex = 1;
										break;
										case (amountIn > 11.8 && amountIn <= 26.1): // BETWEEN 0 AND 21
										colorSelector = 2;
										newzIndex = 2;
										break;
										case (amountIn > 26.1 && amountIn <= 39.3): // BETWEEN 21 AND 40
										colorSelector = 3;
										newzIndex = 3;
										break;
										case (amountIn > 39.3 && amountIn <= 57.8): // BETWEEN 41 AND 60
										colorSelector = 4;
										newzIndex = 4;
										break;
										case (amountIn > 57.8 && amountIn <= 90.2): // BETWEEN 61 AND 80
										colorSelector = 5;
										newzIndex = 5;
										break;
										default: // BETWEEN 81 AND 100
										colorSelector = 6;
										newzIndex = 6;
										break;
									}
								}
								else if(app.payload.property == "gypsum_r"){ //Testing legend and logic for drawing for this specific property
									//console.log(app.payload.property);
									//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
									//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
									//colorSelector = 0;
									//newzIndex = 0;
									legendText = "<img src='img/graysquare.png' height='10px'/> <= 0<br>\
									<img src='img/redsquare.png' height='10px'/>  > 0 and <= 1<br>\
									<img src='img/skybluesquare.png' height='10px'/> > 1 and <= 2<br>\
									<img src='img/purplesquare.png' height='10px'/> > 2 and <= 3<br>\
									<img src='img/blacksquare.png height='10px'/> Not rated or not available ";
									var amountIn = parseFloat(data.coords[key][app.payload.property]);
									//console.log(amountIn);
									//var amountIn = data.coords[key][app.payload.property];
									//console.log(amountIn);
									switch (true) {
										case (amountIn <= 0): // LESS THAN OR EQUAL TO 0
										colorSelector = 1; //not black or gray
										newzIndex = 1;
										break;
										case (amountIn > 0 && amountIn <= 1): // BETWEEN 0 AND 21
										colorSelector = 2;
										newzIndex = 2;
										break;
										case (amountIn > 1 && amountIn <= 2): // BETWEEN 21 AND 40
										colorSelector = 3;
										newzIndex = 3;
										break;
										case (amountIn > 2 && amountIn <= 3): // BETWEEN 41 AND 60
										colorSelector = 4;
										newzIndex = 4;
										break;
										default: // Not rated
										colorSelector = 5;
										newzIndex = 5;
										break;
									}
								}
								else if(app.payload.property == "pi_r"){ //Testing legend and logic for drawing for this specific property
									//console.log(app.payload.property);
									//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
									//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
									//colorSelector = 0;
									//newzIndex = 0;
									legendText = "<img src='img/redsquare.png' height='10px'/> <= 9.4<br>\
									<img src='img/skybluesquare.png' height='10px'/>  > 9.4 and <= 21.0<br>\
									<img src='img/brightgreensquare.png' height='10px'/> > 21.0 and <= 30.6<br>\
									<img src='img/purplesquare.png' height='10px'/> > 30.6 and <= 37.5<br>\
									<img src='img/orangesquare.png' height='10px'/> > 37.5 and <= 54.1<br>\
									<img src='img/graysquare.png height='10px'/> Not rated or not available ";
									// GRAY, RED, SKY BLUE, BRIGHT GREEN, PURPLE, ORANGE, BRIGHT PINK, NAVY BLUE, LILAC, YELLOW
									var amountIn = parseFloat(data.coords[key][app.payload.property]);
									//
									//console.log(amountIn);
									//var amountIn = data.coords[key][app.payload.property];
									//console.log(amountIn);
									switch (true) {
										case (amountIn <= 9.4): // LESS THAN OR EQUAL TO 0
										colorSelector = 1; //red
										newzIndex = 1;
										break;
										case (amountIn > 9.4 && amountIn <= 21.0): // BETWEEN 0 AND 21
										colorSelector = 2; //skybluesquare
										newzIndex = 2;
										break;
										case (amountIn > 21.0 && amountIn <= 30.6): // BETWEEN 21 AND 40
										colorSelector = 3; //brightgreensquare
										newzIndex = 3;
										break;
										case (amountIn > 30.6 && amountIn <= 37.5): // BETWEEN 41 AND 60
										colorSelector = 4; //purplesquare
										newzIndex = 4;
										break;
										case (amountIn > 37.5 && amountIn <= 54.1): // BETWEEN 41 AND 60
										colorSelector = 5; //orangesquare
										newzIndex = 5;
										break;
										default: // Not rated
										colorSelector = 0; //gray
										newzIndex = 0;
										break;
									}
								}
								else if(app.payload.property == "sar_r"){ //Testing legend and logic for drawing for this specific property
									//console.log(app.payload.property);
									//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
									//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
									//colorSelector = 0;
									//newzIndex = 0;
									legendText = "<img src='img/graysquare.png' height='10px'/> <= 0.3<br>\
									<img src='img/redsquare.png' height='10px'/>  > 0.3 and <= 0.9<br>\
									<img src='img/skybluesquare.png' height='10px'/> > 0.9 and <= 1.8<br>\
									<img src='img/purplesquare.png' height='10px'/> > 1.8 and <= 5.9<br>\
									<img src='img/orangesquare.png' height='10px'/> > 5.9 and <= 17.5<br>\
									<img src='img/blacksquare.png height='10px'/> Not rated or not available ";
									var amountIn = parseFloat(data.coords[key][app.payload.property]);
									//console.log(amountIn);
									//var amountIn = data.coords[key][app.payload.property];
									//console.log(amountIn);
									switch (true) {
										case (amountIn <= 0.3): // LESS THAN OR EQUAL TO 0
										colorSelector = 1; //not black or gray
										newzIndex = 1;
										break;
										case (amountIn > 0.9 && amountIn <= 1.8): // BETWEEN 0 AND 21
										colorSelector = 2;
										newzIndex = 2;
										break;
										case (amountIn > 1.8 && amountIn <= 5.9): // BETWEEN 21 AND 40
										colorSelector = 3;
										newzIndex = 3;
										break;
										case (amountIn > 5.9 && amountIn <= 17.5): // BETWEEN 41 AND 60
										colorSelector = 4;
										newzIndex = 4;
										break;
										default: // Not rated
										colorSelector = 5;
										newzIndex = 5;
										break;
									}
								}
								else if(app.payload.property == "ksat_r"){ //Testing legend and logic for drawing for this specific property
									//console.log(app.payload.property);
									//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
									//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
									//colorSelector = 0;
									//newzIndex = 0;
									legendText = "<img src='img/graysquare.png' height='10px'/> Very Low (0.0 - 0.01)<br>\
									<img src='img/redsquare.png' height='10px'/>  Low (0.01 - 0.1)<br>\
									<img src='img/skybluesquare.png' height='10px'/> Moderately Low (0.1 - 1)<br>\
									<img src='img/purplesquare.png' height='10px'/> Moderately High (1 - 10)<br>\
									<img src='img/orangesquare.png' height='10px'/> High (10 - 100)<br>\
									<img src='img/whitesquare.png' height='10px'/> Very High (100 - 705)<br>\
									<img src='img/blacksquare.png height='10px'/> Not rated or not available ";
									var amountIn = parseFloat(data.coords[key][app.payload.property]);
									//console.log(amountIn);
									//var amountIn = data.coords[key][app.payload.property];
									//console.log(amountIn);
									switch (true) {
										case (amountIn > 0.0 && amountIn <= 0.01): // LESS THAN OR EQUAL TO 0
										colorSelect = 2;
										newzIndex = 2;
										break;
										case (amountIn > 0.01 && amountIn <= 0.1): // BETWEEN 21 AND 40
										colorSelector = 3;
										newzIndex = 3;
										break;
										case (amountIn > 0.1 && amountIn <= 1): // BETWEEN 41 AND 60
										colorSelector = 4;
										newzIndex = 4;
										break;
										case (amountIn > 1 && amountIn <= 10): // BETWEEN 41 AND 60
										colorSelector = 5;
										newzIndex = 5;
										break;
										case (amountIn > 10 && amountIn <= 100): // BETWEEN 41 AND 60
										colorSelector = 6;
										newzIndex = 6;
										break;
										case (amountIn > 100 && amountIn <= 705): // BETWEEN 41 AND 60
										colorSelector = 7;
										newzIndex = 7;
										break;
										default: // Not rated
										colorSelector = 8;
										newzIndex = 8;
										break;
									}
								}
								else if(app.payload.property == "sandfine_r"){ //Testing legend and logic for drawing for this specific property
									//console.log(app.payload.property);
									//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
									//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
									//colorSelector = 0;
									//newzIndex = 0;
									legendText = "<img src='img/graysquare.png' height='10px'/> <br>\
									<img src='img/redsquare.png' height='10px'/> <br>\
									<img src='img/skybluesquare.png' height='10px'/> <br>\
									<img src='img/purplesquare.png' height='10px'/> <br>\
									<img src='img/orangesquare.png' height='10px'/> <br>\
									<img src='img/whitesquare.png' height='10px'/> <br>\
									<img src='img/blacksquare.png height='10px'/> Not rated or not available ";
									var amountIn = parseFloat(data.coords[key][app.payload.property]);
									//console.log(amountIn);
									//var amountIn = data.coords[key][app.payload.property];
									//console.log(amountIn);
									switch (true) {
										case (amountIn > 0.0 && amountIn <= 0.01): // LESS THAN OR EQUAL TO 0
										colorSelect = 2;
										newzIndex = 2;
										break;
										case (amountIn > 0.01 && amountIn <= 0.1): // BETWEEN 21 AND 40
										colorSelector = 3;
										newzIndex = 3;
										break;
										case (amountIn > 0.1 && amountIn <= 1): // BETWEEN 41 AND 60
										colorSelector = 4;
										newzIndex = 4;
										break;
										case (amountIn > 1 && amountIn <= 10): // BETWEEN 41 AND 60
										colorSelector = 5;
										newzIndex = 5;
										break;
										case (amountIn > 10 && amountIn <= 100): // BETWEEN 41 AND 60
										colorSelector = 6;
										newzIndex = 6;
										break;
										case (amountIn > 100 && amountIn <= 705): // BETWEEN 41 AND 60
										colorSelector = 7;
										newzIndex = 7;
										break;
										default: // Not rated
										colorSelector = 8;
										newzIndex = 8;
										break;
									}
								}
								else if(app.payload.property == "ph1to1h2o_r"){ //Testing legend and logic for drawing for this specific property
									//console.log(app.payload.property);
									//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
									//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
									//colorSelector = 0;
									//newzIndex = 0;
									legendText = "<img src='img/graysquare.png' height='10px'/> Ultra acid (ph < 3.5)<br>\
									<img src='img/redsquare.png' height='10px'/> Extremely acid (ph 3.5 - 4.4)<br>\
									<img src='img/skybluesquare.png' height='10px'/> Very strongly acid (ph 4.5 - 5.0)<br>\
									<img src='img/purplesquare.png' height='10px'/> Strongly acid (ph 5.1 - 5.5)<br>\
									<img src='img/orangesquare.png' height='10px'/> Moderately acid (ph 5.6 - 6.0)<br>\
									<img src='img/whitesquare.png' height='10px'/> Slightly acid (ph 6.1 - 6.5)<br>\
									<img src='img/greensquare.png' height='10px'/> Neutral (ph 6.6 - 7.3)<br>\
									<img src='img/yellowsquare.png' height='10px'/> Slightly alkaline (ph 7.4 - 7.8)<br>\
									<img src='img/pinksquare.png' height='10px'/> Moderately alkaline (ph 7.9 - 8.4)<br>\
									<img src='img/maroonsquare.png' height='10px'/> Strongly alkaline (ph 8.5 - 9.0)<br>\
									<img src='img/bluesquare.png' height='10px'/> Very strongly alkaline (ph > 9.0)<br>\
									<img src='img/blacksquare.png height='10px'/> Not rated or not available ";
									var amountIn = parseFloat(data.coords[key][app.payload.property]);
									//console.log(amountIn);
									//var amountIn = data.coords[key][app.payload.property];
									//console.log(amountIn);
									switch (true) {
										case (amountIn < 3.5): // LESS THAN OR EQUAL TO 0
										colorSelect = 2;
										newzIndex = 2;
										break;
										case (amountIn >= 3.5 && amountIn <= 4.4): // BETWEEN 21 AND 40
										colorSelector = 3;
										newzIndex = 3;
										break;
										case (amountIn >= 4.5 && amountIn <= 5.0): // BETWEEN 41 AND 60
										colorSelector = 4;
										newzIndex = 4;
										break;
										case (amountIn >= 5.1 && amountIn <= 5.5): // BETWEEN 41 AND 60
										colorSelector = 5;
										newzIndex = 5;
										break;
										case (amountIn >= 5.6 && amountIn <= 6.0): // BETWEEN 41 AND 60
										colorSelector = 6;
										newzIndex = 6;
										break;
										case (amountIn >= 6.1 && amountIn <= 6.5): // BETWEEN 41 AND 60
										colorSelector = 7;
										newzIndex = 7;
										break;
										case (amountIn >= 6.6 && amountIn <= 7.3): // BETWEEN 41 AND 60
										colorSelector = 8;
										newzIndex = 8;
										break;
										case (amountIn >= 7.4 && amountIn <= 7.8): // BETWEEN 41 AND 60
										colorSelector = 9;
										newzIndex = 9;
										break;
										case (amountIn >= 7.9 && amountIn <= 8.4): // BETWEEN 41 AND 60
										colorSelector = 10;
										newzIndex = 10;
										break;
										case (amountIn >= 8.5 && amountIn <= 9.0): // BETWEEN 41 AND 60
										colorSelector = 11;
										newzIndex = 11;
										break;
										case (amountIn > 9.0 ): // BETWEEN 41 AND 60
										colorSelector = 12;
										newzIndex = 12;
										break;
										default: // Not rated
										colorSelector = 13;
										newzIndex = 13;
										break;
									}
								}
								else if(app.payload.property == "aashind_r"){ //Testing legend and logic for drawing for this specific property
									//console.log(app.payload.property);
									//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
									//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
									//colorSelector = 0;
									//newzIndex = 0;
									legendText = "<img src='img/graysquare.png' height='10px'/> A-1<br>\
									<img src='img/redsquare.png' height='10px'/> A-1-a<br>\
									<img src='img/skybluesquare.png' height='10px'/> A-1-b<br>\
									<img src='img/purplesquare.png' height='10px'/> A-b<br>\
									<img src='img/orangesquare.png' height='10px'/> A-2<br>\
									<img src='img/whitesquare.png' height='10px'/> A-2-4<br>\
									<img src='img/greensquare.png' height='10px'/> A-2-5<br>\
									<img src='img/yellowsquare.png' height='10px'/> A-2-6<br>\
									<img src='img/pinksquare.png' height='10px'/> A-2-7<br>\
									<img src='img/maroonsquare.png' height='10px'/> A-3<br>\
									<img src='img/bluesquare.png' height='10px'/> A-4<br>\
									<img src='img/bluesquare.png' height='10px'/> A-5<br>\
									<img src='img/bluesquare.png' height='10px'/> A-6<br>\
									<img src='img/bluesquare.png' height='10px'/> A-7<br>\
									<img src='img/bluesquare.png' height='10px'/> A-7-5<br>\
									<img src='img/bluesquare.png' height='10px'/> A-7-6<br>\
									<img src='img/bluesquare.png' height='10px'/> A-8<br>\
									<img src='img/blacksquare.png height='10px'/> Not rated or not available ";
									var amountIn = parseFloat(data.coords[key][app.payload.property]);
									//console.log(amountIn);
									//var amountIn = data.coords[key][app.payload.property];
									//console.log(amountIn);
									switch (true) {
										case (amountIn == "A-1-a"): // LESS THAN OR EQUAL TO 0
										colorSelect = 2;
										newzIndex = 2;
										break;
										case (amountIn == "A-1-b"): // BETWEEN 21 AND 40
										colorSelector = 3;
										newzIndex = 3;
										break;
										case (amountIn == "A-b"): // BETWEEN 41 AND 60
										colorSelector = 4;
										newzIndex = 4;
										break;
										case (amountIn == "A-2"): // BETWEEN 41 AND 60
										colorSelector = 5;
										newzIndex = 5;
										break;
										case (amountIn == "A-2-4"): // BETWEEN 41 AND 60
										colorSelector = 6;
										newzIndex = 6;
										break;
										case (amountIn == "A-2-5"): // BETWEEN 41 AND 60
										colorSelector = 7;
										newzIndex = 7;
										break;
										case (amountIn == "A-2-6"): // BETWEEN 41 AND 60
										colorSelector = 8;
										newzIndex = 8;
										break;
										case (amountIn == "A-2-7"): // BETWEEN 41 AND 60
										colorSelector = 9;
										newzIndex = 9;
										break;
										case (amountIn == "A-3"): // BETWEEN 41 AND 60
										colorSelector = 10;
										newzIndex = 10;
										break;
										case (amountIn == "A-4"): // BETWEEN 41 AND 60
										colorSelector = 11;
										newzIndex = 11;
										break;
										case (amountIn == "A-5" ): // BETWEEN 41 AND 60
										colorSelector = 12;
										newzIndex = 12;
										break;
										case (amountIn == "A-6" ): // BETWEEN 41 AND 60
										colorSelector = 13;
										newzIndex = 13;
										break;
										case (amountIn == "A-7" ): // BETWEEN 41 AND 60
										colorSelector = 14;
										newzIndex = 14;
										break;
										case (amountIn == "A-7-5" ): // BETWEEN 41 AND 60
										colorSelector = 15;
										newzIndex = 15;
										break;
										case (amountIn == "A-7-6" ): // BETWEEN 41 AND 60
										colorSelector = 16;
										newzIndex = 16;
										break;
										case (amountIn == "A-8" ): // BETWEEN 41 AND 60
										colorSelector = 17;
										newzIndex = 17;
										break;
										default: // Not rated
										colorSelector = 18;
										newzIndex = 18;
										break;
									}
								}
								else if(app.payload.property == "ll_r"){ //Testing legend and logic for drawing for this specific property
									//console.log(app.payload.property);
									//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
									//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
									//colorSelector = 0;
									//newzIndex = 0;
									legendText = "<img src='img/graysquare.png' height='10px'/> <= 27.2<br>\
									<img src='img/redsquare.png' height='10px'/> > 27.2 and <= 45.8<br>\
									<img src='img/skybluesquare.png' height='10px'/> > 45.8 and <= 58.0<br>\
									<img src='img/purplesquare.png' height='10px'/> > 58.0 and <= 66.0<br>\
									<img src='img/orangesquare.png' height='10px'/> > 66.0 and <= 75.7<br>\
									<img src='img/blacksquare.png height='10px'/> Not rated or not available ";
									var amountIn = parseFloat(data.coords[key][app.payload.property]);
									//console.log(amountIn);
									//var amountIn = data.coords[key][app.payload.property];
									//console.log(amountIn);
									switch (true) {
										case (amountIn <= 27.2): // LESS THAN OR EQUAL TO 0
										colorSelect = 2;
										newzIndex = 2;
										break;
										case (amountIn > 27.2 && amountIn <= 45.8): // BETWEEN 21 AND 40
										colorSelector = 3;
										newzIndex = 3;
										break;
										case (amountIn > 45.8 && amountIn <= 58.0): // BETWEEN 41 AND 60
										colorSelector = 4;
										newzIndex = 4;
										break;
										case (amountIn > 58.0 && amountIn <= 66.0): // BETWEEN 41 AND 60
										colorSelector = 5;
										newzIndex = 5;
										break;
										case (amountIn > 66.0 && amountIn <= 75.7): // BETWEEN 41 AND 60
										colorSelector = 6;
										newzIndex = 6;
										break;
										default: // Not rated
										colorSelector = 13;
										newzIndex = 13;
										break;
									}
								}
								else if(app.payload.property == "kffact" || app.payload.property == "kwfact" ){ //Testing legend and logic for drawing for this specific property
									//console.log(app.payload.property);
									//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
									//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
									//colorSelector = 0;
									//newzIndex = 0;
									legendText = "<img src='img/graysquare.png' height='10px'/> .02<br>\
									<img src='img/redsquare.png' height='10px'/> .05<br>\
									<img src='img/skybluesquare.png' height='10px'/> .10<br>\
									<img src='img/purplesquare.png' height='10px'/> .15<br>\
									<img src='img/orangesquare.png' height='10px'/> .17<br>\
									<img src='img/whitesquare.png' height='10px'/> .20<br>\
									<img src='img/greensquare.png' height='10px'/> .24<br>\
									<img src='img/yellowsquare.png' height='10px'/> .28<br>\
									<img src='img/pinksquare.png' height='10px'/> .32<br>\
									<img src='img/maroonsquare.png' height='10px'/> .37<br>\
									<img src='img/bluesquare.png' height='10px'/> .43<br>\
									<img src='img/bluesquare.png' height='10px'/> .49<br>\
									<img src='img/bluesquare.png' height='10px'/> .55<br>\
									<img src='img/bluesquare.png' height='10px'/> .64<br>\
									<img src='img/blacksquare.png height='10px'/> Not rated or not available ";
									var amountIn = parseFloat(data.coords[key][app.payload.property]);
									//console.log(amountIn);
									//var amountIn = data.coords[key][app.payload.property];
									//console.log(amountIn);
									switch (true) {
										case (amountIn <= 0.02): // LESS THAN OR EQUAL TO 0
										colorSelect = 2;
										newzIndex = 2;
										break;
										case (amountIn <= 0.05): // BETWEEN 21 AND 40
										colorSelector = 3;
										newzIndex = 3;
										break;
										case (amountIn <= .10): // BETWEEN 41 AND 60
										colorSelector = 4;
										newzIndex = 4;
										break;
										case (amountIn <= .15): // BETWEEN 41 AND 60
										colorSelector = 5;
										newzIndex = 5;
										break;
										case (amountIn <= .17): // BETWEEN 41 AND 60
										colorSelector = 6;
										newzIndex = 6;
										break;
										case (amountIn <= .20): // BETWEEN 41 AND 60
										colorSelector = 7;
										newzIndex = 7;
										break;
										case (amountIn <= .24): // BETWEEN 41 AND 60
										colorSelector = 8;
										newzIndex = 8;
										break;
										case (amountIn <= 0.28): // BETWEEN 41 AND 60
										colorSelector = 9;
										newzIndex = 9;
										break;
										case (amountIn <= 0.32): // BETWEEN 41 AND 60
										colorSelector = 10;
										newzIndex = 10;
										break;
										case (amountIn <= 0.37): // BETWEEN 41 AND 60
										colorSelector = 11;
										newzIndex = 11;
										break;
										case (amountIn <= 0.43): // BETWEEN 41 AND 60
										colorSelector = 12;
										newzIndex = 12;
										break;
										case (amountIn <= 0.49): // BETWEEN 41 AND 60
										colorSelector = 13;
										newzIndex = 13;
										break;
										case (amountIn <= 0.55): // BETWEEN 41 AND 60
										colorSelector = 14;
										newzIndex = 14;
										break;
										case (amountIn <= 0.64): // BETWEEN 41 AND 60
										colorSelector = 15;
										newzIndex = 15;
										break;
										default: // Not rated
										colorSelector = 16;
										newzIndex = 16;
										break;
									}
								}
								else if(app.payload.property == "ph01mcacl2_r"){ //Testing legend and logic for drawing for this specific property
									//console.log(app.payload.property);
									//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
									//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
									//colorSelector = 0;
									//newzIndex = 0;
									legendText = "<img src='img/graysquare.png' height='10px'/> Ultra acid (ph < 3.5)<br>\
									<img src='img/redsquare.png' height='10px'/> Extremely acid (ph 3.5 - 4.4)<br>\
									<img src='img/skybluesquare.png' height='10px'/> Very strongly acid (ph 4.5 - 5.0)<br>\
									<img src='img/purplesquare.png' height='10px'/> Strongly acid (ph 5.1 - 5.5)<br>\
									<img src='img/orangesquare.png' height='10px'/> Moderately acid (ph 5.6 - 6.0)<br>\
									<img src='img/whitesquare.png' height='10px'/> Slightly acid (ph 6.1 - 6.5)<br>\
									<img src='img/greensquare.png' height='10px'/> Neutral (ph 6.6 - 7.3)<br>\
									<img src='img/yellowsquare.png' height='10px'/> Slightly alkaline (ph 7.4 - 7.8)<br>\
									<img src='img/pinksquare.png' height='10px'/> Moderately alkaline (ph 7.9 - 8.4)<br>\
									<img src='img/maroonsquare.png' height='10px'/> Strongly alkaline (ph 8.5 - 9.0)<br>\
									<img src='img/bluesquare.png' height='10px'/> Very strongly alkaline (ph > 9.0)<br>\
									<img src='img/blacksquare.png height='10px'/> Not rated or not available ";
									var amountIn = parseFloat(data.coords[key][app.payload.property]);
									//console.log(amountIn);
									//var amountIn = data.coords[key][app.payload.property];
									//console.log(amountIn);
									switch (true) {
										case (amountIn < 3.5): // LESS THAN OR EQUAL TO 0
										colorSelect = 2;
										newzIndex = 2;
										break;
										case (amountIn >= 3.5 && amountIn <= 4.4): // BETWEEN 21 AND 40
										colorSelector = 3;
										newzIndex = 3;
										break;
										case (amountIn >= 4.5 && amountIn <= 5.0): // BETWEEN 41 AND 60
										colorSelector = 4;
										newzIndex = 4;
										break;
										case (amountIn >= 5.1 && amountIn <= 5.5): // BETWEEN 41 AND 60
										colorSelector = 5;
										newzIndex = 5;
										break;
										case (amountIn >= 5.6 && amountIn <= 6.0): // BETWEEN 41 AND 60
										colorSelector = 6;
										newzIndex = 6;
										break;
										case (amountIn >= 6.1 && amountIn <= 6.5): // BETWEEN 41 AND 60
										colorSelector = 7;
										newzIndex = 7;
										break;
										case (amountIn >= 6.6 && amountIn <= 7.3): // BETWEEN 41 AND 60
										colorSelector = 8;
										newzIndex = 8;
										break;
										case (amountIn >= 7.4 && amountIn <= 7.8): // BETWEEN 41 AND 60
										colorSelector = 9;
										newzIndex = 9;
										break;
										case (amountIn >= 7.9 && amountIn <= 8.4): // BETWEEN 41 AND 60
										colorSelector = 10;
										newzIndex = 10;
										break;
										case (amountIn >= 8.5 && amountIn <= 9.0): // BETWEEN 41 AND 60
										colorSelector = 11;
										newzIndex = 11;
										break;
										case (amountIn > 9.0 ): // BETWEEN 41 AND 60
										colorSelector = 12;
										newzIndex = 12;
										break;
										default: // Not rated
										colorSelector = 13;
										newzIndex = 13;
										break;
									}
								}
								/*else if{ //another property inside this table (chorizon_r) that handles its own colors and logic
							}*/
							else{ //General legend text for all unspecified propierty
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
								} //end switch
							}//end else statement that handles the general legend for unspecified properties
						}//end the else statement that identifies the table
						else if(app.payload.table == "chconsistence_r"){
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
								// All properties in chconsistence_r have empty string values, in this case it will be colored and drawn on the map
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

						var polygon = new google.maps.Polygon({ //we need another value to determine the key

							description: app.payload.value,
							description_value: data.coords[key][app.payload.property],
							paths: polyCoordis,
							strokeColor: shapeoutline[colorSelector],
							strokeOpacity: 0.18,
							strokeWeight: 2,
							fillColor: shapecolor[colorSelector],
							fillOpacity: 0.18
						});

						polygon.setOptions({ zIndex: newzIndex });
						polygon.addListener('click', polyInfo);
						app.polygons.push(polygon);
						polygon.setMap(app.map);
					}
				}
			}
		}).done(function(data){
			if($('#autocomplete').val() == "Gypsum"){
				var gypsum = "Description for Gypsum: ";
				var gypsumText = "The content of gypsum is the percent, by weight, of hydrated calcium sulfates in the fraction of the soil less than 20 millimeters in size. "; // Gypsum is partially soluble in water. Soils high in content of gypsum, such as those with more than 10 percent gypsum, may collapse if the gypsum is removed by percolating water. Gypsum is corrosive to concrete.
				//For each soil layer, this attribute is actually recorded as three separate values in the database. A low value and a high value indicate the range of this attribute for the soil component. A \"representative\" value indicates the expected value of this attribute for the component. For this soil property, only the representative value is used.";
				var h3 = document.createElement('h3');
				h3.innerHTML = gypsum;
				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + gypsum + "</strong> <br>" + gypsumText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			else if ($('#autocomplete').val() == "PI"){
				var prprty = "Description for Plasticity Index: ";
				var prprtyText = "Plasticity index (PI) is one of the standard Atterberg limits used to indicate the plasticity characteristics of a soil. It is defined as the numerical difference between the liquid limit and plastic limit of the soil. It is the range of water content in which a soil exhibits the characteristics of a plastic solid.";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;
				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			else if ($('#autocomplete').val() == "CaCO3"){
				var prprty = "Description for CaCO3: ";
				var prprtyText = "Calcium carbonate equivalent is the percent of carbonates, by weight, in the fraction of the soil less than 2 millimeters in size. The availability of plant nutrients is influenced by the amount of carbonates in the soil.";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;
				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			else if ($('#autocomplete').val() == "Total Sand"){
				var prprty = "Description for Total Sand: ";
				var prprtyText = "Sand as a soil separate consists of mineral soil particles that are 0.05 millimeter to 2 millimeters in diameter. In the database, the estimated sand content of each soil layer is given as a percentage, by weight, of the soil material that is less than 2 millimeters in diameter. The content of sand, silt, and clay affects the physical behavior of a soil. Particle size is important for engineering and agronomic interpretations, for determination of soil hydrologic qualities, and for soil classification.";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;
				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			else if ($('#autocomplete').val() == "pH H20"){
				var prprty = "Description for pH H20: ";
				var prprtyText = "Soil reaction is a measure of acidity or alkalinity. It is important in selecting crops and other plants, in evaluating soil amendments for fertility and stabilization, and in determining the risk of corrosion.";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;
				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			else if ($('#autocomplete').val() == "Ksat"){
				var prprty = "Description for Ksat: ";
				var prprtyText = "Saturated hydraulic conductivity (Ksat) refers to the ease with which pores in a saturated soil transmit water. The estimates are expressed in terms of micrometers per second. They are based on soil characteristics observed in the field, particularly structure, porosity, and texture. ";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;
				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			/** paste prprtyText here
			*/
			else if ($('#autocomplete').val() == "AASHTO Group Index"){
				var prprty = "Description for AASHTO Group Index: ";
				var prprtyText = "AASHTO group classification is a system that classifies soils specifically for geotechnical engineering purposes that are related to highway and airfield construction. It is based on particle-size distribution and Atterberg limits, such as liquid limit and plasticity index. This classification system is covered in AASHTO Standard No. M 145-82. The classification is based on that portion of the soil that is smaller than 3 inches in diameter.";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;
				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			else if ($('#autocomplete').val() == "pH H2O"){
				var prprty = "Description for ph H2O: ";
				var prprtyText = "Soil reaction is a measure of acidity or alkalinity. It is important in selecting crops and other plants, in evaluating soil amendments for fertility and stabilization, and in determining the risk of corrosion. In general, soils that are either highly alkaline or highly acid are likely to be very corrosive to steel. The most common soil laboratory measurement of pH is the 1:1 water method.";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;
				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			else if ($('#autocomplete').val() == "SAR"){
				var prprty = "Description for Sodium Absortion Ratio (SAR): ";
				var prprtyText = "Sodium adsorption ratio is a measure of the amount of sodium (Na) relative to calcium (Ca) and magnesium (Mg) in the water extract from saturated soil paste. It is the ratio of the Na concentration divided by the square root of one-half of the Ca + Mg concentration. Soils that have SAR values of 13 or more may be characterized by an increased dispersion of organic matter and clay particles, reduced saturated hydraulic conductivity (Ksat) and aeration, and a general degradation of soil structure.";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;
				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			else if ($('#autocomplete').val() == "Kf"){
				var prprty = "Description for K Factor (Rock Free): ";
				var prprtyText = "Erosion factor K indicates the susceptibility of a soil to sheet and rill erosion by water. Factor K is one of six factors used in the Universal Soil Loss Equation (USLE) and the Revised Universal Soil Loss Equation (RUSLE) to predict the average annual rate of soil loss by sheet and rill erosion in tons per acre per year. The estimates are based primarily on percentage of silt, sand, and organic matter and on soil structure and saturated hydraulic conductivity (Ksat)." + " Values of K range from 0.02 to 0.69. Other factors being equal, the higher the value, the more susceptible the soil is to sheet and rill erosion by water. "
				+ "Erosion factor Kf (rock free) indicates the erodibility of the fine-earth fraction, or the material less than 2 millimeters in size.";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;
				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			else if ($('#autocomplete').val() == "Kw"){
				var prprty = "Description for K Factor (Whole Soil): ";
				var prprtyText = "Erosion factor K indicates the susceptibility of a soil to sheet and rill erosion by water. Factor K is one of six factors used in the Universal Soil Loss Equation (USLE) and the Revised Universal Soil Loss Equation (RUSLE) to predict the average annual rate of soil loss by sheet and rill erosion in tons per acre per year. The estimates are based primarily on percentage of silt, sand, and organic matter and on soil structure and saturated hydraulic conductivity (Ksat)."+" Values of K range from 0.02 to 0.69. Other factors being equal, the higher the value, the more susceptible the soil is to sheet and rill erosion by water."
				+ "'Erosion factor Kw (whole soil)' indicates the erodibility of the whole soil. The estimates are modified by the presence of rock fragments.";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;
				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			else if ($('#autocomplete').val() == "LL"){
				var prprty = "Description for Liquid Limit: ";
				var prprtyText = "Liquid limit (LL) is one of the standard Atterberg limits used to indicate the plasticity characteristics of a soil. It is the water content, on a percent by weight basis, of the soil (passing #40 sieve) at which the soil changes from a plastic to a liquid state. Generally, the amount of clay- and silt-size particles, the organic matter content, and the type of minerals determine the liquid limit. Soils that have a high liquid limit have the capacity to hold a lot of water while maintaining a plastic or semisolid state. Liquid limit is used in classifying soils in the Unified and AASHTO classification systems. For each soil layer, this attribute is actually recorded as three separate values in the database. A low value and a high value indicate the range of this attribute for the soil component. A 'representative' value indicates the expected value of this attribute for the component. For this soil property, only the representative value is used.";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;
				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			else{
			}
			/** Copy and paste to change properties.
			else if ($('#autocomplete').val() == "<>"){
			var prprty = "Description for <>: ";
			var prprtyText = "<>";
			var h3 = document.createElement('h3');
			h3.innerHTML = prprty;
			var div = document.createElement('div');
			div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
			var descriptor = document.getElementById('description');
			descriptor.appendChild(div);
		}
		*/
		/* //original to draw the legend
		var div = document.createElement('div');
		div.innerHTML = "<strong>" + $('#autocomplete').val() + "</strong><br>" + legendText;
		var legend = document.createElement('div');
		legend = document.getElementById('legend');
		legend.appendChild(div);
		*/ //original
		//var g = document.createElement('div');
		//g.id = 'someId';
		//draw the legend
		var div = document.createElement('div');
		//div = document.getElementsByTagName("H3")[0].setAttribute("class", "col-md-3");
		//div.attribute('class', 'col-md-3');
		// div.innerHTML = '<img src="img/redsquare.png" height="10px"/> ' + $('#autocomplete').val();;
		//div.id = 'legend';
		div.innerHTML = "<strong>" + $('#autocomplete').val() + "</strong><br>" + legendText;//pinta a legend?
		var legend = document.createElement('div');
		legend = document.getElementById('legend');
		document.getElementById('legend').style.visibility = "visible";//o este?
		legend.appendChild(div);
	});
}
else{ alert("Please select a property and a district."); }
}
//get polygons "run function" ends here

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
	url: 'http://ctis.utep.edu/secretsanta/county_texas.kmz', //url: 'https://casoilresource.lawr.ucdavis.edu/soil_web/kml/SoilWeb.kmz', //url: 'http://googlemaps.github.io/js-v2-samples/ggeoxml/cta.kml',
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
	document.getElementById('legend').style.visibility = "hidden";
	$('#legend').find('*').not('h3').remove();
	$('#description').find('*').not('h3').remove();
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
/*function descriptor(){
}*/
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
