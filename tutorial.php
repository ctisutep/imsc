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
    <title>TX-ISC - Tutorial</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
    <!--    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/css-toggle-switch/latest/toggle-switch.css" />-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>

    </style>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="row">
        <h3 class="text-center" style="padding-left: 95px; color: #FF8000">TxDOT Interactive Soil Characterization
            <img style="float:right" src="./img/ctis_transparent_white_2017.png" height="50" width="50">
            <img style="float:right" src="./img/txdotnewlogo.png" height="50" width="50">
        </h3>
    </div>
    <h6 class="hidden-xs text-center"><i style="color: white;">"</i><strong><i style="color:#FF8000;" class="text-center">CTIS </i></strong><i class="text-center" style="color:white;">is designated as a Member of National, Regional, and Tier 1 University Transportation Center."</i></h6>
    <p class="hidden-xs text-right" style="color: white"> Version 1.4.2 (05/16/2018)</p>
    <!--<p class="hidden-md hidden-lg text-center" style="color: white"> Version 4 (9/27/2017)</p> -->
</nav><br><br>

<div class="container panel panel-default">
    <video class="center-block text-center" width="900" controls>
        <source src="./video/isc.mp4" type="video/mp4">
    </video>
    <br><br>
    <div class="row">
        <div class="col">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Video Time Codes
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <ul> Skip to these times to watch an specific topic covered by the video tutorial.</ul>
                            <ul><b>00:00 - </b> Start </ul>
                            <ul><b>00:07 - </b> Explanation for Corridor, Planning Block, Performance Measure dropdown boxes. </ul>
                            <ul><b>01:00 - </b> Display Tool (Municipalities, Sections, Boundary dropdown boxes inside the Display tab). </ul>
                            <ul><b>02:40 - </b> Explanation for Summary, Corridor Level Analysis, Section Level Analysis </ul>
                            <ul><b>03:14 - </b> Timeline Tool </ul>
                            <ul><b>04:00 - </b> Filter Tool </ul>
                            <ul><b>05:00 - </b> AOI Tool </ul>
                            <ul><b>05:40 - </b> Print Utility </ul>
                            <ul><b>06:20 - </b> Multiple Performance Measures </ul>
                            <ul><b>07:40 - </b> Finish </ul>
                            <ul><b></b></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--    <div class="text-right" id="about">-->
<!--        <h4>-->
<!--            <a href="./index2.php">Back to TX-ISC</a>-->
<!--        </h4>-->
<!--    </div>-->
<!--    -->
<!--    <div id="aboutmodal" class="modal fade" tabindex="-1" role="dialog">-->
<!--        <div class="modal-dialog" role="document">-->
<!--            <div class="modal-content">-->
<!--                <div class="modal-header">-->
<!--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
<!--                    <h4></h4>-->
<!--                </div>-->
<!--                <div class="modal-header">-->
<!--                    <p></p>-->
<!--                    <p></p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script>
    $(document).ready(function() {
        $('.collapse').collapse();
        $('#myModal').modal({
            keyboard: true
        })
    });
</script>
</body>
</html>
