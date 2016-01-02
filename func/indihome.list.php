<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(empty($_GET['tipe_site'])){
    $_GET['tipe_site']="";
}

if($_GET['tipe_site']=="INDIHOME"){
    $tipe_site=" and (lower(status_indihome)='yes')";
}
else if($_GET['tipe_site']=="NOT_INDIHOME"){
    $tipe_site=" and (lower(status_indihome) not in ('yes') or status_indihome is null)";
}
else {
    $tipe_site="";
}
?>
