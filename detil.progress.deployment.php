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
include './func/progress.deployment.list.php';
include './func/indihome.list.php';
$sql = OCIParse($connect,
        "SELECT ID,WITEL,ID_SITE,NAMA_SITE,ALAMAT,PRIORITAS,MITRA_AP,STATUS_CONS_JATIM,KETERANGAN_STATUS_DATA,ID_WS,KOMENTAR"
        . " FROM REPORT_DATA_DEMAND WHERE ".$witel." AND ".$jenis." ".$tipe_site
        ."ORDER BY PRIORITAS");
ociexecute($sql);
?>
  <div class="container">
      <h3 align="center"><strong>DETIL PROGRESS DEPLOYMENT <br> WITEL <?php echo strtoupper($_GET['witel']); ?></strong></h3><br />
  <div class="panel panel-default">
  <div class="panel-body">
<div class="row">
<?php 
if(!empty($_GET['status_update'])){
    $alert = "<div id =\"error\" class=\"col-md-12\"><div class=\"form-group\"><div class=\"alert alert-dismissable alert-success\" style=\"background-color: green;\">
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
          <strong>SUKSES!</strong> DATA BERHASIL DIUPDATE !
          </div></div></div>";
echo $alert;
}
?>
</div>
<div class="row">
<div class="col-md-12">
    <p><a href="get.progress.deployment.php?jenis=<?php echo $_GET['jenis']; ?>&witel=<?php echo $_GET['witel']; ?>" style="text-decoration:none"><font color="green"><strong><i class="fa fa-file-excel-o"></i> EXPORT TO EXCEL</strong></font></a></p>
<table class="table table-bordered" id="table_id">
  <thead bgcolor="#E12E32" style="color:#FFFFFF">
    <tr>
      <td align="center" width="5%"><strong>ACT</strong></td>
      <td><center><strong>ID WS</strong></center></td>
     <!-- <td><center><strong>WITEL</strong></center></td>-->
      <td><center><strong>SITE ID</strong></center></td>
      <td><center><strong>NAMA SITE</strong></center></td>
      <td><center><strong>ALAMAT</strong></center></td>
      <td><center><strong>PRIO</strong></center></td>
      <td><center><strong>MITRA</strong></center></td>
      <td><center><strong>STATUS PROJECT</strong></center></td>
      <td><center><strong>KOMENTAR</strong></center></td>
     </tr>
  </thead>
  <tbody>
  <?php while($row = oci_fetch_array($sql)) { ?>
  <tr>
    <td align="center">
        <a href="edit.progress.deployment.php?site_id=<?php echo $row[0]; ?>&jenis=<?php echo $_GET['jenis']; ?>&witel=<?php echo $_GET['witel']; ?>" style="text-decoration:none"><font color="#E12E32"><i class="fa fa-pencil"></i></font></a>
    </td>
    <td><?php echo $row[9]; ?></td>
    <td><?php echo $row[2]; ?></td>
    <td><?php echo $row[3]; ?></td>
    <td><?php echo $row[4]; ?></td>
    <td><?php echo $row[5]; ?></td>
    <td><?php echo $row[6]; ?></td>
    <td><?php echo $row[7]; ?></td>
    <td><?php echo $row['KOMENTAR']; ?></td>
  </tr>
  <?php }
        if(!empty($_GET['to_do_list']))$link = "to_do_list.php";
        else $link = 'progress.deployment.php';
  ?>
  </table> 
  </div>
  </div> 
      <a onclick="window.location.href='<?php echo $link; ?>'" class="btn btn-primary btn-sm">Kembali</a>
      <a onclick="DeleteConf('deployment')" id="demo" class="btn btn-danger btn-sm">Hapus Data</a>
  </div>
  </div>
<?php include "mod/footer.php"; ?>
  </div>
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="js/simontor.js"></script>
    <script>
    function DeleteConf(before_page){
        var witel = getUrlVars()['witel'];
        var tipe_site = getUrlVars()['tipe_site'];
        var jenis = getUrlVars()['jenis'];
        window.location.assign('delete.sitac.php?witel='+witel+'&tipe_site='+tipe_site+'&before_page='+before_page+'&jenis='+jenis);
    }
    $('#table_id').DataTable({
      "scrollX": false,
      "autoWidth": false
      });  
    </script>  

  </body>
</html>