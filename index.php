<?php
$root=$_SERVER["DOCUMENT_ROOT"];
echo $root;
#$dbfile=$root.'/dbf/nettemp.db';
include_once("$root/config/config.php");

//if( !file_exists($dbfile) || !is_readable($dbfile) || filesize($dbfile) == 0 ){
    //header("Location: html/errors/no_db.php");
//}else{
	
	//$conn = new mysqli($host, $user, $password, $db);
    $db = new PDO($dsn, $user, $password);

    $rows1 = $db->query("SELECT * FROM sensors;") or header("Location: html/errors/db_error.php");
	$row1 = $rows1->fetchAll();
	foreach ($row1 as $a) {
		
		echo $a[rom];
	}
?>
