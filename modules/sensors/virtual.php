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
	
	include("$ROOT/receiver.php");
	
	foreach ($result as $a) {
		
		
		if (substr($a["type"],0,3) == 'air'){
			
			$lati = $a['latitude'];
			$long = $a['longitude'];
			$api = $a['apikey'];
			$localid = $a['id'];
			$local_rom = $a['rom'];
			$local_type = $a['type'];
			$local_device = $a['device'];
			
			
	$json = file_get_contents('https://airapi.airly.eu/v1/nearestSensor/measurements?latitude=$lati&longitude=$long&maxDistance=1000&apikey=$api');
	$obj = json_decode($json,true);
	
	if ($local_type == "airquality") {
		$local_val = round($obj["airQualityIndex"]);
	}elseif ($local_type == "air_pm_25") {
		$local_val = round($obj["pm25"]);
	}elseif ($local_type == "air_pm_10") {
		$local_val = round($obj["pm10"]);
	}
			
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
			
			
		}
		
		
		
		
		
		
		
		
		
		
	}
    
    
    
    
    


} catch (Exception $e) {
    echo $date." Error.\n";
    echo $e;
    exit;
}
?>

