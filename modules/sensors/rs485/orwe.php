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
		$local_type='var';
		$local_rom="usb_".$dev."_".$addr."_".$local_type;
		$local_val=$line[4];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - Var ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		//VA
		$local_type='va';
		$local_rom="usb_".$dev."_".$addr."_".$local_type;
		$local_val=$line[5];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - Va ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		//Cosfi
		$local_type='cosfi';
		$local_rom="usb_".$dev."_".$addr."_".$local_type;
		$local_val=$line[6];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - cosfi ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		//Wh
		$local_type='kwatt';
		$local_rom="usb_".$dev."_".$addr."_".$local_type;
		$local_val=$line[7];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - Wh ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		//varh
		$local_type='varh';
		$local_rom="usb_".$dev."_".$addr."_".$local_type;
		$local_val=$line[8];
		$local_device='usb';
		$local_usb=$dev0;
		echo $date." ORWE - varh ".$local_val." ".$local_type.".\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		//elec
		$local_type='elec';
		$local_rom="usb_".$dev."_".$addr."_".$local_type;
		$local_device='usb';
		$local_usb=$dev0;
		$last='';
		$WATsum=trim($line[3]);
		$ALL=trim($line[7]);
		$query = $db->query("SELECT sum FROM sensors WHERE rom='$local_rom'");
		$result= $query->fetchAll();
		foreach ($result as $r) {
			$last=trim($r['sum']);
		}
		$VAL=trim($ALL-$last);
		//$VAL=number_format($VAL, 3, '.', '');
		
		echo "1. last ".$last."\n";
		echo "2. WAT sum ".$WATsum."\n";
		echo "3. all ".$ALL."\n";
		echo "4. val ".$VAL."\n";

		if($last!=0){
			$local_val= number_format($VAL,4);
			
		} 
		else {
			$local_val='0';
		}
		$local_current=$WATsum;
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		$db->exec("UPDATE sensors SET sum='$ALL' WHERE rom='$local_rom'");
		
		
	}

} catch (Exception $e) {
    echo $date." Error.\n";
    echo $e;
    exit;
}
?>
