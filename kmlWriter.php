<?php
//$prop = $_GET['0'];
//$prop2 = $_GET['1'];
$length = $_GET['length'];
//echo $length;

$string_kml = "";
$all_poly = array();
for ($i=0; $i < $length; $i++) { //array_push($values, $placeholder); values es array
  array_push($all_poly, $_GET[$i]);
}
//var_dump($all_poly);
if($length == 1){
  $string_kml = "
  <kml>
    <Document>
      <name>Polygon.kml</name>
      <open>0</open>
      <Placemark>
        <name>hollow box 1 </name>
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
      <name>Polygon.kml</name>
        <open>0</open>";
  for ($i=0; $i < $length; $i++) {
    $string_kml .= "

    <Placemark>
      <name>hollow box $i </name>
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

  //echo ( "File size : $filesize bytes" );
  //echo ( "<pre>$filetext</pre>" );
  fwrite( $file, "\n This is a sample test \n" );
}
else{
  fwrite($file,  $string_kml);
  fclose($file);
  $filename = "php_example.kml";
  $file = fopen( $filename, "a+" );
  $filesize = filesize( $filename );
}

fclose( $file );
//unlink($filename);

//echo $string_kml;
//echo "<kml><coords>3.1516, 16545.111, 0</coords></kml>";
?>
