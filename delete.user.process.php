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
        $sql_delete = "DELETE FROM LOGIN WHERE NIK='".$key."'";
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
        header ("Location: detil.user.php?status_delete=1");
    }
    else header ("Location: detil.user.php?status_delete=0");
}
