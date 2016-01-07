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
    <title>MICRO POI TELKOMSEL - Potensi Order</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    <script>
    
    </script>
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
          
          input:checkbox{
              width: 20px;
              height: 20px;
          }
    </style>
  </head>
  <body>
<?php 
include "mod/nav.php"; 
include "config/connect.php";
    $sql_to_parse="SELECT * "
        ."FROM LOGIN WHERE NIK IS NOT NULL "
        ."ORDER BY NIK";
    $url_method="delete.user.process.php";
$sql = OCIParse($connect,$sql_to_parse);
ociexecute($sql);

if(!empty($_GET['status_delete'])){
    if($_GET['status_delete']==1)
        $alert = "<div id =\"error\" class=\"col-md-12\"><div class=\"form-group\"><div class=\"alert alert-dismissable alert-success\" style=\"background-color: green;\">
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
              <strong>SUKSES!</strong> DATA BERHASIL DIDELETE !
              </div></div></div>";
    else $alert = "<div id =\"error\" class=\"col-md-12\"><div class=\"form-group\"><div class=\"alert alert-dismissable alert-success\" style=\"background-color: red;\">
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
              <strong>ERROR!</strong> TERJADI KESALAHAN TEKNIS !
              </div></div></div>";
echo $alert;
}
?>
  <div class="container">
  <h3 align="center"><strong>HAPUS DATA USER</strong></h3><br />.
  <h3 align="center" class="board-delete"><strong>Pilih Data yang Akan Dihapus</strong></h3><br />
  <form action="<?php echo $url_method; ?>" method="post">
  <div class="panel panel-default">
      <div class="panel-body">
<div class="row">
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered" id="table_id">
            <thead bgcolor="#E12E32" style="color:#FFFFFF" style="position: fixed">
              <tr>
                <td align="center" width="5%"><strong>ACT</strong></td>
                <td><center><strong>NIK</strong></center></td>
                <td><center><strong>NAMA</strong></center></td>
                <td><center><strong>JABATAN</strong></center></td>
                <td><center><strong>WITEL</strong></center></td>
               </tr>
            </thead>
        </table>
    </div>
<div class="col-md-12" style="height: 600px;overflow: auto;">
<table class="table table-bordered" id="table_id">
  <tbody>
  <?php while($row = oci_fetch_array($sql)) { ?>
  <tr>
    <td align="center">
        <input name="items_to_delete[]" type="checkbox" value="<?php echo $row['NIK']; ?>">
    </td>
    <td><?php echo $row['NIK']; ?></td>
    <td><?php echo $row['NAMA']; ?></td>
    <td><?php echo $row['JABATAN']; ?></td>
    <td><?php echo $row['WITEL']; ?></td>
  </tr>
  <?php } ?>
  </tbody>
  </table> 
  </div>
  </div> 
       <a onclick="window.location.assign('detil.user.php')" class="btn btn-primary btn-sm">Kembali</a>
      <button type="submit" class="btn btn-danger btn-sm">Hapus Data yang Dipilih</button>>
  </div>
  </div>
  </form>
<?php include "mod/footer.php"; ?>
  </div>
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="js/jquery.screwdefaultbuttonsV2.min.js"></script>
    <script type="text/javascript" src="js/simontor.js"></script>
    <script type="text/javascript">
        $('input:checkbox').screwDefaultButtons({
        image: "url(img/checkbox.jpg)",
        width: 43,
        height: 43,
        });
    </script>  

  </body>
</html>