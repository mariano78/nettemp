<?php
$logroot = "/var/www/nettemp";
function log($date,$type,$message)
	{
	$db = new PDO("sqlite:$logroot/dbf/nettemp.db");
	$db->exec("INSERT INTO logs ('date', 'type', 'message') VALUES ('$date', '$type', '$message')");
	}



?>
