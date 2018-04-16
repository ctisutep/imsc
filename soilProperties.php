<?php
require_once('conn.php');

switch (true) {

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

    default:
        $mukey = mysqli_real_escape_string($conn, $_GET['mukey']);
        $sp = $_GET['soilProperty'];
        $query = "SELECT hzdept_r, hzdepb_r, $sp AS classification FROM imsc.chorizon_joins WHERE mukey = $mukey ORDER BY hzdept_r ASC";
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
