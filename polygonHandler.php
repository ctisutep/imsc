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
	getAOI(); //cambio de Ricardo
}
else if(isset($_GET['district'])){//*******************This is the case for retieving the districts from table**********************(2)
	districtNames();
}
else if(isset($_POST['columns'])){//**************** This is the case for retrieving table names  ***********************(3)
	tableNames();
}
/**     -------------------------------------------         */
//returns data back to javascript
header('Content-Type: application/json');
echo json_encode($toReturn);
$conn->close();
/****************************************************/
//functionality ends here. BELOW CONVINIENCE UTILITY
/***************************************************/
//no need to mess with this class, simply for refactoring( making code shorter and or modular )
class dataToQueryPolygons{
	public $table;
	public $property;
	public $district;//not in use yet
	public $lat2;
	public $lat1;
	public $lng2;
	public $lng1;
	public $depth;
	public $depth_method;

	public function __construct(){
		$this->table = $_GET['table'];
		$this->property = $_GET['property'];
		$this->district = $_GET['district'];
		$this->lat2 = $_GET['NE']['lat'];
		$this->lat1 = $_GET['SW']['lat'];
		$this->lng2 = $_GET['NE']['lng'];
		$this->lng1 = $_GET['SW']['lng'];
		$this->depth = ($_GET['depth'] * 2.5400);
		$this->depth_method = $_GET['depth_method'];
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
	//this query goes to a table in the database called "properties" and gets a set containing all records that
	//are either(OR)  LIKE  chonsistency or choriszon for property_table column
	$sql = "SELECT * FROM properties WHERE property_table LIKE \"%chconsistence_r%\" OR property_table LIKE \"%chorizon_r%\" ";
	//conn.query(sql) -> from pre-established connection to data base make given query(sql)
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

function getAOI(){
	global $conn, $toReturn;
	$data_aoi = new dataToQueryPolygons();
	$simplificationFactor = polygonDefinition($data_aoi);
	$query = "SET @geom1 = 'POLYGON(($data_aoi->lng1	$data_aoi->lat1,$data_aoi->lng1	$data_aoi->lat2,$data_aoi->lng2	$data_aoi->lat2,$data_aoi->lng2	$data_aoi->lat1,$data_aoi->lng1	$data_aoi->lat1))'";
	$toReturn['query'] = $query;
	$result = mysqli_query($conn, $query);
	$key = setKey($data_aoi->table);

	if($data_aoi->table == "chorizon_r"){
		$query="SELECT OGR_FID, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data_aoi->property FROM polygon AS p NATURAL JOIN chorizon_joins as x WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		//$query="SELECT OGR_FID, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM mujoins3 NATURAL JOIN polygon AS p NATURAL JOIN chorizon_r as x WHERE x.cokey = mujoins3.cokey AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		$toReturn['query2'] = $query;
		$result = mysqli_query($conn, $query);
		$result = fetchAll($result);
		$polygons = array();

		$poly_arr = array();
		$ogr;
		$past_ogr = 0;
		$skip;
		$counter_i = 0;
		$counter_j;
		$entered = 0;

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
		$max_value;
		$max_index_i;
		$max_index_j;
		$lo_profundo = 203;
		$top;
		$bottom;

		for ($i=0; $i < sizeof($poly_arr); $i++) { //sorting by property values ascending; had to modify query
			array_multisort($poly_arr[$i], SORT_ASC);
		}

		for ($i=0; $i < sizeof($poly_arr); $i++) {
			$max_value = 0;
			$max_index_i = 0;
			$max_index_j = 0;
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
		$min_value;
		$min_index_i;
		$min_index_j;
		$lo_profundo = 203;

		for ($i=0; $i < sizeof($poly_arr); $i++) {
			$min_value = PHP_INT_MAX;
			$min_index_i = 0;
			$min_index_j = 0;
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
		$med_index_i;
		$med_value = 0;
		$done_med;

		for ($j=0; $j < sizeof($poly_arr); $j++) {
			$med_index_i = 0;
			$done_med = 0;
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
			//echo "odd";
			//echo ceil(sizeof($medianos)/2)-1;
			$mediano = $medianos[ceil(sizeof($medianos)/2)-1];
		}
		else{ //even
			$mediano = ($medianos[ceil(sizeof($medianos)/2)-1] + $medianos[ceil(sizeof($medianos)/2)]) / 2;
		}

		//WEIGHTED
		$polygons = array();
		$profundo = 203;
		$limite;
		$n_operaciones = 0;
		$counter = 0;
		$top;
		$bottom;
		$delta;
		$delta_depth;
		$valor;
		$just_one;
		$result_weighted;

		for ($i=0; $i < sizeof($poly_arr); $i++) {
			$profundo = 203;
			$limite = 0;
			$n_operaciones = 0;
			$counter = 0;
			$top = 0;
			$bottom = 0;
			$delta = 0;
			$delta_depth = 0;
			$valor = 0;
			$just_one = 0;
			$result_weighted = 0;

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
					$valor = $poly_arr[$i][$j][$data_aoi->property];
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
					$valor = $poly_arr[$i][$j][$data_aoi->property];
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
				$poly_arr[$i][0][$data_aoi->property] = round($result_weighted,1);
				$polygons[] = $poly_arr[$i][0];
			}
		} //end main for loop
		$promedio = 0;
		for ($i=0; $i < sizeof($polygons); $i++) {
			$promedio += $polygons[$i][$data_aoi->property];
		}
		$promedio = ($promedio)/sizeof($polygons);


		$toReturn['key'] = $key;
		$toReturn['poly_num'] = sizeof($poly_arr);
		$toReturn['maxAOI'] = $maximo;
		$toReturn['minAOI']= $minimo;
		$toReturn['medAOI']= $mediano;
		$toReturn['weightedAOI']= $promedio;
	}
}

function getPolygons(){
	global $conn, $toReturn;
	$data = new dataToQueryPolygons();//automatically gathers necessary data for query
	$simplificationFactor = polygonDefinition($data);//maybe it should be changing(be variable) in the future with  more given parameters($_GET)
	//create zoom area (AOI) polygon for further query
	$query = "SET @geom1 = 'POLYGON(($data->lng1	$data->lat1,$data->lng1	$data->lat2,$data->lng2	$data->lat2,$data->lng2	$data->lat1,$data->lng1	$data->lat1))'";
	$toReturn['query'] = $query;
	$result = mysqli_query($conn, $query);
	$key = setKey( $data->table );//appropriate key for given table
	//actual query for retrieving desired polygons
	//$query = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificationFactor)) AS POLYGON, x.$data->property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN $data->table AS x ON mu.$key = x.$key WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) AND hzdept_r <= $data->depth AND hzdepb_r >= $data->depth";

	if($data->table == "chorizon_r"){
		$query="SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificationFactor)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM polygon AS p NATURAL JOIN chorizon_joins as x WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		//$query="SELECT OGR_FID, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM mujoins3 NATURAL JOIN polygon AS p NATURAL JOIN chorizon_r as x WHERE x.cokey = mujoins3.cokey AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) ORDER BY OGR_FID DESC";
		$toReturn['query2'] = $query;
		$result = mysqli_query($conn, $query);
		$result = fetchAll($result);
		$polygons = array();

		$method_selected = 0;

		if($data->depth_method == 1){
			//echo " On maximum ";
			$method_selected = "Maximum";
		}
		elseif ($data->depth_method == 2) {
			//echo " On minimum ";
			$method_selected = "Minimum";
		}
		elseif ($data->depth_method == 3) {
			//echo " On median ";
			$method_selected = "Median";
		}
		elseif ($data->depth_method == 4) {
			//echo " On weighted ";
			$method_selected = "Weighted";
		}
		elseif ($data->depth_method == 5) {
			//echo " On weighted ";
			$method_selected = "At";
		}
		else{
			//echo " Nothing selected ";
		}

		$poly_arr = array();
		$ogr;
		$past_ogr = 0;
		$skip;
		$counter_i = 0;
		$counter_j;
		$entered = 0;

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
			$max_value;
			$max_index_i;
			$max_index_j;
			$lo_profundo = $data->depth;
			$top;
			$bottom;

			for ($i=0; $i < sizeof($poly_arr); $i++) { //sorting by property values ascending; had to modify query
				array_multisort($poly_arr[$i], SORT_ASC);
			}

			for ($i=0; $i < sizeof($poly_arr); $i++) {
				$max_value = 0;
				$max_index_i = 0;
				$max_index_j = 0;
				$lo_profundo = $data->depth;

				if(sizeof($poly_arr[$i]) > 1 && $poly_arr[$i][sizeof($poly_arr[$i])-1][$data->property] == 0){
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
							if($max_value < $poly_arr[$i][$j][$data->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
								$max_value = $poly_arr[$i][$j][$data->property];
								$max_index_i = $i;
								$max_index_j = $j;
							}
						}
					}
					else{
						for ($j=0; $j < sizeof($poly_arr[$i])-1; $j++) {
							$top = $poly_arr[$i][$j]['top'];
							$bottom = $poly_arr[$i][$j]['bottom'];

							if($max_value < $poly_arr[$i][$j][$data->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
								$max_value = $poly_arr[$i][$j][$data->property];
								$max_index_i = $i;
								$max_index_j = $j;
							}
							elseif($max_value < $poly_arr[$i][$j][$data->property] && $lo_profundo > $top && $lo_profundo <= $bottom){
								$max_value = $poly_arr[$i][$j][$data->property];
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
							if($max_value < $poly_arr[$i][$j][$data->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
								$max_value = $poly_arr[$i][$j][$data->property];
								$max_index_i = $i;
								$max_index_j = $j;
							}
						}
					}
					else{
						for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
							$top = $poly_arr[$i][$j]['top'];
							$bottom = $poly_arr[$i][$j]['bottom'];
							if($max_value < $poly_arr[$i][$j][$data->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
								$max_value = $poly_arr[$i][$j][$data->property];
								$max_index_i = $i;
								$max_index_j = $j;
							}
							elseif($max_value < $poly_arr[$i][$j][$data->property] && $lo_profundo > $top && $lo_profundo <= $bottom){
								$max_value = $poly_arr[$i][$j][$data->property];
								$max_index_i = $i;
								$max_index_j = $j;
							}
						}
					}
				}
				$polygons[] = $poly_arr[$max_index_i][$max_index_j];
			}
			break;

			case 'Minimum':
			/* Busca el valor minimo de la lista de los polignos, dependientemente del depth que el usuario le otorgue*/
			$min_value;
			$min_index_i;
			$min_index_j;
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
							if($min_value > $poly_arr[$i][$j][$data->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
								$min_value = $poly_arr[$i][$j][$data->property];
								$min_index_i =  $i;
								$min_index_j = $j;
							}
						}
					}
					else{
						for ($j=0; $j < sizeof($poly_arr[$i])-1; $j++) {
							$top = $poly_arr[$i][$j]['top'];
							$bottom = $poly_arr[$i][$j]['bottom'];

							if($min_value > $poly_arr[$i][$j][$data->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
								$min_value = $poly_arr[$i][$j][$data->property];
								$min_index_i = $i;
								$min_index_j = $j;
							}
							elseif($min_value > $poly_arr[$i][$j][$data->property] && $lo_profundo > $top && $lo_profundo <= $bottom){
								$min_value = $poly_arr[$i][$j][$data->property];
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
							if($min_value > $poly_arr[$i][$j][$data->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
								$min_value = $poly_arr[$i][$j][$data->property];
								$min_index_i =  $i;
								$min_index_j = $j;
							}
						}
					}
					else{
						for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
							$top = $poly_arr[$i][$j]['top'];
							$bottom = $poly_arr[$i][$j]['bottom'];

							if($min_value > $poly_arr[$i][$j][$data->property] && $lo_profundo > $top && $lo_profundo >= $bottom){
								$min_value = $poly_arr[$i][$j][$data->property];
								$min_index_i = $i;
								$min_index_j = $j;
							}
							elseif($min_value > $poly_arr[$i][$j][$data->property] && $lo_profundo > $top && $lo_profundo <= $bottom){
								$min_value = $poly_arr[$i][$j][$data->property];
								$min_index_i = $i;
								$min_index_j = $j;
							}
						}
					}
				}
				$polygons[] = $poly_arr[$min_index_i][$min_index_j];
			}
			break;

			case 'Median':
			/*Busca el valor medio para poligonos con n layers seasen pares o impares.*/
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
			$limite;
			$n_operaciones = 0;
			$counter = 0;
			$top;
			$bottom;
			$delta;
			$delta_depth;
			$valor;
			$just_one;
			$result_weighted;

			for ($i=0; $i < sizeof($poly_arr); $i++) { //sorting by property values ascending; had to modify query
				array_multisort($poly_arr[$i], SORT_ASC);
			}

			for ($i=0; $i < sizeof($poly_arr); $i++) {
				$profundo = $data->depth;
				$limite = 0;
				$n_operaciones = 0;
				$counter = 0;
				$top = 0;
				$bottom = 0;
				$delta = 0;
				$delta_depth = 0;
				$valor = 0;
				$just_one = 0;
				$result_weighted = 0;

				if(sizeof($poly_arr[$i]) > 1 && $poly_arr[$i][sizeof($poly_arr[$i])-1][$data->property] == 0){ //use the penultimate index
					$limite = $poly_arr[$i][sizeof($poly_arr[$i])-2]['bottom'];//si lo $profundo es mayor que el limite, ignorar y usar el limite como lo profundo
					if($profundo > $limite){
						$profundo = $limite;
					}

					for ($k=0; $k < sizeof($poly_arr[$i])-1; $k++) {
						if($profundo >= $poly_arr[$i][$k]['top'] && $profundo >= $poly_arr[$i][$k]['bottom'] && $profundo <= $limite){ //we need a limit/ceiling for the bottom of this
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
						$valor = $poly_arr[$i][$j][$data->property];
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
					$poly_arr[$i][0][$data->property] = round($result_weighted,1);
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
						$valor = $poly_arr[$i][$j][$data->property];
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
					$poly_arr[$i][0][$data->property] = round($result_weighted,1);
					$polygons[] = $poly_arr[$i][0];
				}
			} //end main for loop
			break;

			case 'At':
			for ($i=0; $i < sizeof($poly_arr); $i++) { //This was the method used before. It searches, goes to the depth specified, and gives the value AT that depth.
				for ($j=0; $j < sizeof($poly_arr[$i]); $j++) {
					if($data->depth >= $poly_arr[$i][$j]['top'] && $data->depth <= $poly_arr[$i][$j]['bottom']){ //discriminador de depth
						$polygons[] = $poly_arr[$i][$j];
					}
				}
			}
			break;

			default:
			for ($i=0; $i < sizeof($poly_arr); $i++) { //This was the method used before. It searches, goes to the depth specified, and gives the value AT that depth.
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
				//if($data->depth >= $result[$unique_index[$i]]['top'] && $data->depth <= $result[$unique_index[$i]]['bottom']){ //discriminador de depth
				$polygons[] = $result[$unique_index[$i]];
				//}
			}
		}

		$toReturn['coords'] = $polygons;//fetch all
	}
}
function polygonDefinition( $data ){
	$zoom = haversine( $data );
	//test wis choping off everything after the 4.
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
