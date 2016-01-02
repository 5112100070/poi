<?php 
session_start();
if(empty($_SESSION['privilege']))
{
  echo "<script language=javascript>
              parent.location.href='login.php';
        </script>";
}

function CekPlan($data,$data2){
        if($data==$data2){
            echo "selected";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="fav.ico" type="image/png">
    <title>DASHBOARD SITAC POI TELKOMSEL</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
    <style>
    body{padding-top:75px}
    footer{
      margin:5em 0
      }
    footer li{
      float:left;
      margin-right:1.5em;
      margin-bottom:1.5em
      }
    footer p{
      clear:left;
      margin-bottom:0
      }
    </style>
  </head>
  <body>
    <?php
        include "mod/nav.php"; 
        include "config/connect.php";
        $sql = "SELECT LONGITUDE,LATITUDE FROM REPORT_DATA_DEMAND WHERE ID='".$_GET['site_id']."'";
        $sql_parse=ociparse($connect, $sql);
        ociexecute($sql_parse);
        $row=  oci_fetch_array($sql_parse);
    ?>
    <div class="container" style="width: 1500px">
      <div class="row">
        <div class='col-sm-6'>
            <h3><strong>MAP BRIEFING SIMONTOR</strong></h3>
            <a onclick="window.history.back()" class="btn btn-default" 
                style="display: <?php 
                     if($_GET['witel']=="NULL" && $_GET['jenis']=="NULL")echo "none";
                     else echo 'display';
                     ?>"><h5>KEMBALI KE EDIT DATA</h5></a>
        </div>
        <div class='col-sm-6'>
            <p align="right"><img src="img/logopoi1.png" width="350"></p>
        </div>
      </div>
        <div class="panel panel-default" style="margin: 0 0 -80px 0;">
            <div class="panel-body"> 
                <h4><strong>LOCATION DETAIL</strong></h4>
                <div class="col-sm-12">
                    <div id="map_sitac" style="width:100%;height:520px;"></div>
                </div>
            </div>
      </div>
      <?php include "mod/footer.php"; ?>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/moment-with-locales.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script src="js/simontor.js"></script>
    <script src="js/map.simontor.js"></script>
    <script>
        <?php include './func/conf.standar.map.php'; ?>
        google.maps.event.addDomListener(window,'load',initialize_map_sitac(latitude,longitude));
    </script>
  </body>
</html>