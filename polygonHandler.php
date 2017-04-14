<?php
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', 300); //300 seconds = 5 minutes
	$conn = mysqli_connect('ctis.utep.edu', 'ctis', '19691963', 'imsc');
	$toReturn = array();
	if(isset($_GET['getMode']) AND $_GET['getMode'] == "polygons"){

		$table = $_GET['table'];
		$property = $_GET['property'];
		$district = $_GET['district'];
		$lat2 = $_GET['NE']['lat'];
		$lat1 = $_GET['SW']['lat'];
		$lng2 = $_GET['NE']['lng'];
		$lng1 = $_GET['SW']['lng'];
		$query = "SET @geom1 = 'POLYGON(($lng1	$lat1,$lng1	$lat2,$lng2	$lat2,$lng2	$lat1,$lng1	$lat1))'";
		$toReturn['query'] = $query;
		$result = mysqli_query($conn, $query);

		if($table == "chorizon_r"){
			$property = "ch." . $property;
			//$query = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, 0.00005)) AS POLYGON, $property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN chorizon_r AS ch ON mu.chkey = ch.chkey WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)";
			$query = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, 0.00005)) AS POLYGON, $property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN chorizon_r AS ch ON mu.chkey = ch.chkey WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)";
			//$testquery = "SELECT mukey FROM polygon WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)";
			//echo $testquery . " TEST LOL MINI";
		}elseif ($table == "chconsistence_r") {
			$property = "co." . $property;
			$query = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, 0.00005)) AS POLYGON, $property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN chconsistence_r AS co ON mu.chconsistkey = co.chconsistkey WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)";
		}

		$toReturn['query2'] = $query;

		//$toReturn['query3'] = $testquery;

		$result = mysqli_query($conn, $query);

		$temp = array();
		while($row = mysqli_fetch_assoc($result)){
			$temp[] = $row;
		}
		$toReturn['coords'] = $temp;


		/*$result2 = mysqli_query($conn, $testquery);

		$temp2 = array();
		while($row = mysqli_fetch_assoc($result2)){
			$temp[] = $row;
		}
		$toReturn['coords'] = $temp2; */
	}
	else if(isset($_GET['district'])){
		$district = $_GET['district'];
		$sql = "CALL getCoordinates($district)";
		$result = $conn->query($sql);
		if($result AND $result->num_rows < 400){
			$toReturn['coords'] = $result->fetch_all();
		}
	}
	/*else if(isset($_GET['mukey'])){ //for the mukey
		$mu = $_GET['mukey'];
		$query = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, 0.00005)) AS POLYGON, $mu FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN chorizon_r AS ch ON mu.chkey = ch.chkey WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)";
		$toReturn['query2'] = $query;
		$result = mysqli_query($conn, $query);
	}*/
	else if(isset($_POST['columns'])){
		$sql = "SELECT * FROM properties WHERE property_table LIKE \"%chconsistence_r%\" OR property_table LIKE \"%chorizon_r%\" ";
		$result = $conn->query($sql);
		$toReturn['columns'] = $result->fetch_all();

	}
	header('Content-Type: application/json');
	echo json_encode($toReturn);
	$conn->close();
?>
