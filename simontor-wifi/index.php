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
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) then 1 else 0 end) as new_potensi,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya' and tanggal_kunjungan=to_date('".  date('d-m-y')."','DD/MM/YYYY')) then 1 else 0 end) as visit_today,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') then 1 else 0 end) as visit_sd,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya' and tanggal_kunjungan=to_date('".  date('d-m-y')."','DD/MM/YYYY')) and (lower(status_sitac)='ok') then 1 else 0 end) as sukses_sitak_today,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') then 1 else 0 end) as sukses_sitak_sd,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya' and tanggal_kunjungan=to_date('".  date('d-m-y')."','DD/MM/YYYY')) and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') then 1 else 0 end) as upload_ws_today,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') then 1 else 0 end) as upload_ws_sd,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya' and tanggal_kunjungan=to_date('".  date('d-m-y')."','DD/MM/YYYY')) and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) then 1 else 0 end) as po_today,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) then 1 else 0 end) as po_sd,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya' and tanggal_kunjungan=to_date('".  date('d-m-y')."','DD/MM/YYYY')) and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_tcares)='ok') then 1 else 0 end) as input_today,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_tcares)='ok') then 1 else 0 end) as input_sd,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya' and tanggal_kunjungan=to_date('".  date('d-m-y')."','DD/MM/YYYY')) and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_cons_jatim)='on air') then 1 else 0 end) as activation_today,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid') and (mitra_ap is not null) and (lower(status_cons_jatim)='on air') then 1 else 0 end) as activation_sd,
sum(case when (witel is not null) then 1 else 0 end) as potensi_order
from report_data_demand
group by witel");
ociexecute($sql);
$new_potensi = 0;
$kunjungan_today = 0;
$kunjungan_sd = 0;
$sukses_today = 0;
$sukses_sd = 0;
$upload_ws_today = 0;
$upload_ws_sd = 0;
$po_today = 0;
$po_sd = 0;
$input_today = 0;
$input_sd = 0;
$activation_today = 0;
$activation_sd = 0;
$potensiOrder = 0;
?>
    <div class="container" style="width: 1500px">
  <div class="row">
  <div class='col-sm-6'>
  <h3><strong>DASHBOARD UTAMA</strong></h3>
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
    <td rowspan="2" align="center" width="10%"><strong><br>WITEL</strong></td>
    <td rowspan="2" align="center" width="3%"><strong><br>POTENSI ORDER</strong></td>
    <td rowspan="2" align="center" width="3%"><strong><br>POTENSI</strong></td>
    <td colspan="3" align="center" width="13%"><strong>VISIT</strong></td>
    <td colspan="3" rowspan="1" align="center" width="13%"><strong>SUCCESS SITAC</strong></td>
    <td colspan="3" rowspan="1" align="center" width="13%"><strong>UPLOAD WS</strong></td>
    <td colspan="3" rowspan="1" align="center" width="13%"><strong>PO</strong></td>
    <td colspan="3" rowspan="1" align="center" width="13%"><strong>INPUT TICARES</strong></td>
    <td colspan="3" rowspan="1" align="center" width="13%"><strong>ON AIR</strong></td>
  </tr>
  <tr>
        <td align="center"><strong>Hari ini</strong></td>
        <td align="center"><strong>s/d</strong></td>
        <td align="center"><strong>% ach</strong></td>
        
        <td align="center"><strong>Hari ini</strong></td>
        <td align="center"><strong>s/d</strong></td>
        <td align="center"><strong>% ach</strong></td>
        
        <td align="center"><strong>Hari ini</strong></td>
        <td align="center"><strong>s/d</strong></td>
        <td align="center"><strong>% ach</strong></td>
        
        <td align="center"><strong>Hari ini</strong></td>
        <td align="center"><strong>s/d</strong></td>
        <td align="center"><strong>% ach</strong></td>
        
        <td align="center"><strong>Hari ini</strong></td>
        <td align="center"><strong>s/d</strong></td>
        <td align="center"><strong>% ach</strong></td>
        
        <td align="center"><strong>Hari ini</strong></td>
        <td align="center"><strong>s/d</strong></td>
        <td align="center"><strong>% ach</strong></td>
  </tr>
  </thead> 
  <tbody>
  <?php $no=1; while($row = oci_fetch_array($sql)) { ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $row[0]; ?></td>
    <td align="center"><a href="detil.potensi.php?witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[14]; ?></a></td>   <!-- POTENSI ORDER-->
    <td align="center"><a href="detil.sitak.php?jenis=new_potensi&witel=<?php echo $row[0]; ?>" style="color: red;text-decoration: none;"><?php echo $row[1]; ?></a></td>   <!-- POTENSI -->
    
    <td align="center"><a href="detil.sitak.php?jenis=kunjungan_today&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[2]; ?></a></td>       <!-- VISITED  -->
    <td align="center" style="background-color: #B7AFB9;"><a href="detil.sitak.php?jenis=kunjungan_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[3]; ?></a></td>
    <td align="center"><?php 
        if($row[1]!=0){
            echo round(($row[3]/$row[1])*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
        
    <td align="center"><a href="detil.sitak.php?jenis=sukses_today&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[4]; ?></a></td>          <!-- SUCCESS -->
    <td align="center" style="background-color: #B7AFB9;"><a href="detil.sitak.php?jenis=sukses_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[5]; ?></a></td>
    <td align="center"><?php
        if($row[3]!=0){
            echo round(($row[5]/$row[3])*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=upload_ws_today&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[6]; ?></a></td>      <!-- UPLOAD -->
    <td align="center" style="background-color: #B7AFB9;"><a href="detil.sitak.php?jenis=upload_ws_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[7]; ?></a></td>
    <td align="center"><?php
    if($row[7]!=0){
            echo round(($row[7]/$row[5])*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=po_today&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[8]; ?></a></td>           <!-- PO -->
    <td align="center" style="background-color: #B7AFB9;"><a href="detil.sitak.php?jenis=po_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[9]; ?></a></td>
    <td align="center"><?php
    if($row[7]!=0){
            echo round(($row[9]/$row[7])*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=input_today&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[10]; ?></a></td>         <!-- INPUT TCARES -->
    <td align="center" style="background-color: #B7AFB9;"><a href="detil.sitak.php?jenis=input_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[11]; ?></a></td>
    <td align="center"><?php
    if($row[9]!=0){
            echo round(($row[11]/$row[9])*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=activation_today&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[12]; ?></a></td>         <!-- ACTIVATION -->
    <td align="center" style="background-color: #B7AFB9;"><a href="detil.sitak.php?jenis=activation_sd&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><?php echo $row[13]; ?></a></td>
    <td align="center"><?php
    if($row[11]!=0){
            echo round(($row[13]/$row[11])*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
  </tr>
  <?php 
  $no++;
  $new_potensi=$new_potensi+$row[1];
  
  $kunjungan_today=$kunjungan_today+$row[2];
  $kunjungan_sd=$kunjungan_sd+$row[3];
  
  $sukses_today=$sukses_today+$row[4];
  $sukses_sd=$sukses_sd+$row[5];
  
  $upload_ws_today=$upload_ws_today+$row[6];
  $upload_ws_sd=$upload_ws_sd+$row[7];
  
  $po_today=$po_today+$row[8];
  $po_sd=$po_sd+$row[9];
  
  $input_today=$input_today+$row[10];
  $input_sd=$input_sd+$row[11];
  
  $activation_today=$activation_today+$row[12];
  $activation_sd=$activation_sd+$row[13];
  
  $potensiOrder=$potensiOrder+$row[14];
  } 
  ?>
  </tbody>
  <tfoot>
  <tr>
    <td colspan="2"><strong>TOTAL REGIONAL V</strong></td>
    <td align="center"><a href="detil.potensi.php?witel=all" style="color: red;text-decoration: none;"><strong><?php echo $potensiOrder; ?></strong></a></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=new_potensi&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $new_potensi; ?></strong></a></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=kunjungan_today&witel=all&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $kunjungan_today ?></strong></a></td> 
    <td align="center" style="background-color: #B7AFB9;"><a href="detil.sitak.php?jenis=kunjungan_sd&witel=all&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $kunjungan_sd ?></strong></a></td>
    <td align="center"><?php 
        if($new_potensi!=0){
            echo round(($kunjungan_sd/$new_potensi)*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=sukses_today&witel=all&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $sukses_today ?></strong></a></td>
    <td align="center" style="background-color: #B7AFB9;"><a href="detil.sitak.php?jenis=sukses_sd&witel=all&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $sukses_sd ?></strong></a></td>   
    <td align="center"><?php
    if($kunjungan_sd!=0){
            echo round(($sukses_sd/$kunjungan_sd)*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=upload_ws_today&witel=all&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $upload_ws_today ?></strong></a></td>   
    <td align="center" style="background-color: #B7AFB9;"><a href="detil.sitak.php?jenis=upload_ws_sd&witel=all&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $upload_ws_sd ?></strong></a></td>
    <td align="center"><?php
    if($sukses_sd!=0){
            echo round(($upload_ws_sd/$sukses_sd)*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=po_today&witel=all&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $po_today ?></strong></a></td>  
    <td align="center" style="background-color: #B7AFB9;"><a href="detil.sitak.php?jenis=po_sd&witel=all&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $po_sd ?></strong></a></td>
    <td align="center"><?php
    if($upload_ws_sd!=0){
            echo round(($po_sd/$upload_ws_sd)*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=input_today&witel=all&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $input_today ?></strong></a></td> 
    <td align="center" style="background-color: #B7AFB9;"><a href="detil.sitak.php?jenis=input_sd&witel=all&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $input_sd ?></strong></a></td> 
    <td align="center"><?php
    if($po_sd!=0){
            echo round(($input_sd/$po_sd)*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.progress.deployment.php?jenis=activation_today&witel=all&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $activation_today ?></strong></a></td> 
    <td align="center" style="background-color: #B7AFB9;"><a href="detil.sitak.php?jenis=activation_sd&witel=all&tgl=<?php echo date('d-m-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $activation_sd ?></strong></a></td> 
    <td align="center"><?php
    if($input_sd!=0){
            echo round(($activation_sd/$input_sd)*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td> 
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