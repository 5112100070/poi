<?php
        session_start();
        include "config/connect.php";
        $sql = "UPDATE REPORT_DATA_DEMAND SET
                        STATUS_DATA = '".$_POST['status_data']."',
                        ID_WS = '".$_POST['id_ws']."',
                        ID_SITE = '".$_POST['site_id']."',
                        NAMA_SITE = '".$_POST['nama_site']."',
                        LONGITUDE = '".$_POST['longitude']."',
                        LATITUDE = '".$_POST['latitude']."',
                        WITEL = '".$_POST['witel']."',
                        KUNJUNGAN = '".$_POST['kunjungan']."',
                        TANGGAL_KUNJUNGAN = TO_DATE('".  $_POST['tanggal_kunjungan']."','DD/MM/YYYY'),
                        STATUS_INDIHOME = '".$_POST['status_indihome']."',
                        NO_INDIHOME = '".$_POST['no_indihome']."',
                        TOTAL_AP = '".$_POST['total_ap']."',
                        KOMENTAR = '".$_POST['komentar']."',
                        PRIORITAS='".$_POST['prioritas']."'
                        WHERE ID = '".$_GET['site_id']."'";
        $result=  oci_parse($connect, $sql);
        $status_input=oci_execute($result);
        
        if($status_input!=1) $status_input=-1;
            if($_GET['witel']=="NULL" && $_GET['jenis']=="NULL")header("Location: edit.potensi.php?site_id=".$_GET['site_id']."&witel=NULL&jenis=NULL&status_update=".$status_input);
            else header("Location: detil.potensi.php?witel=".$_GET['witel']."&status_update=".$status_input);   
?>