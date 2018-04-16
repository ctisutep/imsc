<?php
require_once('conn.php');

switch (true) {

    case (isset($_GET['mukey']) && isset($_GET['soilProperty']) && $_GET['soilProperty'] == 'gypsum_r'):
        $mukey = mysqli_real_escape_string($conn, $_GET['mukey']);
        $query = "SELECT hzdept_r, hzdepb_r, gypsum_r AS classification FROM soilProperties WHERE mukey = $mukey";
        $result = mysqli_query($conn, $query);

        $response = [];
        while($row = mysqli_fetch_assoc($result)){
            $response[] = $row;
        }

        header('Content-type: application/json');
        echo json_encode($response);

        break;

    case (isset($_GET['mukey']) && isset($_GET['soilProperty']) && $_GET['soilProperty'] == 'aashind_r'):
        $mukey = mysqli_real_escape_string($conn, $_GET['mukey']);
        $query = "SELECT hzdept_r, hzdepb_r, aashtocl AS classification FROM chaashto WHERE mukey = $mukey";
        $result = mysqli_query($conn, $query);

        $response = [];
        while($row = mysqli_fetch_assoc($result)){
            $response[] = $row;
        }

        header('Content-type: application/json');
        echo json_encode($response);

        break;

    case (isset($_POST['lat1']) && isset($_POST['lat2']) && isset($_POST['lng1']) && isset($_POST['lng2']) && isset($_POST['soilProperty']) && $_POST['soilProperty'] == 'gypsum_r'):
        $lat1 = $_POST['lat1'];
        $lat2 = $_POST['lat2'];
        $lng1 = $_POST['lng1'];
        $lng2 = $_POST['lng2'];

        $query = "SET @geom1 = 'POLYGON(($lng1	$lat1,$lng1	$lat2,$lng2	$lat2,$lng2	$lat1,$lng1	$lat1))'";
        $result = mysqli_query($conn, $query);
        $query = "SELECT polygon.OGR_FID, ST_AsText(polygon.SHAPE) AS POLYGON, polygon.areasymbol, soilproperties.gypsum_r as classification, soilproperties.mukey FROM polygon NATURAL JOIN soilproperties WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), SHAPE) AND soilproperties.hzdept_r = 0";
        $result = mysqli_query($conn, $query);

        $response = [];
        while($row = mysqli_fetch_assoc($result)){
            $response[] = $row;
        }

        header('Content-type: application/json');
        echo json_encode($response);

        break;

    case (isset($_POST['district']) && isset($_POST['county']) && isset($_POST['soilProperty']) && $_POST['soilProperty'] == 'aashtocl'):
        $district = mysqli_real_escape_string($conn, $_POST['district']);
        $county = mysqli_real_escape_string($conn, $_POST['county']);

        if($county == "All"){
            $query = "SELECT polygon.OGR_FID, ST_AsText(polygon.SHAPE) AS POLYGON, polygon.areasymbol, chaashto.aashtocl, chaashto.mukey FROM polygon NATURAL JOIN chaashto WHERE ST_INTERSECTS(ST_GEOMFROMTEXT(@geom1, 1), SHAPE) AND chaashto.hzdept_r = 0";
        }else{
            $query = "SELECT polygon.OGR_FID, ST_AsText(ST_Simplify(polygon.SHAPE, 0.0001)) AS POLYGON, polygon.areasymbol, chaashto.aashtocl AS classification, chaashto.mukey FROM polygon NATURAL JOIN chaashto WHERE polygon.areasymbol = '$county' AND chaashto.hzdept_r = 0";
        }

        $result = mysqli_query($conn, $query);

        $response = [];
        while($row = mysqli_fetch_assoc($result)){
            $response[] = $row;
        }

        header('Content-type: application/json');
        echo json_encode($response);

        break;

    default:
        $mukey = mysqli_real_escape_string($conn, $_GET['mukey']);
        $sp = $_GET['soilProperty'];
        $query = "SELECT hzdept_r, hzdepb_r, $sp AS classification FROM imsc.chorizon_joins WHERE mukey = $mukey";
        $result = mysqli_query($conn, $query);

        $response = [];
        while($row = mysqli_fetch_assoc($result)){
            $response[] = $row;
        }

        header('Content-type: application/json');
        echo json_encode($response);

        break;
}
mysqli_close($conn);
?>
