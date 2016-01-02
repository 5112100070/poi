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
    <title>MICRO POI TELKOMSEL - Form Input Data</title>
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
      <form name="form1" method="POST" action="input.potensi.process.php" id="form-update">  
<div class="container">
<div class="row">
<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-body">
<h5><strong>FORM INPUT DATA</strong></h5><hr />
<div class="row">
<?php 
if(!empty($_GET['status_input'])){
    if($_GET['status_input']==1)
        $alert = "<div id =\"error\" class=\"col-md-12\"><div class=\"form-group\"><div class=\"alert alert-dismissable alert-success\" style=\"background-color: green;\">
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
              <strong>SUKSES!</strong> DATA BERHASIL DIUPDATE !
              </div></div></div>";
    else if($_GET['status_input']==-1)
        $alert = "<div id =\"error\" class=\"col-md-12\"><div class=\"form-group\"><div class=\"alert alert-dismissable alert-success\" style=\"background-color: red;\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
            <strong>GAGAL!</strong> DATA GAGAL DIINPUT, ID GANDA !
            </div></div></div>";
}
else $alert="";
echo $alert;

?>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label" for="id"><i class="fa fa-map-marker"></i>ID</label>
        <input tipe="text" class="form-control input-sm" name="id" value="<?php echo $id=uniqid($prefix = "",$more_entropy = false); ?>"/>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label" for="id_ws"><i class="fa fa-map-marker"></i>ID WS</label>
        <input tipe="text" class="form-control input-sm" name="id_ws"/>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="id_site"><i class="fa fa-sitemap"></i>SITE ID</label>
        <input tipe="text" class="form-control input-sm" name="id_site"/>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="nama_site"><i class="fa fa-homer"></i>SITE NAME</label>
        <input tipe="text" class="form-control input-sm" name="nama_site"/>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="longitude"><i class="fa fa-location-arrow"></i>LONGITUDE</label>
        <input type="number" class="form-control input-sm" name="longitude" step="0.001"/>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="nama_site"><i class="fa fa-location-arrow"></i>LATITUDE</label>
        <input type="number" class="form-control input-sm" name="latitude" step="0.001"/>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="alamat"><i class="fa carousel-indicators"></i>ALAMAT</label>
        <input type="text" class="form-control input-sm" name="alamat"/>
      </div>
    </div>
</div>
<div class="row">
<div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="witel"><i class="fa fa-tag"></i>WITEL</label>
          <select class="form-control input-sm" name="witel">
              <option value="MALANG">MALANG</option>
              <option value="SIDOARJO">SIDOARJO</option>
              <option value="JEMBER">JEMBER</option>
              <option value="SURABAYA">SURABAYA</option>
              <option value="PASURUAN">PASURUAN</option>
              <option value="DENPASAR">DENPASAR</option>
              <option value="GRESIK">GRESIK</option>
              <option value="MATARAM">MATARAM</option>
          </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="mitra"><i class="fa fa-tag"></i>MITRA</label>
          <input tipe="text" class="form-control input-sm" name="mitra_ap" id="mitra""/>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="prioritas"><i class="fa fa-tag"></i>PRIORITAS</label>
            <select name="prioritas" class="form-control input-sm">
                <option value="-">-</option>
                <option value="Prio-1">Prio-1</option>
                <option value="Prio-2">Prio-2</option>
                <option value="Prio-3">Prio-3</option>
                <option value="Prio-4">Prio-4</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="status_data"><i class="fa fa-tag"></i>STATUS POTENSI/STATUS DATA</label>
          <select name="status_data" class="form-control input-sm">
            <option value="-">-</option>
            <option value="Verified">Verified</option>
            <option value="Rejected">Rejected</option>
        </select>
        </div>
    </div>
</div>
<div class="row">
<div class="col-md-12">  
  <div class="form-group">
        <input type="submit" class="btn btn-danger btn-sm" value="SUBMIT DATA" id="but-update">
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
           
        <script type="text/javascript">
            //Function Area
            $(function () {
                $('#datetimepicker1').datetimepicker({locale: 'id', format: 'DD/MM/YYYY'});
                //$('#datetimepicker2').datetimepicker({locale: 'id', format: 'DD/MM/YYYY'});
                });
            //End of Function Area    
        </script>    

<script>
function goBack() {
    window.history.back();
}
</script>

  </body>
</html>