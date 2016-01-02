<?php 
session_start();
if(empty($_SESSION['privilege']))
{
  echo "<script language=javascript>
              parent.location.href='login.php';
        </script>";
}

function KegagalanCounter($pembilang,$penyebut){
    if($penyebut!=0){
            echo round(($pembilang/$penyebut)*100,0);
            echo "%";
        }
        else echo "0%";
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
    <title>SITAC</title>
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
        include './func/indihome.list.php';
    ?>
<form name="form1" method="POST">  
<?php 
$sql = OCIParse($connect, "select A.witel,
sum(case when (lower(A.prioritas)='prio-1' or lower(A.prioritas)='prio-2' or lower(A.prioritas)='prio-3' or lower(A.prioritas)='prio-4') and (lower(A.status_data) not in ('rejected')) and (lower(A.kunjungan)='ya')".$tipe_site." then 1 else 0 end) as visited,
sum(case when (lower(A.prioritas)='prio-1' or lower(A.prioritas)='prio-2' or lower(A.prioritas)='prio-3' or lower(A.prioritas)='prio-4') and (lower(A.status_data) not in ('rejected')) and (lower(A.kunjungan)='ya') and (lower(A.status_sitac)='ok')".$tipe_site." then 1 else 0 end) as success,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(A.prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='valid')".$tipe_site." then 1 else 0 end) as valid,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') and (lower(ket_status_sitac)='invalid')".$tipe_site." then 1 else 0 end) as invalid,
sum(case when (lower(A.prioritas)='prio-1' or lower(A.prioritas)='prio-2' or lower(A.prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(A.status_data) not in ('rejected')) and (lower(A.kunjungan)='ya') and (lower(A.status_sitac)='pending')".$tipe_site." then 1 else 0 end) as pending,
sum(case when (lower(A.prioritas)='prio-1' or lower(A.prioritas)='prio-2' or lower(A.prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(A.status_data) not in ('rejected')) and (lower(A.kunjungan)='ya') and (lower(A.status_sitac)='gagal')".$tipe_site." then 1 else 0 end) as gagal,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='gagal') and (lower(ket_status_sitac)='tidak bersedia')".$tipe_site." then 1 else 0 end) as gagal_a,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='gagal') and (lower(ket_status_sitac)='site lama ditutup')".$tipe_site." then 1 else 0 end) as gagal_b,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='gagal') and (lower(ket_status_sitac)='site tidak valid')".$tipe_site." then 1 else 0 end) as gagal_c,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='gagal') and (lower(ket_status_sitac)='sudah ada ap')".$tipe_site." then 1 else 0 end) as gagal_d,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='gagal') and (lower(ket_status_sitac)='sudah ada indihome')".$tipe_site." then 1 else 0 end) as gagal_e,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='gagal') and (lower(ket_status_sitac)='bukan pengambil keputusan')".$tipe_site." then 1 else 0 end) as gagal_f,
sum(case when (lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected')) and (lower(kunjungan)='ya') and (lower(status_sitac)='gagal') and (lower(ket_status_sitac)='dan lain lain')".$tipe_site." then 1 else 0 end) as gagal_g
from(
select *
from report_data_demand
) A,
(select * from poi_validator where id is not null) B
where A.id=B.id(+)
group by witel");
ociexecute($sql);

$visited = 0;
$success = 0;
$valid = 0;
$invalid = 0;
$pending = 0;
$gagal = 0;
$gagal_a = 0;
$gagal_b = 0;
$gagal_c = 0;
$gagal_d = 0;
$gagal_e = 0;
$gagal_f = 0;
$gagal_g = 0;

?>
    <div class="container" style="width: 1500px">
  <div class="row">
  <div class='col-sm-6'>
  <h3><strong>DASHBOARD SITAC</strong></h3>
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
    <div class="col-md-3">
        <div class="form-group">
          <label class="control-label" for="status_indihome"><i class="fa fa-tag"></i>INDIHOME</label>
          <select id="index_indihome" class="form-control input-sm" name="status_indihome">
              <option value="ALL" <?php CekPlan("ALL", $_GET['tipe_site']); ?>>ALL</option>
              <option value="INDIHOME" <?php CekPlan("INDIHOME", $_GET['tipe_site']); ?>>INDIHOME</option>
              <option value="NOT_INDIHOME" <?php CekPlan("NOT_INDIHOME", $_GET['tipe_site']); ?>>Bukan INDIHOME</option>
          </select>
        </div>
    </div>
<div class="col-md-10">
  <table class="table table-bordered">
  <thead bgcolor="#E12E32" style="color:#FFFFFF">
  <tr>
    <td rowspan="2" align="center" width="4%"><br /><strong>NO</strong></td>
    <td rowspan="2" align="center" width="10%"><strong><br>WITEL</strong></td>
    <td rowspan="2" align="center" width="6%"><strong><br>VISITED</strong></td>
    <td colspan="8" rowspan="1" align="center" width="13%"><strong>PROCESS SITAC</strong></td>
    <td colspan="7" rowspan="1" align="center" width="13%"><strong>KEGAGALAN SITAC</strong></td>
    <td colspan="7" rowspan="1" align="center" width="13%"><strong>% KEGAGALAN SITAC</strong></td>
  </tr>
  <tr>
        <td align="center"><strong>SUCCESS</strong></td>
        <td align="center"><strong>%</strong></td>
        <td align="center"><strong>VALID</strong></td>
        <td align="center"><strong>INVALID</strong></td>
        <td align="center"><strong>PENDING</strong></td>
        <td align="center"><strong>%</strong></td>
        <td align="center"><strong>GAGAL</strong></td>
        <td align="center"><strong>%</strong></td>
        
        <td align="center"><strong>a</strong></td>
        <td align="center"><strong>b</strong></td>
        <td align="center"><strong>c</strong></td>
        <td align="center"><strong>d</strong></td>
        <td align="center"><strong>e</strong></td>
        <td align="center"><strong>f</strong></td>
        <td align="center"><strong>g</strong></td>
        
        <td align="center"><strong>a</strong></td>
        <td align="center"><strong>b</strong></td>
        <td align="center"><strong>c</strong></td>
        <td align="center"><strong>d</strong></td>
        <td align="center"><strong>e</strong></td>
        <td align="center"><strong>f</strong></td>
        <td align="center"><strong>g</strong></td>
        
  </tr>
  </thead> 
  <tbody>
  <?php $no=1; while($row = oci_fetch_array($sql)) { ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $row[0]; ?></td>
    <td align="center"><a href="detil.sitak.php?jenis=visited&witel=<?php echo $row[0]; ?>&tipe_site=<?php echo $_GET['tipe_site']; ?>" style="color: red;text-decoration: none;"><?php echo $row[1]; ?></a></td>   <!-- VISITED -->
    
    <td align="center"><a href="detil.sitak.php?jenis=success&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>&tipe_site=<?php echo $_GET['tipe_site']; ?>" style="color: red;text-decoration: none;"><?php echo $row[2]; ?></a></td>       <!-- SUCCESS  -->
    <td align="center"><?php 
        if($row[1]!=0){
            echo round(($row[2]/$row[1])*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=valid&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>&tipe_site=<?php echo $_GET['tipe_site']; ?>" style="color: red;text-decoration: none;"><?php echo $row[3]; ?></a></td>          <!-- VALID  -->
    <td align="center"><a href="detil.sitak.php?jenis=invalid&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>&tipe_site=<?php echo $_GET['tipe_site']; ?>" style="color: red;text-decoration: none;"><?php echo $row[4]; ?></a></td>          <!-- INVALID -->
    
    <td align="center"><a href="detil.sitak.php?jenis=pending&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>&tipe_site=<?php echo $_GET['tipe_site']; ?>" style="color: red;text-decoration: none;"><?php echo $row[5]; ?></a></td>             <!-- PENDING -->
    <td align="center"><?php 
        if($row[1]!=0){
            echo round(($row[5]/$row[1])*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=gagal&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>&tipe_site=<?php echo $_GET['tipe_site']; ?>" style="color: red;text-decoration: none;"><?php echo $row[6]; ?></a></td>      <!-- GAGAL -->
    <td align="center"><?php
        if($row[1]!=0){
            echo round(($row[6]/$row[1])*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=gagal_a&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>&tipe_site=<?php echo $_GET['tipe_site']; ?>" style="color: red;text-decoration: none;"><?php echo $row[7]; ?></a></td>          <!-- ALASAN KEGAGALAN --> 
    <td align="center"><a href="detil.sitak.php?jenis=gagal_b&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>&tipe_site=<?php echo $_GET['tipe_site']; ?>" style="color: red;text-decoration: none;"><?php echo $row[8]; ?></a></td>       
    <td align="center"><a href="detil.sitak.php?jenis=gagal_c&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>&tipe_site=<?php echo $_GET['tipe_site']; ?>" style="color: red;text-decoration: none;"><?php echo $row[9]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=gagal_d&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>&tipe_site=<?php echo $_GET['tipe_site']; ?>" style="color: red;text-decoration: none;"><?php echo $row[10]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=gagal_e&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>&tipe_site=<?php echo $_GET['tipe_site']; ?>" style="color: red;text-decoration: none;"><?php echo $row[11]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=gagal_f&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>&tipe_site=<?php echo $_GET['tipe_site']; ?>" style="color: red;text-decoration: none;"><?php echo $row[12]; ?></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=gagal_g&witel=<?php echo $row[0]; ?>&tgl=<?php echo date('d-M-y') ?>&tipe_site=<?php echo $_GET['tipe_site']; ?>" style="color: red;text-decoration: none;"><?php echo $row[13]; ?></a></td>
  
    <!-- KEGAGALAN % -->
    <?php for($i=7;$i<14;$i++){ ?>
    <td align="center"><?php      
          KegagalanCounter($row[$i],$row[6]);
      ?></td>
    <?php } ?>
  </tr>
  <?php 
  $no++;
  $visited=$visited+$row[1];
  
  $success=$success+$row[2];
  $valid=$valid+$row[3];
  $invalid=$invalid+$row[4];
  $pending=$pending+$row[5];  
  $gagal=$gagal+$row[6];
  
  $gagal_a=$gagal_a+$row[7];
  $gagal_b=$gagal_b+$row[8];
  $gagal_c=$gagal_c+$row[9];
  $gagal_d=$gagal_d+$row[10];
  $gagal_e=$gagal_e+$row[11];
  $gagal_f=$gagal_f+$row[12];
  $gagal_g=$gagal_g+$row[13];
  } 
  ?>
  </tbody>
  <tfoot>
  <tr>
    <td colspan="2"><strong>TOTAL REGIONAL V</strong></td>
    <td align="center"><a href="detil.sitak.php?jenis=visited&witel=all" style="color: red;text-decoration: none;"><strong><?php echo $visited; ?></strong></a></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=success&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $success ?></strong></a></td> 
        <td align="center"><?php 
        if($visited!=0){
            echo round(($success/$visited)*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
        
    <td align="center"><a href="detil.sitak.php?jenis=valid&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $valid ?></strong></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=invalid&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $invalid ?></strong></a></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=pending&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $pending ?></strong></a></td>   
    <td align="center"><?php
    if($visited!=0){
            echo round(($pending/$visited)*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=gagal&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $gagal ?></strong></a></td>
    <td align="center"><?php
    if($visited!=0){
            echo round(($gagal/$visited)*100,0);
            echo "%";
        }
        else echo "0%";
    ?></td>
    
    <td align="center"><a href="detil.sitak.php?jenis=gagal_a&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $gagal_a ?></strong></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=gagal_b&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $gagal_b ?></strong></a></td>  
    <td align="center"><a href="detil.sitak.php?jenis=gagal_c&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $gagal_c ?></strong></a></td>
    <td align="center"><a href="detil.sitak.php?jenis=gagal_d&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $gagal_d ?></strong></a></td> 
    <td align="center"><a href="detil.sitak.php?jenis=gagal_e&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $gagal_e ?></strong></a></td> 
    <td align="center"><a href="detil.sitak.php?jenis=gagal_f&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $gagal_f ?></strong></a></td> 
    <td align="center"><a href="detil.sitak.php?jenis=gagal_g&witel=all&tgl=<?php echo date('d-M-y') ?>" style="color: red;text-decoration: none;"><strong><?php echo $gagal_g ?></strong></a></td> 
    
    <td align="center"><strong><?php echo KegagalanCounter($gagal_a, $gagal) ?></strong></td>
    <td align="center"><strong><?php echo KegagalanCounter($gagal_b, $gagal) ?></strong></td>
    <td align="center"><strong><?php echo KegagalanCounter($gagal_c, $gagal) ?></strong></td>
    <td align="center"><strong><?php echo KegagalanCounter($gagal_d, $gagal) ?></strong></td>
    <td align="center"><strong><?php echo KegagalanCounter($gagal_e, $gagal) ?></strong></td>
    <td align="center"><strong><?php echo KegagalanCounter($gagal_f, $gagal) ?></strong></td>
    <td align="center"><strong><?php echo KegagalanCounter($gagal_g, $gagal) ?></strong></td>
  </tr>
  </tfoot>
  </table> 
  </div>
    <div class="col-md-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-barcode"></i> <strong>KETERANGAN</strong></h3>
                </div>
            <div class="panel-body"> 
                       <div class="form-group">
                            <label class="control-label"><i class="fa fa-book">a : </i>Tidak Bersedia
                            <br><i class="fa fa-book">b : </i>Site Lama Tutup
                            <br><i class="fa fa-book">c : </i>Site Tidak Valid
                            <br><i class="fa fa-book">d : </i>Sudah Ada AP
                            <br><i class="fa fa-book">e : </i>Sudah Ada IndiHome
                            <br><i class="fa fa-book">f : </i>Bukan Pengambil Keputusan
                            <br><i class="fa fa-book">g : </i>Dan Lain-Lain
                        </div>
            </div>
            </div>
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
    <script src="js/simontor.js"></script>       
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