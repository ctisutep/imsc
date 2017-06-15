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
		$this->depth = ($_GET['depth'] * 2.54);
		$this->depth_method = $_GET['depth_method'];
	}
}
//depending on which table (for a given property) will be used in query, this will determine the appropriate key
function setKey($table){
	if($table == "chorizon_r")          { return "chkey"; }
	else if($table == "chconsistence_r"){ return "chconsistkey"; }
}
//I dont fully understand why this is needed or what it does
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
function getPolygons(){
	global $conn, $toReturn;
	$data = new dataToQueryPolygons();//automatically gathers necessary data for query
	$simplificaionFactor = polygonDefinition( $data );//maybe it should be changing(be variable) in the future with  more given parameters($_GET)
	//create zoom area (AOI) polygon for further query
	$query = "SET @geom1 = 'POLYGON(($data->lng1	$data->lat1,$data->lng1	$data->lat2,$data->lng2	$data->lat2,$data->lng2	$data->lat1,$data->lng1	$data->lat1))'";
	$toReturn['query'] = $query;
	$result = mysqli_query($conn, $query);
	$key = setKey( $data->table );//appropriate key for given table
	//actual query for retrieving desired polygons
	//$query = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificaionFactor)) AS POLYGON, x.$data->property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN $data->table AS x ON mu.$key = x.$key WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE) AND hzdept_r <= $data->depth AND hzdepb_r >= $data->depth";

	if($data->table == "chorizon_r"){ //necesario (por ahora) para no usar layers si la propiedad no es de chorizon


		/*Query for getting either the Series of Miscellaneous area from component"*/
		$cokeys = "SELECT OGR_FID, component_r.cokey, component_r.compkind FROM polygon, component_r WHERE component_r.mukey = polygon.mukey AND (compkind = 'Miscellaneous area' AND majcompflag = 'Yes' OR compkind = 'Series' AND majcompflag = 'Yes' OR compkind = 'Taxadjunct' AND majcompflag = 'Yes') AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), polygon.SHAPE)";
		//$cokeys = "SELECT * FROM mujoins2 WHERE cokey IN (SELECT cokey FROM component_r WHERE compkind = 'Miscellaneous area' AND majcompflag = 'Yes' OR compkind = 'Series' AND majcompflag = 'Yes')";
		$toReturn['query para cokeys que tienen ya sea series || miscellaneous'] = $cokeys;
		$cokeys = mysqli_query($conn, $cokeys);
		$row_cokeys = fetchAll($cokeys);
		$arr_cokeys = array();

		for ($i=0; $i < sizeof($row_cokeys); $i++) {
			$arr_cokeys[] = $row_cokeys[$i];
		}

		$toReturn['cokeys que tienen ya sea series || miscellaneous || taxadjunct'] = $arr_cokeys;

		//$query = "SELECT x.cokey, p.mukey, OGR_FID, hzdept_r AS top, hzdepb_r AS bottom, x.$data->property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN $data->table AS x ON mu.$key = x.$key WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)"; //working on it
		$query = "SELECT x.cokey, p.mukey, OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificaionFactor)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.$data->property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN $data->table AS x ON mu.$key = x.$key WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)"; //working on it
		//$query = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificaionFactor)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM polygon AS p, chorizon_r as x WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)"; //no se
		//$query = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificaionFactor)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM polygon AS p, chorizon_r as x WHERE x.cokey = $el_cokey_ideal AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)"; //just works for chorizon at the moment

		$toReturn['query2'] = $query;
		$result = mysqli_query($conn, $query);

		$result = fetchAll($result);

		$polygons = array();

		$id_array = array();
		//$indexes_array = array();
		//echo sizeof($result);
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

		$correctos_arr = array();
		$found = false;

		$series_arr = array();
		$misc_arr = array();
		$tax_arr = array();
		$correctos_test_arr = array();


		for($i=0; $i < sizeof($unique_index); $i++){ //elegir los cokeys correctos
			$found = false;
			$found_misc = false;
			$found_tax = false;
			$temp = $result[$unique_index[$i]]['OGR_FID'];

			for($j=0; $j < sizeof($arr_cokeys); $j++){
				if($temp == $arr_cokeys[$j]['OGR_FID'] && $found == false){
					if($arr_cokeys[$j]['compkind'] == 'Series'){ //going inside but not stopping at found
						array_push($series_arr, $j); //mete los indexes que usaremos al meter los resultados al polygon

						$found = true;
					}
				}
			}

			for($h=0; $h < sizeof($arr_cokeys); $h++){
				if($temp == $arr_cokeys[$h]['OGR_FID'] && $found_misc == false){
					if($arr_cokeys[$h]['compkind'] == 'Miscellaneous area'){ //going inside but not stopping at found
						array_push($misc_arr, $h); //mete los indexes que usaremos al meter los resultados al polygon
						$found_misc = true;
					}
				}
			}

			for($k=0; $k < sizeof($arr_cokeys); $k++){
				if($temp == $arr_cokeys[$k]['OGR_FID'] && $found_tax == false){
					if($arr_cokeys[$k]['compkind'] == 'Taxadjunct'){ //going inside but not stopping at found
						array_push($tax_arr, $k); //mete los indexes que usaremos al meter los resultados al polygon
						$found_tax = true;
					}
				}
			}
		}
		//var_dump($arr_cokeys);
		$array_to_use = array();
		if(sizeof($series_arr) > sizeof($misc_arr)){
			$array_to_use = $series_arr;
		}
		else{
			$array_to_use = $misc_arr;
		}

		$find = 0;
		$misc_find = 0;
		$absolute_find = 0;
		$traversed = 0;
		$index_to_store = 0;
		$find_global = 0;
		$checker_ids = array();

		$counter = 0;

		$checker = array();

		for($i=0; $i < sizeof($unique_index); $i++){ //guardar los correctos en el array
			$find = 0;
			$ogr = $result[$unique_index[$i]]['OGR_FID'];
			for ($j=0; $j < sizeof($unique_index); $j++) {
				if($find == 0 && array_key_exists($j, $series_arr) && $ogr == $arr_cokeys[$series_arr[$j]]['OGR_FID'] && $arr_cokeys[$series_arr[$j]]['compkind'] == 'Series'){
					array_push($correctos_test_arr, $series_arr[$j]);
					array_push($checker, $series_arr[$j]);
					$find = 1;
					$counter += 1;
				}
			}
		}

		//var_dump($checker);
		//echo sizeof($series_arr);

		if(sizeof($series_arr) != 0){

			for ($i=0; $i < sizeof($unique_index); $i++) {
				if(array_key_exists($i, $checker)){
					$checker_ids[$i] = $arr_cokeys[$checker[$i]]['OGR_FID'];
				}
			}

			for ($i=0; $i < sizeof($unique_index); $i++){
				if(array_key_exists($i, $misc_arr)){
					$ogr_val = $arr_cokeys[$misc_arr[$i]]['OGR_FID'];
				}
				if(in_array($ogr_val, $checker_ids)){
					//do nothing; we want the other values
				}
				else{
					array_push($correctos_test_arr, $misc_arr[$i]);
				}
			}
		}
		else{
			for($i=0; $i < sizeof($unique_index); $i++){
				$find = 0;

				$ogr = $arr_cokeys[$unique_index[$i]]['OGR_FID'];
				for ($j=0; $j < sizeof($unique_index); $j++) {
					//if(array_key_exists($j, $misc_arr) && ($ogr == $arr_cokeys[$misc_arr[$j]]['OGR_FID'])){ //aqui es el problema, cuzzz compara con inexistente que agarra de arriba*
					if($find == 0 && array_key_exists($j, $misc_arr) && $ogr == $arr_cokeys[$misc_arr[$j]]['OGR_FID'] && $arr_cokeys[$misc_arr[$j]]['compkind'] == 'Miscellaneous area'){
						array_push($correctos_test_arr, $misc_arr[$j]);
						$find = 1;
						$counter += 1;
					}

				}

			}
		}

		for($i=0; $i < sizeof($unique_index); $i++){ //guardar los correctos en el array
			if(array_key_exists($i, $checker) && $checker[$i] == $i){
				$find = 0;
			}
			else{
				$find = 0;
				$ogr = $result[$unique_index[$i]]['OGR_FID'];
				for ($j=0; $j < sizeof($unique_index); $j++) {
					if($counter < sizeof($unique_index)){
						if($find == 0 && array_key_exists($j, $tax_arr) && $ogr == $arr_cokeys[$tax_arr[$j]]['OGR_FID'] && $arr_cokeys[$tax_arr[$j]]['compkind'] == 'Taxadjunct'){
							array_push($correctos_test_arr, $tax_arr[$j]);
							$find = 1;
							$counter += 1;
						}
					}
				}
			}
		}

		/*Pruebas de queries dentro de un loop */
		$array_polygons = array();
		$cokey_usado = 0;
		$ogr_usado = 0;
		$total_size = 0;
		$method_selected = 5;

		//echo $method_selected;

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
		else{
			//echo " Nothing selected ";
		}

		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		for ($i=0; $i < sizeof($unique_index); $i++) {
			$cokey_usado = $arr_cokeys[$correctos_test_arr[$i]]['cokey'];
			$ogr_usado = $arr_cokeys[$correctos_test_arr[$i]]['OGR_FID'];
			$query_test = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, 1.7625422383727E-6)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM polygon AS p, chorizon_r as x WHERE x.cokey = $cokey_usado AND OGR_FID = $ogr_usado AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)"; //just works for chorizon at the moment
			//"            SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, 1.7625422383727E-6)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.pi_r FROM polygon AS p, chorizon_r as x WHERE x.cokey = 13638933 AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)";
			//$query_test = "SELECT OGR_FID, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM polygon AS p, chorizon_r as x WHERE x.cokey = $cokey_usado AND OGR_FID = $ogr_usado AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)"; //just works for chorizon at the moment

			$toReturn['query loop'] = $query_test;
			$result_loop = mysqli_query($conn, $query_test);

			$result_loop = fetchAll($result_loop);
			//$toReturn['testing methods'] = $result_loop;
			$array_polygons[] = $result_loop;

			$total_size += sizeof($result_loop);

			unset($result_loop);
		}

		/*Final de pruebas de queries dentro de un loop*/
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		/*
		En este punto vamos a determinar como vamos a meter nuestros poligonos a
		colorear. Dependenera de methodos, en un case statement.
		*/
		//echo $method_selected;
		switch ($method_selected) {
			case 'Maximum':
				echo "Maximum method selected";
				break;

			case 'Minimum':
				echo "Minimum method selected";
				break;

			case 'Median':
				echo "Median method selected";
				break;

			case 'Weighted':
				echo "Weighted method selected";
				break;

			default:
				echo "lo demas";
				break;
		}

		for ($j=0; $j < sizeof($array_polygons); $j++) {
			for ($i=0; $i < sizeof($array_polygons[$j]); $i++) { //con unique index se sacan los OGR_FID unicos, mas no necesariamente los que poseen layers
				if($data->depth >= $array_polygons[$j][$i]['top'] && $data->depth <= $array_polygons[$j][$i]['bottom']){ //discriminador de depth
					$polygons[] = $array_polygons[$j][$i]; //el indice es aquel que contendra el ID unico, sin embargo, necesitamos extraer el ID que use el cokey perteneciente a layers (compkind == 'Series')
				}
			}
		}

		$toReturn['coords'] = $polygons;//fetch all
	}

	else{
		$query = "SELECT OGR_FID, p.mukey, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificaionFactor)) AS POLYGON, x.$data->property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN $data->table AS x ON mu.$key = x.$key WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)";
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
