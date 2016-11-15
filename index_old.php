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

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

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
								Search
							</div>
							<div class="row">
								<div class="input-group">
									<span class="input-group-addon glyphicon glyphicon-search" id="basic-addon"></span>
									<input type="text" class="form-control" placeholder="Ground Property" aria-describedby="basic-addon" id="autocomplete">
								</div>
							</div>
							<div class="row">
								<label>District:</label>
								<select id="target" class="form-control">
									<option value="32.43561304116276,-100.1953125">
										Abilene
									</option>
									<option value="35.764343479667176,-101.49169921875">
										Amarillo
									</option>
									<option value="32.69651010951669, -94.691162109375">
										Atlanta
									</option>
									<option value="30.25391637229704, -98.23212890625">
										Austin
									</option>
									<option value="30.40211367909724, -94.39453125" data-district="beaumont">
										Beaumont
									</option>
									<option value="31.765537409484374, -99.140625">
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
									<option value="32.54681317351514, -96.85546875">
										Dallas
									</option>
									<option value="30.694611546632302, -104.52392578125">
										El Paso
									</option>
									<option value="32.62087018318113, -97.75634765625">
										Fort Worth
									</option>
									<option value="29.661670115197377, -95.33935546875">
										Houston
									</option>
									<option value="28.613459424004418, -99.90966796875" data-district="laredo">
										Laredo
									</option>
									<option value="33.43144133557529, -101.93115234375" data-district="lubbock">
										Lubbock
									</option>
									<option value="31.203404950917395, -94.7021484375">
										Lufkin
									</option>
									<option value="31.203404950917395, -102.568359375" data-district="odessa">
										Odessa
									</option>
									<option value="33.43144133557529, -95.625">
										Paris
									</option>
									<option value="26.951453083498258, -98.32763671875" data-district="pharr">
										Pharr
									</option>
									<option value="31.10819929911196, -100.48095703125">
										San Angelo
									</option>
									<option value="29.13297013087864, -98.89892578125" data-district="sanAntonio">
										San Antonio
									</option>
									<option value="32.222095840502334, -95.33935546875">
										Tyler
									</option>
									<option value="31.403404950917395, -97.119140625">
										Waco
									</option>
									<option value="33.77914733128647, -98.37158203125">
										Wichita Falls
									</option>
									<option value="29.05616970274342, -96.8115234375">
										Yoakum
									</option>
								</select>
							</div>
							<div class="row">
								<div class="form-control">
									<button class="btn btn-success" type="button">Run</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jquery.autocomplete.min.js"></script>
		<script>
			var properties = [
				{value: 'Plasticity', data: 'PI'}
			];
			$('#autocomplete').autocomplete({
				lookup: properties,
				onSelect: function (suggestion) {
				console.log('You selected: ' + suggestion.value + ', ' + suggestion.data);
				}
			});
			//implements local autocomplete for the search mode
			var app = {map:null};
			function initMap() {
		        app.map = new google.maps.Map(document.getElementById('map'), {
		          zoom: 5,
		          center: {lat: 31.31610138349565, lng: -99.11865234375},
		          mapTypeId: 'terrain'
		        });
		        for(var i = 1100923; i < 1100923 + 100; i++){
		        	insertPolygon(i);
		        }
		    }
		    function insertPolygon(objectIds){
		    	$.get('polygonHandler.php', {'districts':objectIds}).done(function(data){
		    		for(var i = 0; i < data.polygons.length; i++){
		    			var polygon = new google.maps.Polygon({
							paths: toLatLngLiteral(data.polygons[i]),
							strokeColor: '#FF0000',
					        strokeOpacity: 0.8,
					        strokeWeight: 2,
					        fillColor: '#FF0000',
					        fillOpacity: 0.35
						});
						polygon.setMap(app.map);
		    		}
				});
		    }
		    function toLatLngLiteral(coords){
		    	console.log(coords);
		    	var arr = $.map(coords, function(n, i){
		    		return {lat: parseFloat(n[0]), lng: parseFloat(n[1])};
		    	});
		    	console.log(arr);
		    	return arr;
		    }
		</script>
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCHNhO0Yz2Nm75cEMsPpF7n2CdTMGvbhW0&callback=initMap"></script>
	</body>
</html>
