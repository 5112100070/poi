<?php
header("Pragma: public"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=LIST USER SIMONTOR.xls");

include "config/connect.php";

$sql = OCIParse($connect, "SELECT NIK,NAMA,JABATAN,PRIVILEGE,WITEL,NO_TELP FROM LOGIN WHERE NIK IS NOT NULL");
ociexecute($sql);

echo "<table border='1'>\n";
$ncols = oci_num_fields($sql);
echo "<tr>\n";
for ($i = 1; $i <= $ncols; ++$i) {
    $colname = oci_field_name($sql, $i);
    echo "  <th><b>".htmlentities($colname, ENT_QUOTES)."</b></th>\n";
}
echo "</tr>\n";

while (($row = oci_fetch_array($sql, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
     echo "<tr>\n";
     foreach ($row as $therow) {
          echo "  <td>".($therow !== null ? htmlentities($therow, ENT_QUOTES):" ")."</td>\n";
     }
    echo "</tr>\n";
}
echo "</table>\n";
?>