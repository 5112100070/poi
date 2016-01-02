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
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(status_data) not in ('rejected') then 1 else 0 end) as new_potensi,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and (tanggal_kunjungan=to_date('13-Sep-15')) then 1 else 0 end) as kunjungan_hari_ini,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and (tanggal_kunjungan BETWEEN to_date('1-Jan-15') and to_date('13-Sep-15')) then 1 else 0 end) as kunjungan_hari_sd,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(status_sitac)='ok' and (tanggal_kunjungan=to_date('13-Sep-15')) then 1 else 0 end) as sukses_sitak_hari_ini,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(status_sitac)='ok' and (tanggal_kunjungan BETWEEN to_date('1-Jan-15') and to_date('13-Sep-15')) then 1 else 0 end) as sukses_sitak_sd,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(status_sitac)='nok' and (tanggal_kunjungan=to_date('13-Sep-15')) then 1 else 0 end) as nok_sitak_hari_ini,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(status_sitac)='nok' and (tanggal_kunjungan BETWEEN to_date('1-Jan-15') and to_date('13-Sep-15')) then 1 else 0 end) as nok_sitak_sd,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(status_sitac)='pending' and (tanggal_kunjungan=to_date('13-Sep-15')) then 1 else 0 end) as pending_sitak_hari_ini,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3') and lower(status_sitac)='pending' and (tanggal_kunjungan BETWEEN to_date('1-Jan-15') and to_date('13-Sep-15')) then 1 else 0 end) as pending_sitak_sd
from report_data_demand
group by witel");
ociexecute($sql);
$jum_newpotensi = 0;
$kunjungan_today = 0;
$kunjungan_sd = 0;
$sukses_today = 0;
$sukses_sd = 0;


$gagal_today = 0;
$gagal_sd = 0;
$pending_today = 0;
$pending_sd = 0;
?>
    <div class="container" style="width: 1500px">
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
      <h4><strong>Tanggal Laporan <?php echo date("d/M/Y"); ?></strong></h4>
<div class="row">
<div class="col-md-12">

  <table class="table table-bordered">
  <thead bgcolor="#E12E32" style="color:#FFFFFF">
  <tr>
    <td rowspan="2" align="center" width="4%"><br /><strong>NO</strong></td>
    <td rowspan="2" align="center" width="20%"><br /><strong>WITEL</strong></td>
    <td rowspan="2" colspan="1" align="center" width="5%"><strong><br>NEW<br>POTENSI</strong></td>
    <td rowspan="1" colspan="2" align="center" width="13%"><strong>KUNJUNGAN</strong></td>
    <td rowspan="1" colspan="2" align="center" width="13%"><strong>SUKSES SITAC</strong></td>
    <td rowspan="1" colspan="2" align="center" width="13%"><strong>UPLOAD WS</strong></td>
    <td rowspan="1" colspan="2" align="center" width="13%"><strong>GAGAL</strong></td>
    <td rowspan="1" colspan="2" align="center" width="13%"><strong>PENDING</strong></td>
    <td rowspan="2"align="center" width="13%"><strong><br>% SITAC</strong></td>
  </tr>
  <tr>
        <td align="center"><strong>Hari ini</strong></td>
        <td align="center"><strong>s/d <br>hari ini</strong></td>
        
        <td align="center"><strong>Hari ini</strong></td>
        <td align="center"><strong>s/d <br>hari ini</strong></td>
        
        <td align="center"><strong>Hari ini</strong></td>
        <td align="center"><strong>s/d <br>hari ini</strong></td>
        
        <td align="center"><strong>Hari ini</strong></td>
        <td align="center"><strong>s/d <br>hari ini</strong></td>
        
        <td align="center"><strong>Hari ini</strong></td>
        <td align="center"><strong>s/d <br>hari ini</strong></td>
  </tr>
  </thead> 
  <tbody>
      <tr style="background-color: gray; opacity: 0.8;">
        <td align="center"><strong>a</strong></td>
        <td align="center"><strong>b</strong></td>
        <td align="center"><strong>e=c-d</strong></td>
        <td align="center"><strong>f</strong></td>
        <td align="center"><strong>g</strong></td>
        <td align="center"><strong>h</strong></td>
        <td align="center"><strong>i</strong></td>
        <td align="center"><strong>j</strong></td>
        <td align="center"><strong>k</strong></td>
        <td align="center"><strong>l=f-h-n</strong></td>
        <td align="center"><strong>m=g-l-o</strong></td>
        <td align="center"><strong>n</strong></td>
        <td align="center"><strong>o</strong></td>
        <td align="center"><strong>p=k/e</strong></td>
    </tr>
  <?php $no=1; while($row = oci_fetch_array($sql)) { ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $row[0]; ?></td>
    <td align="center"><a href="detil.sitak.php?jenis=new_potensi&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[1]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=kunjungan_today&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[2]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=kunjungan_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[3]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=sukses_today&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[4]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=sukses_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[5]; ?></a></td>
    <td align="center"><a href="#" style="color: red;text-decoration: none;">no data</a></td>
    <td align="center"><a href="#" style="color: red;text-decoration: none;">no data</a></td>
    <td align="center"><a href="detil.sitak.php?jenis=gagal_today&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[8]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=gagal_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[7]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=pending_today&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[8]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=pending_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[9]; ?></a></td>
    <td align="center"><strong><?php 
        //echo $percent_sitak=  round(($row[8]/$row[2])*100,1);
        
        echo "0%";
    ?></strong></td>
  </tr>
  <?php 
  $no++;
  $jum_newpotensi=$jum_newpotensi+$row[1];
  $kunjungan_today=$kunjungan_today+$row[2];
  $kunjungan_sd=$kunjungan_sd+$row[3];
  $sukses_today=$sukses_today+$row[4];
  $sukses_sd=$sukses_sd+$row[5];
  
  
  $gagal_today=$gagal_today+$row[6];
  $gagal_sd=$gagal_sd+$row[7];
  $pending_today=$pending_today+$row[8];
  $pending_sd=$pending_sd+$row[9];
  } 
  ?>
  </tbody>
  <tfoot>
  <tr>
    <td colspan="2"><strong>TOTAL REGIONAL V</strong></td>
    <td align="center"><a href="detil.sitak.php?jenis=new_potensi&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $jum_newpotensi; ?></strong></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=kunjungan_today&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $kunjungan_today ?></strong></a></td> 
    <td align="center"><a href="detil.sitak.php?jenis=kunjungan_sd&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $kunjungan_sd ?></strong></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=sukses_today&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $sukses_today ?></strong></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=sukses_sd&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $sukses_sd ?></strong></a></td>   
    <td align="center"><a href="#" style="color: red;text-decoration: none;"><strong><?php echo "no data" ?></strong></a></td>   
    <td align="center"><a href="#" style="color: red;text-decoration: none;"><strong><?php echo "no data" ?></strong></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=gagal_today&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $gagal_today ?></strong></a></td>  
    <td align="center"><a href="detil.sitak.php?jenis=gagal_sd&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $gagal_sd ?></strong></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=pending_today&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $pending_today ?></strong></a></td> 
    <td align="center"><a href="detil.sitak.php?jenis=pending_sd&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $pending_sd ?></strong></a></td> 
    <td align="center"><strong><?php echo "0%" ?></strong></td>   
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