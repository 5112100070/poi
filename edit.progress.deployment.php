<?php 
session_start();
if(empty($_SESSION['privilege']))
{
  echo "<script language=javascript>
              parent.location.href='login.php';
        </script>";
}
else if($_SESSION['privilege']==1 || $_SESSION['privilege']=='guest')
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
    function CekPlan_Checked($data,$data2){
        if($data==$data2){
            echo "checked";
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
    <title>MICRO POI TELKOMSEL - Form Update Progress Deployment</title>
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
      <form name="form1" method="POST" action="edit.progress.deployment.process.php?witel=<?php echo $_GET['witel']; ?>&jenis=<?php echo $_GET['jenis'] ?>&site_id=<?php echo $_GET['site_id']; ?>" id="form-update">  
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
        <label class="control-label" for="id"><i class="fa fa-map-marker"></i>ID</label>
        <input tipe="text" class="form-control input-sm" name="id" id="alamat" value="<?php echo $row[0] ?>" disabled/>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label" for="id_ws"><i class="fa fa-map-marker"></i>ID WS</label>
        <input tipe="text" class="form-control input-sm" name="id_ws" id="alamat" value="<?php echo $row[3] ?>" 
               <?php
                    if($_SESSION['privilege']!=1){
                        echo "disabled";
                    }
               ?>
               />
      </div>
    </div>
</div>
<div class="row">
<div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="witel"><i class="fa fa-tag"></i>WITEL</label>
          <input tipe="text" class="form-control input-sm" name="witel" id="site_id" value="<?php echo $row[10] ?>" disabled/>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="mitra"><i class="fa fa-tag"></i>MITRA</label>
          <select name="mitra" class="form-control input-sm">
            <option value="<?php echo $row[29]; ?>"><?php echo $row[29]; ?></option>
            <option value="Partnership CISCO" <?php CekPlan("partnership cisco", strtolower($row[29])); ?>>PARTNERSHIP CISCO</option>
            <option value="PT.HUAWEI" <?php CekPlan("pt.huawei", strtolower($row[29])); ?>>PT.HUAWEI</option>
            <option value="PT.PINS" <?php CekPlan("pt.pins", strtolower($row[29])); ?>>PT.PINS</option>
            <option value="SWAKELOLA TELKOM" <?php CekPlan("swakelola telkom", strtolower($row[29])); ?>>SWAKELOLA TELKOM</option>
        </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="site_id"><i class="fa fa-map-marker"></i>SITE ID</label>
        <input tipe="text" class="form-control input-sm" name="site_id" id="alamat" value="<?php echo $row['ID_SITE'] ?>"/>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label" for="site_name"><i class="fa fa-book"></i>NAMA SITE</label>
        <input tipe="text" class="form-control input-sm" name="nama_site" id="nama_site" value="<?php echo $row['NAMA_SITE'] ?>"/>
      </div>
    </div>
</div>

<div class="row">
<div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="longitude"><i class="fa fa-magic"></i>LONGITUDE</label>
    <input tipe="number" class="form-control input-sm" name="longitude" id="longitude" value="<?php echo $row['LONGITUDE'] ?>" disabled/>
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="latitude"><i class="fa fa-magic"></i>LATITUDE</label>
    <input tipe="number" class="form-control input-sm" name="latitude" id="latitude" value="<?php echo $row['LATITUDE'] ?>" disabled/>
  </div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label" for="status_cons_jatim"><i class="fa fa-gear"></i>STATUS PROJECT</label>
        <select name="status_cons_jatim" class="form-control input-sm" id="status_cons_jatim"
                <?php
                    if(strtolower($row[39])=="on air" || strtolower($row[39])=="oa existing"){
                        //echo " disabled";
                    }
                ?>
                >
            <option value="Survey" <?php CekPlan("survey", strtolower($row[39])); ?>>Survey</option>
            <!--<option value="LME" <?php CekPlan("lme", strtolower($row[39])); ?>>LME</option>-->
            <option value="Installed" <?php CekPlan("installed", strtolower($row[39])); ?> <?php CekPlan("install ap", strtolower($row[39])); ?>>Installed/Install AP</option>
            <option value="On Air" id="on_air" <?php CekPlan("on air", strtolower($row[39])); ?> <?php CekPlan("oa existing", strtolower($row[39])); ?>>On Air</option>
            <option value="Drop" <?php CekPlan("drop", strtolower($row[39])); ?>>Drop</option>
            <option value="Hold" <?php CekPlan("hold", strtolower($row[39])); ?>>Hold</option>
        </select>
      </div>
    </div>  
    
    <div class="col-md-12" id="keterangan_status_data">
      <div class="form-group">
        <label class="control-label" for="keterangan_status_data"><i class="fa fa-gear"></i>KETERANGAN STATUS DATA</label>
        <select name="keterangan_status_data" class="form-control input-sm">
            <option value="-">-</option>
            <option value="Survey" <?php CekPlan("survey", strtolower($row[34])); ?> class="proses">Survey</option>
            <option value="Belum Survey" <?php CekPlan("belum survey", strtolower($row[34])); ?> class="proses">Belum Survey</option>
            <option value="Site tidak valid" <?php CekPlan("site tidak valid", strtolower($row[34])); ?> class="cancel">Site Tidak Valid</option>
            <option value="Duplikat" <?php CekPlan("duplikat", strtolower($row[34])); ?> class="cancel">Duplikat</option>
            <option value="lain-lain" <?php CekPlan("lain-lain", strtolower($row[34])); ?> class="cancel">lain-lain</option>
            <option value="Reject Customer" <?php CekPlan("reject customer", strtolower($row[34])); ?> class="cancel">Reject Customer</option>
        </select>
      </div>
    </div>  
</div>
<div class="row">
    <div class="col-md-6" style="display: 
               <?php
                    if(strtolower($row[39])=='on air' || strtolower($row[39])=='installed' || strtolower($row[39])=='oa existing' || strtolower($row[39])=='install ap'){
                        echo "block";
                    }
                    else echo "none";
               ?>
               ">
      <div class="form-group">
        <label class="control-label" for="total_ap"><i class="fa fa-map-marker"></i>TOTAL AP</label>
        <input tipe="text" class="form-control input-sm" name="total_ap" id="total_ap" value="<?php echo $row[54] ?>"/>
      </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label"><i class="fa fa-gear"></i>STATUS LME</label>
            <br><input type="checkbox" name="status_lme" value="OK" id="status_lme" <?php CekPlan_Checked("ok",  strtolower($row[59])); ?>> <strong>LME (ONT Terpasang)</strong><br>
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
        <a onclick="window.location.href='detil.progress.deployment.php?witel=<?php echo $_GET['witel']; ?>&jenis=<?php echo $_GET['jenis']; ?>'" class="btn btn-primary btn-sm" 
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
                  <td><?php echo $row[14]; ?></td>
                </tr>
                <tr>
                  <td width="30%"><strong>LATITUDE</strong></td>
                  <td width="1%">:</td>
                  <td><?php echo $row[15]; ?></td>
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
            //Function Area
            function Drop_StatConsJatim(){
                if(document.getElementById("status_cons_jatim").value=="proses"){
                        $("#keterangan_status_data").show();
                        $(".proses").show();
                        $(".cancel").hide();
                    }
                    else if(document.getElementById("status_cons_jatim").value=="Drop"){
                        $("#keterangan_status_data").show();
                        $(".cancel").show();
                        $(".proses").hide();
                    }
                    else{
                        document.getElementById("keterangan_status_data").value="-";
                        $("#keterangan_status_data").hide();
                    }
            }
            function LME_Check(){
                if(document.getElementById("status_lme").checked)
                        $("#on_air").show();
                    else
                        $("#on_air").hide();
            }
            $(function () {
                $('#datetimepicker1').datetimepicker({locale: 'id', format: 'DD/MM/YYYY'});
                $('#datetimepicker2').datetimepicker({locale: 'id', format: 'DD/MM/YYYY'});
                });
                
            //End of Function Area    
                
            $(document).ready(function (){
                LME_Check();
                Drop_StatConsJatim();
                $("#status_cons_jatim").change(function (){                             //Status Cons Jatim Kontroller
                    Drop_StatConsJatim();
                });
                $("#status_lme").change(function (){
                    LME_Check();
                });
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