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

	public function __construct(){
		$this->table = $_GET['table'];
		$this->property = $_GET['property'];
		$this->district = $_GET['district'];
		$this->lat2 = $_GET['NE']['lat'];
		$this->lat1 = $_GET['SW']['lat'];
		$this->lng2 = $_GET['NE']['lng'];
		$this->lng1 = $_GET['SW']['lng'];
		$this->depth = ($_GET['depth'] * 2.54);
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

	/*TESTING DIFFERENT QUERIES*****************************************************************************************************************************************************************/


	/*END OF 	TESTING DIFFERENT QUERIES*****************************************************************************************************************************************************************/
	//$query = "SELECT x.cokey, p.mukey, OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificaionFactor)) AS POLYGON, hzdept_r AS t, hzdepb_r AS b, x.$data->property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN $data->table AS x ON mu.$key = x.$key WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)"; //for chorizon_r
	//$query = "SELECT p.mukey, OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificaionFactor)) AS POLYGON, x.$data->property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN $data->table AS x ON mu.$key = x.$key WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)"; //for chconsistence_r e.g. Plasticity

	if($data->table == "chorizon_r"){
		$q_cokey = "SELECT mu.cokey FROM polygon, mujoins as mu WHERE mu.mukey = polygon.mukey AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), polygon.SHAPE)"; //assuming we have the 'ideal' cokey
		$toReturn['q_cokey'] = $q_cokey;
		$q_cokey = mysqli_query($conn, $q_cokey);
		$row_q = fetchAll($q_cokey);
		$rows_q = array();

		for ($i=0; $i < sizeof($row_q); $i++) {
			$rows_q[] = $row_q[$i];
		}

		$toReturn['TESTING cokey'] = $rows_q;
		//$el_cokey_ideal = $rows_q[0]['cokey'];

		$q_cokey2 = "SELECT compkind, component_r.cokey FROM component_r, polygon WHERE component_r.mukey = polygon.mukey AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), polygon.SHAPE)"; //assuming we have the 'ideal' cokey
		$toReturn['compkind'] = $q_cokey2;
		$q_cokey2 = mysqli_query($conn, $q_cokey2);
		$row_q2 = fetchAll($q_cokey2);
		$rows_q2 = array();
		$index_ideal = 99;

		//$indexes = array();

		for ($i=0; $i < sizeof($row_q2); $i++) {
			$rows_q2[] = $row_q2[$i];
			if($rows_q2[$i]['compkind'] == "Series"){
				$index_ideal = $i;
				//$indexes[$i] = $i;
			}
		}

		//var_dump($indexes);

		//echo $el_cokey_ideal;

		if($index_ideal != 99){
			$el_cokey_ideal = $rows_q2[$index_ideal]['cokey'];
		}

		//echo $el_cokey_ideal;

		$toReturn['TESTING compkind'] = $rows_q2;
		//$el_cokey_ideal = $rows_q[0]['cokey'];

		//echo $el_cokey_ideal;

		/*if($rows_q[0]['cokey'] == 13639075){
		echo "TESTING: It entered the if-statement";
	}*/
	/*
	$q_mukey = "SELECT polygon.mukey FROM polygon WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), polygon.SHAPE) LIMIT 0, 1";
	$toReturn['q_mukey'] = $q_mukey;
	$q_mukey = mysqli_query($conn, $q_mukey);
	$row_mu = fetchAll($q_mukey);
	$rows_mu = array();
	for ($i=0; $i < sizeof($row_mu); $i++) {
	$rows_mu[] = $row_mu[$i];
}
$toReturn['TESTING mukey'] = $rows_mu;*/
/*if($rows_mu[0]['mukey'] = 393253){
echo "TESTING: It entered the if-statement for mu";
}*/


/*$q_ch = "SELECT hzdept_r, hzdepb_r, chorizon_r.cokey, chorizon_r.$data->property FROM polygon, chorizon_r WHERE chorizon_r.cokey = $el_cokey_ideal AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), polygon.SHAPE)";
$toReturn['q_ch'] = $q_ch;
$q_ch = mysqli_query($conn, $q_ch);
$row_ch = fetchAll($q_ch);
$rows_ch = array();
for ($i=0; $i < sizeof($row_ch); $i++) {
	$rows_ch[] = $row_ch[$i];
}
$toReturn['TESTING ch'] = $rows_ch;
/*

/*if($rows_mu[0]['mukey'] = 393253){
echo "TESTING: It entered the if-statement for mu";
}*/

/*if(isset($el_cokey_ideal)){
	//echo "cokey series existe, por lo tanto $el_cokey_ideal existe";
	$query = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificaionFactor)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM polygon AS p, chorizon_r as x WHERE x.cokey = $el_cokey_ideal AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)"; //just works for chorizon at the moment
}
else{
	//echo "cokey series no existe";
	$query = "SELECT x.cokey, p.mukey, OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificaionFactor)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.$data->property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN $data->table AS x ON mu.$key = x.$key WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)"; //working on it
}*/

$query = "SELECT x.cokey, p.mukey, OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificaionFactor)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.$data->property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN $data->table AS x ON mu.$key = x.$key WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)"; //working on it
//$query = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificaionFactor)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM polygon AS p, chorizon_r as x WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)"; //no se
//$query = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificaionFactor)) AS POLYGON, hzdept_r AS top, hzdepb_r AS bottom, x.cokey, x.$data->property FROM polygon AS p, chorizon_r as x WHERE x.cokey = $el_cokey_ideal AND ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)"; //just works for chorizon at the moment

$toReturn['query2'] = $query;
$result = mysqli_query($conn, $query);

$result = fetchAll($result);

$polygons = array();

$check_duplicate;
$id;

$id_array = array();
//$indexes_array = array();

for($i = 0; $i<sizeof($result); $i++){
	//$id_array[$i]['cokey'] = $result[$i]['cokey'];
	$id_array[$i]['OGR_FID'] = $result[$i]['OGR_FID'];
}

//var_dump($id_array);


$unique = array();
$unique = array_unique($id_array, SORT_REGULAR);

//var_dump($id_array);
//var_dump($unique);

$unique_index = array();

for ($i=0; $i < sizeof($result); $i++) {
	if(array_key_exists($i, $unique)){
		array_push($unique_index, $i);
		//echo $i;
		//echo " \r\n";
	}
}

//var_dump($unique_index);

/*for ($i=0; $i < sizeof($unique_index); $i++) {
echo $unique_index[$i];
echo " \r\n";
}

var_dump($unique_index);*/

/*echo sizeof($result);
for($i = 0; $i<sizeof($result); $i++){
for($j = 0; $j < sizeof($result); $j++){
if($id_array[$i]['OGR_FID'] == $id_array[$j]['OGR_FID']){
//$indexes_array['test'] = $j;
echo "i: ";
echo $i;
echo " j: ";
echo $j;
echo " \r\n";
}
}
}*/

//var_dump($indexes_array);

//var_dump($result);

//echo $unique_index[0]; //0 when testing one polygon
//echo sizeof($unique_index); //1 when testing one polygon

//var_dump($result);
//echo "separate";
//var_dump($unique_index);

/*for($i = 0; $i < sizeof($result); $i++){
	for($j = 0; $j < sizeof($unique_index); $j++){
		//echo $i;
		//echo " \r\n";
		//echo $j;
		//echo " \r\n";
		if($unique_index[$j]['OGR_FID'] == $result[$i]['OGR_FID']){
			var_dump($unique_index);
		}
	}
}*/

/*for($i=0; $i < sizeof($result); $i++) {
		for ($j=0; $j < sizeof($rows_q2); $j++) {
			if($result[$i]['cokey'] == $rows_q2[$index_ideal]['cokey']){
				echo $i;
			}
		}
}*/

/*for($i=0; $i < sizeof($result); $i++) {
		$polygons[] = $result[$i];
}*/

/*
if(sizeof($unique_index) == 1){
	echo "hey";
	for($i = 0; $i<sizeof($result); $i++){
		//for($j = 0; $j < sizeof($unique_index); j++){
		echo "hi";
		if($data->depth >= $result[$i]['top'] && $data->depth <= $result[$i]['bottom'] && $result[$i]['cokey'] == $el_cokey_ideal){ //discriminador de depth
			echo "Hello there";
			echo $result[$i]['cokey'];
			$polygons[] = $result[$i];
		}
	//}
	}
}
else{
	echo "test else";
	for($i = 0; $i<sizeof($unique_index); $i++){
		echo "Hello here";
		if($data->depth >= $result[$unique_index[$i]]['top'] && $data->depth <= $result[$unique_index[$i]]['bottom']){ //discriminador de depth
			echo "hellos";
			$polygons[] = $result[$unique_index[$i]];
		}
	}
}
*/

/*if(sizeof($unique_index) == 1){
	for($i = 0; $i<sizeof($result); $i++){
		if($data->depth >= $result[$i]['top'] && $data->depth <= $result[$i]['bottom']){ //discriminador de depth
			$polygons[] = $result[$i];
		}
	}
}
else{
	for($i = 0; $i<sizeof($unique_index); $i++){
		if($data->depth >= $result[$unique_index[$i]]['top'] && $data->depth <= $result[$unique_index[$i]]['bottom']){ //discriminador de depth
			$polygons[] = $result[$unique_index[$i]];
		}
	}
}*/


for ($i=0; $i < sizeof($unique_index); $i++) {
	if($data->depth >= $result[$unique_index[$i]]['top'] && $data->depth <= $result[$unique_index[$i]]['bottom']){ //discriminador de depth
		$polygons[] = $result[$unique_index[$i]];
	}
}

/*for($i = 0; $i<sizeof($unique_index); $i++){
	if($data->depth >= $result[$unique_index[$i]]['top'] && $data->depth <= $result[$unique_index[$i]]['bottom']){ //discriminador de depth
		$polygons[] = $result[$unique_index[$i]];
	}
}*/

/*for($i = 0; $i<sizeof($result); $i++){
	if($data->depth >= $result[$i]['top'] && $data->depth <= $result[$i]['bottom']){ //discriminador de depth
		$polygons[] = $result[$i];
	}
}*/

/*for( $i = 0; $i<sizeof( $result ); $i++ ){
if(($i + 1)<sizeof($result)){
/*echo $i;
echo ($i + 1);
echo "print";*/
//		$check_duplicate = $result[$i+1]['OGR_FID'];
//}
//echo sizeof($result);
//$id = $result[$i]['OGR_FID'];
//if( $data->depth >= $result[$i]['t'] && $data->depth <= $result[$i]['b']){

/*if(sizeof($result)>2 && $id != $check_duplicate){
$polygons[] = $result[$i];
}*/
//else{
//$polygons[] = $result[$i];
//}
//}
//echo $i;
//}
//}

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

	/*for($i = 0; $i<sizeof($result); $i++){
	//if($data->depth >= $result[$i]['top'] && $data->depth <= $result[$i]['bottom']){ //discriminador de depth
	$polygons[] = $result[$i];
	//}
}*/

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
//google haversine
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
