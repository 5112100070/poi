<?php
if($_GET['jenis']=='new_potensi'){          // INDEX.php CONDITION
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))";
}
else if($_GET['jenis']=='kunjungan_today'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya' and tanggal_kunjungan=to_date('".$_GET['tgl']."','DD/MM/YYYY'))";
}
else if($_GET['jenis']=='kunjungan_sd'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya')";
}
else if($_GET['jenis']=='belum_kunjungan_sd'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan) not in 'ya' or kunjungan is null)";
}
else if($_GET['jenis']=='sukses_today'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya' and tanggal_kunjungan=to_date('".$_GET['tgl']."','DD/MM/YYYY'))"
            . " and (lower(status_sitac)='ok')";
}
else if($_GET['jenis']=='sukses_sd'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya')"
            . " and (lower(status_sitac)='ok')";
}
else if($_GET['jenis']=='upload_ws_today'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya' and tanggal_kunjungan=to_date('".$_GET['tgl']."','DD/MM/YYYY'))"
            . " and (lower(status_sitac)='ok')"
            . " and (lower(ket_status_sitac)='valid')";
}
else if($_GET['jenis']=='upload_ws_sd'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya')"
            . " and (lower(status_sitac)='ok')"
            . " and (lower(ket_status_sitac)='valid')";
}
else if($_GET['jenis']=='unupload_ws_sd'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya')"
            . " and (lower(status_sitac)='ok')"
            . " and (lower(ket_status_sitac) not in ('valid') or ket_status_sitac is null)";
}
else if($_GET['jenis']=='po_today'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya' and tanggal_kunjungan=to_date('".$_GET['tgl']."','DD/MM/YYYY'))"
            . " and (lower(status_sitac)='ok')"
            . " and (lower(ket_status_sitac)='valid')"
            . " and (mitra_ap is not null)";
}
else if($_GET['jenis']=='po_sd'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya')"
            . " and (lower(status_sitac)='ok')"
            . " and (lower(ket_status_sitac)='valid')"
            . " and (mitra_ap is not null)";
}
else if($_GET['jenis']=='unpo_sd'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya')"
            . " and (lower(status_sitac)='ok')"
            . " and (lower(ket_status_sitac)='valid')"
            . " and (mitra_ap is null)";
}
else if($_GET['jenis']=='input_today'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya' and tanggal_kunjungan=to_date('".$_GET['tgl']."','DD/MM/YYYY'))"
            . " and (lower(status_sitac)='ok')"
            . " and (lower(ket_status_sitac)='valid')"
            . " and (mitra_ap is not null)"
            . " and (lower(status_tcares)='ok')";
}
else if($_GET['jenis']=='input_sd'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya')"
            . " and (lower(status_sitac)='ok')"
            . " and (lower(ket_status_sitac)='valid')"
            . " and (mitra_ap is not null)"
            . " and (lower(status_tcares)='ok')";
}
else if($_GET['jenis']=='uninput_sd'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya')"
            . " and (lower(status_sitac)='ok')"
            . " and (lower(ket_status_sitac)='valid')"
            . " and (mitra_ap is not null)"
            . " and (lower(status_tcares) not in 'ok' or status_tcares is null)";
}
else if($_GET['jenis']=='activation_today'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya' and tanggal_kunjungan=to_date('".$_GET['tgl']."','DD/MM/YYYY'))"
            . " and (lower(status_sitac)='ok')"
            . " and (lower(ket_status_sitac)='valid')"
            . " and (mitra_ap is not null)"
            . " and (lower(status_cons_jatim)='on air')";
}
else if($_GET['jenis']=='activation_sd'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') and (lower(status_data) not in ('rejected'))"
            . " and (lower(kunjungan)='ya')"
            . " and (lower(status_sitac)='ok')"
            . " and (lower(ket_status_sitac)='valid')"
            . " and (mitra_ap is not null)"
            . " and (lower(status_cons_jatim)='on air')";
}
else if($_GET['jenis']=='visited'){                                 // SITAK.php condition
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya')";
}
else if($_GET['jenis']=='success'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='ok')";
}
else if($_GET['jenis']=='valid'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='ok') "
            . "and (lower(ket_status_sitac)='valid')";
}
else if($_GET['jenis']=='invalid'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='ok') "
            . "and (lower(ket_status_sitac)='invalid')";
}
else if($_GET['jenis']=='pending'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='pending')";
}
else if($_GET['jenis']=='gagal'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='gagal')";
}
else if($_GET['jenis']=='gagal_a'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='gagal') "
            . "and (lower(ket_status_sitac)='tidak bersedia')";
}
else if($_GET['jenis']=='gagal_b'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='gagal') "
            . "and (lower(ket_status_sitac)='site lama ditutup')";
}
else if($_GET['jenis']=='gagal_c'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='gagal') "
            . "and (lower(ket_status_sitac)='site tidak valid')";
}
else if($_GET['jenis']=='gagal_d'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='gagal') "
            . "and (lower(ket_status_sitac)='sudah ada ap')";
}
else if($_GET['jenis']=='gagal_e'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='gagal') "
            . "and (lower(ket_status_sitac)='sudah ada indihome')";
}
else if($_GET['jenis']=='gagal_f'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='gagal') "
            . "and (lower(ket_status_sitac)='bukan pengambil keputusan')";
}
else if($_GET['jenis']=='gagal_g'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='gagal') "
            . "and (lower(ket_status_sitac)='dan lain lain')";
}
else {
    $jenis="witel is not null";
}
if($_GET['witel']=='all'){
    $witel="WITEL IS NOT NULL";
}
else{
    $witel="WITEL='".$_GET['witel']."'";
}

if($_GET['jenis']=='valid' || $_GET['jenis']=='invalid')$table = "REPORT_DATA_DEMAND";  //TABLE NAME
else $table="REPORT_DATA_DEMAND";
?>

