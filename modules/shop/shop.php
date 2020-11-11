<?php

// Connects to the MYDB database described in tnsnames.ora file,
// One example tnsnames.ora entry for MYDB could be:
   MYDB =
     (DESCRIPTION =
       (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.18.240)(PORT = 1521))
       (CONNECT_DATA =
         (SERVER = DEDICATED)
        (SERVICE_NAME = oracp1250)
       )
     )

$conn = oci_connect('erp', 'erp', 'MYDB');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
} else {
	
	echo "OK";
	
}

?>
