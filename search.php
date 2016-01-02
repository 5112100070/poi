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
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Si Border - MASTER SEARCH RESULT</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>
    <!-- Bootstrap -->
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
    if(!empty($_POST['search_data']))$search_data=$_POST['search_data'];
    else if(!empty ($_GET['search_data']))$search_data=$_GET['search_data'];
    else $search_data = " ";
    $sql = OCIParse($connect,"SELECT WITEL,ID_WS,ID_SITE,NAMA_SITE,ALAMAT,MITRA_AP,STATUS_CONS_JATIM,ID FROM REPORT_DATA_DEMAND WHERE LOWER(WITEL) LIKE LOWER('%".$search_data."%') OR LOWER(ID_WS) LIKE LOWER('%".$search_data."%') OR LOWER(ID) LIKE LOWER('%".$search_data."%')"
            . " OR LOWER(ID_SITE) LIKE LOWER('%".$search_data."%') OR LOWER(NAMA_SITE) LIKE LOWER('%".$search_data."%') OR LOWER(STATUS_CONS_JATIM) LIKE('%".$search_data."%')");
            ociexecute($sql);  
?>
  <div class="container">
        <h3 align="center"><strong>MASTER SEARCH V1.1</strong></h3><br />
        <h3 align="center"><strong>RESULT - <?php echo $search_data; ?></strong></h3><br />
  <div class="panel panel-default">
  <div class="panel-body">
<div class="row">
<div class="col-md-12">
  <table class="table table-bordered" id="table_id">
  <thead bgcolor="#E12E32" style="color:#FFFFFF">
  <tr>
    <?php if($_SESSION['privilege']!='guest') { ?>
    <td align="center" width="5%"><strong>ACT</strong></td>
    <?php } ?>
    <td><center><strong>WITEL</strong></center></td>
    <td><center><strong>ID WS</strong></center></td>
    <td><center><strong>SITE ID</strong></center></td>
    <td><center><strong>SITE NAME</strong></center></td>
    <td><center><strong>ALAMAT</strong></center></td>
    <td><center><strong>MITRA</strong></center></td>
    <td><center><strong>PROJECT STATUS</strong></center></td>
  </tr>
  </thead>
  <tbody>
  <?php while($row = oci_fetch_array($sql)) { ?>
  <tr>
    <?php if($_SESSION['privilege']!='4' || $_SESSION['privilege']!='5') { ?>
    <td>
        <a href="edit.sitak.php?site_id=<?php echo $row[7]; ?>&witel=NULL&jenis=NULL" style="text-decoration:none"><font color="#E12E32"><i class="fa fa-pencil">SITAC</i></font></a>
        <a href="edit.progress.deployment.php?site_id=<?php echo $row[7]; ?>&witel=NULL&jenis=NULL" style="text-decoration:none"><font color="#E12E32"><i class="fa fa-pencil">DEPLOYMENT</i></font></a>
    </td>
    <?php } ?>
    <td><?php echo $row[0]; ?></td>
    <td><?php echo $row[1]; ?></td>
    <td><?php echo $row[2]; ?></td>
    <td><?php echo $row[3]; ?></td>
    <td><?php echo $row[4]; ?></td>
    <td><?php echo $row[5]; ?></td>
    <td><?php echo $row[6]; ?></td>
  </tr>
  <?php } ?>
  </tbody>
  </table> 
  </div>
  </div>   
  </div>
  </div>
<?php include "mod/footer.php"; ?>
  <style>
      .data{
          width: 40%;
          float: left;
          position: absolute;
          left: 29%;
          top: 10%;
          border: 3px groove #080808;
      }
      #confirmation{
          width: 40%;
          float: left;
          position: fixed;
          left: 29%;
          top: 10%;
          border-top: 3px groove #080808;
          border-left: 3px groove #080808;
          border-right: 3px groove #080808;
      }
  </style>
  </div>
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
    <script>
    $(document).ready( function () {
        $("#consttruction").click(function (){
            alert("This Link is Underconstruction...");
        });
        $('#table_id').DataTable({
          "scrollX": false,
          "autoWidth": false
          });  
        });
    </script>  

  </body>
</html>