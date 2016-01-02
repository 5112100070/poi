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
    function CheckValidator($data){
        if($data=="TRUE"){
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
    <script>
        $(document).ready(function (){
            $(document).ready(function (){
                if(document.getElementById("status_sitac").value=="gagal"){
                    document.getElementById("ket_status_sitac_proses_val").value=" ";
                    $("#ket_status_sitac").show();
                    $("#ket_status_sitac_proses").hide();
                    $("#validator").hide();
                }
                else if(document.getElementById("status_sitac").value=="pending"){
                    document.getElementById("ket_status_sitac_val").value=" ";
                    $("#ket_status_sitac_proses").show();
                    $("#ket_status_sitac").hide();
                    $("#validator").hide();
                }
                else {
                    document.getElementById("ket_status_sitac_proses_val").value=" ";
                    document.getElementById("ket_status_sitac_val").value=" ";
                    $("#ket_status_sitac_proses").hide();
                    $("#ket_status_sitac").hide();
                    $("#validator").show();
                }
            
            $("#status_sitac").change(function (){
                if(document.getElementById("status_sitac").value=="gagal"){
                    document.getElementById("ket_status_sitac_proses_val").value=" ";
                    $("#ket_status_sitac_proses").hide();
                    $("#ket_status_sitac").show();
                    $("#validator").hide();
                }
                else if(document.getElementById("status_sitac").value=="pending"){
                    document.getElementById("ket_status_sitac_val").value=" ";
                    $("#ket_status_sitac_proses").show();
                    $("#ket_status_sitac").hide();
                    $("#validator").hide();
                }
                else {
                    document.getElementById("ket_status_sitac_val").value=" ";
                    document.getElementById("ket_status_sitac_proses_val").value=" ";
                    $("#validator").show();
                    $("#ket_status_sitac").hide();
                    $("#ket_status_sitac_proses").hide();
                }
            });
            
            });
        });
    </script>
    <link rel="shortcut icon" href="fav.ico" type="image/png">
    <title>MICRO POI TELKOMSEL - Form Update SITAC</title>
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
      <form name="form1" method="POST" action="edit.sitak.process.php?witel=<?php echo $_GET['witel']; ?>&jenis=<?php echo $_GET['jenis'] ?>&site_id=<?php echo $_GET['site_id']; ?>" id="form-update">  
<?php 
$alert = "";

$sql = OCIParse($connect,"SELECT DISTINCT * FROM REPORT_DATA_DEMAND WHERE ID = '".$_GET['site_id']."'");
ociexecute($sql);
$row = oci_fetch_array($sql);
?>
<div class="container">
<div class="row">
<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-body">
<h5><strong>FORM UPDATE SITAC</strong></h5><hr />
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
        <input tipe="text" class="form-control input-sm" name="id_ws" id="alamat" value="<?php echo $row[3] ?>"/>
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
          <label class="control-label" for="mitra"><i class="fa fa-tag"></i>MITRA</label>
          <input tipe="text" class="form-control input-sm" name="mitra_ap" id="mitra" value="<?php echo $row[29] ?>" style="background-color: rgba(228, 55, 37, 0.87);"/>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="kunjungan"><i class="fa fa-tag"></i>STATUS KUNJUNGAN</label>
          <select name="kunjungan" class="form-control input-sm" id="status_kunjungan" style="background-color: rgba(228, 55, 37, 0.87);">
                <option value="tidak" <?php CekPlan("tidak", strtolower($row[55]));?>>Belum Dikunjungi</option>
                <option value="ya" <?php CekPlan("ya", strtolower($row[55])); ?>>Sudah Dikunjungi</option>
           </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="status_sitac"><i class="fa fa-tag"></i>STATUS SITAC</label>
          <select name="status_sitac" class="form-control input-sm" id="status_sitac" style="background-color: rgba(228, 55, 37, 0.87);">
                <option value=" ">-</option>
                <option value="pending" <?php CekPlan("pending", strtolower($row[18]));?>>PENDING</option>
                <option value="gagal" <?php CekPlan("gagal", strtolower($row[18])); ?>>GAGAL</option>
                <option value="ok" <?php CekPlan("ok", strtolower($row[18])); ?>>SUKSES</option>
           </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="kunjungan"><i class="fa fa-tag"></i>TANGGAL UPDATE</label>
          <input type='text' class="form-control input-sm" name="tanggal_kunjungan" id='datetimepicker1' value="<?php echo date('d/m/y'); ?>"/>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="status_tcares"><i class="fa fa-tag"></i>STATUS TCARES</label>
          <select name="status_tcares" class="form-control input-sm" style="background-color: rgba(228, 55, 37, 0.87);">
                <option value="nok" <?php CekPlan("nok", strtolower($row[17])); ?>>Belum Dapat TCARES</option>
                <option value="ok" <?php CekPlan("ok", strtolower($row[17])); ?>>Sudah Dapat TCARES</option>
           </select>
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
        <input tipe="text" class="form-control input-sm" name="nama_site" id="site_name" value="<?php echo $row[8] ?>"/>
      </div>
    </div>
</div>

<div class="row">
<div class="col-md-6">
        <div class="form-group">
          <label class="control-label" for="total_ap"><i class="fa fa-tag"></i>TOTAL AP</label>
          <input tipe="text" class="form-control input-sm" name="total_ap" id="total_ap" value="<?php echo $row[54] ?>"/>
        </div>
    </div>
</div>

<div class="row">
<div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="longitude"><i class="fa fa-magic"></i>LONGITUDE</label>
    <input tipe="number" class="form-control input-sm" name="longitude" id="longitude" value="<?php echo $row[13] ?>"/>
  </div>
</div>

<div class="col-md-6">
  <div class="form-group">
    <label class="control-label" for="latitude"><i class="fa fa-magic"></i>LATITUDE</label>
    <input tipe="number" class="form-control input-sm" name="latitude" id="latitude" value="<?php echo $row[14] ?>"/>
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
                disabled>
            <option>-</option>
            <option value="LME" <?php CekPlan("lme", strtolower($row[39])); ?>>LME</option>
            <option value="IKG" <?php CekPlan("ikg", strtolower($row[39])); ?>>IKG</option>
            <option value="Installed" <?php CekPlan("installed", strtolower($row[39])); ?> <?php CekPlan("install ap", strtolower($row[39])); ?>>Installed/Install AP</option>
            <option value="On Air" <?php CekPlan("on air", strtolower($row[39])); ?> <?php CekPlan("oa existing", strtolower($row[39])); ?> style="display: <?php
                        if(strtolower($row[39])=="proses")echo "none";
                        else echo "block";
                    ?>">On Air</option>
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
</div>

<div class="row">
    <div class="col-md-12" id="ket_status_sitac">
      <div class="form-group">
        <label class="control-label" for="ket_status_sitac"><i class="fa fa-map-marker"></i>KETERANGAN STATUS SITAC</label>
        <select name="ket_status_sitac" class="form-control input-sm" id="ket_status_sitac_val">
            <option value=" ">-</option>
            <option value="Tidak bersedia" <?php CekPlan("tidak bersedia", strtolower($row[57])); ?>>Tidak Bersedia</option>
            <option value="Site Lama Ditutup" <?php CekPlan("site lama ditutup", strtolower($row[57])); ?>>Site Lama Ditutup</option>
            <option value="Site tidak valid" <?php CekPlan("site tidak valid", strtolower($row[57])); ?>>Site Tidak Valid</option>
            <option value="Sudah Ada AP" <?php CekPlan("sudah ada ap", strtolower($row[57])); ?>>Sudah Ada AP</option>
            <option value="Sudah Ada IndiHome" <?php CekPlan("sudah ada indihome", strtolower($row[57])); ?>>Sudah Ada IndiHome</option>
            <option value="Bukan Pengambil Keputusan" <?php CekPlan("bukan pengambil keputusan", strtolower($row[57])); ?>>Bukan Pengambil Keputusan</option>
            <option value="Dan Lain-Lain" <?php CekPlan("dan lain-lain", strtolower($row[57])); ?>>Dan Lain-lain</option>
        </select>
      </div>
    </div>
    <div class="col-md-12" id="ket_status_sitac_proses">
        <div class="form-group">
            <label class="control-label" for="ket_status_sitac_proses"><i class="fa fa-map-marker"></i>KETERANGAN STATUS SITAC</label>
            <input tipe="text" class="form-control input-sm" name="ket_status_sitac_proses" id="ket_status_sitac_proses_val" value="<?php echo $row[57] ?>"/>
        </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label" for="komentar"><i class="fa carousel-indicators"></i>KOMENTAR</label>
        <textarea class="form-control input-sm" name="komentar"><?php echo $row['KOMENTAR'] ?></textarea>
      </div>
    </div>
</div>

<?php 
    $sql_validator="SELECT V_KONTRAK,V_TTD,V_MATERAI,V_JUM_AP,V_STEMPEL,V_FORM,V_KTP FROM POI_VALIDATOR WHERE ID='".$_GET['site_id']."'";
    $result_validator=oci_parse($connect, $sql_validator);
    oci_execute($result_validator);
    $row_validator=  oci_fetch_array($result_validator);
?>
<div class="row" id="validator">
    <div class="col-md-12" id="validasi">
        <div class="form-group">
            <label class="control-label"><i class="fa fa-gear"></i>VALIDASI SITAC</label>
            <br><input type="checkbox" name="v_kontrak" value="TRUE" <?php CheckValidator($row_validator[0]); ?>> <strong>Valid Masa Kontrak</strong><br>
            <input type="checkbox" name="v_ttd" value="TRUE" <?php CheckValidator($row_validator[1]); ?>> <strong>Valid Tanda Tangan Kedua Belah Pihak</strong><br>
            <input type="checkbox" name="v_materai" value="TRUE" <?php CheckValidator($row_validator[2]); ?>> <strong>Valid Ada Materai</strong><br>
            <input type="checkbox" name="v_jml_ap" value="TRUE" <?php CheckValidator($row_validator[3]);?>> <strong>Valid Jumlah AP</strong><br>
            <input type="checkbox" name="v_stempel" value="TRUE" <?php CheckValidator($row_validator[4]); ?>> <strong>Valid Stempel</strong><br>
            <input type="checkbox" name="v_form" value="TRUE" <?php CheckValidator($row_validator[5]); ?>> <strong>Memakai Form Standar</strong><br>
            <input type="checkbox" name="v_ktp" value="TRUE" <?php CheckValidator($row_validator[6]); ?>> <strong>Valid FotoCopy KTP</strong><br>
        </div>
    </div>
</div>
    
<div class="row">
<div class="col-md-12">  
  <div class="form-group">
        <input type="submit" class="btn btn-danger btn-sm" value="UPDATE DATA" id="but-update">
        <a onclick="window.location.href='detil.sitak.php?witel=<?php echo $_GET['witel']; ?>&jenis=<?php echo $_GET['jenis']; ?>&tgl=<?php echo date('d-m-y') ?>'" class="btn btn-primary btn-sm" 
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
    <script src="js/simontor.js"></script>
    <script src="js/map.simontor.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js" type="text/javascript"></script>
    
        <script type="text/javascript">
            //Function Area
            $(function () {
                $('#datetimepicker1').datetimepicker({locale: 'id', format: 'DD/MM/YYYY'});
                //$('#datetimepicker2').datetimepicker({locale: 'id', format: 'DD/MM/YYYY'});
                });
                <?php include './func/conf.standar.map.php'; ?>
                if(isFinite(latitude)&&isFinite(longitude))
                    google.maps.event.addDomListener(window,'load',initialize_map_sitac(latitude,longitude));
                else {
                    $('#map_sitac img').css("display","inline");
                    $('#briefing_map').css("display","none");
                }
            //End of Function Area    
        </script>    

<script>
function goBack() {
    window.history.back();
}
</script>

  </body>
</html>