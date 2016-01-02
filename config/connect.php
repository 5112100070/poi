<?php

$username = 'wahyu';
$password = 'SOVIET1993';
$database = '127.0.0.1/xe';
$connect = oci_connect($username, $password,$database);

if(!$connect){
    echo "Sorry, We cannot connect to database";
}
?>