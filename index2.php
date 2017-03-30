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
				<!--<div id="legend"> -->
				<!--<h3>Legend</h3> -->
				<div id="legend" style='visibility: hidden'>
					<h3>Legend</h3>
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
	<!--Description text-->
	<div class="row">

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
					console.log(suggestion.data + "  " + suggestion.table + "  " + suggestion.value);
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
								console.log("Testing new legend: "+app.payload.property);
								if(app.payload.property == "caco3_r"){ //Testing legend and logic for drawing for this specific property
									console.log(app.payload.property);
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
									console.log(amountIn);
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
									console.log(app.payload.property);
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
									console.log(amountIn);
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
										case (amountIn > 80 && amountIn < 101): // BETWEEN 81 AND 100
										colorSelector = 6;
										newzIndex = 6;
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
						console.log("Testing description: "+app.payload.value); //the descriptor for the propierty, for example: "Gypsum"
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
			else if ($('#autocomplete').val() == "OM"){
				var prprty = "Description for Organic Matter (OM): ";
				var prprtyText = "Organic matter is the plant and animal residue in the soil at various stages of decomposition. The estimated content of organic matter is expressed as a percentage, by weight, of the soil material that is less than 2 millimeters in diameter. <br> The content of organic matter in a soil can be maintained by returning crop residue to the soil. Organic matter has a positive effect on available water capacity, water infiltration, soil organism activity, and tilth. It is a source of nitrogen and other nutrients for crops and soil organisms. An irregular distribution of organic carbon with depth may indicate different episodes of soil deposition or soil formation. Soils that are very high in organic matter have poor engineering properties and subside upon drying.";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;

				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			else if ($('#autocomplete').val() == "Total Clay"){
				var prprty = "Description for " + $('#autocomplete').val() + ": ";
				var prprtyText = "Clay as a soil separate consists of mineral soil particles that are less than 0.002 millimeter in diameter. The estimated clay content of each soil layer is given as a percentage, by weight, of the soil material that is less than 2 millimeters in diameter. The amount and kind of clay affect the fertility and physical condition of the soil and the ability of the soil to adsorb cations and to retain moisture. They influence shrink-swell potential, saturated hydraulic conductivity (Ksat), plasticity, the ease of soil dispersion, and other soil properties. The amount and kind of clay in a soil also affect tillage and earth-moving operations.";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;

				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			else if ($('#autocomplete').val() == "Total Silt"){
				var prprty = "Description for " + $('#autocomplete').val() + ": ";
				var prprtyText = "Silt as a soil separate consists of mineral soil particles that are 0.002 to 0.05 millimeter in diameter. In the database, the estimated silt content of each soil layer is given as a percentage, by weight, of the soil material that is less than 2 millimeters in diameter.";
				var h3 = document.createElement('h3');
				h3.innerHTML = prprty;

				var div = document.createElement('div');
				div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
				var descriptor = document.getElementById('description');
				descriptor.appendChild(div);
			}
			/* paste text here
			Silt as a soil separate consists of mineral soil particles that are 0.002 to 0.05 millimeter in diameter. In the database, the estimated silt content of each soil layer is given as a percentage, by weight, of the soil material that is less than 2 millimeters in diameter.
			*/
			else{
			}
			/** Copy and paste to change properties.
			else if ($('#autocomplete').val() == "<>"){
			var prprty = "Description for " + $('#autocomplete').val() + ": ";
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
		div.innerHTML = "<strong>" + $('#autocomplete').val() + "</strong><br>" + legendText;
		var legend = document.createElement('div');
		legend = document.getElementById('legend');
		document.getElementById('legend').style.visibility = "visible";
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
