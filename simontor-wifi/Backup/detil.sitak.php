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
    <title>MICRO POI TSEL - Detil SITAC</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    <style>
        body{padding-top:80px}
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
if($_GET['jenis']=='new_potensi'){
    $jenis="(LOWER(PRIORITAS)='prio-1' OR LOWER(PRIORITAS)='prio-2' OR LOWER(PRIORITAS)='prio-3') AND (LOWER(STATUS_DATA) NOT IN ('rejected'))";
}
else if($_GET['jenis']=='kunjungan_today'){
    $jenis="(LOWER(PRIORITAS)='prio-1' OR LOWER(PRIORITAS)='prio-2' OR LOWER(PRIORITAS)='prio-3') AND (TANGGAL_KUNJUNGAN=TO_DATE('".$_GET['tgl']."'))";
}
else if($_GET['jenis']=='kunjungan_sd'){
    $jenis="(LOWER(PRIORITAS)='prio-1' OR LOWER(PRIORITAS)='prio-2' OR LOWER(PRIORITAS)='prio-3') AND (TANGGAL_KUNJUNGAN BETWEEN TO_DATE('1-Jan-15') AND TO_DATE('".$_GET['tgl']."'))";
}
else if($_GET['jenis']=='sukses_today'){
    $jenis="(LOWER(PRIORITAS)='prio-1' OR LOWER(PRIORITAS)='prio-2' OR LOWER(PRIORITAS)='prio-3') AND LOWER(STATUS_SITAC)='ok' AND TANGGAL_KUNJUNGAN=TO_DATE('".$_GET['tgl']."')";
}
else if($_GET['jenis']=='sukses_sd'){
    $jenis="(LOWER(PRIORITAS)='prio-1' OR LOWER(PRIORITAS)='prio-2' OR LOWER(PRIORITAS)='prio-3') AND LOWER(STATUS_SITAC)='ok' AND (TANGGAL_KUNJUNGAN BETWEEN TO_DATE('1-Jan-15') AND TO_DATE('".$_GET['tgl']."'))";
}
else if($_GET['jenis']=='gagal_today'){
    $jenis="(LOWER(PRIORITAS)='prio-1' OR LOWER(PRIORITAS)='prio-2' OR LOWER(PRIORITAS)='prio-3') AND LOWER(STATUS_SITAC)='nok' AND TANGGAL_KUNJUNGAN=TO_DATE('".$_GET['tgl']."')";
}
else if($_GET['jenis']=='gagal_sd'){
    $jenis="(LOWER(PRIORITAS)='prio-1' OR LOWER(PRIORITAS)='prio-2' OR LOWER(PRIORITAS)='prio-3') AND LOWER(STATUS_SITAC)='nok' AND (TANGGAL_KUNJUNGAN BETWEEN TO_DATE('1-Jan-15') AND TO_DATE('".$_GET['tgl']."'))";
}
else if($_GET['jenis']=='pending_today'){
    $jenis="(LOWER(PRIORITAS)='prio-1' OR LOWER(PRIORITAS)='prio-2' OR LOWER(PRIORITAS)='prio-3') AND LOWER(STATUS_SITAC)='pending' AND TANGGAL_KUNJUNGAN=TO_DATE('".$_GET['tgl']."')";
}
else if($_GET['jenis']=='pending_sd'){
    $jenis="(LOWER(PRIORITAS)='prio-1' OR LOWER(PRIORITAS)='prio-2' OR LOWER(PRIORITAS)='prio-3') AND LOWER(STATUS_SITAC)='pending' AND (TANGGAL_KUNJUNGAN BETWEEN TO_DATE('1-Jan-15') AND TO_DATE('".$_GET['tgl']."'))";
}

if($_GET['witel']=='all'){
    $witel="WITEL IS NOT NULL";
}
else{
    $witel="WITEL='".$_GET['witel']."'";
}
$sql = OCIParse($connect,
        "SELECT ID,WITEL,ID_SITE,NAMA_SITE,ALAMAT,PRIORITAS,STATUS_DATA,STATUS_SITAC,KETERANGAN_STATUS_DATA,ID_WS"
        . " FROM REPORT_DATA_DEMAND WHERE ".$witel." AND ".$jenis
        ."ORDER BY PRIORITAS");
ociexecute($sql);
?>
  <div class="container">
  <h3 align="center"><strong>DETIL DATA SITAC - WITEL <?php echo $_GET['witel']; ?></strong></h3><br />
  <div class="panel panel-default">
  <div class="panel-body">

<div class="row">
    <?php 
if(!empty($_GET['status_update'])){
    $alert = "<div id =\"error\" class=\"col-md-12\"><div class=\"form-group\"><div class=\"alert alert-dismissable alert-success\" style=\"background-color: red;\">
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
          <strong>SUKSES!</strong> DATA BERHASIL DIUPDATE !
          </div></div></div>";
    echo $alert;
}
?>
<div class="col-md-12">
<table class="table table-bordered" id="table_id">
  <thead bgcolor="#E12E32" style="color:#FFFFFF">
    <tr>
      <td align="center" width="5%"><strong>ACT</strong></td>
      <td><center><strong>ID WS</strong></center></td>
      <td><center><strong>SITE ID</strong></center></td>
      <td><center><strong>NAMA SITE</strong></center></td>
      <td><center><strong>ALAMAT</strong></center></td>
      <td><center><strong>PRIORITAS</strong></center></td>
      <td><center><strong>STATUS DATA</strong></center></td>
      <td><center><strong>STATUS SITAC</strong></center></td>
      <td><center><strong>KETERANGAN</strong></center></td>
     </tr>
  </thead>
  <tbody>
  <?php while($row = oci_fetch_array($sql)) { ?>
  <tr>
    <td align="center">
        <a href="edit.sitak.php?site_id=<?php echo $row[0] ?>&witel=<?php echo $row[1] ?>&jenis=<?php echo $_GET['jenis'] ?>" style="text-decoration:none"><font color="#E12E32"><i class="fa fa-pencil"></i></font></a>
    </td>
    <td><?php echo $row[9]; ?></td>
    <td><?php echo $row[2]; ?></td>
    <td><?php echo $row[3]; ?></td>
    <td><?php echo $row[4]; ?></td>
    <td><?php echo $row[5]; ?></td>
    <td><?php echo $row[6]; ?></td>
    <td><?php echo $row[7]; ?></td>
    <td><?php echo $row[8]; ?></td>
  </tr>
  <?php } ?>
  </table> 
  </div>
  </div> 
      <a onclick="window.location.href='index.php'" class="btn btn-primary btn-sm">Kembali</a>
  </div>
  </div>
<?php include "mod/footer.php"; ?>
  </div>
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
    <script>
    $(document).ready( function () {
    $('#table_id').DataTable({
      "scrollX": false,
      "autoWidth": false
      });  
    });
    </script>  

  </body>
</html>