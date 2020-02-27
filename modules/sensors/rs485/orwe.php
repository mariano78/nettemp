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
			
		
		
		//Volt
		$local_type='volt';
		$local_rom="usb_".$dev."_".$addr."_".$local_type;
		$local_val=$line[0];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - volt ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		//Amper
		$local_type='amps';
		$local_rom="usb_".$dev."_".$addr."_".$local_type;
		$local_val=$line[1];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - amps".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		//Frequency
		$local_type='frequency';
		$local_rom="usb_".$dev."_".$addr."_".$local_type;
		$local_val=$line[2];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - frequency ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
	
		//Watt 
		$local_type='watt';
		$local_rom="usb_".$dev."_".$addr."_".$local_type;
		$local_val=$line[3];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - watt ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		//Var
		$local_type='watt';
		$local_rom="usb_".$dev."_".$addr."_".$local_type."_var";
		$local_val=$line[4];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - Var ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		//Va
		$local_type='watt';
		$local_rom="usb_".$dev."_".$addr."_".$local_type."_va";
		$local_val=$line[5];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - Va ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		//Cosfi
		$local_type='watt';
		$local_rom="usb_".$dev."_".$addr."_".$local_type."_cosfi";
		$local_val=$line[6];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - cosfi ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		//Wh
		$local_type='watt';
		$local_rom="usb_".$dev."_".$addr."_".$local_type."_wh";
		$local_val=$line[7];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - Wh ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		//varh
		$local_type='watt';
		$local_rom="usb_".$dev."_".$addr."_".$local_type."_varh";
		$local_val=$line[8];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - varh ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		
	}




} catch (Exception $e) {
    echo $date." Error.\n";
    echo $e;
    exit;
}
?>
