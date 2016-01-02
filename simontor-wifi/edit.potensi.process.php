<?php
        session_start();
        include "config/connect.php";
        $sql = "UPDATE REPORT_DATA_DEMAND SET
                        STATUS_DATA = '".$_POST['status_data']."',
                        PRIORITAS='".$_POST['prioritas']."'
                        WHERE ID = '".$_GET['site_id']."'";
        $result=  oci_parse($connect, $sql);
        oci_execute($result);
        if($_GET['witel']=="NULL" && $_GET['jenis']=="NULL")header("Location: edit.potensi.php?site_id=".$_GET['site_id']."&witel=NULL&jenis=NULL&status_update=sukses");
        else header("Location: detil.potensi.php?witel=".$_GET['witel']."&status_update=sukses");     
?>