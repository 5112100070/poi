<?php 
session_start();
if(empty($_SESSION['privilege']))
{
  echo "<script language=javascript>
              parent.location.href='login.php';
        </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="fav.ico" type="image/png">
    <title>PROGRESS DEPLOYMENT</title>
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
    ?>
<form name="form1" method="POST">  
<?php 
$sql = OCIParse($connect, "SELECT WITEL,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') AND MITRA_AP IS NOT NULL THEN 1 ELSE 0 END) AS LOP_SITE,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') AND MITRA_AP IS NOT NULL THEN TOTAL_AP ELSE 0 END) AS LOP_AP,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') AND MITRA_AP IS NOT NULL AND lower(status_cons_jatim)='on air' or lower(status_cons_jatim)='oa existing' THEN 1 ELSE 0 END) AS ON_AIR,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') AND MITRA_AP IS NOT NULL AND lower(status_cons_jatim)='on air' or lower(status_cons_jatim)='oa existing' THEN TOTAL_AP ELSE 0 END) AS ON_AIR_AP,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') AND MITRA_AP IS NOT NULL AND lower(status_cons_jatim)='install ap' or lower(status_cons_jatim)='installed' THEN 1 ELSE 0 END) AS NOT_ON_AIR,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') AND MITRA_AP IS NOT NULL AND lower(status_cons_jatim)='install ap' or lower(status_cons_jatim)='installed' THEN TOTAL_AP ELSE 0 END) AS NOT_ON_AIR_AP,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') AND MITRA_AP IS NOT NULL AND lower(status_cons_jatim)='cancel' THEN 1 ELSE 0 END) AS DROP_,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') AND MITRA_AP IS NOT NULL AND lower(status_cons_jatim)='cancel' THEN TOTAL_AP ELSE 0 END) AS DROP_AP,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') AND MITRA_AP IS NOT NULL AND lower(status_cons_jatim)='hold' THEN 1 ELSE 0 END) AS HOLD,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') AND MITRA_AP IS NOT NULL AND lower(status_cons_jatim)='hold' THEN TOTAL_AP ELSE 0 END) AS HOLD_AP,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') AND MITRA_AP IS NOT NULL AND lower(status_cons_jatim)='proses' THEN 1 ELSE 0 END) AS PROSES,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') AND MITRA_AP IS NOT NULL AND lower(status_cons_jatim)='proses' THEN TOTAL_AP ELSE 0 END) AS PROSES_AP
FROM REPORT_DATA_DEMAND
GROUP BY WITEL");
ociexecute($sql);
$LOP_SITE = 0;
$LOP_AP = 0;
$OA_SITE = 0;
$OA_AP = 0;
$NOA_SITE = 0;
$NOA_AP = 0;
$DROP_SITE = 0;
$DROP_AP = 0;
$HOLD_SITE = 0;
$HOLD_AP = 0;
$PROSES_SITE = 0;
$PROSES_AP = 0;
?>
  <div class="container">
  <div class="row">
  <div class='col-sm-6'>
  <h3><strong>PROGRESS DEPLOYMENT</strong></h3>
  </div>
  <div class='col-sm-6'>
  <p align="right"><img src="img/logo.png" width="200"></p>
  </div>
  </div>
  <br />
  <div class="panel panel-default">
  <div class="panel-body">
<div class="row">
<div class="col-md-12">

  <table class="table table-bordered">
  <thead bgcolor="#E12E32" style="color:#FFFFFF">
  <tr>
    <td rowspan="3" align="center" width="5%"><br /><br /><strong>NO</strong></td>
    <td rowspan="3" colspan="2" align="center"><br /><br /><strong>WITEL</strong></td>
    <td rowspan="2" colspan="2" align="center"><br /><strong>LOP</strong></td>
    <td rowspan="1" colspan="4" align="center" width="16%"><br /><strong>INSTALASI</strong></td>
    <td rowspan="2" colspan="2" align="center" width="16%"><br /><strong>DROP<br></strong></td>
    <td rowspan="2" colspan="2" align="center" width="16%"><br /><strong>HOLD</strong></td>
    <td rowspan="2" colspan="2" align="center" width="16%"><br /><strong>PROSES</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><strong>ON AIR</strong></td>
    <td align="center" colspan="2"><strong>NOT OA</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>SITE</strong></td>
    <td align="center"><strong>AP</strong></td>
    <td align="center"><strong>SITE</strong></td>
    <td align="center"><strong>AP</strong></td>
    <td align="center"><strong>SITE</strong></td>
    <td align="center"><strong>AP</strong></td>
    <td align="center"><strong>SITE</strong></td>
    <td align="center"><strong>AP</strong></td>
    <td align="center"><strong>SITE</strong></td>
    <td align="center"><strong>AP</strong></td>
    <td align="center"><strong>SITE</strong></td>
    <td align="center"><strong>AP</strong></td>
  </tr>
  </thead> 
  <tbody>
  <?php $no=1; while($row = oci_fetch_array($sql)) { ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td colspan="2"><?php echo $row[0]; ?></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=lop&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[1]; ?></a></td>
    <td align="center"><?php echo $row[2]; ?></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=oa&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[3]; ?></a></td>
    <td align="center"><?php echo $row[4]; ?></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=noa&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[5]; ?></a></td>
    <td align="center"><?php echo $row[6]; ?></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=drop&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[7]; ?></a></td>
    <td align="center"><?php echo $row[8]; ?></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=hold&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[9]; ?></td>
    <td align="center"><?php echo $row[10]; ?></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=proses&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[11]; ?></a></td>
    <td align="center"><?php echo $row[12]; ?></td>
  </tr>
  <?php 
    $no++;
    $LOP_SITE=$LOP_SITE+$row[1];
    $LOP_AP = $LOP_AP+$row[2];
    $OA_SITE = $OA_SITE+$row[3];
    $OA_AP = $OA_AP+$row[4];
    $NOA_SITE = $NOA_SITE+$row[5];
    $NOA_AP = $NOA_AP+$row[6];
    $DROP_SITE = $DROP_SITE+$row[7];
    $DROP_AP = $DROP_AP+$row[8];
    $HOLD_SITE = $HOLD_SITE+$row[9];
    $HOLD_AP = $HOLD_AP+$row[10];
    $PROSES_SITE = $PROSES_SITE+$row[11];
    $PROSES_AP = $PROSES_AP+$row[12];
  } 
  ?>
  </tbody>
  <tfoot>
  <tr>
    <td colspan="3"><strong>TOTAL REGIONAL V</strong></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=lop&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $LOP_SITE ?></strong></a></td>
    <td align="center"><strong><?php echo $LOP_AP ?></strong></td> 
    <td align="center"><a href="detil.progress.deployment.php?jenis=oa&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $OA_SITE ?></strong></a></td>
    <td align="center"><strong><?php echo $OA_AP ?></strong></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=noa&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $NOA_SITE ?></strong></a></td>
    <td align="center"><strong><?php echo $NOA_AP ?></strong></td> 
    <td align="center"><a href="detil.progress.deployment.php?jenis=drop&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $DROP_SITE ?></strong></a></td>
    <td align="center"><strong><?php echo $DROP_AP ?></strong></td>   
    <td align="center"><a href="detil.progress.deployment.php?jenis=hold&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $HOLD_SITE ?></strong></a></td>
    <td align="center"><strong><?php echo $HOLD_AP ?></strong></td> 
    <td align="center"><a href="detil.progress.deployment.php?jenis=proses&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $PROSES_SITE ?></strong></a></td>
    <td align="center"><strong><?php echo $PROSES_AP ?></strong></td>   
  </tr>
  </tfoot>
  </table> 
  </div>
  </div> 
  </div>
  </div>
</form>
<?php include "mod/footer.php"; ?>

  </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
           
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({locale: 'id', format: 'DD/MM/YYYY'});
                $('#datetimepicker2').datetimepicker({locale: 'id', format: 'DD/MM/YYYY'});
                $('#datetimepicker1').on("dp.change", function (e) {
                $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
                });
                $('#datetimepicker2').on("dp.change", function (e) {
                $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
                });
            });
        </script>    

  </body>
</html>