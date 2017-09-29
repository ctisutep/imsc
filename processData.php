<?php
session_start();
if(!isset($_SESSION['in']) OR !$_SESSION['in']){
  header('Location: login.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>OT-Reduction Worksheet</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/logo-nav.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/custom.css" rel="stylesheet">

  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->


</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
          <!-- <img src="http://placehold.it/150x50&text=Logo" alt=""> -->
        </a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <a target="_blank" href="http://ctis.utep.edu">
          <img src="img/ctis_transparent_white_2017.png" style="height: max-width: 75px; max-height: 75px; margin-top: 3px;" align="right"> </img>
        </a>
        <a target="_blank" href="http://txdot.gov">
          <img src="img/txdotnewlogo.png" style="height: max-width: 75px; max-height: 75px; margin-top: 3px;" align="right"> </img>
        </a>
        <ul class="nav navbar-nav">
          <li>
            <a href="processData.php" style=" font-size: 16px; font-weight: bold;">Overlay Tester Analysis Tool v1.3 (09/11/17)</a> <!-- <a style="padding-top: 0px; padding-bottom: 0px;"> V1.0 </a> -->
            <!-- <a> hey </a> -->
            <!-- note: version 1.2 as of Wednesday, June 7th  -->
          </li>


          <!--
          <li>
          <a href="#">Services</a>
        </li>xaxes: [{
        font:{
        size:22,
        weight:"bold",
        color: 'black'
      }
    }],
    <li>
    <a href="#">Contact</a>
  </li> -->
</ul>
</div>
<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>
<!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-3">
      <div class="panel panel-primary">
        <div class="panel-heading">Input</div>
        <div class="panel-body">
          <form autocomplete="off" id="otForm" enctype="multipart/form-data" action="uploadHandler.php" method="POST">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="txdotuse" id="txdotuse" value="txdotuse" checked>
                <input type="text" name="txdotuse2" id="txdotuse2" value="checked" hidden>
                For TXDOT use only
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="false" name="cache" id="LIMScheck">
                Retrieve existing data from LIMS
              </label>
            </div>
            <label>OT Device</label>
            <select class="form-control" type="text" id="device" name="device" required autofocus>
              <option>AMPT</option>
              <option>Cooper</option>
              <option>Shedworks</option>
            </select>

            <label>Number of Replicates</label>
            <select class="form-control" type="text" id="numofspec" name="numofspec" required>
              <option>1</option>
              <!-- <option>2</option> -->
            </select>

            <label>TOP LVDT (Log File)</label>
            <select class="form-control" type="text" id="toplvdt" name="toplvdt" required>
              <option>Yes</option>
              <option selected>No</option>
            </select>

            <label>Specimen Thickness</label>
            <input class="form-control" type="number" step="0.01" id="specthickness" name="specthickness" placeholder="1.5" value="1.5" required>

            <label>Specimen Width</label>
            <input class="form-control" type="number" step="0.01" id="specwidth" name="specwidth" placeholder="3" value="3" required>

            <label>Mix Type</label>
            <input class="form-control" type="text" id="mixType" name="mixType" required>

            <label>Site Manager ID</label>
            <input class="form-control" type="text" id="smgr_id" name="smgr_id" required>

            <label>LIMS</label>
            <input class="form-control" type="text" id="LIMS" name="LIMS" required>

            <label>Aggregate Description</label>
            <input class="form-control" type="text" id="description" name="description" required>

            <label>Asphalt Grade</label>
            <input class="form-control" type="text" id="asphalt_grade" name="asphalt_grade" required>

            <label>Asphalt Source</label>
            <input class="form-control" type="text" id="asphalt_source" name="asphalt_source" required>

            <label>Asphalt Content</label>
            <input class="form-control" type="number" step="0.01" id="asphaltcontent" name="asphaltcontent" placeholder="Leave empty if unknown or not applicable">

            <label>% RAP</label>
            <input class="form-control" type="number" step="0.01" id="rappercent" name="rappercent" placeholder="Leave empty if unknown or not applicable">

            <label>% RAS</label>
            <input class="form-control" type="number" step="0.01" id="raspercent" name="raspercent" placeholder="Leave empty if unknown or not applicable">

            <label>Operator</label>
            <input class="form-control" type="text" id="operator" name="operator" required>

            <label>Data Reduction Date</label>
            <input class="form-control" type="text" id="date" name="date" readonly>


            <hr style="border-color:#337ab7; border-width:1px; border-radius:25px;">

            <label>Source data</label>
            <input class="form-control-file" type="file" id="rawData" name="rawData[]" required multiple> <br>

            <label id="peaks_label">Peaks (CSV)</label>
            <input class="form-control" type="file" id="peaks" name="peaks" required multiple>

            <label id="logfile_label">Log File (LOG)</label>
            <input class="form-control" type="file" id="logfile" name="logfile[]" required multiple>

            <br><input class="btn btn-block btn-primary" type="submit" name="submit" id="submit">

          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-9">
      <div class="col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Overlay Test Results</h3>
          </div>
          <table id="results" class="table table-striped table-bordered">
            <thead>
              <th>#</th>
              <th>LIMS</th>
              <!-- <th>Case</th> -->
              <!-- <th>Specimen</th> -->
              <th>Max Load, lbs</th>
              <!-- <th>Fracture Area, lbs/in</th> -->
              <!--<th>Critical Fracture Energy</th> --> <th>Critical Fracture Energy, lbs in / in <sup>2</sup></th>
              <th>Crack Progression Rate</th>
              <!-- <th>R2</th> -->
              <th>Number of Cycles</th>
            </thead>
            <tbody>
              <?php
              if(false){
                for($i = 1; $i <= $k; $i++){

                  $warning = '';
                  if(round($r2[$i-1], 2) < 0.9){
                    $warning = '<span class="label label-warning">r<sup>2</sup> is less than 0.9</span>';
                  }

                  echo '<tr>
                  <td>'. $_SESSION['LIMS'] .'</td>
                  <td>'.ceil($maxLoadVals[$i-1]).'</td>
                  <td>'.round($fenergy[$i-1],2).'</td>
                  <td>'.round($coeff[$i-1],2).' '. $warning  .'</td>
                  <td>'.count($normLoads[$i-1]).'</td>
                  </tr>';

                  // echo '<tr>
                  //         <td>'.$i.'</td>
                  //         <td>1</td>
                  //         <td>'.round($maxLoadVals[$i-1],2).'</td>
                  //         <td>'.round($area[$i-1],2).'</td>
                  //         <td>'.round($fenergy[$i-1],2).'</td>
                  //         <td>'.round($coeff[$i-1],2).'</td>
                  //         <td>'.round($r2[$i-1], 2).'</td>
                  //         <td>'.count($normLoads[$i-1]).'</td>
                  //       </tr>';
                }
              }
              ?>
            </tbody>
          </table>
        </div>

      </div>
      <div class="col-lg-12">
        <div class="panel panel-primary" style="border: none; -webkit-box-shadow: none; box-shadow: none;">
          <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Charts</h3>
          </div>
          <div class="panel-body">
            <?php
            if(false){
              echo "<div>";
            }else{
              echo "<div id=\"start\" class='alert alert-info' role='alert'>
              Submit a form to see the results.
              </div>
              <div id=\"chart_area\">";
            }
            ?>
            <select autocomplete="off" class="form-control" id="table_select">
              <option value="#chart3">OT Interaction Plot</option> <!-- Cambio -->
              <option value="#chart">Crack Initiation</option>
              <option value="#chart2">Crack Propagation</option>
              <option value="#chart4">Top LVDT</option>
            </select><br><br>
            <!-- Performance -->
            <div id="chart3" style="height: 600px;">
              <!--<div id="chart3_prepend">hey</div> <br>-->
              <div class="col-md-11 col-md-offset-1">
              <!--  <div> <strong>Disclaimer:</strong> The Critical Fracture Energy (CFE) and the Crack Progression Rate (CPR) are the performance-based parameters from the overlay test that characterize the cracking susceptibility of asphalt mixtures.  Please utilize these parameters when characterizing the performance of asphalt mixtures and carrying out statistical calculations such as standard deviation and coefficient of variation. The Crack Resistance Index (CRI) is specified only for quality control and acceptance practices.  The CRI index is translated from the Crack Progression Rate.  The CRI shall not be used for statistical calculations. </div> <br> <br>-->
                <div id="chart3_content" style="height: 500px;"> </div> <br> <br> <br>
              </div>

              <div class="col-lg-8 col-lg-offset-2">
                <div class="progress">
                  <div class="progress-bar progress-bar-success progress-bar-striped" style="width: 50%">
                    <span class="sr-only">35% Complete (success)</span>
                  </div>
                  <div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 50%">
                    <span class="sr-only">10% Complete (danger)</span>
                  </div>
                  <!--<div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 33%">
                    <span class="sr-only">20% Complete (warning)</span>
                  </div>-->

                </div>
              </div>
              <div class="col-lg-8 col-lg-offset-3">
                <h4 style="display:inline-block;">Crack Resistant Mix</h4> <i class="fa fa-long-arrow-right fa-2x" style="display:inline-block;" aria-hidden="true"></i> <h4 style="display:inline-block;">Lower Quality Mix</h4>
              </div>

            </div>
            <!-- Crack Initiation -->
            <div id="chart" class="chart-area" style="height: 500px; width: 87%"></div>
            <!-- Crack Propagation -->
            <div id="chart2" class="chart-area" style="height: 500px; width: 87%"></div>
            <!-- Performance -->
            <div id="chart4" class="chart-area" style="height: 500px; width: 87%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!--flot -->
<script src="js/flot/jquery.flot.js"></script>

<!-- custom css for the form -->
<script>
$('#LIMScheck').on('change', function(){
  if($(this).is(':checked')){
    $(this).val(true);
    $('input').attr('disabled', "");
    $('#LIMS').attr('disabled', null);
    $('#LIMScheck').attr('disabled', null);
    $('#submit').attr('disabled', null);
    $('#specthickness').attr('disabled', null);
    $('#specwidth').attr('disabled', null);
  }
  else{
    $(this).val(false);
    $('input').attr('disabled', null);
  }
});
//global var for colors of lines
var colors =[['#000000','000000'], ['rgb(0, 148, 255)', 'rgb(130, 174, 255)'], ['#A1D490', '#B2E6A1'], ['#CD88E3', '#D599E8'], ['#DEA96D', '#FCD2A2'], ['#E83186', '#F071AC']];

$(document).ready(function(){
  var results_table_counter = 1;
  $('#chart_area').hide();
  $("#otForm").on("submit", function(e) {
    var data = new FormData($('form')[0]);
    //console.log(data);
    data.append('submit', true);
    e.preventDefault();
    $.ajax({
      url: $(this).attr("action"),
      type: 'POST',
      data: data,
      cache: false,
      contentType: false,
      processData: false,
    }).done(function(data){
      if(data.hasOwnProperty('error')){
        alert(data.error);
      }
      else{
        $('#chart').empty();
        $('#chart2').empty();
        $('#chart3_content').empty();
        $('#chart4').empty();
        $('#chart_area').show();
        $('#start').hide();
        for(var i = 0; i < data.repetitions; i++){
          $('#results').children('tbody').append('<tr>\
                                                  <td>'+ results_table_counter +'</td>\
                                                  <td>'+data.lims +'</td>\
                                                  <td>'+Math.ceil((data.maxLoadVals[i]*100)/100)+'</td>\
                                                  <td>'+Math.round(data.fenergy[i]*100)/100+'</td>\
                                                  <td>'+ ((data.coeff[i]*100)/100).toFixed(2) +'</td>\
                                                  <td>'+data.normLoads[i].length+'</td></tr>');
          results_table_counter++;
        }
        var norm = data.normLoads;
        var fenergy = data.fenergy[i];
        var coeff = data.coeff[i];
        //console.log(data);
        //format the data for plots
        var normLoad = $.map(norm, function(n,i){ //crack propagation
          var arr = [];
          arr.push({data: $.map(n, function(m, j){return [[j,m]]}), label: 'Raw Data #'+(i+1)}, {data: $.map(n, function(m, j){return [[j,Math.pow(j, -coeff)]]}), label: 'Calculated Load'});
          return arr;
        });
        //console.log(normLoad);
        //console.log(data);
        var firstAndSecond = [];
        for(var i = 0; i < data.firstCycle.length; i++){
          firstAndSecond.push({'data': data.firstCycle[i], 'label': "First Loop #" + (i+1), 'color':colors[i][0]}); // crack initiation
        }
        for(var i = 0; i < data.secondCycle.length; i++){
          firstAndSecond.push({'data': data.secondCycle[i], 'label': "Second Loop #" + (i+1), 'color':colors[i][1]}); // crack initiation
        }
        //console.log(firstAndSecond)
        var sp = [];
        //var tmparr1 = [];
        //var tmparr2 = [];
        /*
        for(var i = 0; i <= 0; i += 0.03){//i <= 1.5; no lineas negras
        tmparr1.push([i, 1]);
        tmparr2.push([i, 3]);
      }
      */
      //sp.push({'data':tmparr1, 'label':null, 'lines':{'show':true}, 'points':{'show':true, 'radius':1}, 'color':'rgba(0, 0, 0, 0.3)'});
      //sp.push({'data':tmparr2, 'label':null, 'lines':{'show':true}, 'points':{'show':true, 'radius':1}, 'color':'rgba(0, 0, 0, 0.3)'});
      var num_spe;
      for(var i = 0; i < data.repetitions; i++){
        sp.push({'data':[[((data.coeff[i])), data.fenergy[i]]], 'label': "Specimen #" + (i+1), 'color': 'black', 'points':{'show':true,'radius':8,'fillColor':colors[i][0],'symbol':'circle'}});
        num_spe = i+1;
      } //specimen fill color is hardcoded to 'black'
      //console.log(sp);
      if(data.hasOwnProperty('disptime')){
        var series = [];
        for(var i = 0; i < data.repetitions; i++){
          series.push({'data':data.disptime[i], 'color':colors[i][0], 'label':'Displacement #' + (i+1)});
        }
        //console.log(series);
        $.plot($("#chart4"), series, {
          yaxis:{tickDecimals:2},
          xaxes: [{
            max: 100,
            min: 0,
            font:{
              size:22,
              weight:"bold",
              color: 'black',
            }
          }],
          yaxes: [{
            font:{
              size:22,
              weight:"bold",
              color: 'black',
            }
          }],
          /*
          yaxes: [{
          max: 0.01,
          min: -0.01
        }],
        */
        legend: {
          position: 'se',
        },
        grid: {
          hoverable: true //IMPORTANT! this is needed for tooltip to work
        },
        tooltip: true
      });
    }
    //plot the charts
    //console.log($('#chart2'));
    $.plot('#chart2', normLoad, {
      yaxis: { min:0, max:1.0 },
      yaxes: [{
        font:{
          size:22,
          weight:"bold",
          color: 'black'
        }
      }],
      xaxes: [{
        max: 300,
        min: 0,
        font:{
          size:22,
          weight:"bold",
          color: 'black'
        }
      }]
    });
    var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Number of Cycles").appendTo($('#chart2'));
    var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Normalized Load").appendTo($('#chart2'));
    $.plot('#chart', firstAndSecond, {
      xaxis: { min:0, max:0.03 },
      xaxes: [{
        font:{
          size:22,
          weight:"bold",
          color: 'black'
        }
      }],
      yaxes: [{
        font:{
          size:22,
          weight:"bold",
          color: 'black'
        }
      }],
      legend: {
        position: 'se'
      }
    });
    var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Displacement, in.").appendTo($('#chart')); //more space between this and graph, use css
    var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Load (lbs)").appendTo($('#chart'));
    //console.log("test")
    /*console.log(sp);
    console.log(sp[0]['data']);
    console.log(sp[0]['data'][0]);
    console.log(sp[0]['points']['fillColor']);
    console.log(((sp[0]['data'][0][0]-133.33)/-133.33));*/
    //var plot = $.plot('#chart3_content', sp, {
    var plot = $.plot('#chart3_content',
     [
       {
        data: sp[0]['data'],
        label: "Specimen #" + num_spe,
        color: 'black',
        points: {show: true, radius: 8, fillColor: sp[0]['points']['fillColor'], symbol: 'circle'},
        xaxis: 1
      },
      {
        /*sp[0]['data'][0][0] = ((sp[0]['data'][0][0]-133.33)/-133.33)*/
        data: sp[0]['data'],
        /*label: "Color of Specimen",*/
        color: 'black',
        points: {show: false, radius: 8, fillColor: sp[0]['points']['fillColor'], symbol: 'circle'},
        xaxis: 1
      }
     ], {
      xaxes: [
        /*{
          position: "top",
          max: 100,
          min: 0,
          font:{ size:22, weight:"bold", color: 'black'}
        },*/{
          /*inverseTransform: function (v) { return -v; },*/
          position: "bottom",
          tickColor: '#000000',
          tickLength: 12,
          max: 1,
          min: 0,
          /*transform: function (v) { return -v; },
          inverseTransform: function (v) { return -v; },*/
          /*ticks: [1, 0],
          /*transform: function (v) { return Math.log(v); },*/
          /*inverseTransform: function (v) { return Math.exp(v); },*/
          /*inverseTransform: function (v) { return -v; },*/
          /*inverse: true,*/
          font:{ size:22, weight:"bold", color: 'black'}
        }
      ],
      yaxes: [{
        min: 0,
        max: 6,
        tickDecimals: 0,
        font:{
          size:22,
          weight:"bold",
          color: 'black'
        }
      }],
      grid: {
        markingsStyle: 'dashed',
        markings: [
          {xaxis: {from:  0, to: 0.5}, color: "rgb(104, 185, 67)", lineWidth: 2},//green
          //{xaxis: {from:  30, to: 70}, color: "rgb(233, 222, 66)", lineWidth: 2},//yellow
          {xaxis: {from:  0.5, to: 1}, color: "rgb(199, 96, 86)", lineWidth: 2},//red
          {xaxis: {from:  0.5, to: 0.5}, color: "red", lineWidth: 5},//vertical line
          {xaxis: {from: 0, to: 100}, yaxis: {from: 1, to: 1}, color: "black", lineWidth: 2},
          {xaxis: {from: 0, to: 100}, yaxis: {from: 3, to: 3}, color: "black", lineWidth: 2}
        ],
        /*markingsStyle: 'solid',
        markings: [
        {xaxis: {from: 0, to: 100}, yaxis: {from: 1, to: 1}, color: "black", lineWidth: 5}
      ]*/
    }
  });
//var xaxisLabel = $("<div class='axisLabel xaxisLabel' style='font-weight:bold;'></div>").text("Crack Resistance Index").appendTo($('#chart3_content'));
/*var xaxisRange = $("<div class='axisLabel xaxisOldRange' style='font-weight:bold;'></div>").text("0.25\t0.333\t0.416\t0.499\t0.5832\t0.6665\t0.7498\t0.833\t0.9164\t1").appendTo($('#chart3_content')); //not acceptable*/
var xaxisBottom = $("<div class='axisLabel xaxisBottom' style='font-weight:bold;'></div>").text("Crack Progression Rate").appendTo($('#chart3_content'));
var yaxisLabel = $("<div class='axisLabel yaxisLabel' style='font-weight:bold;'></div>").html("Critical Fracture Energy, lbs*in/in  <sup>2</sup> ").appendTo($('#chart3_content'));
}
});
});
// input - form handling
$('#logfile').attr('required', false);
$('#logfile_label').hide();
$('#logfile').hide();

$('#peaks').attr('required', false);
$('#peaks_label').hide();
$('#peaks').hide();

$('#date').val(Date());
$('#device').change(function(){
  temp = $('#device').val();
  if(temp == 'AMPT'){
    $('#logfile').attr('required', false);
    $('#logfile_label').hide();
    $('#logfile').hide();

    $('#peaks').attr('required', false);
    $('#peaks_label').hide();
    $('#peaks').hide();
  }else if(temp == 'Cooper'){

    $('#toplvdt').val('Yes');

    $('#logfile').attr('required', true);
    $('#logfile_label').show();
    $('#logfile').show();

    $('#peaks').attr('required', false);
    $('#peaks_label').hide();
    $('#peaks').hide();
  }else{ //Shedworks
    // Overlay Top LVDT (LOG)
    if($('#toplvdt').val() == 'Yes'){
      $('#logfile').attr('required', true);
      $('#logfile_label').show();
      $('#logfile').show();
    }
    // Overlay Data Peaks File (CSV)
    $('#peaks').attr('required', true);
    $('#peaks_label').show();
    $('#peaks').show();
  }
});
$('#toplvdt').change(function(){
  temp = $('#toplvdt').val();
  if(temp == 'No'){
    $('#logfile').attr('required', false);
    $('#logfile_label').hide();
    $('#logfile').hide();
  }else if($('#device').val() != 'AMPT'){ //Shedworks
    // Overlay Top LVDT (LOG)
    $('#logfile').attr('required', true);
    $('#logfile_label').show();
    $('#logfile').show();
  }
});
//var myCanvas = plot.getCanvas();
//var image = myCanvas.toDataURL();
//image = image.replace("image/png","image/octet-stream");
//document.location.href=image;


$('#chart').hide();
$('#chart2').hide();
$('#chart4').hide();
$('#table_select').on('change', function(){
  $('#chart').hide();
  $('#chart2').hide();
  $('#chart3').hide();
  $('#chart4').hide();

  $($('#table_select').val()).fadeIn();
});


$('#txdotuse').change(function(data){
  if($('#txdotuse').is(":checked") == false){
    $('#txdotuse2').val("notchecked");
    $('#smgr_id').attr('disabled', true);
    $('#smgr_id').attr('required', false);

    $('#LIMS').attr('disabled', true);
    $('#LIMS').attr('required', false);

    $('#LIMScheck').attr('disabled', true);
  }else{
    $('#txdotuse2').val("checked");
    $('#smgr_id').attr('disabled', false);
    $('#smgr_id').attr('required', true);

    $('#LIMS').attr('disabled', false);
    $('#LIMS').attr('required', true);

    $('#LIMScheck').attr('disabled', false);
  }

});

});
</script>

</body>
</html>
