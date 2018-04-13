<?php
require_once('conn.php');
switch(true){

    // Get unique road ids
    // case(isset($_GET['request']) && $_GET['request'] == "rids"):
    //   $query = "SELECT DISTINCT(RID) FROM referenceMarkers";
    //   $result = mysqli_query($conn, $query);
    //   $response = [];
    //   while($row = mysqli_fetch_assoc($result)){
    //     $response[] = $row;
    //   }
    //   echo json_encode($response);
    //   break;

    // Get reference markers with coordinates
    case(isset($_GET['request']) && $_GET['request'] == "sections" && isset($_GET['district'])):
        $district = mysqli_real_escape_string($conn, $_GET['district']);
        //$county = mysqli_real_escape_string($conn, $_GET['county']);

//        if($county == 'All'){
//            echo "here";
            $query = "SELECT BEGIN_DFO, END_DFO, DISTRICT, COUNTY, RTE_NM, OBJECTID, ST_AsText(LINESTRING) AS LINESTRING FROM controlSections WHERE DISTRICT = '$district'";
//        }else{
//            echo "here too";
//            $query = "SELECT BEGIN_DFO, END_DFO, DISTRICT, COUNTY, RTE_NM, OBJECTID, ST_AsText(LINESTRING) AS LINESTRING FROM controlSections WHERE DISTRICT = '$district' AND COUNTY = '$county'";
//            // $query = "SELECT OBJECTID, BEGIN_DFO, END_DFO, DISTRICT, COUNTY, RTE_NM, OBJECTID, ST_AsText(LINESTRING) AS LINESTRING FROM controlSections WHERE RTE_NM = 'IH0010-KG'";
//        }

        // $query = "SELECT RTE_NM, OBJECTID, ST_AsText(LINESTRING) AS LINESTRING FROM controlSections WHERE RTE_NM ='FM2119-KG'";

        $result = mysqli_query($conn, $query);

        $response = [];
        while($row = mysqli_fetch_assoc($result)){
            $response[] = $row;
        }

        echo json_encode($response);
        break;

}
?>
