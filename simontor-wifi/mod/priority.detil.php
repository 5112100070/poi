<?php
    if($_GET['prio']=='ALL'){
        $prio = "PRIORITY IS NOT NULL";
    }
    else
        $prio = "PRIORITY = '".$_GET['prio']."'"
?>
