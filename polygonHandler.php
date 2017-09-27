<?php
//init specifications
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 30000); //300 seconds = 5 minutes
//conection to utep database
$conn = mysqli_connect('ctis.utep.edu', 'ctis', '19691963', 'imsc');
//global array that will return requested data
$toReturn = array();
/**     -------------------------------------------         */
//is the "isset()" to determine wether a property has been selected? YES! isset => has been set
if(isset($_GET['getMode']) AND $_GET['getMode'] == "polygons"){//**************The case in charge of retrieving polygon search (run)****************************(1)
	getPolygons(); //cambio de Ricardo
}
if(isset($_GET['getMode']) AND $_GET['getMode'] == "AOI"){//**************The case in charge of retrieving polygon search (run)****************************(1)
	getHelperAOI();
}
if(isset($_GET['getMode']) AND isset($_GET['lineString']) AND $_GET['lineString'] != null AND $_GET['getMode'] == "line"){//**************The case in charge of retrieving polygon search (run)****************************(1)
	getHelperLine();
}
if(isset($_GET['getMode']) AND $_GET['getMode'] == "histogram"){//**************The case in charge of retrieving polygon search (run)****************************(1)
	getHelperHistogramAOI();
}
if(isset($_GET['getMode']) AND isset($_GET['lineString']) AND $_GET['lineString'] != null AND $_GET['getMode'] == "histogram"){//**************The case in charge of retrieving polygon search (run)****************************(1)
	getHelperHistogramLine();
}
else if(isset($_GET['district'])){//*******************This is the case for retieving the districts from table**********************(2)
	districtNames();
}
else if(isset($_POST['columns'])){//**************** This is the case for retrieving table names  ***********************(3)
	tableNames();
}

header('Content-Type: application/json');
echo json_encode($toReturn);
$conn->close();

class dataToQueryPolygons{
	public $table, $property, $district, $lat2, $lat1, $depth, $from_depth, $depth_method, $lineString, $chart1, $chart2, $chart3, $chart4, $runLine, $runRec, $runAOI, $runPoly, $runFilters, $filter_units, $filter_value;
	public function __construct(){
		$this->table = 'chorizon_r'; //hardcoded
		$this->property = $_GET['property'];
		$this->district = $_GET['district'];
		$this->lat2 = $_GET['NE']['lat'];
		$this->lat1 = $_GET['SW']['lat'];
		$this->lng2 = $_GET['NE']['lng'];
		$this->lng1 = $_GET['SW']['lng'];
		$this->depth = ($_GET['depth'] * 2.5400);
		$this->from_depth = ($_GET['from_depth'] * 2.5400);
		$this->depth_method = $_GET['depth_method'];
		$this->lineString = $_GET['lineString'];
		$this->chart1 =  $_GET['chart1'];
		$this->chart2 =  $_GET['chart2'];
		$this->chart3 =  $_GET['chart3'];
		$this->chart4 =  $_GET['chart4'];
		$this->runLine = $_GET['runLine'];
		$this->runRec = $_GET['runRec'];
		$this->runAOI = $_GET['runAOI'];
		$this->runPoly = $_GET['runPoly'];
		$this->runFilters = $_GET['runFilters'];
		$this->filter_units = $_GET['filter_units'];
		$this->filter_value = $_GET['filter_value'];
	}
}
//depending on which table (for a given property) will be used in query, this will determine the appropriate key
function setKey($table){
	if($table == "chorizon_r")          { return "chkey"; }
	else if($table == "chconsistence_r"){ return "chconsistkey"; }
}

function fetchAll($result){
	$temp = array();
	while($row = mysqli_fetch_assoc($result)){
		$temp[] = $row;
	}
	return $temp;
}
function tableNames(){
	global $conn, $toReturn;
	$sql = "SELECT * FROM imsc.properties WHERE property_table = 'chorizon_r' AND property_code NOT IN ('excavdifcl') ORDER BY property_label ASC";
	$result = $conn->query($sql);
	$toReturn['columns'] = $result->fetch_all();
}
function districtNames(){
	global $conn, $toReturn;
	$district = $_GET['district'];
	$sql = "CALL getCoordinates($district)";
	$result = $conn->query($sql);
	if($result AND $result->num_rows < 400){
		$toReturn['coords'] = $result->fetch_all();
	}
}
function getHelperHistogramAOI(){
	$data_aoi = new dataToQueryPolygons();
	if($data_aoi->chart1 != null){ getHistogramAOI(1); }
	else if($data_aoi->chart2 != null){ getHistogramAOI(2); }
	else if($data_aoi->chart3 != null){ getHistogramAOI(3); }
	else if($data_aoi->chart4 != null){ getHistogramAOI(4); }
}

function getHistogramAOI($x){
	global $conn, $toReturn;
	$data_aoi = new dataToQueryPolygons();
	$simplificationFactor = polygonDefinition($data_aoi);
	$query = "SET @geom1 = 'POLYGON(($data_aoi->lng1	$data_aoi->lat1,$data_aoi->lng1	$data_aoi->lat2,$data_aoi->lng2	$data_aoi->lat2,$data_aoi->lng2	$data_aoi->lat1,$data_aoi->lng1	$data_aoi->lat1))'";
	$toReturn['query'] = $query;
	$result = mysqli_query($conn, $query);
	$data_aoi->table = 'chorizon_r';
	$key = setKey($data_aoi->table);
	if($x == 1){ $data_aoi->property = $data_aoi->chart1; }
	else if ($x == 2) { $data_aoi->property = $data_aoi->chart2; }
	else if ($x == 3) { $data_aoi->property = $data_aoi->chart3; }
	else if ($x == 4) { $data_aoi->property = $data_aoi->chart4; }

	if($data_aoi->table == "chorizon_r"){
		$query="SELECT OGR_FID, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data_aoi->property FROM polygon AS p NATURAL JOIN chorizon_joins as x WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		//$query="SELECT OGR_FID, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM mujoins3 NATURAL JOIN polygon AS p NATURAL JOIN chorizon_r as x WHERE x.cokey = mujoins3.cokey AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		$toReturn['query2'] = $query;
		$result = mysqli_query($conn, $query);
		$result = fetchAll($result);
		$polygons = array();

		$poly_arr = array();
		$ogr; $skip; $counter_j;
		$past_ogr = $counter_i = $entered = 0;

		for ($i=0; $i < sizeof($result); $i++){
			$counter_j = $skip = 0;
			$ogr = $result[$i]['OGR_FID'];

			if($entered == 1){
				$counter_i++;
			}

			if($past_ogr == $ogr){
				$ogr = 1;
				$skip = 1;
				$entered = 0;
			}
			else{
				$ogr = $result[$i]['OGR_FID'];
				$skip = 0;
				$entered = 0;
			}
			for ($j=0; $j < sizeof($result); $j++) {
				if($ogr == $result[$j]['OGR_FID'] && $skip == 0){
					$poly_arr[$counter_i][$counter_j] = $result[$j];
					$past_ogr = $ogr;
					$counter_j++;
					$entered = 1;
				}
			}
		}
	}
	$values = array();
	$placeholder;
	for ($i=0; $i < sizeof($poly_arr); $i++) {
		for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
			$placeholder = $poly_arr[$i][$j][$data_aoi->property];
			array_push($values, $placeholder);
		}
	}
	$toReturn['values'] = $values;
}
function getHelperHistogramLine(){
	$data_line = new dataToQueryPolygons();
	if($data_line->chart1 != null){ getHistogramLine(1); }
	else if($data_line->chart2 != null){ getHistogramLine(2); }
	else if($data_line->chart3 != null){ getHistogramLine(3); }
	else if($data_line->chart4 != null){ getHistogramLine(4); }
}
function getHistogramLine($x){
	global $conn, $toReturn;
	$data_line = new dataToQueryPolygons();
	$simplificationFactor = polygonDefinition($data_line);
	$query = "SET @geomline = 'LineString($data_line->lineString)'";
	$toReturn['query'] = $query;
	$result = mysqli_query($conn, $query);
	$data_line->table = 'chorizon_r';
	$key = setKey($data_line->table);
	if($x == 1){ $data_line->property = $data_line->chart1; }
	else if ($x == 2) { $data_line->property = $data_line->chart2; }
	else if ($x == 3) { $data_line->property = $data_line->chart3; }
	else if ($x == 4) { $data_line->property = $data_line->chart4; }

	if($data_line->table == "chorizon_r"){
		$query="SELECT OGR_FID, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data_line->property FROM polygon AS p NATURAL JOIN chorizon_joins as x WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geomline, 1), p.SHAPE) ORDER BY OGR_FID DESC, top DESC";
		//$query="SELECT OGR_FID, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM mujoins3 NATURAL JOIN polygon AS p NATURAL JOIN chorizon_r as x WHERE x.cokey = mujoins3.cokey AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		$toReturn['query2'] = $query;
		$result = mysqli_query($conn, $query);
		$result = fetchAll($result);
		$polygons = array();

		$poly_arr = array();
		$ogr; $skip; $counter_j;
		$past_ogr = $counter_i = $entered = 0;

		for ($i=0; $i < sizeof($result); $i++){
			$counter_j = 0;
			$ogr = $result[$i]['OGR_FID'];
			$skip = 0;

			if($entered == 1){
				$counter_i++;
			}

			if($past_ogr == $ogr){
				$ogr = 1;
				$skip = 1;
				$entered = 0;
			}
			else{
				$ogr = $result[$i]['OGR_FID'];
				$skip = 0;
				$entered = 0;
			}
			for ($j=0; $j < sizeof($result); $j++) {
				if($ogr == $result[$j]['OGR_FID'] && $skip == 0){
					$poly_arr[$counter_i][$counter_j] = $result[$j];
					$past_ogr = $ogr;
					$counter_j++;
					$entered = 1;
				}
			}
		}
	}
	$values = array();
	$placeholder;
	for ($i=0; $i < sizeof($poly_arr); $i++) {
		for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
			$placeholder = $poly_arr[$i][$j][$data_line->property];
			array_push($values, $placeholder);
		}
	}
	$toReturn['values'] = $values;
}
function getHelperLine(){
	$data_line = new dataToQueryPolygons();
	if($data_line->chart1 != null){ getLine(1); }
	else if($data_line->chart2 != null){ getLine(2); }
	else if($data_line->chart3 != null){ getLine(3); }
	else if($data_line->chart4 != null){ getLine(4); }
}
function getLine($x){
	global $conn, $toReturn;
	$data_line = new dataToQueryPolygons();
	$simplificationFactor = polygonDefinition($data_line);
	$query = "SET @geomline = 'LineString($data_line->lineString)'";
	$toReturn['query'] = $query;
	$result = mysqli_query($conn, $query);
	$data_line->table = 'chorizon_r';
	$key = setKey($data_line->table);

	if($x == 1){ $data_line->property = $data_line->chart1; }
	else if ($x == 2) { $data_line->property = $data_line->chart2; }
	else if ($x == 3) { $data_line->property = $data_line->chart3; }
	else if ($x == 4) { $data_line->property = $data_line->chart4; }

	if($data_line->table == "chorizon_r"){
		$query="SELECT OGR_FID, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data_line->property FROM polygon AS p NATURAL JOIN chorizon_joins as x WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geomline, 1), p.SHAPE) ORDER BY OGR_FID DESC, top DESC";
		//$query="SELECT OGR_FID, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM mujoins3 NATURAL JOIN polygon AS p NATURAL JOIN chorizon_r as x WHERE x.cokey = mujoins3.cokey AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		$toReturn['query2'] = $query;
		$result = mysqli_query($conn, $query);
		$result = fetchAll($result);
		$polygons = array();

		$poly_arr = array();
		$ogr; $skip; $counter_j;
		$past_ogr = $counter_i = $entered = 0;

		for ($i=0; $i < sizeof($result); $i++){
			$counter_j = 0;
			$ogr = $result[$i]['OGR_FID'];
			$skip = 0;

			if($entered == 1){
				$counter_i++;
			}

			if($past_ogr == $ogr){
				$ogr = 1;
				$skip = 1;
				$entered = 0;
			}
			else{
				$ogr = $result[$i]['OGR_FID'];
				$skip = 0;
				$entered = 0;
			}
			for ($j=0; $j < sizeof($result); $j++) {
				if($ogr == $result[$j]['OGR_FID'] && $skip == 0){
					$poly_arr[$counter_i][$counter_j] = $result[$j];
					$past_ogr = $ogr;
					$counter_j++;
					$entered = 1;
				}
			}
		}

		/* Busca el valor MAXIMO de la lista de los polignos, dependientemente del depth que el usuario le otorgue*/
		$lo_profundo = 203;
		$bottom; $top; $max_value; $max_index_i; $max_index_j;

		for ($i=0; $i < sizeof($poly_arr); $i++) { //sorting by property values ascending; had to modify query
			array_multisort($poly_arr[$i], SORT_ASC);
		}

		for ($i=0; $i < sizeof($poly_arr); $i++) {
			$max_value = $max_index_i = $max_index_j = 0;
			$lo_profundo = 203;

			if(sizeof($poly_arr[$i]) > 1 && $poly_arr[$i][sizeof($poly_arr[$i])-1][$data_line->property] == 0){
				$limite =  $poly_arr[$i][sizeof($poly_arr[$i])-2]['bottom'];

				if($lo_profundo <= $poly_arr[$i][0]['bottom']){
					$max_index_i = $i;
					$max_index_j = 0;
				}
				elseif($lo_profundo >= $limite){
					$lo_profundo = $limite;
					for ($j=0; $j < sizeof($poly_arr[$i])-1; $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($max_value < $poly_arr[$i][$j][$data_line->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$max_value = $poly_arr[$i][$j][$data_line->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
					}
				}
				else{
					for ($j=0; $j < sizeof($poly_arr[$i])-1; $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];

						if($max_value < $poly_arr[$i][$j][$data_line->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$max_value = $poly_arr[$i][$j][$data_line->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
						elseif($max_value < $poly_arr[$i][$j][$data_line->property] && $lo_profundo > $top && $lo_profundo <= $bottom){
							$max_value = $poly_arr[$i][$j][$data_line->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
					}
				}
			}
			else{
				$limite =  $poly_arr[$i][sizeof($poly_arr[$i])-1]['bottom'];

				if($lo_profundo <= $poly_arr[$i][0]['bottom']){
					$max_index_i = $i;
					$max_index_j = 0;
				}
				elseif($lo_profundo >= $limite){
					$lo_profundo = $limite;
					for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($max_value < $poly_arr[$i][$j][$data_line->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$max_value = $poly_arr[$i][$j][$data_line->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
					}
				}
				else{
					for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($max_value < $poly_arr[$i][$j][$data_line->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$max_value = $poly_arr[$i][$j][$data_line->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
						elseif($max_value < $poly_arr[$i][$j][$data_line->property] && $lo_profundo > $top && $lo_profundo <= $bottom){
							$max_value = $poly_arr[$i][$j][$data_line->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
					}
				}
			}
			$polygons[] = $poly_arr[$max_index_i][$max_index_j];
		}
		$maximo = $polygons[0][$data_line->property];
		for ($i=0; $i < sizeof($polygons); $i++) {
			if($maximo < $polygons[$i][$data_line->property]){
				$maximo = $polygons[$i][$data_line->property];
			}
		}

		//MINIMUM
		$polygons = array();
		$min_value; $min_index_i; $min_index_j;
		$lo_profundo = 203;

		for ($i=0; $i < sizeof($poly_arr); $i++) {
			$min_value = PHP_INT_MAX;
			$min_index_i = $min_index_j = 0;
			$lo_profundo = 203;

			if(sizeof($poly_arr[$i]) > 1 && $poly_arr[$i][sizeof($poly_arr[$i])-1][$data_line->property] == 0){
				$limite = $poly_arr[$i][sizeof($poly_arr[$i])-2]['bottom'];

				if($lo_profundo <= $poly_arr[$i][0]['bottom']){
					$min_index_i = $i;
					$min_index_j = 0;
				}
				elseif($lo_profundo >= $limite){
					$lo_profundo = $limite;
					for ($j=0; $j < sizeof($poly_arr[$i])-1; $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($min_value > $poly_arr[$i][$j][$data_line->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$min_value = $poly_arr[$i][$j][$data_line->property];
							$min_index_i =  $i;
							$min_index_j = $j;
						}
					}
				}
				else{
					for ($j=0; $j < sizeof($poly_arr[$i])-1; $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];

						if($min_value > $poly_arr[$i][$j][$data_line->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$min_value = $poly_arr[$i][$j][$data_line->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}
						elseif($min_value > $poly_arr[$i][$j][$data_line->property] && $lo_profundo > $top && $lo_profundo <= $bottom){
							$min_value = $poly_arr[$i][$j][$data_line->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}
					}
				}
			}
			else{
				$limite = $poly_arr[$i][sizeof($poly_arr[$i])-1]['bottom'];

				if($lo_profundo <= $poly_arr[$i][0]['bottom']){
					$min_index_i = $i;
					$min_index_j = 0;
				}
				elseif($lo_profundo >= $limite){
					$lo_profundo = $limite;
					for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($min_value > $poly_arr[$i][$j][$data_line->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$min_value = $poly_arr[$i][$j][$data_line->property];
							$min_index_i =  $i;
							$min_index_j = $j;
						}
					}
				}
				else{
					for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];

						if($min_value > $poly_arr[$i][$j][$data_line->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$min_value = $poly_arr[$i][$j][$data_line->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}
						elseif($min_value > $poly_arr[$i][$j][$data_line->property] && $lo_profundo > $top && $lo_profundo <= $bottom){
							$min_value = $poly_arr[$i][$j][$data_line->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}
					}
				}
			}
			$polygons[] = $poly_arr[$min_index_i][$min_index_j];
		}
		$minimo = $polygons[0][$data_line->property];
		for ($i=0; $i < sizeof($polygons); $i++) {
			if($minimo > $polygons[$i][$data_line->property]){
				$minimo = $polygons[$i][$data_line->property];
			}
		}

		//MEDIAN
		$polygons = array();
		$med_index_i; $done_med;
		$med_value = 0;

		for ($j=0; $j < sizeof($poly_arr); $j++) {
			$med_index_i = 0;
			$done_med = 0;
			if(sizeof($poly_arr[$j]) > 1 && $poly_arr[$j][sizeof($poly_arr[$j])-1][$data_line->property] == 0){
				for ($i=0; $i < sizeof($poly_arr[$j])-1; $i++) {
					if((sizeof($poly_arr[$j])-1)%2 == 1 && $done_med == 0){//odd
						$med_index_i = ceil(sizeof($poly_arr[$j])/2); //have to subtract one from this value to get the index correctly
						$done_med = 1;
						$polygons[] = $poly_arr[$j][$med_index_i - 1];
					}
					elseif((sizeof($poly_arr[$j])-1)%2 == 0 && $done_med == 0){ //even
						$med_value = ($poly_arr[$j][(ceil((sizeof($poly_arr[$j])-1)/2)) - 1][$data_line->property] + $poly_arr[$j][(ceil((sizeof($poly_arr[$j])-1)/2))][$data_line->property]) / 2;
						$poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1][$data_line->property] = $med_value;
						$polygons[] = $poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1];
						$done_med = 1;
					}
				}
			}
			else{
				for ($i=0; $i < sizeof($poly_arr[$j]); $i++) {
					if((sizeof($poly_arr[$j])-1)%2 == 1 && $done_med == 0){//odd
						$med_index_i = ceil(sizeof($poly_arr[$j])/2); //have to subtract one from this value to get the index correctly
						$done_med = 1;
						$polygons[] = $poly_arr[$j][$med_index_i - 1];
					}
					elseif(sizeof($poly_arr[$j])%2 == 0 && $done_med == 0){ //even
						$med_value = ($poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1][$data_line->property] + $poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2))][$data_line->property]) / 2;
						$poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1][$data_line->property] = $med_value;
						$polygons[] = $poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1];
						$done_med = 1;
					}
				}
			}
		}
		$medianos = array();
		for ($i=0; $i < sizeof($polygons); $i++) {
			$medianos[$i] = $polygons[$i][$data_line->property];
		}
		array_multisort($medianos, SORT_ASC);
		$mediano;
		if(sizeof($polygons)%2 == 1){ //odd
			$mediano = $medianos[ceil(sizeof($medianos)/2)-1];
		}
		else{ //even
			$mediano = ($medianos[ceil(sizeof($medianos)/2)-1] + $medianos[ceil(sizeof($medianos)/2)]) / 2;
		}

		//WEIGHTED
		$polygons = array();
		$profundo = 203;
		$limite; $top; $bottom; $delta; $delta_depth; $valor; $just_one; $result_weighted;
		$n_operaciones = $counter = 0;

		for ($i=0; $i < sizeof($poly_arr); $i++) {
			$profundo = 203;
			$limite = $n_operaciones = $counter = $top = $bottom = $delta = $delta_depth = $valor = $just_one = $result_weighted = 0;

			if(sizeof($poly_arr[$i]) > 1 && $poly_arr[$i][sizeof($poly_arr[$i])-1][$data_line->property] == 0){ //use the penultimate index
				$limite = $poly_arr[$i][sizeof($poly_arr[$i])-2]['bottom'];//si lo $profundo es mayor que el limite, ignorar y usar el limite como lo profundo
				if($profundo > $limite){
					$profundo = $limite;
				}

				for ($k=0; $k < sizeof($poly_arr[$i])-1; $k++) {
					if($profundo >= $poly_arr[$i][$k]['top'] && $profundo >= $poly_arr[$i][$k]['bottom'] && $profundo <= $limite){
						$n_operaciones += 1;
					}
					elseif($profundo >= $poly_arr[$i][$k]['top'] && $profundo <= $poly_arr[$i][$k]['bottom'] && $profundo <= $limite){
						$n_operaciones += 1;
					}
				}

				for ($j=0; $j < (sizeof($poly_arr[$i])-1); $j++) {
					$top = $poly_arr[$i][$j]['top'];
					$bottom = $poly_arr[$i][$j]['bottom'];
					$delta = $bottom - $top;
					$valor = floatval($poly_arr[$i][$j][$data_line->property]);
					if($n_operaciones > $j){
						if($profundo >= $delta && $profundo >= $bottom){
							$result_weighted += (($delta/$profundo)*$valor);
						}
						elseif($profundo >= $delta && $profundo <= $bottom){
							$delta_depth = $profundo - $top;
							$result_weighted += (($delta_depth/$profundo)*$valor);
						}
						elseif($profundo <= $delta && $profundo <= $bottom && $just_one == 0) {
							$just_one = 1;
							$result_weighted += $valor;
						}
					} //end if n_operations
				}
				$poly_arr[$i][0][$data_line->property] = round($result_weighted,1);
				$polygons[] = $poly_arr[$i][0];
			} //end if for using penultimate index
			else{ //permissible to use the last index
				$limite = $poly_arr[$i][sizeof($poly_arr[$i])-1]['bottom'];
				if($profundo > $limite){
					$profundo = $limite;
				}

				for ($k=0; $k < sizeof($poly_arr[$i]); $k++) {
					if($profundo >= $poly_arr[$i][$k]['top'] && $profundo >= $poly_arr[$i][$k]['bottom'] && $profundo <= $limite){ //we need a limit/ceiling for the bottom of this
						$n_operaciones += 1;
					}
					elseif($profundo >= $poly_arr[$i][$k]['top'] && $profundo <= $poly_arr[$i][$k]['bottom'] && $profundo <= $limite){
						$n_operaciones += 1;
					}
				}

				for ($j=0; $j < (sizeof($poly_arr[$i])); $j++) {
					$top = $poly_arr[$i][$j]['top'];
					$bottom = $poly_arr[$i][$j]['bottom'];
					$delta = $bottom - $top;
					$valor = floatval($poly_arr[$i][$j][$data_line->property]);
					if($n_operaciones > $j){
						if($profundo >= $delta && $profundo >= $bottom){
							$result_weighted += (($delta/$profundo)*$valor);
						}
						elseif($profundo >= $delta && $profundo <= $bottom){
							$delta_depth = $profundo - $top;
							$result_weighted += (($delta_depth/$profundo)*$valor);
						}
						elseif($profundo <= $delta && $profundo <= $bottom && $just_one == 0) {
							$just_one = 1;
							$result_weighted += $valor;
						}
					}
				}
				$poly_arr[$i][0][$data_line->property] = round($result_weighted,1);
				$polygons[] = $poly_arr[$i][0];
			}
		} //end main for loop
		$promedio = 0;
		for ($i=0; $i < sizeof($polygons); $i++) {
			$promedio += $polygons[$i][$data_line->property];
		}
		$promedio = ($promedio)/sizeof($polygons);

		if($x == 1){
			$toReturn['key'] = $key;
			$toReturn['poly_num'] = sizeof($poly_arr);
			$toReturn['maxAOIch1'] = $maximo;
			$toReturn['minAOIch1']= $minimo;
			$toReturn['medAOIch1']= $mediano;
			$toReturn['weightedAOIch1']= $promedio;
		}
		elseif ($x == 2) {
			$toReturn['key'] = $key;
			$toReturn['poly_num'] = sizeof($poly_arr);
			$toReturn['maxAOIch2'] = $maximo;
			$toReturn['minAOIch2']= $minimo;
			$toReturn['medAOIch2']= $mediano;
			$toReturn['weightedAOIch2']= $promedio;
		}
		elseif ($x == 3) {
			$toReturn['key'] = $key;
			$toReturn['poly_num'] = sizeof($poly_arr);
			$toReturn['maxAOIch3'] = $maximo;
			$toReturn['minAOIch3']= $minimo;
			$toReturn['medAOIch3']= $mediano;
			$toReturn['weightedAOIch3']= $promedio;
		}
		elseif ($x == 4) {
			$toReturn['key'] = $key;
			$toReturn['poly_num'] = sizeof($poly_arr);
			$toReturn['maxAOIch4'] = $maximo;
			$toReturn['minAOIch4']= $minimo;
			$toReturn['medAOIch4']= $mediano;
			$toReturn['weightedAOIch4']= $promedio;
		}
	}
}
$x = 0;
function getHelperAOI(){
	$data_aoi = new dataToQueryPolygons();
	if($data_aoi->chart1 != null){ $x=1; getAOI($x); }
	else if($data_aoi->chart2 != null){ $x=2; getAOI($x); }
	else if($data_aoi->chart3 != null){ $x=3; getAOI($x); }
	else if($data_aoi->chart4 != null){ $x=4; getAOI($x); }
}
function getAOI($x){
	global $conn, $toReturn;
	$data_aoi = new dataToQueryPolygons();
	$simplificationFactor = polygonDefinition($data_aoi);
	$query = "SET @geom1 = 'POLYGON(($data_aoi->lng1	$data_aoi->lat1,$data_aoi->lng1	$data_aoi->lat2,$data_aoi->lng2	$data_aoi->lat2,$data_aoi->lng2	$data_aoi->lat1,$data_aoi->lng1	$data_aoi->lat1))'";
	$toReturn['query'] = $query;
	$result = mysqli_query($conn, $query);
	$data_aoi->table = 'chorizon_r';
	$key = setKey($data_aoi->table);
	if($x == 1){ $data_aoi->property = $data_aoi->chart1; }
	else if ($x == 2) { $data_aoi->property = $data_aoi->chart2; }
	else if ($x == 3) { $data_aoi->property = $data_aoi->chart3; }
	else if ($x == 4) { $data_aoi->property = $data_aoi->chart4; }

	if($data_aoi->table == "chorizon_r"){
		$query="SELECT OGR_FID, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data_aoi->property FROM polygon AS p NATURAL JOIN chorizon_joins as x WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		//$query="SELECT OGR_FID, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM mujoins3 NATURAL JOIN polygon AS p NATURAL JOIN chorizon_r as x WHERE x.cokey = mujoins3.cokey AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		$toReturn['query2'] = $query;
		$result = mysqli_query($conn, $query);
		$result = fetchAll($result);
		$polygons = array();

		$poly_arr = array();
		$ogr; $skip; $counter_j;
		$past_ogr = $counter_i = $entered = 0;

		for ($i=0; $i < sizeof($result); $i++){
			$counter_j = $skip = 0;
			$ogr = $result[$i]['OGR_FID'];

			if($entered == 1){
				$counter_i++;
			}

			if($past_ogr == $ogr){
				$ogr = 1;
				$skip = 1;
				$entered = 0;
			}
			else{
				$ogr = $result[$i]['OGR_FID'];
				$skip = 0;
				$entered = 0;
			}
			for ($j=0; $j < sizeof($result); $j++) {
				if($ogr == $result[$j]['OGR_FID'] && $skip == 0){
					$poly_arr[$counter_i][$counter_j] = $result[$j];
					$past_ogr = $ogr;
					$counter_j++;
					$entered = 1;
				}
			}
		}

		/* Busca el valor MAXIMO de la lista de los polignos, dependientemente del depth que el usuario le otorgue*/
		$max_value; $max_index_i; $max_index_j; $top; $bottom;
		$lo_profundo = 203;

		for ($i=0; $i < sizeof($poly_arr); $i++) { //sorting by property values ascending; had to modify query
			array_multisort($poly_arr[$i], SORT_ASC);
		}

		for ($i=0; $i < sizeof($poly_arr); $i++) {
			$max_value = $max_index_i = $max_index_j = 0;
			$lo_profundo = 203;

			if(sizeof($poly_arr[$i]) > 1 && $poly_arr[$i][sizeof($poly_arr[$i])-1][$data_aoi->property] == 0){
				$limite =  $poly_arr[$i][sizeof($poly_arr[$i])-2]['bottom'];

				if($lo_profundo <= $poly_arr[$i][0]['bottom']){
					$max_index_i = $i;
					$max_index_j = 0;
				}
				elseif($lo_profundo >= $limite){
					$lo_profundo = $limite;
					for ($j=0; $j < sizeof($poly_arr[$i])-1; $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($max_value < $poly_arr[$i][$j][$data_aoi->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$max_value = $poly_arr[$i][$j][$data_aoi->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
					}
				}
				else{
					for ($j=0; $j < sizeof($poly_arr[$i])-1; $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];

						if($max_value < $poly_arr[$i][$j][$data_aoi->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$max_value = $poly_arr[$i][$j][$data_aoi->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
						elseif($max_value < $poly_arr[$i][$j][$data_aoi->property] && $lo_profundo > $top && $lo_profundo <= $bottom){
							$max_value = $poly_arr[$i][$j][$data_aoi->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
					}
				}
			}
			else{
				$limite =  $poly_arr[$i][sizeof($poly_arr[$i])-1]['bottom'];

				if($lo_profundo <= $poly_arr[$i][0]['bottom']){
					$max_index_i = $i;
					$max_index_j = 0;
				}
				elseif($lo_profundo >= $limite){
					$lo_profundo = $limite;
					for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($max_value < $poly_arr[$i][$j][$data_aoi->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$max_value = $poly_arr[$i][$j][$data_aoi->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
					}
				}
				else{
					for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($max_value < $poly_arr[$i][$j][$data_aoi->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$max_value = $poly_arr[$i][$j][$data_aoi->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
						elseif($max_value < $poly_arr[$i][$j][$data_aoi->property] && $lo_profundo > $top && $lo_profundo <= $bottom){
							$max_value = $poly_arr[$i][$j][$data_aoi->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
					}
				}
			}
			$polygons[] = $poly_arr[$max_index_i][$max_index_j];
		}
		$maximo = $polygons[0][$data_aoi->property];
		for ($i=0; $i < sizeof($polygons); $i++) {
			if($maximo < $polygons[$i][$data_aoi->property]){
				$maximo = $polygons[$i][$data_aoi->property];
			}
		}

		//MINIMUM
		$polygons = array();
		$min_value; $min_index_i; $min_index_j;
		$lo_profundo = 203;

		for ($i=0; $i < sizeof($poly_arr); $i++) {
			$min_value = PHP_INT_MAX;
			$min_index_i = $min_index_j = 0;
			$lo_profundo = 203;

			if(sizeof($poly_arr[$i]) > 1 && $poly_arr[$i][sizeof($poly_arr[$i])-1][$data_aoi->property] == 0){
				$limite = $poly_arr[$i][sizeof($poly_arr[$i])-2]['bottom'];

				if($lo_profundo <= $poly_arr[$i][0]['bottom']){
					$min_index_i = $i;
					$min_index_j = 0;
				}
				elseif($lo_profundo >= $limite){
					$lo_profundo = $limite;
					for ($j=0; $j < sizeof($poly_arr[$i])-1; $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($min_value > $poly_arr[$i][$j][$data_aoi->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$min_value = $poly_arr[$i][$j][$data_aoi->property];
							$min_index_i =  $i;
							$min_index_j = $j;
						}
					}
				}
				else{
					for ($j=0; $j < sizeof($poly_arr[$i])-1; $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];

						if($min_value > $poly_arr[$i][$j][$data_aoi->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$min_value = $poly_arr[$i][$j][$data_aoi->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}
						elseif($min_value > $poly_arr[$i][$j][$data_aoi->property] && $lo_profundo > $top && $lo_profundo <= $bottom){
							$min_value = $poly_arr[$i][$j][$data_aoi->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}
					}
				}
			}
			else{
				$limite = $poly_arr[$i][sizeof($poly_arr[$i])-1]['bottom'];

				if($lo_profundo <= $poly_arr[$i][0]['bottom']){
					$min_index_i = $i;
					$min_index_j = 0;
				}
				elseif($lo_profundo >= $limite){
					$lo_profundo = $limite;
					for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($min_value > $poly_arr[$i][$j][$data_aoi->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$min_value = $poly_arr[$i][$j][$data_aoi->property];
							$min_index_i =  $i;
							$min_index_j = $j;
						}
					}
				}
				else{
					for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];

						if($min_value > $poly_arr[$i][$j][$data_aoi->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
							$min_value = $poly_arr[$i][$j][$data_aoi->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}
						elseif($min_value > $poly_arr[$i][$j][$data_aoi->property] && $lo_profundo > $top && $lo_profundo <= $bottom){
							$min_value = $poly_arr[$i][$j][$data_aoi->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}
					}
				}
			}
			$polygons[] = $poly_arr[$min_index_i][$min_index_j];
		}
		$minimo = $polygons[0][$data_aoi->property];
		for ($i=0; $i < sizeof($polygons); $i++) {
			if($minimo > $polygons[$i][$data_aoi->property]){
				$minimo = $polygons[$i][$data_aoi->property];
			}
		}

		//MEDIAN
		$polygons = array();
		$med_index_i; $done_med;
		$med_value = 0;

		for ($j=0; $j < sizeof($poly_arr); $j++) {
			$med_index_i = $done_med = 0;
			if(sizeof($poly_arr[$j]) > 1 && $poly_arr[$j][sizeof($poly_arr[$j])-1][$data_aoi->property] == 0){
				for ($i=0; $i < sizeof($poly_arr[$j])-1; $i++) {
					if((sizeof($poly_arr[$j])-1)%2 == 1 && $done_med == 0){//odd
						$med_index_i = ceil(sizeof($poly_arr[$j])/2); //have to subtract one from this value to get the index correctly
						$done_med = 1;
						$polygons[] = $poly_arr[$j][$med_index_i - 1];
					}
					elseif((sizeof($poly_arr[$j])-1)%2 == 0 && $done_med == 0){ //even
						$med_value = ($poly_arr[$j][(ceil((sizeof($poly_arr[$j])-1)/2)) - 1][$data_aoi->property] + $poly_arr[$j][(ceil((sizeof($poly_arr[$j])-1)/2))][$data_aoi->property]) / 2;
						$poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1][$data_aoi->property] = $med_value;
						$polygons[] = $poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1];
						$done_med = 1;
					}
				}
			}
			else{
				for ($i=0; $i < sizeof($poly_arr[$j]); $i++) {
					if((sizeof($poly_arr[$j])-1)%2 == 1 && $done_med == 0){//odd
						$med_index_i = ceil(sizeof($poly_arr[$j])/2); //have to subtract one from this value to get the index correctly
						$done_med = 1;
						$polygons[] = $poly_arr[$j][$med_index_i - 1];
					}
					elseif(sizeof($poly_arr[$j])%2 == 0 && $done_med == 0){ //even
						$med_value = ($poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1][$data_aoi->property] + $poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2))][$data_aoi->property]) / 2;
						$poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1][$data_aoi->property] = $med_value;
						$polygons[] = $poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1];
						$done_med = 1;
					}
				}
			}
		}
		$medianos = array();
		for ($i=0; $i < sizeof($polygons); $i++) {
			$medianos[$i] = $polygons[$i][$data_aoi->property];
		}
		array_multisort($medianos, SORT_ASC);
		$mediano;
		if(sizeof($polygons)%2 == 1){ //odd
			$mediano = $medianos[ceil(sizeof($medianos)/2)-1];
		}
		else{ //even
			$mediano = ($medianos[ceil(sizeof($medianos)/2)-1] + $medianos[ceil(sizeof($medianos)/2)]) / 2;
		}

		//WEIGHTED
		$polygons = array();
		$profundo = 203;
		$n_operaciones = 0;
		$counter = 0;
		$top; $bottom; $delta; $delta_depth; $limite; $valor; $just_one; $result_weighted;

		for ($i=0; $i < sizeof($poly_arr); $i++) {
			$profundo = 203;
			$limite = $n_operaciones = $counter = $top = $bottom = $delta = $delta_depth = $valor = $just_one = $result_weighted = 0;

			if(sizeof($poly_arr[$i]) > 1 && $poly_arr[$i][sizeof($poly_arr[$i])-1][$data_aoi->property] == 0){ //use the penultimate index
				$limite = $poly_arr[$i][sizeof($poly_arr[$i])-2]['bottom'];//si lo $profundo es mayor que el limite, ignorar y usar el limite como lo profundo
				if($profundo > $limite){
					$profundo = $limite;
				}

				for ($k=0; $k < sizeof($poly_arr[$i])-1; $k++) {
					if($profundo >= $poly_arr[$i][$k]['top'] && $profundo >= $poly_arr[$i][$k]['bottom'] && $profundo <= $limite){
						$n_operaciones += 1;
					}
					elseif($profundo >= $poly_arr[$i][$k]['top'] && $profundo <= $poly_arr[$i][$k]['bottom'] && $profundo <= $limite){
						$n_operaciones += 1;
					}
				}

				for ($j=0; $j < (sizeof($poly_arr[$i])-1); $j++) {
					$top = $poly_arr[$i][$j]['top'];
					$bottom = $poly_arr[$i][$j]['bottom'];
					$delta = $bottom - $top;
					$valor = floatval($poly_arr[$i][$j][$data_aoi->property]);
					if($n_operaciones > $j){
						if($profundo >= $delta && $profundo >= $bottom){
							$result_weighted += (($delta/$profundo)*$valor);
						}
						elseif($profundo >= $delta && $profundo <= $bottom){
							$delta_depth = $profundo - $top;
							$result_weighted += (($delta_depth/$profundo)*$valor);
						}
						elseif($profundo <= $delta && $profundo <= $bottom && $just_one == 0) {
							$just_one = 1;
							$result_weighted += $valor;
						}
					} //end if n_operations
				}
				$poly_arr[$i][0][$data_aoi->property] = round($result_weighted,1);
				$polygons[] = $poly_arr[$i][0];
			} //end if for using penultimate index
			else{ //permissible to use the last index
				$limite = $poly_arr[$i][sizeof($poly_arr[$i])-1]['bottom'];
				if($profundo > $limite){
					$profundo = $limite;
				}
				for ($k=0; $k < sizeof($poly_arr[$i]); $k++) {
					if($profundo >= $poly_arr[$i][$k]['top'] && $profundo >= $poly_arr[$i][$k]['bottom'] && $profundo <= $limite){ //we need a limit/ceiling for the bottom of this
						$n_operaciones += 1;
					}
					elseif($profundo >= $poly_arr[$i][$k]['top'] && $profundo <= $poly_arr[$i][$k]['bottom'] && $profundo <= $limite){
						$n_operaciones += 1;
					}
				}

				for ($j=0; $j < (sizeof($poly_arr[$i])); $j++) {
					$top = $poly_arr[$i][$j]['top'];
					$bottom = $poly_arr[$i][$j]['bottom'];
					$delta = $bottom - $top;
					$valor = floatval($poly_arr[$i][$j][$data_aoi->property]);
					if($n_operaciones > $j){
						if($profundo >= $delta && $profundo >= $bottom){
							$result_weighted += round((($delta/$profundo)*$valor), 2);
						}
						elseif($profundo >= $delta && $profundo <= $bottom){
							$delta_depth = $profundo - $top;
							$result_weighted += (($delta_depth/$profundo)*$valor);
						}
						elseif($profundo <= $delta && $profundo <= $bottom && $just_one == 0) {
							$just_one = 1;
							$result_weighted += $valor;
						}
					}
				}
				$poly_arr[$i][0][$data_aoi->property] = round($result_weighted,1);
				$polygons[] = $poly_arr[$i][0];
			}
		} //end main for loop
		$promedio = 0;
		for ($i=0; $i < sizeof($polygons); $i++) {
			$promedio += $polygons[$i][$data_aoi->property];
		}
		$promedio = ($promedio)/sizeof($polygons);

		if($x == 1){
			$toReturn['key'] = $key;
			$toReturn['poly_num'] = sizeof($poly_arr);
			$toReturn['maxAOIch1'] = $maximo;
			$toReturn['minAOIch1']= $minimo;
			$toReturn['medAOIch1']= $mediano;
			$toReturn['weightedAOIch1']= $promedio;
		}
		elseif ($x == 2) {
			$toReturn['key'] = $key;
			$toReturn['poly_num'] = sizeof($poly_arr);
			$toReturn['maxAOIch2'] = $maximo;
			$toReturn['minAOIch2']= $minimo;
			$toReturn['medAOIch2']= $mediano;
			$toReturn['weightedAOIch2']= $promedio;
		}
		elseif ($x == 3) {
			$toReturn['key'] = $key;
			$toReturn['poly_num'] = sizeof($poly_arr);
			$toReturn['maxAOIch3'] = $maximo;
			$toReturn['minAOIch3']= $minimo;
			$toReturn['medAOIch3']= $mediano;
			$toReturn['weightedAOIch3']= $promedio;
		}
		elseif ($x == 4) {
			$toReturn['key'] = $key;
			$toReturn['poly_num'] = sizeof($poly_arr);
			$toReturn['maxAOIch4'] = $maximo;
			$toReturn['minAOIch4']= $minimo;
			$toReturn['medAOIch4']= $mediano;
			$toReturn['weightedAOIch4']= $promedio;
		}
	}
}
function getPolygons(){
	global $conn, $toReturn;
	$data = new dataToQueryPolygons();//automatically gathers necessary data for query
	$simplificationFactor = polygonDefinition($data);//maybe it should be changing(be variable) in the future with  more given parameters($_GET)
	//create zoom area (AOI) polygon for further query
	if($data->runAOI == "true" && $data->runLine == "true"){ $query = "SET @geom1 = 'LineString($data->lineString)'"; }
	// ^ If the user only wants the polygons touching the AOI, and  he is using the line tool or the polygon tool, then use the LineString instead of the rectangle/map boundaries (the else statement).
	elseif($data->runAOI == "true" && $data->runPoly == "true"){ $query = "SET @geom1 = 'POLYGON(($data->lineString))'"; }
	else{ $query = "SET @geom1 = 'POLYGON(($data->lng1	$data->lat1,$data->lng1	$data->lat2,$data->lng2	$data->lat2,$data->lng2	$data->lat1,$data->lng1	$data->lat1))'"; }
	$toReturn['query'] = $query;
	$result = mysqli_query($conn, $query);
	$key = setKey( $data->table );
	//$query = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificationFactor)) AS POLYGON, x.$data->property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN $data->table AS x ON mu.$key = x.$key WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) AND hzdept_r <= $data->depth AND hzdepb_r >= $data->depth";
	if($data->table == "chorizon_r"){
		$method_selected = "none";
		if($data->depth_method == 1){ $method_selected = "Maximum"; }
		elseif ($data->depth_method == 2) { $method_selected = "Minimum"; }
		elseif ($data->depth_method == 3) { $method_selected = "Median"; }
		elseif ($data->depth_method == 4) { $method_selected = "Weighted"; }
		elseif ($data->depth_method == 5) { $method_selected = "At"; }
		if($data->runFilters == "true" && $data->filter_value == "bigger"){
			$units = (int)$data->filter_units;
			$method_selected = "Maximum";
			$query="SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificationFactor)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM polygon AS p NATURAL JOIN chorizon_joins as x WHERE x.$data->property >= $units AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		}
		else if($data->runFilters == "true" && $data->filter_value == "smaller"){
			$units = (int)$data->filter_units;
			$method_selected = "Maximum";
			$query="SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificationFactor)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM polygon AS p NATURAL JOIN chorizon_joins as x WHERE x.$data->property <= $units AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		}
		else if($data->runFilters == "true" && $data->filter_value == "equal"){
			$units = (int)$data->filter_units;
			$method_selected = "Maximum";
			$query="SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificationFactor)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM polygon AS p NATURAL JOIN chorizon_joins as x WHERE x.$data->property = $units AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		}
		else{
			$query="SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificationFactor)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM polygon AS p NATURAL JOIN chorizon_joins as x WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		}
		$toReturn['query2'] = $query;
		$result = mysqli_query($conn, $query);
		$result = fetchAll($result);
		$polygons = array();
		$poly_arr = array();
		$ogr; $skip; $counter_j;
		$past_ogr = $counter_i = $entered = 0;

		for ($i=0; $i < sizeof($result); $i++){
			$counter_j = 0;
			$ogr = $result[$i]['OGR_FID'];
			$skip = 0;
			if($entered == 1){
				$counter_i++;
			}
			if($past_ogr == $ogr){
				$ogr = 1;
				$skip = 1;
				$entered = 0;
			}
			else{
				$ogr = $result[$i]['OGR_FID'];
				$skip = 0;
				$entered = 0;
			}
			for ($j=0; $j < sizeof($result); $j++) {
				if($ogr == $result[$j]['OGR_FID'] && $skip == 0){
					$poly_arr[$counter_i][$counter_j] = $result[$j];
					$past_ogr = $ogr;
					$counter_j++;
					$entered = 1;
				}
			}
		}

		switch ($method_selected) {
			case 'Maximum':
			/* Busca el valor maximo de la lista de los polignos, dependientemente del depth que el usuario le otorgue*/
			$max_value; $max_index_i; $max_index_j; $top; $bottom;
			$lo_profundo = $data->depth;
			$not_shown = array(); //used for debugging
			for ($i=0; $i < sizeof($poly_arr); $i++) { //sorting by property values ascending; had to modify query
				array_multisort($poly_arr[$i], SORT_ASC);
			}
			for ($i=0; $i < sizeof($poly_arr); $i++) {
				$max_value = 0;
				$max_index_i = $i;
				$max_index_j = 0;
				if(isset($units) && $units > 0){ $data->depth = 0; }
				else{ $lo_profundo = $data->depth; }
				if(sizeof($poly_arr[$i]) > 1 && $poly_arr[$i][sizeof($poly_arr[$i])-1][$data->property] == 0){ //si el array de polys tiene mas de un campo, y si el ultimo valor es 0, no lo tomamos en cuenta
					$limite =  $poly_arr[$i][sizeof($poly_arr[$i])-2]['bottom']; //el limite (bottom depth) se toma en el penultimo valor de los arrays
					$jumps = 0;
					for ($z=0; $z < sizeof($poly_arr[$i])-1; $z++) {
						$top = $poly_arr[$i][$z]['top'];
						$bottom = $poly_arr[$i][$z]['bottom'];
						if($data->from_depth > $top && $data->from_depth > $bottom){ $jumps++; }
					}
					if($jumps >= sizeof($poly_arr[$i])-1){ //if the requested depth does not exist in the poylgon, return -99, which will color it gray
						//array_push($not_shown, $i); //not using this one, but useful for debugging
						$max_index_i = $i;
						$max_index_j = 0;
						$poly_arr[$i][0][$data->property] = -99;
					}
					for ($j=$jumps; $j < sizeof($poly_arr[$i])-1; $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($max_value < $poly_arr[$i][$j][$data->property] && ($data->from_depth >= $top && $lo_profundo <= $bottom)){
							$max_value = $poly_arr[$i][$j][$data->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}elseif($max_value < $poly_arr[$i][$j][$data->property] && ($data->from_depth >= $top && $lo_profundo >= $bottom)){
							$max_value = $poly_arr[$i][$j][$data->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}elseif($max_value < $poly_arr[$i][$j][$data->property] && ($data->from_depth <= $top && $lo_profundo >= $bottom)){
							$max_value = $poly_arr[$i][$j][$data->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
					}
				}
				else{ //el ultimo valor no es cero, y puede contener un solo poligono
					$limite =  $poly_arr[$i][sizeof($poly_arr[$i])-1]['bottom']; //el limite (bottom depth) se toma en el penultimo valor de los arrays
					$jumps = 0;
					for ($z=0; $z < sizeof($poly_arr[$i]); $z++) {
						$top = $poly_arr[$i][$z]['top'];
						$bottom = $poly_arr[$i][$z]['bottom'];
						if($data->from_depth > $top && $data->from_depth > $bottom){ $jumps++; }
					}
					if($jumps >= sizeof($poly_arr[$i])){ //if the requested depth does not exist in the poylgon, return -99, which will color it gray
						//array_push($not_shown, $i); //not using this one, but useful for debugging
						$max_index_i = $i;
						$max_index_j = 0;
						$poly_arr[$i][0][$data->property] = -99;
					}
					for ($j=$jumps; $j < sizeof($poly_arr[$i]); $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($max_value < $poly_arr[$i][$j][$data->property] && ($data->from_depth >= $top && $lo_profundo <= $bottom)){
							$max_value = $poly_arr[$i][$j][$data->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}elseif($max_value < $poly_arr[$i][$j][$data->property] && ($data->from_depth >= $top && $lo_profundo >= $bottom)){
							$max_value = $poly_arr[$i][$j][$data->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}elseif($max_value < $poly_arr[$i][$j][$data->property] && ($data->from_depth <= $top && $lo_profundo >= $bottom)){
							$max_value = $poly_arr[$i][$j][$data->property];
							$max_index_i = $i;
							$max_index_j = $j;
						}
					}
				} //end else
				$polygons[] = $poly_arr[$max_index_i][$max_index_j];
			}//end main for-loop
			break;

			case 'Minimum':
			/* Busca el valor minimo de la lista de los polignos, dependientemente del depth que el usuario le otorgue*/;
			$min_value; $min_index_i; $min_index_j;
			$lo_profundo = $data->depth;

			for ($i=0; $i < sizeof($poly_arr); $i++) { //sorting by property values ascending; had to modify query
				array_multisort($poly_arr[$i], SORT_ASC);
			}

			for ($i=0; $i < sizeof($poly_arr); $i++) {
				$min_value = PHP_INT_MAX;
				$min_index_i = 0;
				$min_index_j = 0;
				$lo_profundo = $data->depth;

				if(sizeof($poly_arr[$i]) > 1 && $poly_arr[$i][sizeof($poly_arr[$i])-1][$data->property] == 0){
					$limite =  $poly_arr[$i][sizeof($poly_arr[$i])-2]['bottom']; //el limite (bottom depth) se toma en el penultimo valor de los arrays
					$jumps = 0;
					for ($z=0; $z < sizeof($poly_arr[$i])-1; $z++) {
						$top = $poly_arr[$i][$z]['top'];
						$bottom = $poly_arr[$i][$z]['bottom'];
						if($data->from_depth > $top && $data->from_depth > $bottom){ $jumps++; }
					}
					$short =-1;
					for ($z=0; $z < sizeof($poly_arr[$i])-1; $z++) {
						$top = $poly_arr[$i][$z]['top'];
						$bottom = $poly_arr[$i][$z]['bottom'];
						if($top > $data->from_depth && $bottom > $lo_profundo){ $short++; }
					}
					if($short == -1){ $short++; } //handles limits
					if($short == sizeof($poly_arr[$i])-3){ $short++; } //as well as this one
					if($jumps >= sizeof($poly_arr[$i])-1){ //if the requested depth does not exist in the poylgon, return -99, which will color it gray
						//array_push($not_shown, $i); //not using this one, but useful for debugging
						$min_index_i = $i;
						$min_index_j = 0;
						$poly_arr[$i][0][$data->property] = -99;
					}
					for ($j=$jumps; $j < (sizeof($poly_arr[$i])-1)-$short; $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($min_value > $poly_arr[$i][$j][$data->property] && ($data->from_depth >= $top && $lo_profundo <= $bottom)){
							$min_value = $poly_arr[$i][$j][$data->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}elseif($min_value > $poly_arr[$i][$j][$data->property] && ($data->from_depth >= $top && $lo_profundo >= $bottom)){
							$min_value = $poly_arr[$i][$j][$data->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}elseif($min_value > $poly_arr[$i][$j][$data->property] && ($data->from_depth <= $top && $lo_profundo >= $bottom)){
							$min_value = $poly_arr[$i][$j][$data->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}elseif($min_value > $poly_arr[$i][$j][$data->property] && ($data->from_depth <= $top && $lo_profundo <= $bottom)){
							$min_value = $poly_arr[$i][$j][$data->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}
					}
				}
				else{
					$limite =  $poly_arr[$i][sizeof($poly_arr[$i])-1]['bottom']; //el limite (bottom depth) se toma en el penultimo valor de los arrays
					$jumps = 0;
					for ($z=0; $z < sizeof($poly_arr[$i]); $z++) {
						$top = $poly_arr[$i][$z]['top'];
						$bottom = $poly_arr[$i][$z]['bottom'];
						if($data->from_depth > $top && $data->from_depth > $bottom){ $jumps++; }
					}
					$short =-1;
					for ($z=0; $z < sizeof($poly_arr[$i]); $z++) {
						$top = $poly_arr[$i][$z]['top'];
						$bottom = $poly_arr[$i][$z]['bottom'];
						if($top > $data->from_depth && $bottom > $lo_profundo){ $short++; }
					}
					if($short == -1){ $short++; } //handles limits
					if($short == sizeof($poly_arr[$i])-2){ $short++; } //as well as this one
					if($jumps >= sizeof($poly_arr[$i])){ //if the requested depth does not exist in the polygon, return -99, which will color it gray
						//array_push($not_shown, $i); //not using this one, but useful for debugging
						$min_index_i = $i;
						$min_index_j = 0;
						$poly_arr[$i][0][$data->property] = -99;
					}
					for ($j=$jumps; $j < (sizeof($poly_arr[$i]))-$short; $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($min_value > $poly_arr[$i][$j][$data->property] && ($data->from_depth >= $top && $lo_profundo <= $bottom)){
							$min_value = $poly_arr[$i][$j][$data->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}elseif($min_value > $poly_arr[$i][$j][$data->property] && ($data->from_depth >= $top && $lo_profundo >= $bottom)){
							$min_value = $poly_arr[$i][$j][$data->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}elseif($min_value > $poly_arr[$i][$j][$data->property] && ($data->from_depth <= $top && $lo_profundo >= $bottom)){
							$min_value = $poly_arr[$i][$j][$data->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}elseif($min_value > $poly_arr[$i][$j][$data->property] && ($data->from_depth <= $top && $lo_profundo <= $bottom)){
							$min_value = $poly_arr[$i][$j][$data->property];
							$min_index_i = $i;
							$min_index_j = $j;
						}
					}
				}
				$polygons[] = $poly_arr[$min_index_i][$min_index_j];
			}
			break;

			case 'Median':
			/*Busca el valor medio para poligonos con n layers seasen pares o impares. No depende de depth*/
			$med_index_i;
			$med_value = 0;
			$done_med;
			$arr_med = array();
			$size_arr = sizeof($poly_arr);

			for ($i=0; $i < sizeof($poly_arr); $i++) { //sorting by property values ascending; had to modify query
				array_multisort($poly_arr[$i], SORT_ASC);
			}

			for ($j=0; $j < sizeof($poly_arr); $j++) {
				$med_index_i = 0;
				$done_med = 0;
				if(sizeof($poly_arr[$j]) > 1 && $poly_arr[$j][sizeof($poly_arr[$j])-1][$data->property] == 0){
					for ($i=0; $i < sizeof($poly_arr[$j])-1; $i++) {
						if((sizeof($poly_arr[$j])-1)%2 == 1 && $done_med == 0){//odd
							$med_index_i = ceil(sizeof($poly_arr[$j])/2); //have to subtract one from this value to get the index correctly
							$done_med = 1;
							$polygons[] = $poly_arr[$j][$med_index_i - 1];
						}
						elseif((sizeof($poly_arr[$j])-1)%2 == 0 && $done_med == 0){ //even
							$med_value = ($poly_arr[$j][(ceil((sizeof($poly_arr[$j])-1)/2)) - 1][$data->property] + $poly_arr[$j][(ceil((sizeof($poly_arr[$j])-1)/2))][$data->property]) / 2;
							$poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1][$data->property] = $med_value;
							$polygons[] = $poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1];
							$done_med = 1;
						}
					}
				}
				else{
					for ($i=0; $i < sizeof($poly_arr[$j]); $i++) {
						if((sizeof($poly_arr[$j])-1)%2 == 1 && $done_med == 0){//odd
							$med_index_i = ceil(sizeof($poly_arr[$j])/2); //have to subtract one from this value to get the index correctly
							$done_med = 1;
							$polygons[] = $poly_arr[$j][$med_index_i - 1];
						}
						elseif(sizeof($poly_arr[$j])%2 == 0 && $done_med == 0){ //even
							$med_value = ($poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1][$data->property] + $poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2))][$data->property]) / 2;
							$poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1][$data->property] = $med_value;
							$polygons[] = $poly_arr[$j][(ceil(sizeof($poly_arr[$j])/2)) - 1];
							$done_med = 1;
						}
					}
				}
			}
			break;

			case 'Weighted':
			/*Depending on the depth, this method will get the average value for all the layers until that depth. */
			$profundo = $data->depth;
			$limite; $top; $bottom; $delta; $delta_depth; $valor; $just_one; $result_weighted;

			for ($i=0; $i < sizeof($poly_arr); $i++) { //sorting by property values ascending; had to modify query
				array_multisort($poly_arr[$i], SORT_ASC);
			}

			for ($i=0; $i < sizeof($poly_arr); $i++) {
				$profundo = $data->depth;
				$from = $data->from_depth;
				$limite = $n_operaciones = $counter = $top = $bottom = $delta = $delta_depth = $valor = $just_one = $result_weighted = 0;
				if(sizeof($poly_arr[$i]) > 1 && $poly_arr[$i][sizeof($poly_arr[$i])-1][$data->property] == 0){ //use the penultimate index
					$operations = 0;
					$in_case = 0;
					$delta = $profundo - $from;
					if($profundo > $poly_arr[$i][sizeof($poly_arr[$i])-2]['bottom']){
						$delta = $poly_arr[$i][sizeof($poly_arr[$i])-2]['bottom'] - $from;
					}
					if($profundo <= $poly_arr[$i][0]['bottom']){
						$delta = $poly_arr[$i][0]['bottom'];
					}
					$weighted = $diff = $from_delta = $to_delta = 0;
					for ($j=0; $j < (sizeof($poly_arr[$i])-1); $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($top <= $data->from_depth && $bottom >= $data->from_depth){
							$diff = $bottom - $data->from_depth;
							$x = $poly_arr[$i][$j][$data->property];
							$weighted += ($diff/$delta) * $poly_arr[$i][$j][$data->property];
							$in_case = $x;
							$operations++;
						}
						elseif($top <= $profundo && $bottom >= $profundo){
							$diff = $profundo - $top;
							$x = $poly_arr[$i][$j][$data->property];
							$weighted += ($diff/$delta) * $poly_arr[$i][$j][$data->property];
							$in_case = $x;
							$operations++;
						}
						elseif(($top >= $data->from_depth && $bottom >= $data->from_depth) && ($top <= $profundo && $bottom <= $profundo)){
							$diff = $bottom - $top;
							$x = $poly_arr[$i][$j][$data->property];
							$weighted += ($diff/$delta) * $poly_arr[$i][$j][$data->property];
							$in_case = $x;
							$operations++;
						}
					}
					if($weighted == 0){
						$weighted = -99;
					}
					if($operations == 1){
						$weighted = $in_case;
					}
					$poly_arr[$i][0][$data->property] = round($weighted,1);
					$polygons[] = $poly_arr[$i][0];
				} //end if for using penultimate index
				else{ //permissible to use the last index
					$operations = 0;
					$in_case = 0;
					$delta = $profundo - $from;
					if($profundo > $poly_arr[$i][sizeof($poly_arr[$i])-1]['bottom']){
						$delta = $poly_arr[$i][sizeof($poly_arr[$i])-1]['bottom'] - $from;
					}
					if($profundo <= $poly_arr[$i][0]['bottom']){
						$delta = $poly_arr[$i][0]['bottom'];
					}
					$weighted = $diff = $from_delta = $to_delta = 0;
					for ($j=0; $j < (sizeof($poly_arr[$i])); $j++) {
						$top = $poly_arr[$i][$j]['top'];
						$bottom = $poly_arr[$i][$j]['bottom'];
						if($top <= $data->from_depth && $bottom >= $data->from_depth){
							$diff = $bottom - $data->from_depth;
							$x = $poly_arr[$i][$j][$data->property];
							$weighted += ($diff/$delta) * $x;
							$in_case = $x;
							$operations++;
							//echo " we are in 'from'. diff is $diff, delta is $delta, data->prop is $x \n";

						}
						elseif($top <= $profundo && $bottom >= $profundo){
							$diff = $profundo - $top;
							$x = $poly_arr[$i][$j][$data->property];
							$weighted += ($diff/$delta) * $x;
							$in_case = $x;
							$operations++;
							//echo " we are in 'to'. diff is $diff, delta is $delta, data->prop is $x \n";
						}
						elseif(($top >= $data->from_depth && $bottom >= $data->from_depth) && ($top <= $profundo && $bottom <= $profundo)){
							$diff = $bottom - $top;
							$x = $poly_arr[$i][$j][$data->property];
							$weighted += ($diff/$delta) * $x;
							$in_case = $x;
							$operations++;
							//echo " we are in 'middle'. diff is $diff, delta is $delta, data->prop is $x \n";
						}
					}
					if($weighted == 0){
						$weighted = -99;
					}
					if($operations == 1){
						$weighted = $in_case;
					}
					$poly_arr[$i][0][$data->property] = round($weighted,1);
					$polygons[] = $poly_arr[$i][0];
				}
			} //end main for-loop
			break;

			case 'At':
			for ($i=0; $i < sizeof($poly_arr); $i++) { //This was the method used before. It searches, goes to the depth specified, and gives the value AT that depth.
				for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
					if($data->from_depth >= $poly_arr[$i][$j]['top'] && $data->depth <= $poly_arr[$i][$j]['bottom']){ //discriminador de depth
						$polygons[] = $poly_arr[$i][$j];
					}
				}
			}
			break;

			default:
			for ($i=0; $i < sizeof($poly_arr); $i++) {
				for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
					if($data->depth >= $poly_arr[$i][$j]['top'] && $data->depth <= $poly_arr[$i][$j]['bottom']){ //discriminador de depth
						$polygons[] = $poly_arr[$i][$j];
					}
				}
			}
			break;
		}
		$toReturn['coords'] = $polygons;
	}
	else{
		$query = "SELECT OGR_FID, p.mukey, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificationFactor)) AS POLYGON, x.$data->property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN $data->table AS x ON mu.$key = x.$key WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)";
		$toReturn['query2'] = $query;
		$result = mysqli_query($conn, $query);
		$result = fetchAll($result);
		$polygons = array();
		$id_array = array();
		$indexes_array = array();

		for($i = 0; $i<sizeof($result); $i++){
			$id_array[$i]['OGR_FID'] = $result[$i]['OGR_FID'];
		}

		$unique = array();
		$unique = array_unique($id_array, SORT_REGULAR);
		$unique_index = array();

		for ($i=0; $i < sizeof($result); $i++) {
			if(array_key_exists($i, $unique)){
				array_push($unique_index, $i);
			}
		}

		if(sizeof($unique_index) == 1){
			for($i = 0; $i<sizeof($result); $i++){
				if($data->depth >= $result[$i]['top'] && $data->depth <= $result[$i]['bottom']){ //discriminador de depth
					$polygons[] = $result[$i];
				}
			}
		}
		else{
			for($i = 0; $i<sizeof($unique_index); $i++){
				$polygons[] = $result[$unique_index[$i]];
			}
		}
		$toReturn['coords'] = $polygons;//fetch all
	}
}
function polygonDefinition( $data ){
	$zoom = haversine( $data );
	$factor = ($zoom * 0.0000000147540984 );
	if( $factor > 0.5 ){ return 0.5; }
	return $factor;
}

function haversine( $data ){
	$earthRadius = 6371000;
	$latFrom = deg2rad($data->lat2);
	$lonFrom = deg2rad($data->lng2);
	$latTo = deg2rad($data->lat1);
	$lonTo = deg2rad($data->lng1);
	$latDelta = ($latTo - $latFrom);
	$lonDelta = ($lonTo - $lonFrom);
	$angle = 2 * asin( sqrt( pow( sin( $latDelta / 2 ), 2 ) + cos($latFrom) * cos( $latTo ) * pow( sin( $lonDelta / 2 ), 2 ) ) );
	$distance = $angle * $earthRadius;
	return $distance;
}
?>
