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
    <title>DASHBOARD STATUS ORDER POI TELKOMSEL</title>
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
sum(case when (witel is not null) then 1 else 0 end) as potensi_order,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) then 1 else 0 end) as new_potensi,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') then 1 else 0 end) as visit,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan) not in ('ya') or kunjungan is null) then 1 else 0 end) as unvisit,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') then 1 else 0 end) as sukses_sitak,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') then 1 else 0 end) as upload_ws,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac) not in ('valid') or ket_status_sitac is null) then 1 else 0 end) as unupload_ws,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) then 1 else 0 end) as po,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is null) then 1 else 0 end) as unpo,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_tcares)='ok') then 1 else 0 end) as input,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_tcares) not in ('ok') or status_tcares is null) then 1 else 0 end) as uninput,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_cons_jatim)='installed') then 1 else 0 end) as installation,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_cons_jatim)='on air') then 1 else 0 end) as activation
from report_data_demand
group by witel order by witel asc");
ociexecute($sql);
$potensiOrder = 0;
$new_potensi = 0;
$visited = 0;
$unvisited = 0;
$sukses = 0;
$upload_ws = 0;
$unupload_ws = 0;
$po = 0;
$unpo = 0;
$input = 0;
$uninput = 0;
$installed = 0;
$activation = 0;
?>
    <div class="container" style="width: 1500px">
  <div class="row">
  <div class='col-sm-6'>
  <h3><strong>TO DO LIST</strong></h3>
  </div>
  <div class='col-sm-6'>
  <p align="right"><img src="img/logopoi1.png" width="350"></p>
  </div>
  </div>
  <br />
  <div class="panel panel-default">
  <div class="panel-body">
      <h4><strong>Tanggal Laporan <?php echo date("d/M/Y"); ?></strong></h4>
      <h4 style="text-align:right"><strong>Satuan Site</strong></h4>
<div class="row">
<div class="col-md-12">

  <table class="table table-bordered">
  <thead bgcolor="#E12E32" style="color:#FFFFFF">
  <tr>
    <td rowspan="2" align="center" width="2%"><br /><strong>NO</strong></td>
    <td rowspan="2" align="center" width="13%"><strong><br>WITEL</strong></td>
    <td rowspan="2" align="center" width="3%"><strong><br>TSEL ORDER</strong></td>
    <td rowspan="2" align="center" width="2%"><strong><br>POTENSI</strong></td>
    <td colspan="11" align="center" width="80%"><strong><br>STATUS ORDER WIFI ID POI-TSEL</strong></td>
  </tr>
  <tr>
    <td align="center" width="5%"><strong>VISITED</strong></td>
    <td align="center" width="5%"><strong>UNVISITED</strong></td>
    <td align="center" width="5%"><strong>SUCCESS SITAC</strong></td>
    <td align="center" width="5%"><strong>UPLOAD WS</strong></td>
    <td align="center" width="5%"><strong>UNUPLOAD WS</strong></td>
    <td align="center" width="5%"><strong>PO</strong></td>
    <td align="center" width="5%"><strong>UN-PO</strong></td>
    <td align="center" width="5%"><strong>INPUT TICARES</strong></td>
    <td align="center" width="5%"><strong>UNINPUT TICARES</strong></td>
    <td align="center" width="5%"><strong>INSTALATION</strong></td>
    <td align="center" width="5%"><strong>ON AIR</strong></td>
  </tr>
  </thead> 
  <tbody>
  <?php $no=1; while($row = oci_fetch_array($sql)) { ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $row[0]; ?></td>
    <td align="center"><a href="detil.potensi.php?witel=<?php echo $row[0]; ?>&to_do_list=1" style="color: red;text-decoration: none;"><?php echo $row[1]; ?></a></td>                                                               <!-- TSEL ORDER-->
    <td align="center"><a href="detil.sitak.php?jenis=new_potensi&witel=<?php echo $row[0]; ?>&to_do_list=1" style="color: red;text-decoration: none;"><?php echo $row[2]; ?></a></td>                                               <!-- POTENSI -->  
    <td align="center"><a href="detil.sitak.php?jenis=kunjungan_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><?php echo $row[3]; ?></a></td>              <!-- VISITED -->
    <td align="center"><a href="detil.sitak.php?jenis=belum_kunjungan_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><?php echo $row[4]; ?></a></td>        <!-- UNVISITED -->      
    <td align="center"><a href="detil.sitak.php?jenis=sukses_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><?php echo $row[5]; ?></a></td>                 <!-- SUCCESS SITAC -->    
    <td align="center"><a href="detil.sitak.php?jenis=upload_ws_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><?php echo $row[6]; ?></a></td>              <!-- UPLOAD WS-->
    <td align="center"><a href="detil.sitak.php?jenis=unupload_ws_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><?php echo $row[7]; ?></a></td>            <!-- UNUPLOAD WS-->
    <td align="center"><a href="detil.sitak.php?jenis=po_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><?php echo $row[8]; ?></a></td>                     <!-- PO -->
    <td align="center"><a href="detil.sitak.php?jenis=unpo_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><?php echo $row[9]; ?></a></td>                   <!-- UN-PO -->
    <td align="center"><a href="detil.sitak.php?jenis=input_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><?php echo $row[10]; ?></a></td>                  <!-- INPUT TCARES -->
    <td align="center"><a href="detil.sitak.php?jenis=uninput_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><?php echo $row[11]; ?></a></td>                 <!-- UNINPUT TCARES -->
    <td align="center"><a href="detil.progress.deployment.php?jenis=installed&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><?php echo $row[12]; ?></a></td>          <!-- INSTALLATION -->
    <td align="center"><a href="detil.progress.deployment.php?jenis=oa&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><?php echo $row[13]; ?></a></td>            <!-- ACTIVATION -->
  </tr>
  <?php 
  $no++;
  $potensiOrder=$potensiOrder+$row[1];
  $new_potensi=$new_potensi+$row[2];
  $visited=$visited+$row[3];
  $unvisited=$unvisited+$row[4];
  $sukses=$sukses+$row[5];
  $upload_ws=$upload_ws+$row[6];
  $unupload_ws=$unupload_ws+$row[7];
  $po=$po+$row[8];
  $unpo=$unpo+$row[9];
  $input=$input+$row[10];
  $uninput=$uninput+$row[11];
  $installed=$installed+$row[12];
  $activation=$activation+$row[13];
  } 
  ?>
  </tbody>
  <tfoot>
  <tr>
    <td colspan="2"><strong>TOTAL REGIONAL V</strong></td>
    <td align="center"><a href="detil.potensi.php?witel=all&to_do_list=1" style="color: red;text-decoration: none;"><strong><?php echo $potensiOrder; ?></strong></a></td>    
    <td align="center"><a href="detil.sitak.php?jenis=new_potensi&witel=all&to_do_list=1" style="color: red;text-decoration: none;"><strong><?php echo $new_potensi; ?></strong></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=kunjungan_sd&witel=all&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><strong><?php echo $visited ?></strong></a></td> 
    <td align="center"><a href="detil.sitak.php?jenis=belum_kunjungan_sd&witel=all&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><strong><?php echo $unvisited ?></strong></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=sukses_sd&witel=all&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><strong><?php echo $sukses ?></strong></a></td>    
    <td align="center"><a href="detil.sitak.php?jenis=upload_ws_sd&witel=all&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><strong><?php echo $upload_ws ?></strong></a></td>   
    <td align="center"><a href="detil.sitak.php?jenis=unupload_ws_sd&witel=all&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><strong><?php echo $unupload_ws ?></strong></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=po_sd&witel=all&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><strong><?php echo $po ?></strong></a></td>  
    <td align="center"><a href="detil.sitak.php?jenis=unpo_sd&witel=all&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><strong><?php echo $unpo ?></strong></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=input_sd&witel=all&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><strong><?php echo $input ?></strong></a></td> 
    <td align="center"><a href="detil.sitak.php?jenis=uninput_sd&witel=all&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><strong><?php echo $uninput ?></strong></a></td>
    <td align="center"><a href="detil.progress.deployment.php?jenis=installed&witel=all&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><strong><?php echo $installed ?></strong></a></td> 
    <td align="center"><a href="detil.progress.deployment.php?jenis=oa&witel=all&tgl=<?php echo date('d-m-y') ?>&to_do_list=1" style="color: red;text-decoration: none;"><strong><?php echo $activation ?></strong></a></td> 
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