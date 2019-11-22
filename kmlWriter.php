<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', -1);

// $length = $_POST["length"];
// $name = $_POST["name"];

$json = file_get_contents('php://input');
$data = json_decode($json);

$string_kml = "";
$all_poly = array();
// for ($i=0; $i < $length; $i++) {
//   array_push($all_poly, $_POST[$i]);
// }

for ($i=0; $i < $data->length; $i++) {
  array_push($all_poly, $data->$i);
}

$all_values = array();
// for ($i=0; $i < $length; $i++) {
//   $v = $i.'value';
//   $value = $_POST[$v];
//   array_push($all_values, $value);
// }

for ($i=0; $i < $data->length; $i++) {
  $v = $i.'value';
  $value = $data->$v;
  array_push($all_values, $value);
}

// echo "$data->length \n";

// return;

if($length == 1){
  // $name = $data->name;
  $string_kml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<kml xmlns=\"http://www.opengis.net/kml/2.2\">
    <Document>
      <name>ctis_isc_polygon.kml</name>
      <Style id=\"thickLine\"><LineStyle><width>2.5</width></LineStyle></Style>
<Style id=\"transparent50Poly\"><PolyStyle><color>7fffffff</color></PolyStyle></Style>
      <Placemark>
        <name>hollow polygon 0 </name>
        <ExtendedData>
          <Data name=\"$name\">
            <value>$all_values[0]</value>
          </Data>
        </ExtendedData>
        <Polygon>
          <outerBoundaryIs>
            <LinearRing>
              <coordinates>
                $all_poly[0]
              </coordinates>
            </LinearRing>
          </outerBoundaryIs>
        </Polygon>
        <styleUrl>#transparent50Poly</styleUrl>
      </Placemark>
    </Document>
  </kml>";
}
else{ //multiple tags/polygons
  $string_kml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
  <kml xmlns=\"http://www.opengis.net/kml/2.2\">
    <Document>
      <name>ctis_isc_polygon.kml</name>
      <Style id=\"thickLine\"><LineStyle><width>2.5</width></LineStyle></Style>
<Style id=\"transparent50Poly\"><PolyStyle><color>7fffffff</color></PolyStyle></Style>";
  for ($i=0; $i < $data->length; $i++) {
  // for ($i=0; $i < $length; $i++) {        
    $name = $data->name;
    $string_kml .= "

    <Placemark>
      <name>hollow polygon $i </name>
      <ExtendedData>
        <Data name=\"$name\">
          <value>$all_values[$i]</value>
        </Data>
      </ExtendedData>
      <Polygon>
        <outerBoundaryIs>
          <LinearRing>
            <coordinates>
              $all_poly[$i]
            </coordinates>
          </LinearRing>
        </outerBoundaryIs>
      </Polygon>
      <styleUrl>#transparent50Poly</styleUrl>
    </Placemark>
    ";
  }
$string_kml .= "
  </Document>
</kml>";
}

$filename = "./ctis_isc_polygon.kml";
$file = fopen( "$filename", "w+" );

if( $file == false ) {
  echo ( "Error opening file first" );
  exit();
}

if(filesize($filename) == 0){
  fwrite($file,  $string_kml);
}
else{
  fclose( $file );
  unlink($filename);
  $filename = "./ctis_isc_polygon.kml";
  $file = fopen( $filename, "w+" );
  fwrite($file,  $string_kml);
}
fclose( $file );

?>
