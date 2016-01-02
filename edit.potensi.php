<?php 
session_start();
if(empty($_SESSION['privilege']))
{
  echo "<script language=javascript>
              parent.location.href='login.php';
        </script>";
}
else if($_SESSION['privilege']=='guest' || $_SESSION['privilege']==2)
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
      <form name="form1" method="POST" action="edit.potensi.process.php?witel=<?php echo $_GET['witel']; ?>&site_id=<?php echo $_GET['site_id']; ?>" id="form-update">  
<?php 
$alert = "";

$sql = OCIParse($connect,"SELECT * FROM REPORT_DATA_DEMAND WHERE ID = '".$_GET['site_id']."'");
ociexecute($sql);
$row = oci_fetch_array($sql);
?>
<div class="container">
<div class="row">
<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-body">
<h5><strong>FORM UPDATE PROGRESS DEPLOYMENT</strong></h5><hr />
<div class="row">
<?php 
if(!empty($_GET['status_update'])){
    if($_GET['status_update']==1)
        $alert = "<div id =\"error\" class=\"col-md-12\"><div class=\"form-group\"><div class=\"alert alert-dismissable alert-success\" style=\"background-color: green;\">
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
              <strong>SUKSES!</strong> DATA BERHASIL DIUPDATE !
              </div></div></div>";
    else $alert = "<div id =\"error\" class=\"col-md-12\"><div class=\"form-group\"><div class=\"alert alert-dismissable alert-success\" style=\"background-color: red;\">
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
              <strong>SUKSES!</strong> DATA GAGAL DIUPDATE !
              </div></div></div>";
echo $alert;
}
?>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label" for="id"><i class="fa fa-map-marker"></i>ID TSEL</label>
        <input tipe="text" class="form-control input-sm" name="id" id="alamat" value="<?php echo $row[0] ?>" disabled/>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label" for="id_ws"><i class="fa fa-map-marker"></i>ID WS</label>
        <input tipe="text" class="form-control input-sm" name="id_ws" value="<?php echo $row[3] ?>"/>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="site_id"><i class="fa fa-map-marker"></i>SITE ID</label>
        <input tipe="text" class="form-control input-sm" name="site_id" id="alamat" value="<?php echo $row[6] ?>"/>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="site_name"><i class="fa fa-book"></i>NAMA SITE</label>
        <input tipe="text" class="form-control input-sm" name="nama_site" id="nama_site" value="<?php echo $row[8] ?>" />
      </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="total_ap"><i class="fa fa-tag"></i>TOTAL AP</label>
          <input tipe="text" class="form-control input-sm" name="total_ap" value="<?php echo $row['TOTAL_AP'] ?>"/>
        </div>
    </div>
</div>
<div class="row">
<div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="longitude"><i class="fa fa-magic"></i>LONGITUDE</label>
    <input tipe="number" class="form-control input-sm" name="longitude" id="longitude" value="<?php echo $row[13] ?>" />
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="latitude"><i class="fa fa-magic"></i>LATITUDE</label>
    <input tipe="number" class="form-control input-sm" name="latitude" id="latitude" value="<?php echo $row[14] ?>" />
  </div>
</div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="witel"><i class="fa fa-tag"></i>WITEL</label>
          <select class="form-control input-sm" name="witel">
              <option value="MALANG" <?php CekPlan("MALANG", $row['WITEL']); ?>>MALANG</option>
              <option value="SIDOARJO" <?php CekPlan("SIDOARJO", $row['WITEL']); ?>>SIDOARJO</option>
              <option value="JEMBER" <?php CekPlan("JEMBER", $row['WITEL']); ?>>JEMBER</option>
              <option value="SURABAYA" <?php CekPlan("SURABAYA", $row['WITEL']); ?>>SURABAYA</option>
              <option value="PASURUAN" <?php CekPlan("PASURUAN", $row['WITEL']); ?>>PASURUAN</option>
              <option value="DENPASAR" <?php CekPlan("DENPASAR", $row['WITEL']); ?>>DENPASAR</option>
              <option value="GRESIK" <?php CekPlan("GRESIK", $row['WITEL']); ?>>GRESIK</option>
              <option value="MATARAM" <?php CekPlan("MATARAM", $row['WITEL']); ?>>MATARAM</option>
          </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="kunjungan"><i class="fa fa-tag"></i>STATUS KUNJUNGAN</label>
          <select name="kunjungan" class="form-control input-sm" id="status_kunjungan" style="background-color: rgba(228, 55, 37, 0.87);">
                <option value="tidak" <?php CekPlan("tidak", strtolower($row['KUNJUNGAN']));?>>Belum Dikunjungi</option>
                <option value="ya" <?php CekPlan("ya", strtolower($row['KUNJUNGAN'])); ?>>Sudah Dikunjungi</option>
           </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="prioritas"><i class="fa fa-tag"></i>PRIORITAS</label>
          <select name="prioritas" class="form-control input-sm">
            <option value="-">-</option>
            <option value="Prio-1" <?php CekPlan("prio-1", strtolower($row[32])); ?>>Prio-1</option>
            <option value="Prio-2" <?php CekPlan("prio-2", strtolower($row[32])); ?>>Prio-2</option>
            <option value="Prio-3" <?php CekPlan("prio-3", strtolower($row[32])); ?>>Prio-3</option>
            <option value="Prio-4" <?php CekPlan("prio-4", strtolower($row[32])); ?>>Prio-4</option>
        </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="status_data"><i class="fa fa-tag"></i>STATUS POTENSI/STATUS DATA</label>
          <select name="status_data" class="form-control input-sm">
            <option value="-">-</option>
            <option value="Verified" <?php CekPlan("verified", strtolower($row[33])); ?>>Verified</option>
            <option value="Rejected" <?php CekPlan("rejected", strtolower($row[33])); ?>>Rejected</option>
        </select>
        </div>
    </div>
    <div class="col-md-6" style="display: none;">
        <div class="form-group">
          <label class="control-label" for="kunjungan"><i class="fa fa-tag"></i>TANGGAL UPDATE</label>
          <input type='text' class="form-control input-sm" name="tanggal_kunjungan" id='datetimepicker1' value="<?php echo date('d/m/y'); ?>"/>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="status_indihome"><i class="fa fa-tag"></i>INDIHOME</label>
          <select id="status_indihome" class="form-control input-sm" name="status_indihome">
              <option value="NO" <?php CekPlan("NO", $row['STATUS_INDIHOME']); ?>>Bukan INDIHOME</option>
              <option value="YES" <?php CekPlan("YES",$row['STATUS_INDIHOME']); ?>>INDIHOME</option>
          </select>
        </div>
    </div>
    <div class="col-md-6" id="no_indihome">
      <div class="form-group">
        <label class="control-label" for="no_indihome"><i class="fa carousel-indicators"></i>NOMOR INDIHOME</label>
        <input type="text" class="form-control input-sm" name="no_indihome" value="<?php echo $row['NO_INDIHOME'] ?>"/>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label" for="komentar"><i class="fa carousel-indicators"></i>KOMENTAR</label>
        <textarea class="form-control input-sm" name="komentar"><?php echo $row['KOMENTAR'] ?></textarea>
      </div>
    </div>
</div>
<div class="row">
<div class="col-md-12">  
  <div class="form-group">
        <input type="submit" class="btn btn-danger btn-sm" value="UPDATE DATA" id="but-update">
        <a onclick="window.location.href='detil.potensi.php?witel=<?php echo $_GET['witel']; ?>'" class="btn btn-primary btn-sm" 
           style="display: <?php 
                if($_GET['witel']=="NULL" && $_GET['jenis']=="NULL")echo "none";
                else echo 'display';
           ?>">Kembali</a>
  </div>
</div>
</div>
</div>
</div> 
</div>
<div class="col-md-6">
    <div class="col-md-12">
        <ul id="detil_data" class="nav nav-tabs">
            <li><a id="detil_sitac" href="#">Detil SITAC</a></li>
            <li class="active"><a id="detil_map" href="#">Map Location</a></li>
        </ul>
    </div>
    <div id="detil-container" class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
            <h5><strong>DETIL SITAC</strong></h5><hr/>
            <table class="table table-condensed">
                <tr>
                  <td width="30%"><strong>ID TSEL</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[58]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>ID SITE</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[6]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>NAMA SITE</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[8]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>ALAMAT</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[9]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>WITEL</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[10]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>LONGITUDE</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row['LONGITUDE']; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>LATITUDE</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row['LATITUDE']; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>STATUS DATA</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[33]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>PRIORITAS</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[32]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>KUNJUNGAN</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[55]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>STATUS SITAC</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[18]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>KETERANGAN STATUS SITAC</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[57]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>MITRA AP</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[29]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>STATUS TCARES</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[17]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>STATUS PROJECT</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[39]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>KETERANGAN STATUS DATA</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[34]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>JUMLAH AP</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[41]; ?></td>
                </tr>
            </table>
            </div>
        </div>
    </div>
    <div id="map-container" class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
            <h5><strong>DENAH LOKASI</strong></h5><hr/>
            <div id="map_sitac" class="col-lg-12" style="height: 320px;">
                <img src="img/NoDataAvailable.png" style="display:none;height: 100%;width: 100%;">
            </div>
            </div>
        </div>
        <a id="briefing_map" href="#" class="btn btn-default">Detail Map</a>
    </div>
</div>
</div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                <h5><strong>Keterangan Syarat</strong></h5><hr/>
                    <table class="table table-condensed">
                        <tr>
                            <td width="70%">Syarat POTENSI (STATUS DATA = <strong>Verified</strong> dan PRIORITAS = <strong>Prio-1 s/d Prio-4)</strong></td>
                        </tr>
                        <tr>
                          <td width="30%">STATUS DATA (Saat Ini)</td>
                          <td width="1%">:</td>
                          <td><?php echo $row[33]; ?></td>
                        </tr>
                        <tr>
                          <td width="30%">PRIORITAS (Saat Ini)</td>
                          <td width="1%">:</td>
                          <td><?php echo $row[32]; ?></td>
                        </tr>
                        
                        <tr><td></td></tr>
                        <tr>
                            <td width="70%">Syarat VISITED (<strong>POTENSI</strong> dan KUNJUNGAN = <strong>Ya</strong></td>
                        </tr>
                        <tr>
                          <td width="30%">KUNJUNGAN (Saat Ini)</td>
                          <td width="1%">:</td>
                          <td><?php echo $row[55]; ?></td>
                        </tr>
                        
                        <tr><td></td></tr>
                        <tr>
                            <td width="70%">Syarat SUCCESS SITAC (<strong>VISITED</strong> dan STATUS SITAC = <strong>Ok</strong></td>
                        </tr>
                        <tr>
                          <td width="30%">STATUS SITAC (Saat Ini)</td>
                          <td width="1%">:</td>
                          <td><?php echo $row[18]; ?></td>
                        </tr>
                        
                       <tr><td></td></tr>
                        <tr>
                            <td width="70%">Syarat UPLOAD WS (<strong>SUCCESS SITAC</strong> dan KETERANGAN STATUS SITAC = <strong>Valid</strong></td>
                        </tr>
                        <tr>
                          <td width="30%">KETERANGAN STATUS SITAC (Saat Ini)</td>
                          <td width="1%">:</td>
                          <td><?php echo $row[57]; ?></td>
                        </tr>
                        
                       <tr><td></td></tr>
                        <tr>
                            <td width="70%">Syarat PO (<strong>UPLOAD WS</strong> dan MITRA AP <strong>Sudah Terisi</strong></td>
                        </tr>                        
                        <tr>
                          <td width="30%"><strong>MITRA AP (Saat Ini)</strong></td>
                          <td width="1%">:</td>
                          <td><?php echo $row[29]; ?></td>
                        </tr>
                        
                        <tr><td></td></tr>
                        <tr>
                            <td width="70%">Syarat INPUT TCARES (<strong>PO</strong> dan STATUS TCARES = <strong>Ok</strong></td>
                        </tr>   
                        <tr>
                          <td width="30%"><strong>STATUS TCARES (Saat Ini)</strong></td>
                          <td width="1%">:</td>
                          <td><?php echo $row[17]; ?></td>
                        </tr>
                        
                        <tr><td></td></tr>
                        <tr>
                            <td width="70%">Syarat ON AIR (<strong>PO</strong> dan STATUS PROJECT = <strong>On Air</strong></td>
                        </tr>                           
                        <tr>
                          <td width="30%"><strong>STATUS PROJECT (Saat Ini)</strong></td>
                          <td width="1%">:</td>
                          <td><?php echo $row[39]; ?></td>
                        </tr>
                    </table>
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
    <script src="js/simontor.js"></script>
    <script src="js/map.simontor.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js" type="text/javascript"></script>
           
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({locale: 'id', format: 'DD/MM/YYYY'});
                $('#datetimepicker2').datetimepicker({locale: 'id', format: 'DD/MM/YYYY'});
                });
                <?php include './func/conf.standar.map.php'; ?>
                if(isFinite(latitude)&&isFinite(longitude))
                    google.maps.event.addDomListener(window,'load',initialize_map_sitac(latitude,longitude));
                else {
                    $('#map_sitac img').css("display","inline");
                    $('#briefing_map').css("display","none");
                }
        </script>    

<script>
function goBack() {
    window.history.back();
}
</script>

  </body>
</html>