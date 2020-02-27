<?php
$ROOT=dirname(dirname(dirname(dirname(__FILE__))));
$date = date("Y-m-d H:i:s"); 
define("LOCAL","local");


try {
    $db = new PDO("sqlite:$ROOT/dbf/nettemp.db");
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo $date." Could not connect to the database.\n";
    exit;
}

try {
    include("$ROOT/receiver.php");
    $query = $db->query("SELECT dev FROM usb WHERE device='RS485'");
    $result= $query->fetchAll();
    foreach($result as $r) {
		$dev0=$r['dev'];
    }
    if($dev0=='none'){
		echo $date." No RS485 USB Device.\n";
		// dodać logsy
		exit;
	}
    $dev=str_replace("/dev/","",$dev0);
	$query = $db->query("SELECT addr, baudrate FROM rs485 WHERE dev='OR-WE'");
	$result= $query->fetchAll();
    foreach($result as $r) {
		$addr=$r['addr'];
		$baud=$r['baudrate'];
		echo $date." RS485 ".$dev0." ".$addr."\n";
    	$cmd="$ROOT/modules/sensors/rs485/orwe_get $dev0 $addr $baud";
		$res=shell_exec($cmd);
		$res = preg_split ('/$\R?^/m', $res);
		echo $res;
		foreach ($res as $l) {
			$line[]=trim($l);
		}
			
		
		
		//$local_val=$line[13];
		//$local_type='var';
		//$local_device='usb';
		//$local_usb=$dev0;
		//$local_rom="usb_".$dev."a".$addr."impb_".$local_type;
		//echo $date." SDM630 import energii biernej ".$local_val." ".$local_type.".\n";
		
		
		
		
		
	}




} catch (Exception $e) {
    echo $date." Error.\n";
    echo $e;
    exit;
}
?>
