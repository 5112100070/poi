<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include './config/connect.php';
$delete_flag=TRUE;
if(!empty($_POST['items_to_delete'])){
    foreach ($_POST['items_to_delete'] as $key) {
        $sql_delete = "DELETE FROM REPORT_DATA_DEMAND WHERE ID='".$key."'";
        echo $sql_delete;
        $sql_delete_parse=  ociparse($connect, $sql_delete);
        $delete_flag=ociexecute($sql_delete_parse);
        if(!$delete_flag){
            ocierror($sql_delete_parse);
            oci_rollback($connect);
            break;
        }
    }
    if($delete_flag){
        if($_GET['before_page']=='potensi')header ("Location: delete.sitac.php?witel=".$_GET['witel']."&tipe_site=".$_GET['tipe_site']."&before_page=".$_GET['before_page']."&status_delete=1");   
        else if($_GET['before_page']=='sitac' || $_GET['before_page']=='deployment')header ("Location: delete.sitac.php?witel=".$_GET['witel']."&tipe_site=".$_GET['tipe_site']."&before_page=".$_GET['before_page']."&jenis=".$_GET['jenis']."&status_delete=1");
        
    }
    else header ("Location: delete.sitac.php?witel=".$_GET['witel']."&tipe_site=".$_GET['tipe_site']."&before_page=".$_GET['before_page']."&status_delete=0");
}
