<?php
        session_start();
        include "config/connect.php";
        if(empty($_POST['v_kontrak']))$_POST['v_kontrak']="FALSE";
        if(empty($_POST['v_ttd']))$_POST['v_ttd']="FALSE";
        if(empty($_POST['v_materai']))$_POST['v_materai']="FALSE";
        if(empty($_POST['v_jml_ap']))$_POST['v_jml_ap']="FALSE";
        if(empty($_POST['v_stempel']))$_POST['v_stempel']="FALSE";
        if(empty($_POST['v_form']))$_POST['v_form']="FALSE";
        if(empty($_POST['v_ktp']))$_POST['v_ktp']="FALSE";

        $sql = "SELECT * FROM POI_VALIDATOR WHERE ID='".$_GET['site_id']."'";
        $result=  oci_parse($connect, $sql);
        oci_execute($result);
        $row = oci_fetch_array($result);
        
        if(empty($row)){
            $sql = "INSERT INTO POI_VALIDATOR(ID,V_KONTRAK,V_TTD,V_MATERAI,V_JUM_AP,V_STEMPEL,V_FORM,V_KTP) "
                    . "VALUES('".$_GET['site_id']."','".$_POST['v_kontrak']."','".$_POST['v_ttd']."','".$_POST['v_materai']."','".$_POST['v_jml_ap']."','".$_POST['v_stempel']."','".$_POST['v_form']."','".$_POST['v_ktp']."')";
            $result=  oci_parse($connect, $sql);
            oci_execute($result);
            
            $sql = "SELECT * FROM POI_VALIDATOR WHERE ID='".$_GET['site_id']."'";
            $result=  oci_parse($connect, $sql);
            oci_execute($result);
            $row = oci_fetch_array($result);
        }  
        
        //valid checker
            if($_POST['v_kontrak']=="TRUE" && $_POST['v_ttd']=="TRUE" && $_POST['v_materai']=="TRUE" && $_POST['v_jml_ap']=="TRUE" && $_POST['v_stempel']=="TRUE" 
                && $_POST['v_form']=="TRUE" && $_POST['v_ktp']=="TRUE")$valid_checker="valid";
            else $valid_checker="invalid";
        //end valid checker
        
        $sql="UPDATE POI_VALIDATOR SET "
                . "V_KONTRAK='".$_POST['v_kontrak']."',"
                . "V_MATERAI='".$_POST['v_materai']."',"
                . "V_JUM_AP='".$_POST['v_jml_ap']."',"
                . "V_STEMPEL='".$_POST['v_stempel']."',"
                . "V_FORM='".$_POST['v_form']."',"
                . "V_KTP='".$_POST['v_ktp']."',"
                . "V_TTD='".$_POST['v_ttd']."' "
                . "WHERE ID='".$_GET['site_id']."'";
        $result=  oci_parse($connect, $sql);
        oci_execute($result);
        
        
        
        //Update data REPORT_DATA_DEMAND proses
        $standart_query = "UPDATE REPORT_DATA_DEMAND SET
                            STATUS_SITAC = '".$_POST['status_sitac']."',
                            MITRA_AP = '".$_POST['mitra_ap']."',
                            KUNJUNGAN = '".$_POST['kunjungan']."',
                            STATUS_TCARES = '".$_POST['status_tcares']."',
                            STATUS_DATA = '".$_POST['status_data']."',
                            PRIORITAS='".$_POST['prioritas']."'  
                            TANGGAL_KUNJUNGAN = TO_DATE('".  $_POST['tanggal_kunjungan']."','DD/MM/YYYY'),";
        
        if($_POST['ket_status_sitac']!=" "){
            $sql = $standart_query.
                    "KET_STATUS_SITAC = '".$_POST['ket_status_sitac']."'
                    WHERE ID = '".$_GET['site_id']."'";
        }
        else if($_POST['ket_status_sitac_proses']!=" "){
            $sql = $standart_query.
                    "KET_STATUS_SITAC = '".$_POST['ket_status_sitac_proses']."'
                    WHERE ID = '".$_GET['site_id']."'";
        }
        else{
            $sql = $standart_query.
                    "KET_STATUS_SITAC = '".$valid_checker."'
                    WHERE ID = '".$_GET['site_id']."'";
        }
        $result = oci_parse($connect, $sql);
        oci_execute($result);
        //End Update data REPORT_DATA_DEMAND proses
            if($_GET['witel']=="NULL" && $_GET['jenis']=="NULL")header("Location: edit.sitak.php?site_id=".$_GET['site_id']."&witel=NULL&jenis=NULL&status_update=sukses&tgl=".date("d-m-y"));
            else header("Location: detil.sitak.php?witel=".$_GET['witel']."&jenis=".$_GET['jenis']."&status_update=sukses&tgl=".date("d-m-y"));     
?>