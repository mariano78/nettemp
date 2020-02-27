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
		var_dump($res);
		foreach ($res as $l) {
			$line[]=trim($l);
		}
			
		
		
		//L1
		$local_type='volt';
		$local_rom="usb_".$dev.$addr."_".$local_type;
		$local_val=$line[0];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		
		
		
		
	}




} catch (Exception $e) {
    echo $date." Error.\n";
    echo $e;
    exit;
}
?>
