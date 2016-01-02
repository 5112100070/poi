<?php
        session_start();
        include "config/connect.php";
        $sql = "INSERT INTO REPORT_DATA_DEMAND(ID,ID_WS,ID_SITE,NAMA_SITE,LONGITUDE,LATITUDE,ALAMAT,WITEL,MITRA_AP,PRIORITAS,STATUS_DATA)"
                . "VALUES('".strtoupper($_POST['id'])."',"
                . "'".strtoupper($_POST['id_ws'])."',"
                . "'".strtoupper($_POST['id_site'])."',"
                . "'".strtoupper($_POST['nama_site'])."',"
                . "'".strtoupper($_POST['longitude'])."',"
                . "'".strtoupper($_POST['latitude'])."',"
                . "'".strtoupper($_POST['alamat'])."',"
                . "'".strtoupper($_POST['witel'])."',"
                . "'".strtoupper($_POST['mitra_ap'])."',"
                . "'".strtoupper($_POST['prioritas'])."',"
                . "'".strtoupper($_POST['status_data'])."'"
                . ") ";
        $result=  oci_parse($connect, $sql);
        $status_input=oci_execute($result);
        if($status_input==1)
            header("Location: input.potensi.php?status_input=1");
        else
            header("Location: input.potensi.php?status_input=-1");
?>