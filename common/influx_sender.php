<?php


  
function sendInflux($s_value, $s_current, $rom, $name, $type){ 
 
	$root= "/var/www/nettemp";

	$date = date("Y-m-d H:i:s");  
  
  	try {
    	$db = new PDO("sqlite:$root/dbf/nettemp.db");
    	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  	} 
  		catch (Exception $e) {
    	echo $date."Could not connect to the database.\n";
		exit;
	}

	try {
   	$sth = $db->query("SELECT * FROM nt_settings");
   	$sth->execute();
   	$result = $sth->fetchAll();
   	foreach ($result as $a) {
      	if($a['option']=='inflip') {
         	$influxdb_ip=$a['value'];
      	}
      	if($a['option']=='inflport') {
         	$influxdb_port=$a['value'];
      	}
      	if($a['option']=='inflon') {
         	$influxdb_on=$a['value'];
      	}
      	if($a['option']=='inflbase') {
         	$influxdb_base=$a['value'];
      	}
   	}
    
    	if(!empty($influxdb_ip)&&!empty($influxdb_port)&&!empty($influxdb_base)&&$influxdb_on=='on'){
		
			require $root."/other/composer/vendor/autoload.php";
   		$client = new InfluxDB\Client($influxdb_ip, $influxdb_port);
   		$database = $client->selectDB($influxdb_base);

         $value=floatval($s_value);
         
         
			if (isset($current) && is_numeric($current)) {
				$current=floatval($s_current);
				$points = [
	                 new InfluxDB\Point(
	                     'nt_'.$type, // the name of the measurement
	                     $value, // measurement value
	                     ['name' => $name, 'rom' => $rom], // measurement tags
	                     ['current' => $current], // additional measurement fields
	                     exec('date +%s%N') // timestamp in nanoseconds on Linux ONLY
	                 )
	             ];						
			}               
         else {
	         $points = [
	                 new InfluxDB\Point(
	                     'nt_'.$type, // the name of the measurement
	                     $value, // measurement value
	                     ['name' => $name, 'rom' => $rom], // measurement tags
	                     [], // additional measurement fields
	                     exec('date +%s%N') // timestamp in nanoseconds on Linux ONLY
	                 )
	             ];
	      }
	      $toinflux = $database->writePoints($points);
	      $to_send = false;
	      echo $name." to influx\n";
	      echo $toinflux;	
      }
    } 
    catch (Exception $e) {
    	echo $date." Error.\n";
    	echo $e;
    	exit;
	 }   
}
  
  
?>