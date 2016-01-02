<?php
//PROGRESS DEPLOYMENT LOGIC
if($_GET['jenis']=='po'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='ok') "
            . "and (lower(ket_status_sitac)='valid') "
            . "and (mitra_ap is not null)";
}
else if($_GET['jenis']=='drop'){
    $jenis="((lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') "
            . "and (lower(ket_status_sitac)='valid') "
            . "and (mitra_ap is not null) "
            . "and (lower(status_cons_jatim)='cancel' or lower(status_cons_jatim)='drop'))";
}
else if($_GET['jenis']=='hold'){
    $jenis="((lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') "
            . "and (lower(ket_status_sitac)='valid') "
            . "and (mitra_ap is not null) "
            . "AND lower(status_cons_jatim)='hold')";
}
else if($_GET['jenis']=='survey'){
    $jenis="((lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') "
            . "and (lower(ket_status_sitac)='valid') "
            . "and (mitra_ap is not null) "
            . "and lower(status_cons_jatim)='survey')";
}
else if($_GET['jenis']=='lme'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='ok') "
            . "and (lower(ket_status_sitac)='valid') "
            . "and (mitra_ap is not null) "
            . "and (lower(status_lme)='ok')";
}
else if($_GET['jenis']=='installed'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='ok') "
            . "and (lower(ket_status_sitac)='valid') "
            . "and (mitra_ap is not null) "
            . "and (lower(status_cons_jatim)='installed')";
}
else if($_GET['jenis']=='installed_lme'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='ok') "
            . "and (lower(ket_status_sitac)='valid') "
            . "and (mitra_ap is not null) "
            . "and (lower(status_cons_jatim)='installed' or lower(status_lme)='ok')";
}
else if($_GET['jenis']=='oa'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') and (lower(status_sitac)='ok') "
            . "and (lower(ket_status_sitac)='valid') "
            . "and (mitra_ap is not null) "
            . "and (lower(status_cons_jatim)='on air' or lower(status_cons_jatim)='oa existing')";
}
else if($_GET['jenis']=='noa'){
    $jenis="((lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4')"
            . " AND lower(status_cons_jatim)='install ap' or lower(status_cons_jatim)='installed')";
}
else if($_GET['jenis']=='ikg'){
    $jenis="(lower(prioritas)='prio-1' or lower(prioritas)='prio-2' or lower(prioritas)='prio-3' or lower(prioritas)='prio-4') "
            . "and (lower(status_data) not in ('rejected')) "
            . "and (lower(kunjungan)='ya') "
            . "and (lower(status_sitac)='ok') "
            . "and (lower(ket_status_sitac)='valid') "
            . "and (mitra_ap is not null) "
            . "and (lower(status_cons_jatim)='ikg')";
}
//END of PROGRESS DEPLOYMENT LOGIC


if($_GET['witel']=='all'){
    $witel="WITEL IS NOT NULL";
}
else{
    $witel="WITEL='".$_GET['witel']."'";
}
?>
