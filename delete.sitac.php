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
include './func/indihome.list.php';
if($_GET['witel']=='all'){
    $witel="WITEL IS NOT NULL ";
}
else{
    $witel= "WITEL='".$_GET['witel']."' ";
}
if($_GET['before_page']=='potensi'){
    $sql_to_parse="SELECT ID,ID_WS,ID_SITE,NAMA_SITE,ALAMAT,STATUS_DATA,STATUS_INDIHOME,PRIORITAS,KOMENTAR"
        . " FROM REPORT_DATA_DEMAND WHERE ".$witel." ".$tipe_site
        ."ORDER BY WITEL";
    $url_method="delete.sitac.process.php?witel=".$_GET['witel']."&tipe_site=".$_GET['tipe_site']."&before_page=".$_GET['before_page'];
}
else if($_GET['before_page']=='sitac'){
    include "func/sitac.logic.list.php";
    include "func/sitac.logic.var.php";
    include './func/indihome.list.php';
    $sql_to_parse="SELECT ID,WITEL,ID_SITE,NAMA_SITE,ALAMAT,STATUS_SITAC,MITRA_AP,STATUS_DATA,KET_STATUS_SITAC,ID_WS,KOMENTAR"
        . " FROM ".$table." WHERE ".$witel." AND (".$jenis.") ".$tipe_site
        ."ORDER BY PRIORITAS";
    $url_method="delete.sitac.process.php?witel=".$_GET['witel']."&tipe_site=".$_GET['tipe_site']."&before_page=".$_GET['before_page']."&jenis=".$_GET['jenis'];
}
else if($_GET['before_page']=='deployment'){
    include './func/progress.deployment.list.php';
    include './func/indihome.list.php';
    $sql_to_parse="SELECT ID,WITEL,ID_SITE,NAMA_SITE,ALAMAT,PRIORITAS,MITRA_AP,STATUS_CONS_JATIM,KETERANGAN_STATUS_DATA,ID_WS,KOMENTAR"
        . " FROM REPORT_DATA_DEMAND WHERE ".$witel." AND ".$jenis." ".$tipe_site
        ."ORDER BY PRIORITAS";
    $url_method="delete.sitac.process.php?witel=".$_GET['witel']."&tipe_site=".$_GET['tipe_site']."&before_page=".$_GET['before_page']."&jenis=".$_GET['jenis'];
}
else{
    $sql_to_parse="";
}
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
  <h3 align="center"><strong>DETIL DATA POTENSI ORDER - WITEL <?php echo $_GET['witel']; ?></strong></h3><br />.
  <h3 align="center" class="board-delete"><strong>Pilih Data yang Akan Dihapus</strong></h3><br />
  <form action="<?php echo $url_method; ?>" method="post">
  <div class="panel panel-default">
      <div class="panel-body">
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
              <strong>ERROR!</strong> DATA GAGAL DIUPDATE !
              </div></div></div>";
echo $alert;
}
?>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered" id="table_id">
            <thead bgcolor="#E12E32" style="color:#FFFFFF" style="position: fixed">
              <tr>
                <td align="center" width="5%"><strong>ACT</strong></td>
                <td><center><strong>ID TSEL</strong></center></td>
                <td><center><strong>ID WS</strong></center></td>
                <td><center><strong>NAMA SITE</strong></center></td>
                <td><center><strong>ID SITE</strong></center></td>
                <td><center><strong>ALAMAT</strong></center></td>
                <td><center><strong>KOMENTAR</strong></center></td>
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
        <input name="items_to_delete[]" type="checkbox" value="<?php echo $row['ID']; ?>">
    </td>
    <td><?php echo $row['ID']; ?></td>
    <td><?php echo $row['ID_WS']; ?></td>
    <td><?php echo $row['NAMA_SITE']; ?></td>
    <td><?php echo $row['ID_SITE']; ?></td>
    <td><?php echo $row['ALAMAT']; ?></td>
    <td><?php echo $row['KOMENTAR']; ?></td>
  </tr>
  <?php } ?>
  </tbody>
  </table> 
  </div>
  </div> 
      <a onclick="BackToDetail()" class="btn btn-primary btn-sm">Kembali</a>
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
     /*var list_data_delete=[];
     function push_deleted_data(data_to_delete){
         var duplicate_data = false;
         if(list_data_delete.length==0)
             list_data_delete.push(data_to_delete);
         else{
             for(var i=0;i<list_data_delete.length;i++){
                 if(list_data_delete[i]==data_to_delete){
                    duplicate_data=true; 
                    break;
                 }
             }
             if(duplicate_data==false)list_data_delete.push(data_to_delete);
         }
     };
        $(document).ready(function (){
            $('.styledCheckbox').change(function (){
                alert($('.styledCheckbox').get);
                push_deleted_data($('.styledCheckbox input:checkbox:checked').attr("id"));
                alert(list_data_delete);
            });
        });*/
        function BackToDetail(){
            var witel = getUrlVars()['witel'];
            var tipe_site = getUrlVars()['tipe_site'];
            if(getUrlVars()['before_page']=='potensi')window.location.assign('detil.potensi.php?witel='+witel+'&tipe_site='+tipe_site);
            else if(getUrlVars()['before_page']=='sitac'){
                var jenis = getUrlVars()['jenis'];
                window.location.assign('detil.potensi.php?witel='+witel+'&tipe_site='+tipe_site+'&jenis='+jenis);
            }
            else if(getUrlVars()['before_page']=='deployment'){
                var jenis = getUrlVars()['jenis'];
                window.location.assign('detil.progress.deployment.php?witel='+witel+'&tipe_site='+tipe_site+'&jenis='+jenis);
            }
            else window.location.assign('index.php');
        }
        
        $('input:checkbox').screwDefaultButtons({
        image: "url(img/checkbox.jpg)",
        width: 43,
        height: 43,
        });
    </script>  

  </body>
</html>