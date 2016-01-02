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
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) THEN 1 ELSE 0 END) AS PO_SITE,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_cons_jatim)='drop' or lower(status_cons_jatim)='cancel') THEN 1 ELSE 0 END) AS DROP_DATA,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_cons_jatim)='hold') THEN 1 ELSE 0 END) AS HOLD,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_cons_jatim)='survey') THEN 1 ELSE 0 END) AS survey,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_cons_jatim)='on air') THEN 1 ELSE 0 END) AS OA,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_lme)='ok') THEN 1 ELSE 0 END) AS LME,
SUM(CASE WHEN (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_cons_jatim)='installed') THEN 1 ELSE 0 END) AS INSTALLED
FROM REPORT_DATA_DEMAND
GROUP BY WITEL");
ociexecute($sql);
$po = 0;
$drop = 0;
$hold=0;
$survey = 0;
$lme = 0;
$installation = 0;
$oa = 0;
?>
  <div class="container">
  <div class="row">
  <div class='col-sm-6'>
  <h3><strong>PROGRESS DEPLOYMENT</strong></h3>
  </div>
  <div class='col-sm-6'>
  <p align="right"><img src="img/logopoi1.png" width="200"></p>
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
    <td rowspan="2" colspan="1" align="center" width="5%"><br /><strong>NO</strong></td>
    <td rowspan="2" colspan="1" align="center"><br /><strong>WITEL</strong></td>
    <td rowspan="2" colspan="1" align="center"><br /><strong>PO</strong></td>
    <td rowspan="2" colspan="1" align="center"><br /><strong>DROP</strong></td>
    <td rowspan="2" colspan="1" align="center"><br /><strong>HOLD</strong></td>
    <td rowspan="2" colspan="1" align="center"><br /><strong>SURVEY</strong></td>
    <td rowspan="1" colspan="2" align="center" width="16%"><br /><strong>INSTALATION</strong></td>
    <td rowspan="2" colspan="1" align="center" width="16%"><br /><strong>ON AIR</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>LME*</strong></td>
    <td align="center"><strong>AP</strong></td>
  </tr>
  </thead> 
  <tbody>
  <?php $no=1; while($row = oci_fetch_array($sql)) { ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $row[0]; ?></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=po&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[1]; ?></a></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=drop&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[2]; ?></a></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=hold&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[3]; ?></a></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=survey&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[4]; ?></a></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=lme&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[6]; ?></a></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=installed&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[7]; ?></a></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=oa&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[5]; ?></a></td>
  </tr>
  <?php 
    $no++;
    $po=$po+$row[1];
    $drop = $drop+$row[2];
    $hold = $hold+$row[3];
    $survey = $survey+$row[4];
    $oa = $oa+$row[5];
    $lme = $lme + $row[6];
    $installation = $installation + $row[7];
  } 
  ?>
  </tbody>
  <tfoot>
  <tr>
    <td colspan="2"><strong>TOTAL REGIONAL V</strong></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=po&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $po ?></strong></a></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=drop&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $drop ?></strong></a></td> 
    <td align="center"><a href="detil.progress.deployment.php?jenis=hold&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $hold ?></strong></a></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=survey&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $survey ?></strong></a></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=lme&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $lme ?></strong></a></td> 
    <td align="center"><a href="detil.progress.deployment.php?jenis=installed&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $installation ?></strong></a></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=oa&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $oa ?></strong></a></td> 
  </tr>
  </tfoot>
  </table> 
  </div>
  </div> 
  </div>
  </div>
</form>
      <h5 style="text-align:left"><strong>KETERANGAN :</strong></h5>
      <h5 style="text-align:left"><strong>LME : ONT TERPASANG</strong></h5>
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