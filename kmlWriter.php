<?php
$length = $_POST['length'];

$string_kml = "";
$all_poly = array();
for ($i=0; $i < $length; $i++) {
  array_push($all_poly, $_POST[$i]);
}

if($length == 1){
  $string_kml = "
  <kml>
    <Document>
      <name>ctis_isc_polygon.kml</name>
      <open>0</open>
      <Placemark>
        <name>hollow polygon 0 </name>
        <Polygon>
          <extrude>1</extrude>
          <altitudeMode>relativeToGround</altitudeMode>
          <outerBoundaryIs>
            <LinearRing>
              <coordinates>
                $all_poly[0]
              </coordinates>
            </LinearRing>
          </outerBoundaryIs>
        </Polygon>
      </Placemark>
    </Document>
  </kml>";
}
else{ //multiple tags/polygons
  $string_kml = "
  <kml>
    <Document>
      <name>ctis_isc_polygon.kml</name>
        <open>0</open>";
  for ($i=0; $i < $length; $i++) {
    $string_kml .= "

    <Placemark>
      <name>hollow polygon $i </name>
      <Polygon>
        <extrude>1</extrude>
        <altitudeMode>relativeToGround</altitudeMode>
        <outerBoundaryIs>
          <LinearRing>
            <coordinates>
              $all_poly[$i]
            </coordinates>
          </LinearRing>
        </outerBoundaryIs>
      </Polygon>
    </Placemark>
    ";
  }
$string_kml .= "
  </Document>
</kml>";
}

$filename = "ctis_isc_polygon.kml";
$file = fopen( $filename, "a+" );

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
  $filename = "ctis_isc_polygon.kml";
  $file = fopen( $filename, "a+" );
  fwrite($file,  $string_kml);
}
fclose( $file );
?>
