<?php
        session_start();
        include "config/connect.php";
        $sql = "UPDATE REPORT_DATA_DEMAND SET
                        KET_STATUS_SITAC = '".$_POST['ket_status_sitac']."',
                        STATUS_CONS_JATIM = '".$_POST['status_cons_jatim']."',
                        KETERANGAN_STATUS_DATA='".$_POST['keterangan_status_data']."',
                        ID_SITE = '".$_POST['site_id']."',
                        STATUS_SITAC = '".$_POST['status_sitac']."'
                        WHERE ID = '".$_GET['site_id']."'";
            $result = oci_parse($connect, $sql);
            oci_execute($result);
        $sql = "INSERT INTO UPDATE_STATUS (ID,TANGGAL_UPDATE,STATUS_PROJECT,KETERANGAN_STATUS_DATA) 
                        VALUES
                        ('".$_GET['site_id']."',
                         TO_DATE('".date("d-M-Y")."','DD/MM/YYYY'),
                         '".$_POST['status_cons_jatim']."',
                         '".$_POST['keterangan_status_data']."'
                        )";
            $result = oci_parse($connect, $sql);
            oci_execute($result);
            if($_GET['witel']=="NULL" && $_GET['jenis']=="NULL")header("Location: edit.sitak.php?site_id=".$_GET['site_id']."&witel=NULL&jenis=NULL&status_update=sukses&tgl=".date("d-M-y"));
            else header("Location: detil.sitak.php?witel=".$_GET['witel']."&jenis=".$_GET['jenis']."&status_update=sukses&tgl=".date("d-M-y"));     
?>