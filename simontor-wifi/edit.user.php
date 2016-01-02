<?php 
session_start();
if(empty($_SESSION['privilege']))
{
  echo "<script language=javascript>
              parent.location.href='login.php';
        </script>";
}
else if($_SESSION['privilege']=='guest')
{
  echo "<script language=javascript>
              parent.location.href='unknown.php';
        </script>";
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
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>
    <link rel="shortcut icon" href="fav.ico" type="image/png">
    <title>MICRO POI TELKOMSEL - Form Update Potensi Order</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">

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
      ?>
      <form name="form1" method="POST" action="edit.user.process.php?NIK=<?php echo $_GET['NIK']; ?>" id="form-update">  
<?php 
$alert = "";

$sql = OCIParse($connect,"SELECT * FROM LOGIN WHERE NIK = '".$_GET['NIK']."'");
ociexecute($sql);
$row = oci_fetch_array($sql);
?>
<div class="container">
<div class="row">
<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-body">
<h5><strong>FORM UPDATE USER</strong></h5><hr />
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
      <div class="form-group">
        <label class="control-label" for="nik"><i class="fa fa-map-marker"></i>NIK</label>
        <input tipe="text" class="form-control input-sm" name="nik" value="<?php echo $row['NIK'] ?>" disabled/>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label" for="nama"><i class="fa fa-map-marker"></i>NAMA</label>
        <input tipe="text" class="form-control input-sm" name="nama" value="<?php echo $row['NAMA'] ?>"/>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="jabatan"><i class="fa fa-map-marker"></i>JABATAN</label>
        <input tipe="text" class="form-control input-sm" name="jabatan" value="<?php echo $row['JABATAN'] ?>"/>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="privilege"><i class="fa fa-book"></i>PRIVILEGE</label>
        <select name="privilege" class="form-control input-sm">
            <option value="-">-</option>
            <option value="8" <?php CekPlan("8", strtolower($row['PRIVILEGE'])); ?>>Admin</option>
            <option value="1" <?php CekPlan("1", strtolower($row['PRIVILEGE'])); ?>>Wholesale</option>
            <option value="2" <?php CekPlan("2", strtolower($row['PRIVILEGE'])); ?>>ROC</option>
        </select>
      </div>
    </div>
</div>
<div class="row">
<div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="witel"><i class="fa fa-magic"></i>WITEL</label>
    <input tipe="text" class="form-control input-sm" name="witel" value="<?php echo $row['WITEL'] ?>"/>
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="telp"><i class="fa fa-magic"></i>TELEPON</label>
    <input tipe="number" class="form-control input-sm" name="no_telp" value="<?php echo $row['NO_TELP'] ?>"/>
  </div>
</div>
</div>
<div class="row">
<div class="col-md-12">  
  <div class="form-group">
        <input type="submit" class="btn btn-danger btn-sm" value="UPDATE DATA" id="but-update">
        <a onclick="window.location.href='detil.user.php'" class="btn btn-primary btn-sm">Kembali</a>
  </div>
</div>
</div>
</div>
</div> 
</div>
</div>
<?php include "mod/footer.php"; ?>

  </div>
</form>  
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>           
<script>
function goBack() {
    window.history.back();
}
</script>

  </body>
</html>