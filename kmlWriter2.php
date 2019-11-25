<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', -1);

function parser($c) {
  $just_c = substr($c, 9, -2);
  $without_commas = explode(",", $just_c);
  $parsed = [];
  for ($i = 0; $i < sizeof($without_commas); $i++) {
    $xy = explode(" ", $without_commas[$i]);
    $to_send = $xy[0] . "," . $xy [1] . ",0\n"; 
    array_push($parsed, $to_send);
  }
  return $parsed;
}

$soil_name = "Plasticity Index";
$soil_val = "pi_r";
$filename = "./jsons/all_pi_36.json";

$json = file_get_contents($filename);
$data = json_decode($json);

$kml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<kml xmlns=\"http://www.opengis.net/kml/2.2\">
<Document>
<name>ctis_isc_polygon.kml</name>
<Style id=\"thickLine\"><LineStyle><width>2.5</width></LineStyle></Style>
<Style id=\"transparent50Poly\"><PolyStyle><color>7fffffff</color></PolyStyle></Style>";

for($i = 0; $i < sizeof($data); $i++) {
  $value = $data[$i]->$soil_val;
  $kml .= "<Placemark>
  <name>hollow polygon ".$i." </name>
  <ExtendedData>
  <Data name=\"".$soil_name."\">
  <value>".$value."</value>
  </Data>
  </ExtendedData>
  <Polygon>
  <outerBoundaryIs>
  <LinearRing>
  <coordinates>";

  $parsed = parser($data[$i]->POLYGON);

  for ($j = 0; $j < sizeof($parsed); $j++) { 
    $kml .= $parsed[$j];
  }

  $kml .= "</coordinates>
    </LinearRing>
    </outerBoundaryIs>
    </Polygon>
    <styleUrl>#transparent50Poly</styleUrl>
    </Placemark>";
}

$kml .= "</Document></kml>";

$filename = "./ctis_isc_polygon_all_pi_36.kml";
$file = fopen( "$filename", "w+" );

if( $file == false ) {
  echo ( "Error opening file first" );
  exit();
}

if(filesize($filename) == 0){
  fwrite($file,  $kml);
}
else{
  fclose( $file );
  unlink($filename);
  $filename = "./ctis_isc_polygon_all_pi_36.kml";
  $file = fopen( $filename, "w+" );
  fwrite($file,  $kml);
}

fclose( $file );
?>
