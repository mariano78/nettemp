<?php
// phpinfo();

if(!empty($_SERVER["DOCUMENT_ROOT"])){
    $root=$_SERVER["DOCUMENT_ROOT"];
}else{
    $root=__DIR__;
    for($i=0;$i<5;$i++){
        $root = file_exists($root.'/dbf/nettemp.db') ? $root : dirname($root) ;
    }
}
if(!isset($db)){
    $db = new PDO("sqlite:$root/dbf/nettemp.db");
}
$sth = $db->query("SELECT * FROM shop");
$sth->execute();
$result = $sth->fetchAll();
foreach ($result as $a) {
	if($a['option']=='user') {
		$user=$a['value'];
	}
	if($a['option']=='pass') {
		$pass=$a['value'];
	}
	if($a['option']=='database') {
		$database=$a['value'];
	}
}	

$conn = oci_connect($user, $pass, $database);
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, 'SELECT * FROM JFOX_MAGAZ');
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";

?>