<?php
        session_start();
        include "config/connect.php";
        $sql = "INSERT INTO LOGIN (NIK,NAMA,PASSWORD,JABATAN,PRIVILEGE,WITEL,NO_TELP)
                VALUES('".$_POST['nik']."','".$_POST['nama']."','".$_POST['password']."','".$_POST['jabatan']."','".$_POST['privilege']."','".$_POST['witel']."','".$_POST['no_telp']."')";
        $result=  oci_parse($connect, $sql);
        oci_execute($result);
        header("Location: input.user.php?status_update=sukses");
?>