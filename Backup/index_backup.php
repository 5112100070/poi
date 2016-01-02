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
    ?>
<form name="form1" method="POST">  
<?php 
$sql = OCIParse($connect, "select witel,
sum(case when lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' then 1 else 0 end) as potensi,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(status_data)='rejected' then 1 else 0 end) as rejected,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(status_data) not in ('rejected') then 1 else 0 end) as new_potensi,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(kunjungan)='ok' then 1 else 0 end) as OK,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(kunjungan)='gagal' then 1 else 0 end) as GAGAL,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(kunjungan)='pending' then 1 else 0 end) as pending,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(status_sitac)='ok' then 1 else 0 end) as sitac_ws
from report_data_demand
group by witel");
//ociexecute($sql);
$jum_potensi = 0;
$jum_rejected = 0;
$jum_newpotensi = 0;
$jum_sitakws = 0;
$jum_ok = 0;
$jum_gagal = 0;
$jum_pending = 0;
$jum_total = 0;
?>
  <div class="container">
  <div class="row">
  <div class='col-sm-6'>
  <h3><strong>SITAC - SITE ACQUISITION</strong></h3>
  </div>
  <div class='col-sm-6'>
  <p align="right"><img src="img/logopoi1.png" width="350"></p>
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
    <td rowspan="3" align="center"><br /><strong>NO</strong></td>
    <td rowspan="3" align="center"><br /><strong>WITEL</strong></td>
    <!--<td rowspan="3" colspan="1" align="center" width="16%"><br /><strong>POTENSI</strong></td>
    <td rowspan="3" colspan="1" align="center" width="16%"><br /><strong>REJECTED<br></strong></td>-->
    <td rowspan="3" colspan="1" align="center" width="10%"><strong>NEW<br>POTENSI</strong></td>
    <td rowspan="1" colspan="2" align="center" width="22%"><strong>KUNJUNGAN</strong></td>
    <td rowspan="3" colspan="1" align="center" width="16%"><strong>SITAC<br>WS</strong></td>
  </tr>
  <tr>
        <td align="center"><strong>Hari ini<br><?php echo date("d-M-y"); ?></strong></td>
        <td align="center"><strong><br>s/d hari ini</strong></td>
  </tr>
  </thead> 
  <tbody>
  <?php $no=1; while($row = oci_fetch_array($sql)) { ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $row[0]; ?></td>
    <!--<td align="center"><a href="detil.sitak.php?jenis=potensi&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[1]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=rejected&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[2]; ?></a></td> -->
    <td align="center"><a href="detil.sitak.php?jenis=new&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[3]; ?></a></td>
    <!--<td align="center"><a href="detil.sitak.php?jenis=total&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[4]+$row[5]+$row[6]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=ok&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[4]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=gagal&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[5]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=pending&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[6]; ?></a></td>-->
    <td align="center"><a href="detil.sitak.php?jenis=ws&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[7]; ?></a></td>
  </tr>
  <?php 
  $no++;
  $jum_potensi=$jum_potensi+$row[1];
  $jum_rejected=$jum_rejected+$row[2];
  $jum_newpotensi=$jum_newpotensi+$row[3];
  $jum_total=$jum_total+$row[4]+$row[5]+$row[6];
  $jum_ok=$jum_ok+$row[4];
  $jum_gagal=$jum_gagal+$row[5];
  $jum_pending=$jum_pending+$row[6];
  $jum_sitakws=$jum_sitakws+$row[7];
  } 
  ?>
  </tbody>
  <tfoot>
  <tr>
    <td colspan="2"><strong>TOTAL REGIONAL V</strong></td>
    <td align="right"><a href="detil.sitak.php?jenis=potensi&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $jum_potensi ?></strong></a></td>
    <td align="right"><a href="detil.sitak.php?jenis=rejected&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $jum_rejected ?></strong></a></td> 
    <td align="right"><a href="detil.sitak.php?jenis=new&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $jum_newpotensi ?></strong></a></td>
    <!--<td align="right"><a href="detil.sitak.php?jenis=total&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $jum_total ?></strong></a></td>
    <td align="right"><a href="detil.sitak.php?jenis=ok&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $jum_ok ?></strong></a></td>   
    <td align="right"><a href="detil.sitak.php?jenis=gagal&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $jum_gagal ?></strong></a></td>   
    <td align="right"><a href="detil.sitak.php?jenis=pending&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $jum_pending ?></strong></a></td>   -->
    <td align="right"><a href="detil.sitak.php?jenis=ws&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $jum_sitakws ?></strong></a></td>   
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

<!--
13-09-2015 SQL
select witel,
sum(case when lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' then 1 else 0 end) as potensi,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(status_data)='rejected' then 1 else 0 end) as rejected,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(status_data) not in ('rejected') then 1 else 0 end) as new_potensi,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(kunjungan)='ok' then 1 else 0 end) as OK,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(kunjungan)='gagal' then 1 else 0 end) as GAGAL,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(kunjungan)='pending' then 1 else 0 end) as pending,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(status_sitac)='ok' then 1 else 0 end) as sitac_ws
from report_data_demand
group by witel