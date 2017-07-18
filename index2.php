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
	<!--<link rel="stylesheet" href="/resources/demos/style.css">-->


	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">-->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->

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
				<!--<h1> testing </h1>-->
				<div id="map"></div>
				<div id="description"></div>
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
								<option value="" disabled selected>Select a district</option>
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
								<!--<option value="30.694611546632302, -104.52392578125" data-district="elPaso">-->
								<option value="31.770546, -106.504874" data-district="elPaso">
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
							<label> Soil Property: </label>
						</div>
						<div class="row"> <!--search-->
							<div class="input-group">
								<!--<span class="input-group-addon glyphicon glyphicon-search" id="basic-addon"></span>
								<input type="text" class="form-control" placeholder="Ground Property" aria-describedby="basic-addon" id="autocomplete" autocomplete="off">-->
								<span class="input-group-addon glyphicon glyphicon-search" id="basic-addon"></span>
								<select type="text" class="form-control" placeholder="Ground Property" aria-describedby="basic-addon" id="selectProp">
									<option value="" disabled selected>Select a ground property</option>
								</select>
							</div> <br>
							</div>
							<!-- Depth methods-->
							<div class="row">
								<div class="col-md-5 col-md-offset-0">
									<label> Depth:</label> <br>
									<div class="input-group">
										<!-- <label> Depth:</label> <br> -->
										<span class="input-group-addon" id="basic-addon3">inch</span>
										<input type="number" class="form-control" value="0" placeholder="...inches" id="depth" aria-describedby="basic-addon3">
										<!-- <input type="text" value="0" id="depth" placeholder=" ...inches" style="color: black;"> -->
										<!--<p> Top = <input type="text" value="" id="depth_top" placeholder="...inches" style="color: black;"></p>
										<p> Bottom = <input type="text" value="" id="depth_bottom" placeholder="...inches" style="color: black;"></p>-->
									</div>
								</div>
								<div class="col-md-5 col-md-offset-2">
									<label> Method:</label> <br>
									<select id="methods" class="form-control">
										<option value="" disabled selected>Select method</option>
										<option value="1" id="max_method">Max</option>
										<option value="2" id="min_method">Min</option>
										<option value="3" id="med_method">Median</option>
										<option value="4" id="weight_method">Weighted average</option>
										<option value="5" id="specific_method">At Specific Depth</option>
									</select>
								</div>
							</div>
							<!-- End depth methods -->
						<div> <p> </p> </div> <!--separate-->
						<div class="row">
							<button class="btn btn-success form-control" type="button" id="run" onClick="getPolygons()">Run</button>
						</div>
						<p>  </p> <!--separator-->
						<div class="row">
							<button class="btn btn-warning form-control" type="button" id="clear" onClick="removePolygons()">Clear</button>
						</div>
						<p>  </p> <!--separator-->

						<div class="row">
							<button type="button" class="map-print" id="print" onClick="printMaps()">Print</button> <!-- to print map -->
							<p> </p>
						</div>
						<div class="row">
							  <button type="button" class="btn btn-default form-control" id="draw" onclick="drawAnotherRectangle();">Delete drawn area of interest</button>
						</div>

						<div id="load"> </div>
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
			<!--<div class="col-md-9">
			<div id="description">
		</div>
	</div> -->
</div>
</div>
<br>
<div id="chart_area"> </div>

<div class="row">
	<div class = "col-md-5">

		<div class="col-md-4">
			<label> Legend Definition </label>
			<br>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon3"># of labels</span>
				<input type="number" class="form-control" value="1" placeholder="...inches" id="labels" aria-describedby="basic-addon3">
			</div>
			<br>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon3">value</span>
				<input type="number" class="form-control" value="1" placeholder="...inches" id="value" aria-describedby="basic-addon3">
			</div>
		</div>
		<div class="col-md-3">
			<br> <br>
			<button class="btn btn-default" onClick="spawn()">Get the legend</button>
		</div>
	</div>
	<div class = "col-md-5">
		<label> Legend Testing</label>
		<div class="col-md-3">
			<br>
			<div id="legendSpawner">

			</div>

		</div>
	</div>
</div>

<p></p>
<!--Description text-->


<!-- Bootstrap Core JavaScript -->

<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->

<script src="js/jquery.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="js/bootstrap.js"></script>

<script src="js/jquery.autocomplete.min.js"></script>
<script src="js/properties.js"></script>
<script>

var app = {map:null, polygons:null, payload:{getMode:"polygons", property:null, district:null, depth:null, depth_method:null, AoI:null, lineString:null}}; //added value for depth method
var hecho = false;
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
		var selectProp = document.getElementById("selectProp");
		var prop = [{number: 0, value: null, data: null, table: null},
			{number: 1, value: null, data: null, table: null},
			{number: 2, value: null, data: null, table: null},
			{number: 3, value: null, data: null, table: null},
			{number: 4, value: null, data: null, table: null},
			{number: 5, value: null, data: null, table: null},
			{number: 6, value: null, data: null, table: null},
			{number: 7, value: null, data: null, table: null},
			{number: 8, value: null, data: null, table: null},
			{number: 9, value: null, data: null, table: null},
			{number: 10, value: null, data: null, table: null},
			{number: 11, value: null, data: null, table: null},
			{number: 12, value: null, data: null, table: null},
			{number: 13, value: null, data: null, table: null},
			{number: 14, value: null, data: null, table: null},
			{number: 15, value: null, data: null, table: null},
			{number: 16, value: null, data: null, table: null},
			{number: 17, value: null, data: null, table: null},
			{number: 18, value: null, data: null, table: null},
			{number: 19, value: null, data: null, table: null},
			{number: 20, value: null, data: null, table: null},
			{number: 21, value: null, data: null, table: null},
			{number: 22, value: null, data: null, table: null},
			{number: 23, value: null, data: null, table: null},
			{number: 24, value: null, data: null, table: null},
			{number: 25, value: null, data: null, table: null},
			{number: 26, value: null, data: null, table: null},
			{number: 27, value: null, data: null, table: null},
			{number: 28, value: null, data: null, table: null},
			{number: 29, value: null, data: null, table: null},
			{number: 30, value: null, data: null, table: null},
			{number: 31, value: null, data: null, table: null},
			{number: 32, value: null, data: null, table: null},
			{number: 33, value: null, data: null, table: null},
			{number: 34, value: null, data: null, table: null},
			{number: 35, value: null, data: null, table: null},
			{number: 36, value: null, data: null, table: null},
			{number: 37, value: null, data: null, table: null}
		];

for (var i = 0; i < 37; i++) {
	prop[i].number = i;
	prop[i].value = properties[i].value;
	prop[i].data = properties[i].data;
	prop[i].table = properties[i].table;
}
for(var i = 0; i < prop.length-1; i++) {
	var propr = prop[i].number;
	//console.log("En loop (value): " + propr);
	var elem = document.createElement("option");
	elem.textContent = prop[i].value;
	elem.value = propr;
	//console.log("En loop (value): " + propr);
	elem.data = prop[i].data;
	//console.log("En loop (data): " + prop[i].data);
	elem.table = prop[i].table;
	//console.log("En loop (table): " + prop[i].table);
	selectProp.appendChild(elem);
}
$("#selectProp").change(function(){
	app.payload.property =  prop[this.value].data;
	app.payload.table =  prop[this.value].table;
	app.payload.value =  prop[this.value].value;
});
//create the autocomplete with the data
$('#autocomplete').autocomplete({
	lookup: properties,
	onSelect: function (suggestion) {
		console.log(suggestion.data + "  " + suggestion.table + "  " + suggestion.value);
		app.payload.property = suggestion.data;
		app.payload.table = suggestion.table;
		app.payload.value = suggestion.value;
	}
});
$('#target').on('change', setDistrict);
});
app.payload.district = $('#target').children("option:selected").data('district');

/*
Si es minimo o maximo, necesitamos depth a ese punto. Si es weighted average
no necesitamos considerar o saber depth. Tambien para median necesitamos saber.
*/
$("#methods").change(function(){ //0: max / 1: min / 2: median / 3: weight/
	app.payload.depth_method = this.value;
});

});


function getPolygons(){//this is run button
	app.payload.getMode="polygons";
	hecho = false;
	var depth = document.getElementById("depth").value;
	//console.log(depth);
	depth = parseFloat(depth);
	//console.log(depth);

	app.payload.depth = depth;
	if(app.payload.property && app.payload.district && (isNaN(depth)==false)){//to make sure a property is selected
		//get the polygons
		// console.log(app.payload);
		var getparams = app.payload;
		var bounds = app.map.getBounds();
		getparams.NE = bounds.getNorthEast().toJSON(); //north east corner
		getparams.SW = bounds.getSouthWest().toJSON(); //south-west corner
		//console.log(getparams.NE);
		//console.log(getparams.SW);

		$(document.body).css({'cursor': 'wait'});
		$.get('polygonHandler.php', app.payload, function(data){


		if(depth < 0 || depth * 2.54 > 204 || isNaN(depth)){
			alert("Please make sure depth is a numerical value and it is between 0 and 79 inches.");
			hecho = true;
		}
		if(data.hasOwnProperty('coords')){
			removePolygons();
			//               0           1           2          3          4         5          6           7         8          9        10        11        12          13         14         15        16          17
			//              GRAY,       RED,     SKY BLUE, BRIGHT GREEN, PURPLE,   ORANGE,  BRIGHT PINK,NAVY BLUE,  LILAC,     YELLOW    maroon    cyan     navygreen    peach      flesh      brown    neongreen   neonpurple
			shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#fe9253", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D", "#8C0909", "#07FDCA", "#008C35", "FFDBA5", "#B57777", "#6D3300", "#D0FF00", "#5900FF"];
			shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a", "8c0909", "36c9bd", "#008c35", "#ffdba5", "#B57777", "#6D3300", "#D0FF00", "#5900FF"];
			colorSelector = 0;
			newzIndex = 0;
			legendText = "";
			for(key in data.coords){
				if(data.coords.hasOwnProperty(key)){
					var polyCoordis = [];
					if(app.payload.table == "chorizon_r"){
						if(app.payload.property == "caco3_r"){ //Testing legend and logic for drawing for this specific property
							legendText = "<img src='img/redsquare.png' height='10px'/> <= 7<br>\
							<img src='img/skybluesquare.png' height='10px'/>  > 7 and <= 17<br>\
							<img src='img/brightgreensquare.png' height='10px'/> > 17 and <= 36<br>\
							<img src='img/purplesquare.png' height='10px'/> > 36 and <= 55<br>\
							<img src='img/orangesquare.png' height='10px'/> > 55 and <= 65<br>\
							<img src='img/graysquare.png' height='10px'/> Not rated or not available";
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
							legendText = "<img src='img/redsquare.png' height='10px'/> <= 11.8<br>\
							<img src='img/skybluesquare.png' height='10px'/>  > 11.8 and <= 26.1<br>\
							<img src='img/brightgreensquare.png' height='10px'/> > 26.1 and <= 39.3<br>\
							<img src='img/purplesquare.png' height='10px'/> > 39.3 and <= 57.8<br>\
							<img src='img/orangesquare.png' height='10px'/> > 57.8 and <= 90.2<br>\
							<img src='img/graysquare.png' height='10px'/> Not rated or not available ";
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
								colorSelector = 0;
								newzIndex = 0;
								break;
							}
						}
						else if(app.payload.property == "gypsum_r"){ //Testing legend and logic for drawing for this specific property
							//console.log(app.payload.property);
							//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
							//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
							//colorSelector = 0;
							//newzIndex = 0;
							legendText = "<img src='img/redsquare.png' height='10px'/> <= 0 <br>\
							<img src='img/skybluesquare.png' height='10px'/> > 0 and <= 2 <br>\
							<img src='img/brightgreensquare.png' height='10px'/> Greater than 8% <br>\
							<img src='img/graysquare.png' height='10px'/> Not rated or not available ";
							var amountIn = parseFloat(data.coords[key][app.payload.property]);
							//console.log(amountIn);
							//var amountIn = data.coords[key][app.payload.property];
							//console.log(amountIn);
							switch (true) {
								case (amountIn <= 0): // LESS THAN OR EQUAL TO 0
								colorSelector = 1;
								newzIndex = 1;
								break;
								case (amountIn > 0 && amountIn <=2): // BETWEEN 0 AND 21
								colorSelector = 2;
								newzIndex = 2;
								break;
								/*case (amountIn > 8): // BETWEEN 21 AND 40
								colorSelector = 3;
								newzIndex = 3;
								break;*/
								default: // Not rated
								colorSelector = 0;
								newzIndex = 0;
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
							<img src='img/graysquare.png' height='10px'/> Not rated or not available ";
							// GRAY, RED, SKY BLUE, BRIGHT GREEN, PURPLE, ORANGE, BRIGHT PINK, NAVY BLUE, LILAC, YELLOW
							var amountIn = parseFloat(data.coords[key][app.payload.property]);
							//console.log(amountIn);
							//
							//console.log(amountIn);
							//var amountIn = data.coords[key][app.payload.property];
							//console.log(amountIn);
							switch (true) {
								case (amountIn <= 9.4): // LESS THAN OR EQUAL TO
								colorSelector = 1; //red
								newzIndex = 1;
								break;
								case (amountIn > 9.4 && amountIn <= 21.0): // BETWEEN 0 AND 21
								colorSelector = 2; //skybluesquare
								newzIndex = 2
								break;
								case (amountIn > 21.0 && amountIn <= 30.6): // BETWEEN 21 AND 40
								colorSelector = 3; //brightgreensquare
								newzIndex = 3;
								break;
								case (amountIn > 30.6 && amountIn <= 37.5): // BETWEEN 41 AND 60
								colorSelector = 4; //purplesquare
								newzIndex = 4;
								break;
								case (amountIn > 37.5 && amountIn <= 60): // BETWEEN 41 AND 60
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
							// 								GRAY, 			RED, 			SKY BLUE, BRIGHT GREEN, PURPLE, ORANGE, 	BRIGHT PINK, NAVY BLUE, LILAC, YELLOW
							//colorSelector = 0;
							//newzIndex = 0;
							legendText = "<img src='img/redsquare.png' height='10px'/> <= 0.3<br>\
							<img src='img/skybluesquare.png' height='10px'/>  > 0.3 and <= 0.9<br>\
							<img src='img/brightgreensquare.png' height='10px'/> > 0.9 and <= 1.8<br>\
							<img src='img/purplesquare.png' height='10px'/> > 1.8 and <= 5.9<br>\
							<img src='img/orangesquare.png' height='10px'/> > 5.9 and <= 17.5<br>\
							<img src='img/graysquare.png' height='10px'/> Not rated or not available ";
							var amountIn = parseFloat(data.coords[key][app.payload.property]);
							//console.log(amountIn);
							//var amountIn = data.coords[key][app.payload.property];
							//console.log(amountIn);
							switch (true) {
								case (amountIn <= 0.3): // LESS THAN OR EQUAL TO 0
								colorSelector = 1; //not black or gray
								newzIndex = 1;
								break;
								case (amountIn > 0.3 && amountIn <= 0.9): // BETWEEN 21 AND 40
								colorSelector = 2;
								newzIndex = 2;
								break;
								case (amountIn > 0.9 && amountIn <= 1.8): // BETWEEN 0 AND 21
								colorSelector = 3;
								newzIndex = 3;
								break;
								case (amountIn > 1.8 && amountIn <= 5.9): // BETWEEN 21 AND 40
								colorSelector = 4;
								newzIndex = 4;
								break;
								case (amountIn > 5.9 && amountIn <= 17.5): // BETWEEN 41 AND 60
								colorSelector = 5;
								newzIndex = 5;
								break;
								default: // Not rated
								colorSelector = 0;
								newzIndex = 0;
								break;
							}
						}
						else if(app.payload.property == "ksat_r"){ //Testing legend and logic for drawing for this specific property
							//console.log(app.payload.property);
							//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
							//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
							//colorSelector = 0;
							//newzIndex = 0;
							legendText = "<img src='img/redsquare.png' height='10px'/> Very Low (0.0 - 0.01)<br>\
							<img src='img/skybluesquare.png' height='10px'/>  Low (0.01 - 0.1)<br>\
							<img src='img/brightgreensquare.png' height='10px'/> Moderately Low (0.1 - 1)<br>\
							<img src='img/purplesquare.png' height='10px'/> Moderately High (1 - 10)<br>\
							<img src='img/orangesquare.png' height='10px'/> High (10 - 100)<br>\
							<img src='img/brightpinksquare.png' height='10px'/> Very High (100 - 705)<br>\
							<img src='img/graysquare.png' height='10px'/> Not rated or not available ";
							var amountIn = parseFloat(data.coords[key][app.payload.property]);
							//console.log(amountIn);
							//var amountIn = data.coords[key][app.payload.property];
							//console.log(amountIn);
							switch (true) {
								case (amountIn > 0.0 && amountIn <= 0.01): // LESS THAN OR EQUAL TO 0
								colorSelect = 1;
								newzIndex = 1;
								break;
								case (amountIn > 0.01 && amountIn <= 0.1): // BETWEEN 21 AND 40
								colorSelector = 2;
								newzIndex = 2;
								break;
								case (amountIn > 0.1 && amountIn <= 1): // BETWEEN 41 AND 60
								colorSelector = 3;
								newzIndex = 3;
								break;
								case (amountIn > 1 && amountIn <= 10): // BETWEEN 41 AND 60
								colorSelector = 4;
								newzIndex = 4;
								break;
								case (amountIn > 10 && amountIn <= 100): // BETWEEN 41 AND 60
								colorSelector = 5;
								newzIndex = 5;
								break;
								case (amountIn > 100 && amountIn <= 705): // BETWEEN 41 AND 60
								colorSelector = 6;
								newzIndex = 6;
								break;
								default: // Not rated
								colorSelector = 0;
								newzIndex = 0;
								break;
							}
						}
						else if(app.payload.property == "sandfine_r"){ //Testing legend and logic for drawing for this specific property
							//console.log(app.payload.property);
							//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
							//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
							//colorSelector = 0;
							//newzIndex = 0;
							legendText = "<img src='img/brightpinksquare.png' height='10px'/> <br>\
							<img src='img/redsquare.png' height='10px'/> <br>\
							<img src='img/skybluesquare.png' height='10px'/> <br>\
							<img src='img/purplesquare.png' height='10px'/> <br>\
							<img src='img/orangesquare.png' height='10px'/> <br>\
							<img src='img/brightgreensquare.png' height='10px'/> <br>\
							<img src='img/graysquare.png' height='10px'/> Not rated or not available ";
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
							//not enough colors for this propierty
							//console.log(app.payload.property);
							//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
							//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
							//colorSelector = 0;
							//newzIndex = 0;
							legendText = "<img src='img/redsquare.png' height='10px'/> Ultra acid (ph < 3.5)<br>\
							<img src='img/skybluesquare.png' height='10px'/> Extremely acid (ph 3.5 - 4.4)<br>\
							<img src='img/brightgreensquare.png' height='10px'/> Very strongly acid (ph 4.5 - 5.0)<br>\
							<img src='img/purplesquare.png' height='10px'/> Strongly acid (ph 5.1 - 5.5)<br>\
							<img src='img/orangesquare.png' height='10px'/> Moderately acid (ph 5.6 - 6.0)<br>\
							<img src='img/brightpinksquare.png' height='10px'/> Slightly acid (ph 6.1 - 6.5)<br>\
							<img src='img/navybluesquare.png' height='10px'/> Neutral (ph 6.6 - 7.3)<br>\
							<img src='img/lilacsquare.png' height='10px'/> Slightly alkaline (ph 7.4 - 7.8)<br>\
							<img src='img/yellowsquare.png' height='10px'/> Moderately alkaline (ph 7.9 - 8.4)<br>\
							<img src='img/maroonsquare.png' height='10px'/> Strongly alkaline (ph 8.5 - 9.0)<br>\
							<img src='img/navygreen.png' height='10px'/> Very strongly alkaline (ph > 9.0)<br>\
							<img src='img/graysquare.png' height='10px'/> Not rated or not available ";
							var amountIn = parseFloat(data.coords[key][app.payload.property]);
							//console.log(amountIn);
							//var amountIn = data.coords[key][app.payload.property];
							//console.log(amountIn);
							switch (true) {
								case (amountIn < 3.5): // LESS THAN OR EQUAL TO 0
								colorSelect = 1;
								newzIndex = 1;
								break;
								case (amountIn >= 3.5 && amountIn <= 4.4): // BETWEEN 21 AND 40
								colorSelector = 2;
								newzIndex = 2;
								break;
								case (amountIn >= 4.5 && amountIn <= 5.0): // BETWEEN 41 AND 60
								colorSelector = 3;
								newzIndex = 3;
								break;
								case (amountIn >= 5.1 && amountIn <= 5.5): // BETWEEN 41 AND 60
								colorSelector = 4;
								newzIndex = 4;
								break;
								case (amountIn >= 5.6 && amountIn <= 6.0): // BETWEEN 41 AND 60
								colorSelector = 5;
								newzIndex = 5;
								break;
								case (amountIn >= 6.1 && amountIn <= 6.5): // BETWEEN 41 AND 60
								colorSelector = 6;
								newzIndex = 6;
								break;
								case (amountIn >= 6.6 && amountIn <= 7.3): // BETWEEN 41 AND 60
								colorSelector = 7;
								newzIndex = 7;
								break;
								case (amountIn >= 7.4 && amountIn <= 7.8): // BETWEEN 41 AND 60
								colorSelector = 8;
								newzIndex = 8;
								break;
								case (amountIn >= 7.9 && amountIn <= 8.4): // BETWEEN 41 AND 60
								colorSelector = 9;
								newzIndex = 9;
								break;
								case (amountIn >= 8.5 && amountIn <= 9.0): // BETWEEN 41 AND 60
								colorSelector = 10;
								newzIndex = 10;
								break;
								case (amountIn > 9.0 ): // BETWEEN 41 AND 60
								colorSelector = 11;
								newzIndex = 11;
								break;
								default: // Not rated
								colorSelector = 0;
								newzIndex = 0;
								break;
							}
						}
						else if(app.payload.property == "aashind_r"){ //Testing legend and logic for drawing for this specific property
							//console.log(app.payload.property);
							//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
							//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
							//colorSelector = 0;
							//newzIndex = 0;
							legendText = "<img src='img/redsquare.png' height='10px'/> A-1<br>\
							<img src='img/skybluesquare.png' height='10px'/> A-1-a<br>\
							<img src='img/brightgreensquare.png' height='10px'/> A-1-b<br>\
							<img src='img/purplesquare.png' height='10px'/> A-b<br>\
							<img src='img/orangesquare.png' height='10px'/> A-2<br>\
							<img src='img/brightpinksquare.png' height='10px'/> A-2-4<br>\
							<img src='img/navybluesquare.png' height='10px'/> A-2-5<br>\
							<img src='img/lilacsquare.png' height='10px'/> A-2-6<br>\
							<img src='img/yellowsquare.png' height='10px'/> A-2-7<br>\
							<img src='img/maroonsquare.png' height='10px'/> A-3<br>\
							<img src='img/cyansquare.png' height='10px'/> A-4<br>\
							<img src='img/navygreensquare.png' height='10px'/> A-5<br>\
							<img src='img/peachsquare.png' height='10px'/> A-6<br>\
							<img src='img/fleshsquare.png' height='10px'/> A-7<br>\
							<img src='img/brownsquare.png' height='10px'/> A-7-5<br>\
							<img src='img/neongreen.png' height='10px'/> A-7-6<br>\
							<img src='img/neonpurple.png' height='10px'/> A-8<br>\
							<img src='img/graysquare.png' height='10px'/> Not rated or not available ";
							console.log(amountIn);
							var amountIn = parseFloat(data.coords[key][app.payload.property]);
							console.log(amountIn);
							//console.log(amountIn);
							//var amountIn = data.coords[key][app.payload.property];
							//console.log(amountIn);
							switch (true) {
								case (amountIn == "A-1-a"): // LESS THAN OR EQUAL TO 0
								colorSelect = 1;
								newzIndex = 1;
								break;
								case (amountIn == "A-1-b"): // BETWEEN 21 AND 40
								colorSelector = 2;
								newzIndex = 2;
								break;
								case (amountIn == "A-b"): // BETWEEN 41 AND 60
								colorSelector = 3;
								newzIndex = 3;
								break;
								case (amountIn == "A-2"): // BETWEEN 41 AND 60
								colorSelector = 4;
								newzIndex = 4;
								break;
								case (amountIn == "A-2-4"): // BETWEEN 41 AND 60
								colorSelector = 5;
								newzIndex = 5;
								break;
								case (amountIn == "A-2-5"): // BETWEEN 41 AND 60
								colorSelector = 6;
								newzIndex = 6;
								break;
								case (amountIn == "A-2-6"): // BETWEEN 41 AND 60
								colorSelector = 7;
								newzIndex = 7;
								break;
								case (amountIn == "A-2-7"): // BETWEEN 41 AND 60
								colorSelector = 8;
								newzIndex = 8;
								break;
								case (amountIn == "A-3"): // BETWEEN 41 AND 60
								colorSelector = 9;
								newzIndex = 9;
								break;
								case (amountIn == "A-4"): // BETWEEN 41 AND 60
								colorSelector = 10;
								newzIndex = 10;
								break;
								case (amountIn == "A-5" ): // BETWEEN 41 AND 60
								colorSelector = 11;
								newzIndex = 11;
								break;
								case (amountIn == "A-6" ): // BETWEEN 41 AND 60
								colorSelector = 12;
								newzIndex = 12;
								break;
								case (amountIn == "A-7" ): // BETWEEN 41 AND 60
								colorSelector = 13;
								newzIndex = 13;
								break;
								case (amountIn == "A-7-5" ): // BETWEEN 41 AND 60
								colorSelector = 14;
								newzIndex = 14;
								break;
								case (amountIn == "A-7-6" ): // BETWEEN 41 AND 60
								colorSelector = 15;
								newzIndex = 15;
								break;
								case (amountIn == "A-8" ): // BETWEEN 41 AND 60
								colorSelector = 16;
								newzIndex = 16;
								break;
								default: // Not rated
								colorSelector = 0;
								newzIndex = 0;
								break;
							}
						}
						else if(app.payload.property == "ll_r"){ //Testing legend and logic for drawing for this specific property
							//console.log(app.payload.property);
							//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
							//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
							//colorSelector = 0;
							//newzIndex = 0;
							legendText = "<img src='img/redsquare.png' height='10px'/> <= 27.2<br>\
							<img src='img/skybluesquare.png' height='10px'/> > 27.2 and <= 45.8<br>\
							<img src='img/brightgreensquare.png' height='10px'/> > 45.8 and <= 58.0<br>\
							<img src='img/purplesquare.png' height='10px'/> > 58.0 and <= 66.0<br>\
							<img src='img/orangesquare.png' height='10px'/> > 66.0 and <= 75.7<br>\
							<img src='img/graysquare.png' height='10px'/> Not rated or not available ";
							var amountIn = parseFloat(data.coords[key][app.payload.property]);
							//console.log(amountIn);
							//var amountIn = data.coords[key][app.payload.property];
							//console.log(amountIn);
							switch (true) {
								case (amountIn <= 27.2): // LESS THAN OR EQUAL TO 0
								colorSelect = 1;
								newzIndex = 1;
								break;
								case (amountIn > 27.2 && amountIn <= 45.8): // BETWEEN 21 AND 40
								colorSelector = 2;
								newzIndex = 2;
								break;
								case (amountIn > 45.8 && amountIn <= 58.0): // BETWEEN 41 AND 60
								colorSelector = 3;
								newzIndex = 3;
								break;
								case (amountIn > 58.0 && amountIn <= 66.0): // BETWEEN 41 AND 60
								colorSelector = 4;
								newzIndex = 4;
								break;
								case (amountIn > 66.0 && amountIn <= 75.7): // BETWEEN 41 AND 60
								colorSelector = 5;
								newzIndex = 5;
								break;
								default: // Not rated
								colorSelector = 0;
								newzIndex = 0;
								break;
							}
						}
						else if(app.payload.property == "kffact" || app.payload.property == "kwfact" ){ //Testing legend and logic for drawing for this specific property
							//console.log(app.payload.property);
							//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
							//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
							//colorSelector = 0;
							//newzIndex = 0;
							legendText = "<img src='img/redsquare.png' height='10px'/> .02<br>\
							<img src='img/skybluesquare.png' height='10px'/> .05<br>\
							<img src='img/brightgreensquare.png' height='10px'/> .10<br>\
							<img src='img/purplesquare.png' height='10px'/> .15<br>\
							<img src='img/orangesquare.png' height='10px'/> .17<br>\
							<img src='img/brightpinksquare.png' height='10px'/> .20<br>\
							<img src='img/navybluesquare.png' height='10px'/> .24<br>\
							<img src='img/lilacsquare.png' height='10px'/> .28<br>\
							<img src='img/yellowsquare.png' height='10px'/> .32<br>\
							<img src='img/maroonsquare.png' height='10px'/> .37<br>\
							<img src='img/cyansquare.png' height='10px'/> .43<br>\
							<img src='img/navygreensquare.png' height='10px'/> .49<br>\
							<img src='img/peachsquare.png' height='10px'/> .55<br>\
							<img src='img/fleshsquare.png' height='10px'/> .64<br>\
							<img src='img/graysquare.png' height='10px'/> Not rated or not available ";
							var amountIn = parseFloat(data.coords[key][app.payload.property]);
							//console.log(amountIn);
							//var amountIn = data.coords[key][app.payload.property];
							//console.log(amountIn);
							switch (true) {
								case (amountIn <= 0.02): // LESS THAN OR EQUAL TO 0
								colorSelect = 1;
								newzIndex = 1;
								break;
								case (amountIn <= 0.05): // BETWEEN 21 AND 40
								colorSelector = 2;
								newzIndex = 2;
								break;
								case (amountIn <= .10): // BETWEEN 41 AND 60
								colorSelector = 3;
								newzIndex = 3;
								break;
								case (amountIn <= .15): // BETWEEN 41 AND 60
								colorSelector = 4;
								newzIndex = 4;
								break;
								case (amountIn <= .17): // BETWEEN 41 AND 60
								colorSelector = 5;
								newzIndex = 5;
								break;
								case (amountIn <= .20): // BETWEEN 41 AND 60
								colorSelector = 6;
								newzIndex = 6;
								break;
								case (amountIn <= .24): // BETWEEN 41 AND 60
								colorSelector = 7;
								newzIndex = 7;
								break;
								case (amountIn <= 0.28): // BETWEEN 41 AND 60
								colorSelector = 8;
								newzIndex = 8;
								break;
								case (amountIn <= 0.32): // BETWEEN 41 AND 60
								colorSelector = 9;
								newzIndex = 9;
								break;
								case (amountIn <= 0.37): // BETWEEN 41 AND 60
								colorSelector = 10;
								newzIndex = 10;
								break;
								case (amountIn <= 0.43): // BETWEEN 41 AND 60
								colorSelector = 11;
								newzIndex = 11;
								break;
								case (amountIn <= 0.49): // BETWEEN 41 AND 60
								colorSelector = 12;
								newzIndex = 12;
								break;
								case (amountIn <= 0.55): // BETWEEN 41 AND 60
								colorSelector = 13;
								newzIndex = 13;
								break;
								case (amountIn <= 0.64): // BETWEEN 41 AND 60
								colorSelector = 14;
								newzIndex = 14;
								break;
								default: // Not rated
								colorSelector = 0;
								newzIndex = 0;
								break;
							}
						}
						else if(app.payload.property == "ph01mcacl2_r"){ //Testing legend and logic for drawing for this specific property
							//console.log(app.payload.property);
							//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
							//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
							//colorSelector = 0;
							//newzIndex = 0;
							legendText = "<img src='img/redsquare.png' height='10px'/> Ultra acid (ph < 3.5)<br>\
							<img src='img/skybluesquare.png' height='10px'/> Extremely acid (ph 3.5 - 4.4)<br>\
							<img src='img/brightgreensquare.png' height='10px'/> Very strongly acid (ph 4.5 - 5.0)<br>\
							<img src='img/purplesquare.png' height='10px'/> Strongly acid (ph 5.1 - 5.5)<br>\
							<img src='img/orangesquare.png' height='10px'/> Moderately acid (ph 5.6 - 6.0)<br>\
							<img src='img/brightpinksquare.png' height='10px'/> Slightly acid (ph 6.1 - 6.5)<br>\
							<img src='img/navybluesquare.png' height='10px'/> Neutral (ph 6.6 - 7.3)<br>\
							<img src='img/lilacsquare.png' height='10px'/> Slightly alkaline (ph 7.4 - 7.8)<br>\
							<img src='img/yellowsquare.png' height='10px'/> Moderately alkaline (ph 7.9 - 8.4)<br>\
							<img src='img/maroonsquare.png' height='10px'/> Strongly alkaline (ph 8.5 - 9.0)<br>\
							<img src='img/navygreen.png' height='10px'/> Very strongly alkaline (ph > 9.0)<br>\
							<img src='img/graysquare.png' height='10px'/> Not rated or not available ";
							var amountIn = parseFloat(data.coords[key][app.payload.property]);
							//console.log(amountIn);
							//var amountIn = data.coords[key][app.payload.property];
							//console.log(amountIn);
							switch (true) {
								case (amountIn < 3.5): // LESS THAN OR EQUAL TO 0
								colorSelect = 1;
								newzIndex = 1;
								break;
								case (amountIn >= 3.5 && amountIn <= 4.4): // BETWEEN 21 AND 40
								colorSelector = 2;
								newzIndex = 2;
								break;
								case (amountIn >= 4.5 && amountIn <= 5.0): // BETWEEN 41 AND 60
								colorSelector = 3;
								newzIndex = 3;
								break;
								case (amountIn >= 5.1 && amountIn <= 5.5): // BETWEEN 41 AND 60
								colorSelector = 4;
								newzIndex = 4;
								break;
								case (amountIn >= 5.6 && amountIn <= 6.0): // BETWEEN 41 AND 60
								colorSelector = 5;
								newzIndex = 5;
								break;
								case (amountIn >= 6.1 && amountIn <= 6.5): // BETWEEN 41 AND 60
								colorSelector = 6;
								newzIndex = 6;
								break;
								case (amountIn >= 6.6 && amountIn <= 7.3): // BETWEEN 41 AND 60
								colorSelector = 7;
								newzIndex = 7;
								break;
								case (amountIn >= 7.4 && amountIn <= 7.8): // BETWEEN 41 AND 60
								colorSelector = 8;
								newzIndex = 8;
								break;
								case (amountIn >= 7.9 && amountIn <= 8.4): // BETWEEN 41 AND 60
								colorSelector = 9;
								newzIndex = 9;
								break;
								case (amountIn >= 8.5 && amountIn <= 9.0): // BETWEEN 41 AND 60
								colorSelector = 10;
								newzIndex = 10;
								break;
								case (amountIn > 9.0 ): // BETWEEN 41 AND 60
								colorSelector = 11;
								newzIndex = 11;
								break;
								default: // Not rated
								colorSelector = 0;
								newzIndex = 0;
								break;
							}
						}
						else if(app.payload.property == "om_r"){ //Testing legend and logic for drawing for this specific property
							//console.log(app.payload.property);
							//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#f1a50c", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D"];
							//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a"];
							//colorSelector = 0;
							//newzIndex = 0;
							legendText = "<img src='img/redsquare.png' height='10px'/> 0.5% <br>\
							<img src='img/skybluesquare.png' height='10px'/> 1% <br>\
							<img src='img/brightgreensquare.png' height='10px'/> 2% <br>\
							<img src='img/purplesquare.png' height='10px'/> 3% <br>\
							<img src='img/orangesquare.png' height='10px'/> 4% <br>\
							<img src='img/brightpinksquare.png' height='10px'/> 5% <br>\
							<img src='img/navybluesquare.png' height='10px'/> Greater than 5% <br>\
							<img src='img/graysquare.png' height='10px'/> Not rated or not available ";
							var amountIn = parseFloat(data.coords[key][app.payload.property]);
							//console.log(amountIn);
							//var amountIn = data.coords[key][app.payload.property];
							//console.log(amountIn);
							switch (true) {
								case (amountIn >= 0.5 && amountIn < 1): // LESS THAN OR EQUAL TO 0
								colorSelect = 1;
								newzIndex = 1;
								break;
								case (amountIn >= 1 && amountIn < 2): // BETWEEN 21 AND 40
								colorSelector = 2;
								newzIndex = 2;
								break;
								case (amountIn >= 2 && amountIn < 3): // BETWEEN 41 AND 60
								colorSelector = 3;
								newzIndex = 3;
								break;
								case (amountIn >= 3 && amountIn < 4): // BETWEEN 41 AND 60
								colorSelector = 4;
								newzIndex = 4;
								break;
								case (amountIn >= 4 && amountIn < 5): // BETWEEN 41 AND 60
								colorSelector = 5;
								newzIndex = 5;
								break;
								case (amountIn >= 5 && amountIn <= 5.99): // BETWEEN 41 AND 60
								colorSelector = 6;
								newzIndex = 6;
								break;
								case (amountIn > 5): // BETWEEN 41 AND 60
								colorSelector = 7;
								newzIndex = 7;
								break;
								default: // Not rated
								colorSelector = 0;
								newzIndex = 0;
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
				else{
					removePolygons();
				}
				temp = wktFormatter(data.coords[key]['POLYGON']);
				for (var i = 0; i < temp.length; i++) {
					polyCoordis.push(temp[i]);
				}
				var polygon = new google.maps.Polygon({ //we need another value to determine the key
					description: app.payload.value, //value that appears when you click the map
					description_value: data.coords[key][app.payload.property],
					paths: polyCoordis,
					strokeColor: shapeoutline[colorSelector],
					strokeOpacity: 0.60,
					strokeWeight: 0.70,
					fillColor: shapecolor[colorSelector],
					fillOpacity: 0.60,
					zIndex: -1
				});
				polygon.setOptions({ zIndex: newzIndex });
				polygon.addListener('click', polyInfo);
				app.polygons.push(polygon);
				polygon.setMap(app.map);
			}
		}
	}
}).done(function(data){
	$(document.body).css({'cursor': 'auto'});

	if($('#selectProp').val() == 32){ //should have made it like this: if(app.payload.value == "gypsum"){ //but it's too late now
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
else if ($('#selectProp').val() == 27){
	var prprty = "Description for Plasticity Index: ";
	var prprtyText = "Plasticity index (PI) is one of the standard Atterberg limits used to indicate the plasticity characteristics of a soil. It is defined as the numerical difference between the liquid limit and plastic limit of the soil. It is the range of water content in which a soil exhibits the characteristics of a plastic solid.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 12){
	var prprty = "Description for Total Sand: ";
	var prprtyText = "Sand as a soil separate consists of mineral soil particles that are 0.05 millimeter to 2 millimeters in diameter. In the database, the estimated sand content of each soil layer is given as a percentage, by weight, of the soil material that is less than 2 millimeters in diameter. The content of sand, silt, and clay affects the physical behavior of a soil. Particle size is important for engineering and agronomic interpretations, for determination of soil hydrologic qualities, and for soil classification.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 34){
	var prprty = "Description for pH H20: ";
	var prprtyText = "Soil reaction is a measure of acidity or alkalinity. It is important in selecting crops and other plants, in evaluating soil amendments for fertility and stabilization, and in determining the risk of corrosion.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 25){
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
else if ($('#selectProp').val() == 28){
	var prprty = "Description for AASHTO Group Index: ";
	var prprtyText = "AASHTO group classification is a system that classifies soils specifically for geotechnical engineering purposes that are related to highway and airfield construction. It is based on particle-size distribution and Atterberg limits, such as liquid limit and plasticity index. This classification system is covered in AASHTO Standard No. M 145-82. The classification is based on that portion of the soil that is smaller than 3 inches in diameter.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 34){
	var prprty = "Description for ph H2O: ";
	var prprtyText = "Soil reaction is a measure of acidity or alkalinity. It is important in selecting crops and other plants, in evaluating soil amendments for fertility and stabilization, and in determining the risk of corrosion. In general, soils that are either highly alkaline or highly acid are likely to be very corrosive to steel. The most common soil laboratory measurement of pH is the 1:1 water method.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 33){
	var prprty = "Description for Sodium Absortion Ratio (SAR): ";
	var prprtyText = "Sodium adsorption ratio is a measure of the amount of sodium (Na) relative to calcium (Ca) and magnesium (Mg) in the water extract from saturated soil paste. It is the ratio of the Na concentration divided by the square root of one-half of the Ca + Mg concentration. Soils that have SAR values of 13 or more may be characterized by an increased dispersion of organic matter and clay particles, reduced saturated hydraulic conductivity (Ksat) and aeration, and a general degradation of soil structure.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 30){
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
else if ($('#selectProp').val() == 29){
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
else if ($('#selectProp').val() == 26){
	var prprty = "Description for Liquid Limit:  ";
	var prprtyText = "Liquid limit (LL) is one of the standard Atterberg limits used to indicate the plasticity characteristics of a soil. It is the water content, on a percent by weight basis, of the soil (passing #40 sieve) at which the soil changes from a plastic to a liquid state. Generally, the amount of clay- and silt-size particles, the organic matter content, and the type of minerals determine the liquid limit. Soils that have a high liquid limit have the capacity to hold a lot of water while maintaining a plastic or semisolid state. Liquid limit is used in classifying soils in the Unified and AASHTO classification systems. For each soil layer, this attribute is actually recorded as three separate values in the database. A low value and a high value indicate the range of this attribute for the soil component. A 'representative' value indicates the expected value of this attribute for the component. For this soil property, only the representative value is used.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 23){
	var prprty = "Description for Organic Matter: ";
	var prprtyText = "Organic matter percent is the weight of decomposed plant, animal, and microbial residues exclusive of non-decomposed plant and animal residues. It is expressed as a percentage, by weight, of the soil material that is less than 2 mm in diameter.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 7){
	var prprty = "Description for Rock 3-10: ";
	var prprtyText = "The percent by weight of the horizon occupied by rock fragments 3 to 10 inches in size.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 8){
	var prprty = "Description for #4 Sieve: ";
	var prprtyText = "Soil fraction passing a number 4 sieve (4.70mm square opening) as a weight percentage of the less than 3 inch (76.4mm) fraction.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 9){
	var prprty = "Description for #10 Sieve: ";
	var prprtyText = "Soil fraction passing a number 10 sieve (2.00mm square opening) as a weight percentage of less than 3 inch (76.4mm) fraction.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 10){
	var prprty = "Description for #40 Sieve: ";
	var prprtyText = "Soil fraction passing a number 40 sieve (0.42mm square opening) as a weight percentage of less than 3 inch (76.4mm) fraction.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 11){
	var prprty = "Description for #200 Sieve: ";
	var prprtyText = "Soil fraction passing a number 200 sieve (0.074mm square opening) as a weight percentage of less than 3 inch (76.4mm) fraction.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 13){
	var prprty = "Description for vcos: ";
	var prprtyText = "Mineral particles 1.00mm to 2.0mm in equivalent diameter as a weight percentage of the less than 2mm fraction.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 14){
	var prprty = "Description for cos: ";
	var prprtyText = "Mineral particles 0.50mm to 1.0mm in equivalent diameter as a weight percentage of the less than 2mm fraction.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 15){
	var prprty = "Description for ms: ";
	var prprtyText = "Mineral particles 0.25mm to 0.5mm in equivalent diameter as a weight percentage of the less than 2mm fraction.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 16){
	var prprty = "Description for fs: ";
	var prprtyText = "Mineral particles 0.10mm to 0.25mm in equivalent diameter as a weight percentage of the less than 2mm fraction.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 17){
	var prprty = "Description for vfs: ";
	var prprtyText = "Mineral particles 0.05mm to 0.10mm in equivalent diameter as a weight percentage of the less than 2mm fraction.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 18){
	var prprty = "Description for Total Silt: ";
	var prprtyText = "Mineral particles ranging in size from 0.002 to 0.05mm in equivalent diameter as a weight percentage of the less than 2.0mm fraction."
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 19){
	var prprty = "Description for Coarse Silt: ";
	var prprtyText = "Mineral particles ranging in size from 0.02mm to 0.05mm in equivalent diameter as a weight percentage of the less than 2.0mm fraction."
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 20){
	var prprty = "Description for Fine Silt: ";
	var prprtyText = "Mineral particles ranging in size from 0.002mm to 0.02mm in equivalent diameter as a weight percentage of the less than 2.0mm fraction."
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 21){
	var prprty = "Description for Total Clay: ";
	var prprtyText = "Mineral particles less than 0.002mm in equivalent diameter as a weight percentage of the less than 2.0mm fraction."
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 22){
	var prprty = "Description for CaCO3 Clay: ";
	var prprtyText = "Carbonate particles less than 0.002mm in equivalent diameter as a weight percentage of the less than 2.0mm fraction."
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 24){
	var prprty = "Description for Part Density: ";
	var prprtyText = "Mass per unit of volume (not including pore space) of the solid soil particle either mineral or organic. Also known as specific gravity.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 31){
	var prprty = "Description for CaCO3: ";
	var prprtyText = "The quantity of Carbonate (CO3)in the soil expressed as CaCO3 and as a weight percentage of the less than 2mm size fraction.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 35){
	var prprty = "Description for ph CaCl2: ";
	var prprtyText = "The negative logarithm to base of 10 or the hydrogen ion activity in the soil, using the 0.01M CaCl2 method, in a 1:2 soil:solution ratio. A numerical expression of the relative acidity or alkalinity of a soil sample.";
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else if ($('#selectProp').val() == 36){
	var prprty = "Description for Excavation Difficulty: ";
	var prprtyText = "An estimation of the difficulty of working an excavation into soil layers, horizons, pedons, or geologic layers. In most instances, excavation difficulty is related to and controlled by a water state."
	var h3 = document.createElement('h3');
	h3.innerHTML = prprty;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
}
else{
	//removePolygons();
}
//draw the legend
if(!hecho){
	var div = document.createElement('div');
	div.innerHTML = "<strong>" + app.payload.value + "</strong><br>" + legendText;
	var legend = document.createElement('div');
	legend = document.getElementById('legend');
	document.getElementById('legend').style.visibility = "visible";
	legend.appendChild(div);
}
else if(hecho){
	removePolygons();
	return;
}
});
}
else{
	document.getElementById('legend').style.visibility = "hidden";
	$('#legend').find('*').not('h3').remove();
	$('#description').find('*').not('h3').remove();
	alert("Please select a property and a district, and make sure depth is a numerical value.");
	removePolygons();
}
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
/******************************************************************************/
google.charts.load('current', {'packages':['corechart', 'bar']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(initialize);

function initialize () {
}

var rec;
var rectangle;
var map;
var infoWindow;
var selectedRec;
var drawingManager;
var paths;

function initMap() {
	app.map = new google.maps.Map(document.getElementById('map'), {
		zoom: 5,
		center: new google.maps.LatLng(31.31610138349565, -99.11865234375),
		mapTypeId: 'terrain'
	});

	app.infoWindow = new google.maps.InfoWindow;

	app.map.addListener('click', function(e) {
	// console.log(e.latLng.toString());
	});

	drawingManager = new google.maps.drawing.DrawingManager({
    drawingControl: true,
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER,
      drawingModes: ['rectangle', 'polyline']
    },
    rectangleOptions: {
      draggable: true,
      clickable: true,
      editable: true,
			zIndex: 10
    },
		polylineOptions: {
			clickable: true,
			draggable: true,
			editable: false,
			geodesic: true,
			zIndex: 10,
			strokeWeight: 6
		}
  });

  drawingManager.setMap(app.map);

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
		app.payload.AoI = 1;
    setSelection(rec);
    google.maps.event.addListener(rec, 'click', function() {
			if(rec.type == 'polyline'){
				lineParser();
		  }
      clickRec(rec);
			drawChart();
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
		app.payload.lineString = null;
    selectedRec.setMap(null);
		infoWindow.close();
    // To show:
    drawingManager.setOptions({
      drawingControl: true,
      drawingControlOptions: {
        position: google.maps.ControlPosition.TOP_CENTER,
        drawingModes: ['rectangle','polyline']
      },
      rectangleOptions: {
        draggable: true,
        clickable: true,
        editable: true,
				zIndex: 10
      },
			polylineOptions: {
				clickable: true,
				draggable: true,
				editable: false,
				geodesic: true,
				zIndex: 10,
				strokeWeight: 6
			}
    });
  }
}

function deleteSelectedShape() {
  if (selectedShape) {
		app.payload.AoI = 0;
    selectedShape.setMap(null);
    // To show
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
	if(shape.type == 'rectangle'){
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
		var contentString = '<b>Rectangle clicked.</b><br><br>' + 'Area is: ' + area + ' m^2';
		var center = shape.getBounds().getCenter();

		// Set the info window's content and position.
		infoWindow.setContent(contentString);
		infoWindow.setPosition(center);

		infoWindow.open(app.map);
	}
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

  infoWindow.open(app.map);
}
var chart;
function drawChart() {
	if(rec.type == 'rectangle'){
		var maxaoi;
		var minaoi;
		var medaoi;
		var weightedaoi;

		app.payload.getMode = "AOI";
		getparams = app.payload;
		bounds = rec.getBounds();
		getparams.NE = bounds.getNorthEast().toJSON();
		getparams.SW = bounds.getSouthWest().toJSON();
		$.get('polygonHandler.php', app.payload, function(data){
			maxaoi = parseFloat(data.maxAOI);
			minaoi = parseFloat(data.minAOI);
			medaoi = parseFloat(data.medAOI);
			weightedaoi = parseFloat(data.weightedAOI);
			weightedaoi = parseFloat(weightedaoi).toFixed(2);
			weightedaoi = parseFloat(weightedaoi);

			var data = google.visualization.arrayToDataTable([
				['Method', 'Value',],
				['Maximum ' + app.payload.value + ' for AOI', maxaoi],
				['Minimum '+ app.payload.value + ' for AOI', minaoi],
				['Median '+ app.payload.value + ' for AOI', medaoi],
				['Weighted Average '+ app.payload.value + ' for AOI', weightedaoi]
			]);

			var options = {
				title: 'Data for Area Of Interest',
				chartArea: {
					width: '40%'
				},
				hAxis: {
					title: 'Values',
					minValue: 0
				},
				vAxis: {
					title: 'Methods'
				}
			};

			chart = new google.visualization.BarChart(document.getElementById('chart_area'));
			chart.draw(data, options);
		});
	}
	else{
		var maxaoi;
		var minaoi;
		var medaoi;
		var weightedaoi;

		app.payload.getMode = "line";
		$.get('polygonHandler.php', app.payload, function(data){
			maxaoi = parseFloat(data.maxAOI);
			minaoi = parseFloat(data.minAOI);
			medaoi = parseFloat(data.medAOI);
			weightedaoi = parseFloat(data.weightedAOI);
			weightedaoi = parseFloat(weightedaoi).toFixed(2);
			weightedaoi = parseFloat(weightedaoi);

			var data = google.visualization.arrayToDataTable([
				['Method', 'Value',],
				['Maximum ' + app.payload.value + ' for AOI', maxaoi],
				['Minimum '+ app.payload.value + ' for AOI', minaoi],
				['Median '+ app.payload.value + ' for AOI', medaoi],
				['Weighted Average '+ app.payload.value + ' for AOI', weightedaoi]
			]);

			var options = {
				title: 'Data for Areas Intersecting with Line',
				chartArea: {
					width: '40%'
				},
				hAxis: {
					title: 'Values',
					minValue: 0
				},
				vAxis: {
					title: 'Methods'
				}
			};

			chart = new google.visualization.BarChart(document.getElementById('chart_area'));
			chart.draw(data, options);
		});
	}
}

function lineParser(){
	app.payload.getMode = "line";
	var lineString = "";
	paths = rec.getPath();
	paths = paths.getArray();

	for (var i = 0; i < paths.length; i++) {
		//console.log(paths[i].lng() + ' ' + paths[i].lat());
		if(paths.length > 1 && i < paths.length - 1){
			lineString += paths[i].lng() + ' ' + paths[i].lat() + ',';
		}
		else{
			lineString += paths[i].lng() + ' ' + paths[i].lat();
		}
	}
	//console.log(lineString);
	app.payload.lineString = lineString;
	//$.get('polygonHandler.php', app.payload, function(data){});
}

/******************************************************************************/
function removePolygons(){
	if(app.polygons){
		for(var i = 0; i < app.polygons.length; i++){
			app.polygons[i].setMap(null);
		}
	}
	app.polygons = [];
	app.infoWindow.close();
	document.getElementById('legend').style.visibility = "hidden";
	$('#legend').find('*').not('h3').remove();
	$('#description').find('*').not('h3').remove();
	if(typeof chart === 'undefined'){

	}else{
		chart.clearChart();
	}
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

function spawn(){
	//document.getElementById('legend').style.visibility = "visible";
	var labels = document.getElementById('labels').value;
	var value = document.getElementById('value').value;
	/*
	var gypsum = "Description for Gypsum: ";
	var gypsumText = "The content of gypsum is the percent, by weight, of hydrated calcium sulfates in the fraction of the soil less than 20 millimeters in size. "; // Gypsum is partially soluble in water. Soils high in content of gypsum, such as those with more than 10 percent gypsum, may collapse if the gypsum is removed by percolating water. Gypsum is corrosive to concrete.
	//For each soil layer, this attribute is actually recorded as three separate values in the database. A low value and a high value indicate the range of this attribute for the soil component. A \"representative\" value indicates the expected value of this attribute for the component. For this soil property, only the representative value is used.";
	var h3 = document.createElement('h3');
	h3.innerHTML = gypsum;
	var div = document.createElement('div');
	div.innerHTML = "<br> <strong>" + gypsum + "</strong> <br>" + gypsumText + "<br> <br>";
	var descriptor = document.getElementById('description');
	descriptor.appendChild(div);
	*/
	//console.log(labels);
	//console.log(value);
	if(labels == 0 || value == 0){
		alert("Zero labels & zero value");
	}
	else{
		var range = (value/labels);
		var count = 0;
		var cnt = 0;
		var spawner = document.getElementById('legendSpawner');
		var separations = [];
		while(count<=value){
			//console.log(count);
			separations[cnt] =  parseFloat(count).toFixed(2);
			count+=range;
			cnt++;
		}
	}
	//console.log(count);
	console.log(separations);
}

// ***********
</script>
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY0B3_Fr1vRpgJDdbvNmrVyXmoOOtiq64&callback=initMap"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY0B3_Fr1vRpgJDdbvNmrVyXmoOOtiq64&libraries=drawing&callback=initMap"async defer></script>
</body>
</html>
