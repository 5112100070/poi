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
          <input tipe="text" class="form-control input-sm" name="mitra" id="mitra" value="<?php echo $row[29] ?>"/>
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
        <input tipe="text" class="form-control input-sm" name="site_name" id="site_name" value="<?php echo $row[8] ?>" disabled/>
      </div>
    </div>
</div>

<div class="row">
<div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="longitude"><i class="fa fa-magic"></i>LONGITUDE</label>
    <input tipe="number" class="form-control input-sm" name="longitude" id="longitude" value="<?php echo $row[13] ?>" disabled/>
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="latitude"><i class="fa fa-magic"></i>LATITUDE</label>
    <input tipe="number" class="form-control input-sm" name="latitude" id="latitude" value="<?php echo $row[14] ?>" disabled/>
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
                        echo " disabled";
                    }
                ?>
                >
            <option value="On Air" <?php CekPlan("on air", strtolower($row[39])); ?> <?php CekPlan("oa existing", strtolower($row[39])); ?> style="display: <?php
                        if(strtolower($row[39])=="proses")echo "none";
                        else echo "block";
                    ?>">On Air</option>
            <option value="Installed" <?php CekPlan("installed", strtolower($row[39])); ?> <?php CekPlan("install ap", strtolower($row[39])); ?>>Installed</option>
            <option value="Proses" <?php CekPlan("proses", strtolower($row[39])); ?> style="display: <?php
                        if(strtolower($row[39])=="hold" || strtolower($row[39])=="cancel" || strtolower($row[39])=="on air" || strtolower($row[39])=="installed" || strtolower($row[39])=="install ap")echo "none";
                        else echo "block";
                    ?>
                    ">Proses</option>
            <option value="Cancel" <?php CekPlan("cancel", strtolower($row[39])); ?>>Cancel</option>
            <option value="Hold" <?php CekPlan("hold", strtolower($row[39])); ?>>Hold</option>
        </select>
      </div>
    </div>  
    
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label" for="keterangan_status_data"><i class="fa fa-gear"></i>KETERANGAN STATUS DATA</label>
        <select name="keterangan_status_data" class="form-control input-sm" id="keterangan_status_data">
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
        <input tipe="text" class="form-control input-sm" name="total_ap" id="total_ap" value="<?php echo $row[55] ?>"/>
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
<div class="panel panel-default">
<div class="panel-body">
<h5><strong>DETIL SITAC</strong></h5><hr/>
<table class="table table-condensed">
    <tr>
      <td width="30%"><strong>ALPROID STATUS</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[1]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>IS_STATIONARY</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[2]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>ID WS</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[3]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>SHIP TO PARTY</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[4]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>STO</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[5]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>ID SITE</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[6]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>SITE</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[7]; ?></td>
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
      <td width="30%"><strong>NAMA PIC</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[11]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>TELEPON PIC</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[12]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>LONGITUDE</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[13]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>LATITUDE</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[14]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>TOTAL AP</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[15]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>PROGRAM</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[16]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>SUB PROGRAM</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[17]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>STATUS TCARES</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[18]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>STATUS SITAC</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[19]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>FILE SITAC</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[20]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>USER DEMAND</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[21]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>INPUT DEMAND</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[22]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>AKSES</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[23]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>TIPE AKSES</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[24]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>MITRA AKSES</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[25]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>USER AKSES</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[26]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>INPUT AKSES</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[27]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>STATUS WITEL</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[28]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>TIPE AP</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[29]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>MITRA AP</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[30]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>BATCH</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[31]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>STATUS AP</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[32]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>PRIORITAS</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[33]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>STATUS DATA</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[34]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>KETERANGAN STATUS DATA</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[35]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>TANGGAL SITAC</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[36]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>TANGGAL BERAKHIR SITAC</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[37]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>SKEMA BISNIS</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[38]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>STATUS CONSTRUCTION</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[39]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>STATUS PROJECT</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[40]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>KET OA EXISTING</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[41]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>JUM AP</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[42]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>AP INSTALL</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[43]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>AP ON AIR</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[44]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>TIPE AP2</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[45]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>TANGGAL PO</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[46]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>MITRA AP3</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[47]; ?></td>
    </tr>
    <tr>
      <td width="30%"><strong>BATCH 4</strong></td>
      <td width="1%">:</td>
      <td><?php echo $row[48]; ?></td>
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
           
        <script type="text/javascript">
            //Function Area
            function Drop_StatConsJatim(){
                if(document.getElementById("status_cons_jatim").value=="Proses"){
                        $("#keterangan_status_data").show();
                        $(".proses").show();
                        $(".cancel").hide();
                    }
                    else if(document.getElementById("status_cons_jatim").value=="Cancel"){
                        $("#keterangan_status_data").show();
                        $(".cancel").show();
                        $(".proses").hide();
                    }
                    else{
                        document.getElementById("keterangan_status_data").value="-";
                        $("#keterangan_status_data").hide();
                    }
            }
            $(function () {
                $('#datetimepicker1').datetimepicker({locale: 'id', format: 'DD/MM/YYYY'});
                $('#datetimepicker2').datetimepicker({locale: 'id', format: 'DD/MM/YYYY'});
                });
            //End of Function Area    
                
            $(document).ready(function (){
                Drop_StatConsJatim();
                $("#status_cons_jatim").change(function (){                             //Status Cons Jatim Kontroller
                    Drop_StatConsJatim();
                });
            });
        </script>    

<script>
function goBack() {
    window.history.back();
}
</script>

  </body>
</html>