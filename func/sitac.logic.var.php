<?php
    if($_GET['jenis']=='kunjungan_sd' || $_GET['jenis']=='kunjungan_today'){
        $detail = "VISITED";
    }
    else if($_GET['jenis']=='belum_kunjungan_sd'){
        $detail = "NOT VISIT";
    }
    else if($_GET['jenis']=='sukses_sd' || $_GET['jenis']=='sukses_today'){
        $detail = "SUKSES SITAC";
    }
    else if($_GET['jenis']=='upload_ws_sd' || $_GET['jenis']=='upload_ws_today'){
        $detail = "UPLOAD WS";
    }
    else if($_GET['jenis']=='unupload_ws_sd'){
        $detail = "UN-UPLOAD WS";
    }
    else if($_GET['jenis']=='po_sd' || $_GET['jenis']=='po_today'){
        $detail = "PO";
    }
    else if($_GET['jenis']=='unpo_sd'){
        $detail = "UN-PO";
    }
    else if($_GET['jenis']=='input_sd' || $_GET['jenis']=='input_today'){
        $detail = "INPUT TCARES";
    }
    else if($_GET['jenis']=='uninput_sd'){
        $detail = "UN-INPUT TCARES";
    }
    else if($_GET['jenis']=='new_potensi'){
        $detail = "POTENSI";
    }
    else $detail="";
?>