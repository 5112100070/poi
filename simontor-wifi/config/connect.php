<?php
//Koneksi ke Database
$oraHost  = 'scan-colodb.telkom.co.id';
$oraHostPort= '1521';
$oraSID   = 'colodb';
$oraUser  = 'ccare';
$oraPwd   = 'siborder#2015';
$db   = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = $oraHost)(PORT = $oraHostPort))(CONNECT_DATA = (SERVICE_NAME = $oraSID)))";
$connect  = OCILogon($oraUser,$oraPwd,$db);
//Baris akhir koneksi
 
//function sql_ora
if (!function_exists(sql_ora)) {
function sql_ora($sql=""){
global $connect,$sql;
$state=OCIparse($connect,$sql);
OCIexecute($state);
}
}
//end of function sql_ora
?>