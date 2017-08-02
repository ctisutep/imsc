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

	<!-- Custom CSS -->
	<link href="css/custom.css" rel="stylesheet" type="text/css">
	<link href="css/modern-business.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="css/font-awesome.css" rel="stylesheet" type="text/css">

	<!--switches-->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/css-toggle-switch/latest/toggle-switch.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<style>
	#legend {
		font-family: Arial, sans-serif;
		background: #fff;
		padding: 6px;
		margin: 30px;
		border: 3px solid #000;
		margin-top: 50px;
		margin-bottom: 20px;
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
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="text-center" style='font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;'>
				<h3 style="color:#FF8000;margin-right:8%;padding-top:1%;">CENTER FOR TRANSPORTATION INFRASTRUCTURE SYSTEMS</h3>
				<h6><i style="color:white;margin-right:8%">"Designated as a Member of National, Regional, and Tier 1 University Transportation Center."</i></h6>
			</div>
		</div>
	</nav>

	<!-- Content Row -->
	<div>
		<div class="row">
			<div class="col-md-9">
				<div class="row">
					<div id="map"></div>
					<div id="description"></div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="row">
							<div id="chart_area_1"> </div>
						</div>
						<div class="row">
							<div id="chart_area_2"> </div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="row">
							<div id="chart_histogram_1"> </div>
						</div>
						<div class="row">
							<div id="chart_histogram_2"> </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="row">
							<div id="chart_area_3"> </div>
						</div>
						<div class="row">
							<div id="chart_area_4"> </div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="row">
							<div id="chart_histogram_3"> </div>
						</div>
						<div class="row">
							<div id="chart_histogram_4"> </div>
						</div>
					</div>
				</div>
			</div> <!-- End main column 1 -->
			<div class="col-md-3">
				<div class="col-md-11">
					<div class="panel panel-default">
						<div class="panel-heading">
							<center><h3 class="panel-title">Toolbar</h3></center>
						</div>
						<div class="panel-body">
							<div class="row panel panel-default">
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
							<div class="row panel panel-default">
								<center><label>Soil Mapping</label></center>
								<div class="row">
									<ul class="nav nav-tabs">
										<li class="active"><a data-toggle="tab" href="#default" data-target="#default, #defaultbtn">Default</a></li>
										<li><a data-toggle="tab" href="#filters" data-target="#filters, #filtersbtn">Filter</a></li>
									</ul>

									<div class="col-md-5 col-sm-11 col-lg-7">
										<div class="tab-content">
											<div id="default" class="tab-pane fade in active">
												<label> Soil Property:</label>
												<div class="input-group">
													<span class="input-group-addon glyphicon glyphicon-search" id="basic-addon"></span>
													<select type="text" class="form-control" placeholder="Ground Property" aria-describedby="basic-addon" id="selectProp">
														<option value="" disabled selected>Select a ground property</option>
													</select>
												</div> <br>
												<label> Depth:</label>
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon3">inches</span>
													<input type="number" class="form-control" value="0" min="0" placeholder="...inches" id="depth" aria-describedby="basic-addon3">
												</div><br>
												<label> Method:</label>
												<select id="methods" class="form-control">
													<option value="" disabled selected>Select method</option>
													<option value="1" id="max_method">Max</option>
													<option value="2" id="min_method">Min</option>
													<option value="3" id="med_method">Median</option>
													<option value="4" id="weight_method">Weighted average</option>
													<option value="5" id="specific_method">At Specific Depth</option>
												</select><br>
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon3"># of labels</span>
													<input type="number" class="form-control" value="1" min="0"placeholder="...inches" id="labels" aria-describedby="basic-addon3">
												</div>
											</div>
											<div id="filters" class="tab-pane fade">
												<div class="form-check">
													<p class="form-check-label">
														<input class="form-check-input" type="radio" name="exampleRadios" id="biggerThan" value="bigger" checked>
														Only color those polygons that are bigger than the unit value
													</p>
												</div>
												<div class="form-check">
													<p class="form-check-label">
														<input class="form-check-input" type="radio" name="exampleRadios" id="smallerThan" value="smaller">
														Only color those polygons that are smaller than the unit value
													</p>
												</div>
												<div class="input-group">
													<span class="input-group-addon glyphicon glyphicon-search" id="basic-addon"></span>
													<select type="text" class="form-control" placeholder="Ground Property" aria-describedby="basic-addon" id="select_prop_filters">
														<option value="" disabled selected>Select a ground property</option>
													</select>
												</div> <br>
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon3">unit value</span>
													<input type="number" class="form-control" value="1" min="0"placeholder="...units" id="filter_units" aria-describedby="basic-addon3">
												</div>
											</div>
										</div>
									</div> <!--end column for selectors-->

									<div class="col-md-5"><br>
										<div class="tab-content">
											<div id="defaultbtn" class="tab-pane fade in active">
												<button class="btn btn-success form-control" type="button" id="run" onClick="getPolygons()">Run</button><br><br>
												<button class="btn btn-success form-control" type="button" id="runAOI" onClick="runAOI()">Run AOI</button><br><br>
												<button class="btn btn-warning form-control" type="button" id="clear" onClick="removePolygons()">Clear</button><br><br>
												<button type="button" class="map-print" id="print" onClick="printMaps()">Print</button>
											</div>
											<div id="filtersbtn" class="tab-pane fade"><br><br><br><br>
												<button class="btn btn-success form-control" type="button" id="runFilters" onClick="runFilters()">Run Filter</button><br><br>
											</div>
										</div>
									</div> <!-- end column for buttons-->

								</div>
								<div class="row">
									<div class="col-md-5 col-sm-11 col-lg-7">
										<!--unused col -->
									</div>
									<div class"col-md-7">
										<div id="legend" style='visibility: hidden'>
										</div>
									</div>
								</div>
								<div class="row panel panel-default">
									<center><label>Statistics</label></center>
									<div class="col-lg-6">
										<label>Select parameters:</label>
										<div class="input-group">
											<span class="input-group-addon glyphicon glyphicon-search" id="basic-addon"></span>
											<select type="text" class="form-control" placeholder="Ground Property" aria-describedby="basic-addon" id="select_chart_1">
												<option value="" disabled selected>Select a ground property</option>
											</select>
										</div> <br>
										<div class="input-group">
											<span class="input-group-addon glyphicon glyphicon-search" id="basic-addon"></span>
											<select type="text" class="form-control" placeholder="Ground Property" aria-describedby="basic-addon" id="select_chart_2">
												<option value="" disabled selected>Select a ground property</option>
											</select>
										</div> <br>
										<div class="input-group">
											<span class="input-group-addon glyphicon glyphicon-search" id="basic-addon"></span>
											<select type="text" class="form-control" placeholder="Ground Property" aria-describedby="basic-addon" id="select_chart_3">
												<option value="" disabled selected>Select a ground property</option>
											</select>
										</div> <br>
										<div class="input-group">
											<span class="input-group-addon glyphicon glyphicon-search" id="basic-addon"></span>
											<select type="text" class="form-control" placeholder="Ground Property" aria-describedby="basic-addon" id="select_chart_4">
												<option value="" disabled selected>Select a ground property</option>
											</select>
										</div> <br>
									</div>
									<div class="col-md-5"><br><br><br><br><br>
										<button type="button" class="btn btn-default form-control" id="draw" onclick="drawAnotherRectangle();">Clear AOI</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- End main column 2 -->
			</div>

			<script src="js/jquery.js"></script>
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script src="js/bootstrap.js"></script>
			<script src="js/jquery.autocomplete.min.js"></script>
			<script src="js/properties.js"></script>

			<script>
			var app = {map:null, polygons:null, payload:{getMode:"polygons", runAOI:false, runLine:false, runRec:false, property:null, district:null, depth:0, depth_method:null, AoI:null, lineString:null, chart1:null, chart1n:null, chart2:null, chart2n:null, chart3:null, chart3n:null, chart4:null, chart4n:null, filter_prop:null, filter_prop_n:null}}; //added value for depth method
			var hecho = false;
			//var suggested = all the aliases of the properties, note: not all properties have an alias
			$(document).ready(function(){
				$.post('polygonHandler.php', {'columns': true}, function(result){
					var properties;
					if(result.hasOwnProperty('columns')){
						properties = $.map(result.columns, function(val, i){
							return {value: val[2], data: val[1], table: val[3]};
						});
					}
					var selectProp = document.getElementById("selectProp");
					var ch1 = document.getElementById("select_chart_1");
					var ch2 = document.getElementById("select_chart_2");
					var ch3 = document.getElementById("select_chart_3");
					var ch4 = document.getElementById("select_chart_4");
					var filt = document.getElementById("select_prop_filters");

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
						{number: 36, value: null, data: null, table: null}
						//{number: 37, value: null, data: null, table: null}
					];

					for (var i = 0; i < properties.length; i++) {
						prop[i].number = i;
						prop[i].value = properties[i].value;
						prop[i].data = properties[i].data;
						prop[i].table = properties[i].table;

					}
					for(var i = 0; i < properties.length; i++) {
						var propr = prop[i].number;
						var elem = document.createElement("option");
						elem.textContent = prop[i].value;
						elem.value = propr;
						elem.data = prop[i].data;
						elem.table = prop[i].table;
						selectProp.appendChild(elem);
					}
					for(var i = 0; i < properties.length; i++) {
						var propr = prop[i].number;
						var elem = document.createElement("option");
						elem.textContent = prop[i].value;
						elem.value = propr;
						elem.data = prop[i].data;
						elem.table = prop[i].table;
						ch1.appendChild(elem);
					}
					for(var i = 0; i < properties.length; i++) {
						var propr = prop[i].number;
						var elem = document.createElement("option");
						elem.textContent = prop[i].value;
						elem.value = propr;
						elem.data = prop[i].data;
						elem.table = prop[i].table;
						ch2.appendChild(elem);
					}
					for(var i = 0; i < properties.length; i++) {
						var propr = prop[i].number;
						var elem = document.createElement("option");
						elem.textContent = prop[i].value;
						elem.value = propr;
						elem.data = prop[i].data;
						elem.table = prop[i].table;
						ch3.appendChild(elem);
					}
					for(var i = 0; i < properties.length; i++) {
						var propr = prop[i].number;
						var elem = document.createElement("option");
						elem.textContent = prop[i].value;
						elem.value = propr;
						elem.data = prop[i].data;
						elem.table = prop[i].table;
						ch4.appendChild(elem);
					}
					for(var i = 0; i < properties.length; i++) {
						var propr = prop[i].number;
						var elem = document.createElement("option");
						elem.textContent = prop[i].value;
						elem.value = propr;
						elem.data = prop[i].data;
						elem.table = prop[i].table;
						filt.appendChild(elem);
					}

					$("#selectProp").change(function(){
						app.payload.property =  prop[this.value].data; //ex. pi_r
						app.payload.table =  prop[this.value].table;
						app.payload.value =  prop[this.value].value;
					});
					$("#select_chart_1").change(function(){
						app.payload.chart1 =  prop[this.value].data;
						app.payload.chart1n = prop[this.value].value;
					});
					$("#select_chart_2").change(function(){
						app.payload.chart2 =  prop[this.value].data;
						app.payload.chart2n = prop[this.value].value;
					});
					$("#select_chart_3").change(function(){
						app.payload.chart3 =  prop[this.value].data;
						app.payload.chart3n = prop[this.value].value;
					});
					$("#select_chart_4").change(function(){
						app.payload.chart4 =  prop[this.value].data;
						app.payload.chart4n = prop[this.value].value;
					});
					$("#select_prop_filt").change(function(){
						app.payload.filter_prop =  prop[this.value].data;
						app.payload.filter_prop_n = prop[this.value].value;
					});

					$("#biggerThan").click(function(){
						console.log(this.value);
					});
					$("#smallerThan").click(function(){
						console.log(this.value);
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


				$("#methods").change(function(){ //0: max / 1: min / 2: median / 3: weight/
					app.payload.depth_method = this.value;
				});
			});

			function runAOI(){
				app.payload.runAOI = true;
				getPolygons();
			}

			function getPolygons(){
				var maximum;
				app.payload.getMode="polygons";
				hecho = false;
				var depth = document.getElementById("depth").value;
				depth = parseFloat(depth);

				app.payload.depth = depth;
				if(app.payload.property && app.payload.district && (isNaN(depth)==false)){//to make sure a property is selected
					if(app.payload.runAOI == true && typeof rec != 'undefined' && rec.type == 'rectangle'){
						var getparams = app.payload;
						var bounds = rec.getBounds();
						getparams.NE = bounds.getNorthEast().toJSON(); //north east corner
						getparams.SW = bounds.getSouthWest().toJSON();
					}
					else{
						var getparams = app.payload;
						var bounds = app.map.getBounds();
						getparams.NE = bounds.getNorthEast().toJSON(); //north east corner
						getparams.SW = bounds.getSouthWest().toJSON(); //south-west corner
					}

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
							//shapecolor = ["#84857B", "#FF0000", "#009BFF", "#13FF00", "#6100FF", "#fe9253", "#F20DD6", "#0051FF", "#AB77FF", "#EBF20D", "#8C0909", "#07FDCA", "#008C35", "FFDBA5", "#B57777", "#6D3300", "#D0FF00", "#5900FF"];
							//shapeoutline = ["#000000", "#c10000", "#007fd1", "#0b9b00", "#310082", "#d18f0a", "#bc0ba7", "#0037ad", "#873dff", "#aaaf0a", "8c0909", "36c9bd", "#008c35", "#ffdba5", "#B57777", "#6D3300", "#D0FF00", "#5900FF"];

							shapecolor = ["#84857B", "#13FF00", "#009BFF", "#EBF20D", "#fe9253", "#FF0000", "#8C0909", "#0051FF", "#AB77FF", "#EBF20D", "#8C0909", "#07FDCA", "#008C35", "FFDBA5", "#B57777", "#6D3300", "#D0FF00", "#5900FF"];
							shapeoutline = ["#000000", "#0b9b00", "#007fd1", "#aaaf0a", "#d18f0a", "#c10000", "#8c0909", "#0037ad", "#873dff", "#aaaf0a", "8c0909", "36c9bd", "#008c35", "#ffdba5", "#B57777", "#6D3300", "#D0FF00", "#5900FF"];
							colorSelector = 0;
							newzIndex = 0;
							legendText = "";
							maximum = -1;
							for(var i = 0; i < data.coords.length; i++){
								if(maximum < parseFloat(data.coords[i][app.payload.property])){
									maximum = data.coords[i][app.payload.property];
								}
							}
							var div = document.createElement('div');
							div.innerHTML = "<strong>" + "Legend for " + app.payload.value + "</strong>";
							var l = document.createElement('div');
							l = document.getElementById('legend');
							l.appendChild(div);

							var num_labels = spawn(maximum);
							if(num_labels != null){
							}
							else{
								alert("Please select a feasible number of labels.");
								$('#legend').find('*').not('h3').remove();
								var div = document.createElement('div');
								div.innerHTML = "<strong>" + "Legend N/A" + "</strong>" + "<br>" + "<img src='img/brightgreensquare.png' height='10px'/> "
								+ " 0 to " + maximum;
								var l = document.createElement('div');
								l = document.getElementById('legend');
								l.appendChild(div);
								num_labels = [];
							}
							var polyCoordis = [];
							for(key in data.coords){
								if(data.coords.hasOwnProperty(key)){
									var polyCoordis = [];
									if(app.payload.table == "chorizon_r"){
										var a = parseFloat(data.coords[key][app.payload.property]);
										colorSelector = 0;
										if(a == 0){
											colorSelector = 1;
										}
										for(var i = 0; i < num_labels.length; i++){
											if(a > num_labels[i]){
												colorSelector = i+1;
											}
										}
									}
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
									polygon.setOptions({ zIndex: -1 });
									polygon.addListener('click', polyInfo);
									app.polygons.push(polygon);
									polygon.setMap(app.map);
								}
							}
						}
					}).done(function(data){
						$(document.body).css({'cursor': 'auto'});

					if(app.payload.property == 'gypsum_r'){ //should have made it like this: if(app.payload.value == "gypsum"){ //but it's too late now
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
					else if (app.payload.property == 'pi_r'){
						var prprty = "Description for Plasticity Index: ";
						var prprtyText = "Plasticity index (PI) is one of the standard Atterberg limits used to indicate the plasticity characteristics of a soil. It is defined as the numerical difference between the liquid limit and plastic limit of the soil. It is the range of water content in which a soil exhibits the characteristics of a plastic solid.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'sandtotal_r'){
						var prprty = "Description for Total Sand: ";
						var prprtyText = "Sand as a soil separate consists of mineral soil particles that are 0.05 millimeter to 2 millimeters in diameter. In the database, the estimated sand content of each soil layer is given as a percentage, by weight, of the soil material that is less than 2 millimeters in diameter. The content of sand, silt, and clay affects the physical behavior of a soil. Particle size is important for engineering and agronomic interpretations, for determination of soil hydrologic qualities, and for soil classification.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'ph1to1h2o_r'){
						var prprty = "Description for pH H20: ";
						var prprtyText = "Soil reaction is a measure of acidity or alkalinity. It is important in selecting crops and other plants, in evaluating soil amendments for fertility and stabilization, and in determining the risk of corrosion.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'ksat_r'){
						var prprty = "Description for Ksat: ";
						var prprtyText = "Saturated hydraulic conductivity (Ksat) refers to the ease with which pores in a saturated soil transmit water. The estimates are expressed in terms of micrometers per second. They are based on soil characteristics observed in the field, particularly structure, porosity, and texture. ";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'aashind_r'){
						var prprty = "Description for AASHTO Group Index: ";
						var prprtyText = "AASHTO group classification is a system that classifies soils specifically for geotechnical engineering purposes that are related to highway and airfield construction. It is based on particle-size distribution and Atterberg limits, such as liquid limit and plasticity index. This classification system is covered in AASHTO Standard No. M 145-82. The classification is based on that portion of the soil that is smaller than 3 inches in diameter.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'sar_r'){
						var prprty = "Description for Sodium Absortion Ratio (SAR): ";
						var prprtyText = "Sodium adsorption ratio is a measure of the amount of sodium (Na) relative to calcium (Ca) and magnesium (Mg) in the water extract from saturated soil paste. It is the ratio of the Na concentration divided by the square root of one-half of the Ca + Mg concentration. Soils that have SAR values of 13 or more may be characterized by an increased dispersion of organic matter and clay particles, reduced saturated hydraulic conductivity (Ksat) and aeration, and a general degradation of soil structure.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'kffact'){
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
					else if (app.payload.property == 'kwfact'){
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
					else if (app.payload.property == 'll_r'){
						var prprty = "Description for Liquid Limit:  ";
						var prprtyText = "Liquid limit (LL) is one of the standard Atterberg limits used to indicate the plasticity characteristics of a soil. It is the water content, on a percent by weight basis, of the soil (passing #40 sieve) at which the soil changes from a plastic to a liquid state. Generally, the amount of clay- and silt-size particles, the organic matter content, and the type of minerals determine the liquid limit. Soils that have a high liquid limit have the capacity to hold a lot of water while maintaining a plastic or semisolid state. Liquid limit is used in classifying soils in the Unified and AASHTO classification systems. For each soil layer, this attribute is actually recorded as three separate values in the database. A low value and a high value indicate the range of this attribute for the soil component. A 'representative' value indicates the expected value of this attribute for the component. For this soil property, only the representative value is used.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'om_r'){
						var prprty = "Description for Organic Matter: ";
						var prprtyText = "Organic matter percent is the weight of decomposed plant, animal, and microbial residues exclusive of non-decomposed plant and animal residues. It is expressed as a percentage, by weight, of the soil material that is less than 2 mm in diameter.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'frag3to10_r'){
						var prprty = "Description for Rock 3-10: ";
						var prprtyText = "The percent by weight of the horizon occupied by rock fragments 3 to 10 inches in size.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'sieveno4_r'){
						var prprty = "Description for #4 Sieve: ";
						var prprtyText = "Soil fraction passing a number 4 sieve (4.70mm square opening) as a weight percentage of the less than 3 inch (76.4mm) fraction.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'sieveno10_r'){
						var prprty = "Description for #10 Sieve: ";
						var prprtyText = "Soil fraction passing a number 10 sieve (2.00mm square opening) as a weight percentage of less than 3 inch (76.4mm) fraction.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'sieveno40_r'){
						var prprty = "Description for #40 Sieve: ";
						var prprtyText = "Soil fraction passing a number 40 sieve (0.42mm square opening) as a weight percentage of less than 3 inch (76.4mm) fraction.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'sieveno200_r'){
						var prprty = "Description for #200 Sieve: ";
						var prprtyText = "Soil fraction passing a number 200 sieve (0.074mm square opening) as a weight percentage of less than 3 inch (76.4mm) fraction.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'sandvc_r'){
						var prprty = "Description for vcos: ";
						var prprtyText = "Mineral particles 1.00mm to 2.0mm in equivalent diameter as a weight percentage of the less than 2mm fraction.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'sandco_r'){
						var prprty = "Description for cos: ";
						var prprtyText = "Mineral particles 0.50mm to 1.0mm in equivalent diameter as a weight percentage of the less than 2mm fraction.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'sandmed_r'){
						var prprty = "Description for ms: ";
						var prprtyText = "Mineral particles 0.25mm to 0.5mm in equivalent diameter as a weight percentage of the less than 2mm fraction.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'sandfine_r'){
						var prprty = "Description for fs: ";
						var prprtyText = "Mineral particles 0.10mm to 0.25mm in equivalent diameter as a weight percentage of the less than 2mm fraction.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'sandvf_r'){
						var prprty = "Description for vfs: ";
						var prprtyText = "Mineral particles 0.05mm to 0.10mm in equivalent diameter as a weight percentage of the less than 2mm fraction.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'silttotal_r'){
						var prprty = "Description for Total Silt: ";
						var prprtyText = "Mineral particles ranging in size from 0.002 to 0.05mm in equivalent diameter as a weight percentage of the less than 2.0mm fraction."
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'siltco_r'){
						var prprty = "Description for Coarse Silt: ";
						var prprtyText = "Mineral particles ranging in size from 0.02mm to 0.05mm in equivalent diameter as a weight percentage of the less than 2.0mm fraction."
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'siltfine_r'){
						var prprty = "Description for Fine Silt: ";
						var prprtyText = "Mineral particles ranging in size from 0.002mm to 0.02mm in equivalent diameter as a weight percentage of the less than 2.0mm fraction."
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'claytotal_r'){
						var prprty = "Description for Total Clay: ";
						var prprtyText = "Mineral particles less than 0.002mm in equivalent diameter as a weight percentage of the less than 2.0mm fraction."
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'claysizedcarb_r'){
						var prprty = "Description for CaCO3 Clay: ";
						var prprtyText = "Carbonate particles less than 0.002mm in equivalent diameter as a weight percentage of the less than 2.0mm fraction."
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'partdensity'){
						var prprty = "Description for Part Density: ";
						var prprtyText = "Mass per unit of volume (not including pore space) of the solid soil particle either mineral or organic. Also known as specific gravity.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'caco3_r'){
						var prprty = "Description for CaCO3: ";
						var prprtyText = "The quantity of Carbonate (CO3) in the soil expressed as CaCO3 and as a weight percentage of the less than 2mm size fraction.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'ph01mcacl2_r'){
						var prprty = "Description for ph CaCl2: ";
						var prprtyText = "The negative logarithm to base of 10 or the hydrogen ion activity in the soil, using the 0.01M CaCl2 method, in a 1:2 soil:solution ratio. A numerical expression of the relative acidity or alkalinity of a soil sample.";
						var h3 = document.createElement('h3');
						h3.innerHTML = prprty;
						var div = document.createElement('div');
						div.innerHTML = "<br> <strong>" + prprty + "</strong> <br>" + prprtyText + "<br> <br>";
						var descriptor = document.getElementById('description');
						descriptor.appendChild(div);
					}
					else if (app.payload.property == 'excavdifcl'){
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
					}

					if(!hecho){
						var div = document.createElement('div');
						div.innerHTML = "<strong>" + "</strong>" + legendText;
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
				if(rec.type == 'polyline'){
					lineParser();
				}

				google.maps.event.addListener(rec, 'click', function() {
					if(rec.type == 'polyline'){
						lineParser();
					}
					clickRec(rec);
					chartChecker();
				});

				google.maps.event.addListener(rec, 'bounds_changed', function() {
					showNewRect2(rec);
				});

				if(rec.type == 'polyline'){
					google.maps.event.addListener(rec, 'dragend', function() {
						lineParser();
					});
				}

			});

			google.maps.event.addDomListener(document.getElementById('draw'), 'click', drawAnotherRectangle);

			infoWindow = new google.maps.InfoWindow();
		}

		function drawAnotherRectangle(){
			if (selectedRec) {
				app.payload.lineString = null;
				app.payload.runLine = false;
				app.payload.runRec = false;
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

			infoWindow.setContent(contentString);
			infoWindow.setPosition(ne);

			infoWindow.open(app.map);
		}

		var chart;
		var chart_2;
		var chart_3;
		var chart_4;
		var chart_histo;
		var chart_histo_2;
		var chart_histo_3;
		var chart_histo_4;
		function chartChecker(){
			if(app.payload.chart1 != null){
				drawChart(1);
			}

			if(app.payload.chart2 != null){
				drawChart(2);
			}

			if(app.payload.chart3 != null){
				drawChart(3);
			}

			if(app.payload.chart4 != null){
				drawChart(4);
			}
		}

		function drawChart(x) {
			if(typeof chart === 'undefined'){
			}else{
				chart.clearChart();
				chart_histo.clearChart();
			}

			if(typeof chart_2 === 'undefined'){
			}else{
				chart_2.clearChart();
				chart_histo_2.clearChart();
			}

			if(typeof chart_3 === 'undefined'){
			}else{
				chart_3.clearChart();
				chart_histo_3.clearChart();
			}

			if(typeof chart_4 === 'undefined'){
			}else{
				chart_4.clearChart();
				chart_histo_4.clearChart();
			}

			if(rec.type == 'rectangle'){
				var maxaoi;
				var minaoi;
				var medaoi;
				var weightedaoi;
				var previous1;
				var previous2;
				var previous3;
				var previous4;

				app.payload.getMode = "AOI";
				getparams = app.payload;
				bounds = rec.getBounds();
				getparams.NE = bounds.getNorthEast().toJSON();
				getparams.SW = bounds.getSouthWest().toJSON();
				if(x == 1){
					previous1 = app.payload.chart1;
					previous2 = app.payload.chart2;
					previous3 = app.payload.chart3;
					previous4 = app.payload.chart4;
					app.payload.chart1;
					app.payload.chart2 = null;
					app.payload.chart3 = null;
					app.payload.chart4 = null;

					$.get('polygonHandler.php', app.payload, function(data){
						maxaoi = parseFloat(data.maxAOIch1);
						minaoi = parseFloat(data.minAOIch1);
						medaoi = parseFloat(data.medAOIch1);
						weightedaoi = parseFloat(data.weightedAOIch1);
						weightedaoi = parseFloat(weightedaoi).toFixed(2);
						weightedaoi = parseFloat(weightedaoi);

						var data = google.visualization.arrayToDataTable([
							['Method', 'Value',],
							['Maximum ', maxaoi],
							['Minimum ', minaoi],
							['Median ', medaoi],
							['Weighted Avg ', weightedaoi]
						]);

						var options = {
							title: app.payload.chart1n,
							legend: {
								position: 'none'
							},
							chartArea: {
								width: '70%'
							},
							hAxis: {
								//title: 'a',
								minValue: 0
							},
							vAxis: {
								//title: 'b'
							}
						};
						chart = new google.visualization.BarChart(document.getElementById('chart_area_1'));
						chart.draw(data, options);
					});

					var histo_array;
					app.payload.getMode = "histogram";
					$.get('polygonHandler.php', app.payload, function(data){
						histo_array = data.values;
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Property');
						data.addColumn('number', 'Value');
						data.addRows(histo_array.length);
						var max = Math.max(...histo_array);
						for (var i = 0; i < histo_array.length; i++) {
							data.setCell(i, 1, histo_array[i]);
						}
						var size;
						size = Math.ceil(Math.sqrt(histo_array.length - 1)) - 1;
						size = Math.ceil(max/size);
						var options = {
							title: app.payload.chart1n,
							legend: {
								position: 'none'
							},
							histogram: {
								bucketSize: size
							},
							// bar: { width: 5 },
							hAxis: {
								type: 'category'
								// , viewWindow: { min: 0, max: 6 } // note min and max values are indices when type is category.
							}
						};

						chart_histo = new google.visualization.Histogram(document.getElementById('chart_histogram_1'));
						chart_histo.draw(data, options);
					});
					app.payload.getMode = "AOI";
					app.payload.chart1 = previous1;
					app.payload.chart2 = previous2;
					app.payload.chart3 = previous3;
					app.payload.chart4 = previous4;
				}
				else if (x == 2) {
					previous1 = app.payload.chart1;
					previous2 = app.payload.chart2;
					previous3 = app.payload.chart3;
					previous4 = app.payload.chart4;
					app.payload.chart1 = null;
					app.payload.chart2;
					app.payload.chart3 = null;
					app.payload.chart4 = null;
					$.get('polygonHandler.php', app.payload, function(data){
						maxaoi = parseFloat(data.maxAOIch2);
						minaoi = parseFloat(data.minAOIch2);
						medaoi = parseFloat(data.medAOIch2);
						weightedaoi = parseFloat(data.weightedAOIch2);
						weightedaoi = parseFloat(weightedaoi).toFixed(2);
						weightedaoi = parseFloat(weightedaoi);

						var data = google.visualization.arrayToDataTable([
							['Method', 'Value',],
							['Maximum ', maxaoi],
							['Minimum ', minaoi],
							['Median ', medaoi],
							['Weighted Avg ', weightedaoi]
						]);

						var options = {
							title: app.payload.chart2n,
							legend: {
								position: 'none'
							},
							chartArea: {
								width: '70%'
							},
							hAxis: {
								//title: 'a',
								minValue: 0
							},
							vAxis: {
								//title: 'b'
							}
						};
						chart_2 = new google.visualization.BarChart(document.getElementById('chart_area_2'));
						chart_2.draw(data, options);
					});

					var histo_array;
					app.payload.getMode = "histogram";
					$.get('polygonHandler.php', app.payload, function(data){
						histo_array = data.values;
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Property');
						data.addColumn('number', 'Value');
						data.addRows(histo_array.length);
						var max = Math.max(...histo_array);
						for (var i = 0; i < histo_array.length; i++) {
							data.setCell(i, 1, histo_array[i]);
						}
						var size;
						size = Math.ceil(Math.sqrt(histo_array.length - 1)) - 1;
						size = Math.ceil(max/size);
						var options = {
							title: app.payload.chart2n,
							legend: {
								position: 'none'
							},
							histogram: {
								bucketSize: size
							},
							// bar: { width: 5 },
							hAxis: {
								type: 'category'
								// , viewWindow: { min: 0, max: 6 } // note min and max values are indices when type is category.
							}
						};

						chart_histo_2 = new google.visualization.Histogram(document.getElementById('chart_histogram_2'));
						chart_histo_2.draw(data, options);
					});
					app.payload.chart1 = previous1;
					app.payload.chart2 = previous2;
					app.payload.chart3 = previous3;
					app.payload.chart4 = previous4;
				}
				else if(x == 3){
					previous1 = app.payload.chart1;
					previous2 = app.payload.chart2;
					previous3 = app.payload.chart3;
					previous4 = app.payload.chart4;
					app.payload.chart1 = null;
					app.payload.chart2 = null;
					app.payload.chart3;
					app.payload.chart4 = null;
					$.get('polygonHandler.php', app.payload, function(data){
						maxaoi = parseFloat(data.maxAOIch3);
						minaoi = parseFloat(data.minAOIch3);
						medaoi = parseFloat(data.medAOIch3);
						weightedaoi = parseFloat(data.weightedAOIch3);
						weightedaoi = parseFloat(weightedaoi).toFixed(2);
						weightedaoi = parseFloat(weightedaoi);

						var data = google.visualization.arrayToDataTable([
							['Method', 'Value',],
							['Maximum ', maxaoi],
							['Minimum ', minaoi],
							['Median ', medaoi],
							['Weighted Avg ', weightedaoi]
						]);

						var options = {
							title: app.payload.chart3n,
							legend: {
								position: 'none'
							},
							chartArea: {
								width: '70%'
							},
							hAxis: {
								//title: 'a',
								minValue: 0
							},
							vAxis: {
								//title: 'b'
							}
						};
						chart_3 = new google.visualization.BarChart(document.getElementById('chart_area_3'));
						chart_3.draw(data, options);
					});

					var histo_array;
					app.payload.getMode = "histogram";
					$.get('polygonHandler.php', app.payload, function(data){
						histo_array = data.values;
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Property');
						data.addColumn('number', 'Value');
						data.addRows(histo_array.length);
						var max = Math.max(...histo_array);
						for (var i = 0; i < histo_array.length; i++) {
							data.setCell(i, 1, histo_array[i]);
						}
						var size;
						size = Math.ceil(Math.sqrt(histo_array.length - 1)) - 1;
						size = Math.ceil(max/size);
						var options = {
							title: app.payload.chart3n,
							legend: {
								position: 'none'
							},
							histogram: {
								bucketSize: size
							},
							// bar: { width: 5 },
							hAxis: {
								type: 'category'
								// , viewWindow: { min: 0, max: 6 } // note min and max values are indices when type is category.
							}
						};

						chart_histo_3 = new google.visualization.Histogram(document.getElementById('chart_histogram_3'));
						chart_histo_3.draw(data, options);
					});
					app.payload.chart1 = previous1;
					app.payload.chart2 = previous2;
					app.payload.chart3 = previous3;
					app.payload.chart4 = previous4;
				}
				else if(x == 4){
					previous1 = app.payload.chart1;
					previous2 = app.payload.chart2;
					previous3 = app.payload.chart3;
					previous4 = app.payload.chart4;
					app.payload.chart1 = null;
					app.payload.chart2 = null;
					app.payload.chart3 = null;
					app.payload.chart4;
					$.get('polygonHandler.php', app.payload, function(data){
						maxaoi = parseFloat(data.maxAOIch4);
						minaoi = parseFloat(data.minAOIch4);
						medaoi = parseFloat(data.medAOIch4);
						weightedaoi = parseFloat(data.weightedAOIch4);
						weightedaoi = parseFloat(weightedaoi).toFixed(2);
						weightedaoi = parseFloat(weightedaoi);

						var data = google.visualization.arrayToDataTable([
							['Method', 'Value',],
							['Maximum ', maxaoi],
							['Minimum ', minaoi],
							['Median ', medaoi],
							['Weighted Avg ', weightedaoi]
						]);

						var options = {
							title: app.payload.chart4n,
							legend: {
								position: 'none'
							},
							chartArea: {
								width: '70%'
							},
							hAxis: {
								//title: 'a',
								minValue: 0
							},
							vAxis: {
								//title: 'b'
							}
						};
						chart_4 = new google.visualization.BarChart(document.getElementById('chart_area_4'));
						chart_4.draw(data, options);
					});

					var histo_array;
					app.payload.getMode = "histogram";
					$.get('polygonHandler.php', app.payload, function(data){
						histo_array = data.values;
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Property');
						data.addColumn('number', 'Value');
						data.addRows(histo_array.length);
						var max = Math.max(...histo_array);
						for (var i = 0; i < histo_array.length; i++) {
							data.setCell(i, 1, histo_array[i]);
						}
						var size;
						size = Math.ceil(Math.sqrt(histo_array.length - 1)) - 1;
						size = Math.ceil(max/size);
						var options = {
							title: app.payload.chart4n,
							legend: {
								position: 'none'
							},
							histogram: {
								bucketSize: size
							},
							// bar: { width: 5 },
							hAxis: {
								type: 'category'
								// , viewWindow: { min: 0, max: 6 } // note min and max values are indices when type is category.
							}
						};

						chart_histo_4 = new google.visualization.Histogram(document.getElementById('chart_histogram_4'));
						chart_histo_4.draw(data, options);
					});
					app.payload.chart1 = previous1;
					app.payload.chart2 = previous2;
					app.payload.chart3 = previous3;
					app.payload.chart4 = previous4;
				}
			}
			else{
				var maxaoi;
				var minaoi;
				var medaoi;
				var weightedaoi;

				app.payload.getMode = "line";
				var getparams = app.payload;
				var bounds = app.map.getBounds();
				getparams.NE = bounds.getNorthEast().toJSON(); //north east corner
				getparams.SW = bounds.getSouthWest().toJSON(); //south-west corner
				if(x == 1){
					previous1 = app.payload.chart1;
					previous2 = app.payload.chart2;
					previous3 = app.payload.chart3;
					previous4 = app.payload.chart4;
					app.payload.chart1;
					app.payload.chart2 = null;
					app.payload.chart3 = null;
					app.payload.chart4 = null;

					$.get('polygonHandler.php', app.payload, function(data){
						maxaoi = parseFloat(data.maxAOIch1);
						minaoi = parseFloat(data.minAOIch1);
						medaoi = parseFloat(data.medAOIch1);
						weightedaoi = parseFloat(data.weightedAOIch1);
						weightedaoi = parseFloat(weightedaoi).toFixed(2);
						weightedaoi = parseFloat(weightedaoi);

						var data = google.visualization.arrayToDataTable([
							['Method', 'Value',],
							['Maximum ', maxaoi],
							['Minimum ', minaoi],
							['Median ', medaoi],
							['Weighted Avg ', weightedaoi]
						]);

						var options = {
							title: app.payload.chart1n,
							legend: {
								position: 'none'
							},
							chartArea: {
								width: '70%'
							},
							hAxis: {
								//title: 'a',
								minValue: 0
							},
							vAxis: {
								//title: 'b'
							}
						};
						chart = new google.visualization.BarChart(document.getElementById('chart_area_1'));
						chart.draw(data, options);
					});

					var histo_array;
					app.payload.getMode = "histogram";
					$.get('polygonHandler.php', app.payload, function(data){
						histo_array = data.values;
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Property');
						data.addColumn('number', 'Value');
						data.addRows(histo_array.length);
						var max = Math.max(...histo_array);
						for (var i = 0; i < histo_array.length; i++) {
							data.setCell(i, 1, histo_array[i]);
						}
						var size;
						size = Math.ceil(Math.sqrt(histo_array.length - 1)) - 1;
						size = Math.ceil(max/size);
						var options = {
							title: app.payload.chart1n,
							legend: {
								position: 'none'
							},
							histogram: {
								bucketSize: size
							},
							// bar: { width: 5 },
							hAxis: {
								type: 'category'
								// , viewWindow: { min: 0, max: 6 } // note min and max values are indices when type is category.
							}
						};

						chart_histo = new google.visualization.Histogram(document.getElementById('chart_histogram_1'));
						chart_histo.draw(data, options);
					});
					app.payload.chart1 = previous1;
					app.payload.chart2 = previous2;
					app.payload.chart3 = previous3;
					app.payload.chart4 = previous4;
				}
				else if (x == 2) {
					previous1 = app.payload.chart1;
					previous2 = app.payload.chart2;
					previous3 = app.payload.chart3;
					previous4 = app.payload.chart4;
					app.payload.chart1 = null;
					app.payload.chart2;
					app.payload.chart3 = null;
					app.payload.chart4 = null;
					$.get('polygonHandler.php', app.payload, function(data){
						maxaoi = parseFloat(data.maxAOIch2);
						minaoi = parseFloat(data.minAOIch2);
						medaoi = parseFloat(data.medAOIch2);
						weightedaoi = parseFloat(data.weightedAOIch2);
						weightedaoi = parseFloat(weightedaoi).toFixed(2);
						weightedaoi = parseFloat(weightedaoi);

						var data = google.visualization.arrayToDataTable([
							['Method', 'Value',],
							['Maximum ', maxaoi],
							['Minimum ', minaoi],
							['Median ', medaoi],
							['Weighted Avg ', weightedaoi]
						]);

						var options = {
							title: app.payload.chart2n,
							legend: {
								position: 'none'
							},
							chartArea: {
								width: '70%'
							},
							hAxis: {
								//title: 'a',
								minValue: 0
							},
							vAxis: {
								//title: 'b'
							}
						};
						chart_2 = new google.visualization.BarChart(document.getElementById('chart_area_2'));
						chart_2.draw(data, options);
					});

					var histo_array;
					app.payload.getMode = "histogram";
					$.get('polygonHandler.php', app.payload, function(data){
						histo_array = data.values;
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Property');
						data.addColumn('number', 'Value');
						data.addRows(histo_array.length);
						var max = Math.max(...histo_array);
						for (var i = 0; i < histo_array.length; i++) {
							data.setCell(i, 1, histo_array[i]);
						}
						var size;
						size = Math.ceil(Math.sqrt(histo_array.length - 1)) - 1;
						size = Math.ceil(max/size);
						var options = {
							title: app.payload.chart2n,
							legend: {
								position: 'none'
							},
							histogram: {
								bucketSize: size
							},
							// bar: { width: 5 },
							hAxis: {
								type: 'category'
								// , viewWindow: { min: 0, max: 6 } // note min and max values are indices when type is category.
							}
						};

						chart_histo_2 = new google.visualization.Histogram(document.getElementById('chart_histogram_2'));
						chart_histo_2.draw(data, options);
					});
					app.payload.chart1 = previous1;
					app.payload.chart2 = previous2;
					app.payload.chart3 = previous3;
					app.payload.chart4 = previous4;
				}
				else if(x == 3){
					previous1 = app.payload.chart1;
					previous2 = app.payload.chart2;
					previous3 = app.payload.chart3;
					previous4 = app.payload.chart4;
					app.payload.chart1 = null;
					app.payload.chart2 = null;
					app.payload.chart3;
					app.payload.chart4 = null;
					$.get('polygonHandler.php', app.payload, function(data){
						maxaoi = parseFloat(data.maxAOIch3);
						minaoi = parseFloat(data.minAOIch3);
						medaoi = parseFloat(data.medAOIch3);
						weightedaoi = parseFloat(data.weightedAOIch3);
						weightedaoi = parseFloat(weightedaoi).toFixed(2);
						weightedaoi = parseFloat(weightedaoi);

						var data = google.visualization.arrayToDataTable([
							['Method', 'Value',],
							['Maximum ', maxaoi],
							['Minimum ', minaoi],
							['Median ', medaoi],
							['Weighted Avg ', weightedaoi]
						]);

						var options = {
							title: app.payload.chart3n,
							legend: {
								position: 'none'
							},
							chartArea: {
								width: '70%'
							},
							hAxis: {
								//title: 'a',
								minValue: 0
							},
							vAxis: {
								//title: 'b'
							}
						};
						chart_3 = new google.visualization.BarChart(document.getElementById('chart_area_3'));
						chart_3.draw(data, options);
					});

					var histo_array;
					app.payload.getMode = "histogram";
					$.get('polygonHandler.php', app.payload, function(data){
						histo_array = data.values;
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Property');
						data.addColumn('number', 'Value');
						data.addRows(histo_array.length);
						var max = Math.max(...histo_array);
						for (var i = 0; i < histo_array.length; i++) {
							data.setCell(i, 1, histo_array[i]);
						}
						var size;
						size = Math.ceil(Math.sqrt(histo_array.length - 1)) - 1;
						size = Math.ceil(max/size);
						var options = {
							title: app.payload.chart3n,
							legend: {
								position: 'none'
							},
							histogram: {
								bucketSize: size
							},
							// bar: { width: 5 },
							hAxis: {
								type: 'category'
								// , viewWindow: { min: 0, max: 6 } // note min and max values are indices when type is category.
							}
						};

						chart_histo_3 = new google.visualization.Histogram(document.getElementById('chart_histogram_3'));
						chart_histo_3.draw(data, options);
					});
					app.payload.chart1 = previous1;
					app.payload.chart2 = previous2;
					app.payload.chart3 = previous3;
					app.payload.chart4 = previous4;
				}
				else if(x == 4){
					previous1 = app.payload.chart1;
					previous2 = app.payload.chart2;
					previous3 = app.payload.chart3;
					previous4 = app.payload.chart4;
					app.payload.chart1 = null;
					app.payload.chart2 = null;
					app.payload.chart3 = null;
					app.payload.chart4;
					$.get('polygonHandler.php', app.payload, function(data){
						maxaoi = parseFloat(data.maxAOIch4);
						minaoi = parseFloat(data.minAOIch4);
						medaoi = parseFloat(data.medAOIch4);
						weightedaoi = parseFloat(data.weightedAOIch4);
						weightedaoi = parseFloat(weightedaoi).toFixed(2);
						weightedaoi = parseFloat(weightedaoi);

						var data = google.visualization.arrayToDataTable([
							['Method', 'Value',],
							['Maximum ', maxaoi],
							['Minimum ', minaoi],
							['Median ', medaoi],
							['Weighted Avg ', weightedaoi]
						]);

						var options = {
							title: app.payload.chart4n,
							legend: {
								position: 'none'
							},
							chartArea: {
								width: '70%'
							},
							hAxis: {
								//title: 'a',
								minValue: 0
							},
							vAxis: {
								//title: 'b'
							}
						};
						chart_4 = new google.visualization.BarChart(document.getElementById('chart_area_4'));
						chart_4.draw(data, options);
					});

					var histo_array;
					app.payload.getMode = "histogram";
					$.get('polygonHandler.php', app.payload, function(data){
						histo_array = data.values;
						var data = new google.visualization.DataTable();
						data.addColumn('string', 'Property');
						data.addColumn('number', 'Value');
						data.addRows(histo_array.length);
						var max = Math.max(...histo_array);
						for (var i = 0; i < histo_array.length; i++) {
							data.setCell(i, 1, histo_array[i]);
						}
						var size;
						size = Math.ceil(Math.sqrt(histo_array.length - 1)) - 1;
						size = Math.ceil(max/size);
						var options = {
							title: app.payload.chart4n,
							legend: {
								position: 'none'
							},
							histogram: {
								bucketSize: size
							},
							// bar: { width: 5 },
							hAxis: {
								type: 'category'
								// , viewWindow: { min: 0, max: 6 } // note min and max values are indices when type is category.
							}
						};

						chart_histo_4 = new google.visualization.Histogram(document.getElementById('chart_histogram_4'));
						chart_histo_4.draw(data, options);
					});
					app.payload.chart1 = previous1;
					app.payload.chart2 = previous2;
					app.payload.chart3 = previous3;
					app.payload.chart4 = previous4;
				}
			}
		}

		function lineParser(){
			app.payload.getMode = "line";
			var lineString = "";
			paths = rec.getPath();
			paths = paths.getArray();

			for (var i = 0; i < paths.length; i++) {
				if(paths.length > 1 && i < paths.length - 1){
					lineString += paths[i].lng() + ' ' + paths[i].lat() + ',';
				}
				else{
					lineString += paths[i].lng() + ' ' + paths[i].lat();
				}
			}
			app.payload.lineString = lineString;
			app.payload.runLine = true;
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
			app.payload.runAOI = false;

			document.getElementById('legend').style.visibility = "hidden";
			$('#legend').find('*').not('h3').remove();
			$('#description').find('*').not('h3').remove();
			if(typeof chart === 'undefined'){
			}else{
				chart.clearChart();
				chart_histo.clearChart();
			}

			if(typeof chart_2 === 'undefined'){
			}else{
				chart_2.clearChart();
				chart_histo_2.clearChart();
			}

			if(typeof chart_3 === 'undefined'){
			}else{
				chart_3.clearChart();
				chart_histo_3.clearChart();
			}

			if(typeof chart_4 === 'undefined'){
			}else{
				chart_4.clearChart();
				chart_histo_4.clearChart();
			}
		}
		function printMaps() {
			var body               = $('body');
			var mapContainer       = $('#map');
			var mapContainerParent = mapContainer.parent();
			var printContainer     = $('<div>');
			printContainer.addClass('print-container').css('position', 'relative').height(mapContainer.height()).append(mapContainer).prependTo(body);
			var content = body.children().not('script').not(printContainer).detach();

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


		function spawn(value){
			var squareboxes = ["<img src='img/brightgreensquare.png' height='10px'/>",
			"<img src='img/skybluesquare.png' height='10px'/>",
			"<img src='img/yellowsquare.png' height='10px'/>",
			"<img src='img/orangesquare.png' height='10px'/>",
			"<img src='img/redsquare.png' height='10px'/>",
			"<img src='img/maroonsquare.png' height='10px'/>",
			"<img src='img/lilacsquare.png' height='10px'/>",
			"<img src='img/yellowsquare.png' height='10px'/>",
			"<img src='img/maroonsquare.png' height='10px'/>",
			"<img src='img/cyansquare.png' height='10px'/>",
			"<img src='img/navygreensquare.png' height='10px'/>",
			"<img src='img/peachsquare.png' height='10px'/>",
			"<img src='img/fleshsquare.png' height='10px'/>",
			"<img src='img/brownsquare.png' height='10px'/>",
			"<img src='img/neongreensquare.png' height='10px'/>",
			"<img src='img/neonpurplesquare.png' height='10px'/>",
			"<img src='img/graysquare.png' height='10px'/>"]

			$('#legendSpawner').find('*').not('h3').remove();
			var labels = document.getElementById('labels').value;

			if(labels <= 0 || value <= 0 ){
				alert("Zero labels & zero value; negative numbers");
			}
			else{
				var range = (value/labels);
				var count = 0;
				var cnt = 0;
				var spawner = document.getElementById('legendSpawner');
				var separations = [];
				while(count<=value){
					separations[cnt] =  parseFloat(count).toFixed(2);
					count+=range;
					cnt++;
				}
				for(var i = 0; i < separations.length-1; i++){
					var div = document.createElement('div');
					div.innerHTML = squareboxes[i] + " " +
					+ separations[i] + ' to ' + separations[i+1];
					var newLegend = document.createElement('div');
					newLegend = document.getElementById('legend');
					document.getElementById('legend').style.visibility = "visible";
					newLegend.appendChild(div);
				}
				return separations;
			}
		}
		// ***********
		</script>
		<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY0B3_Fr1vRpgJDdbvNmrVyXmoOOtiq64&callback=initMap"></script>-->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY0B3_Fr1vRpgJDdbvNmrVyXmoOOtiq64&libraries=drawing&callback=initMap"async defer></script>
	</body>
	</html>
