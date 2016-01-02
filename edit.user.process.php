<?php
        session_start();
        include "config/connect.php";
        $sql = "UPDATE LOGIN SET
                        NAMA = '".$_POST['nama']."',
                        JABATAN = '".$_POST['jabatan']."',
                        PRIVILEGE = '".$_POST['privilege']."',
                        WITEL = '".$_POST['witel']."',
                        NO_TELP = '".$_POST['no_telp']."'
                        WHERE NIK = '".$_GET['NIK']."'";
        $result=  oci_parse($connect, $sql);
        oci_execute($result);
        header("Location: edit.user.php?NIK=".$_GET['NIK']."&status_update=sukses");
?>