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
		getPolygons();
	}
	else if(isset($_GET['district'])){//*******************This is the case for retieving the districts from table**********************(2)
		districtNames();
	}
	else if(isset($_POST['columns'])){//**************** This is the case for retrieving table names ***********************(3)
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

		public function __construct(){
			$this->table = $_GET['table'];
			$this->property = $_GET['property'];
			$this->district = $_GET['district'];
			$this->lat2 = $_GET['NE']['lat'];
			$this->lat1 = $_GET['SW']['lat'];
			$this->lng2 = $_GET['NE']['lng'];
			$this->lng1 = $_GET['SW']['lng'];
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
		$simplificaionFactor = 0.00005;//maybe it should be changing(be variable) in the future with  more given parameters($_GET)

		//create zoom area (AOI) polygon for further query
		$query = "SET @geom1 = 'POLYGON(($data->lng1	$data->lat1,$data->lng1	$data->lat2,$data->lng2	$data->lat2,$data->lng2	$data->lat1,$data->lng1	$data->lat1))'";
		$toReturn['query'] = $query;
		$result = mysqli_query($conn, $query);

		$key = setKey( $data->table );//appropriate key for given table

		//actual query for retrieving desired polygons
		$query = "SELECT OGR_FID, ASTEXT(ST_SIMPLIFY(SHAPE, $simplificaionFactor)) AS POLYGON, x.$data->property FROM polygon AS p JOIN mujoins AS mu ON p.mukey = CAST(mu.mukey AS UNSIGNED) JOIN $data->table AS x ON mu.$key = x.$key WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), p.SHAPE)";
		$toReturn['query2'] = $query;
		$result = mysqli_query($conn, $query);

		$toReturn['coords'] = fetchAll($result);//fetch all
	}








?>
