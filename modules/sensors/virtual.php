<?php
$ROOT=dirname(dirname(dirname(__FILE__)));
 
$date = date("Y-m-d H:i:s"); 
$hostname=gethostname(); 

try {
    $db = new PDO("sqlite:$ROOT/dbf/nettemp.db");
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo $date." Could not connect to the database.\n";
    exit;
}


try {
    $sth = $db->query("SELECT * FROM sensors WHERE device = 'virtual'");
	$sth->execute();
	$result = $sth->fetchAll();
	
	
	
	foreach ($result as $vr) {
		
		$local_type = $vr['type'];
		if (substr($local_type,0,2) == 'air'){
			
			$lati = $vr['latitude'];
			$long = $vr['longitude'];
			$vrpi = $vr['apikey'];
			$localid = $vr['id'];
			$local_rom = $vr['rom'];
			//$local_type = $vr['type'];
			$local_device = $vr['device'];
			
			
	$json = file_get_contents('https://airapi.airly.eu/v1/nearestSensor/measurements?latitude=$lati&longitude=$long&maxDistance=1000&apikey=$vrpi');
	$obj = json_decode($json,true);
	
	if ($local_type == "airquality") {
		$local_val = round($obj["airQualityIndex"]);
	}elseif ($local_type == "air_pm_25") {
		$local_val = round($obj["pm25"]);
	}elseif ($local_type == "air_pm_10") {
		$local_val = round($obj["pm10"]);
	}
		include("$ROOT/receiver.php");	
		echo $local_rom."\n";
		echo $local_val."\n";
		echo $local_type."\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
			
			
}
		
		
		
		
		
		
		
		
		
		
	}
    
    
    
    
    


} catch (Exception $e) {
    echo $date." Error.\n";
    echo $e;
    exit;
}
?>

