<?php
        session_start();
        include "config/connect.php";
        if(!empty($_POST['status_cons_jatim']))
        $sql = "UPDATE REPORT_DATA_DEMAND SET
                        STATUS_CONS_JATIM = '".$_POST['status_cons_jatim']."',
                        KETERANGAN_STATUS_DATA='".$_POST['keterangan_status_data']."',
                        ID_WS = '".$_POST['id_ws']."',
                        MITRA_AP = '".$_POST['mitra']."',
                        TOTAL_AP = '".$_POST['total_ap']."',
                        ID_SITE = '".$_POST['site_id']."'
                        WHERE ID = '".$_GET['site_id']."'";
        else
        $sql = "UPDATE REPORT_DATA_DEMAND SET
                        ID_WS = '".$_POST['id_ws']."',
                        MITRA_AP = '".$_POST['mitra']."',
                        TOTAL_AP = '".$_POST['total_ap']."',
                        ID_SITE = '".$_POST['site_id']."'
                        WHERE ID = '".$_GET['site_id']."'";
            $result = oci_parse($connect, $sql);
        echo $_POST['total_ap'];
        echo $_POST['id_ws'];
        echo $_POST['mitra'];
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
            if($_GET['witel']=="NULL" && $_GET['jenis']=="NULL")header("Location: edit.progress.deployment.php?site_id=".$_GET['site_id']."&witel=NULL&jenis=NULL&status_update=sukses");
            else header("Location: detil.progress.deployment.php?witel=".$_GET['witel']."&jenis=".$_GET['jenis']."&status_update=sukses");     
?>