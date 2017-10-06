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
$filename = "php_example.kml";
$file = fopen( $filename, "a+" );

if( $file == false ) {
  echo ( "Error in opening file first" );
  exit();
}
if(filesize($filename)>0){ //
  $filesize = filesize( $filename );
  $filetext = fread( $file, $filesize );
  //fwrite( $file, "\n This is a sample test \n" );
}
else{
  fwrite($file,  $string_kml);
  fclose($file);
  $filename = "php_example.kml";
  $file = fopen( $filename, "a+" );
  $filesize = filesize( $filename );
}

fclose( $file );
unlink($filename);
?>
