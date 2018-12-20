<?php
$logroot = "/var/www/nettemp";
function logs($date,$type,$message)
	{
	$logroot = "/var/www/nettemp";	
		
	$db = new PDO("sqlite:$logroot/dbf/nettemp.db");
	$db->exec("INSERT INTO logs ('date', 'type', 'message') VALUES ('$date', '$type', '$message')");
	}



?>
