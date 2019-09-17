<?php
$ROOT=dirname(dirname(dirname(__FILE__)));
 
include("$ROOT/receiver.php");	

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
		
		
	if (substr($vr['type'],0,3) == 'air'){
			
			$lati = $vr['latitude'];
			$long = $vr['longitude'];
			$api = $vr['apikey'];
			$localid = $vr['id'];
			$local_rom = $vr['rom'];
			$local_type = $vr['type'];
			$local_device = $vr['device'];
			
	$url = "https://airapi.airly.eu/v2/measurements/nearest?lat=$lati&lng=$long&maxDistanceKM=5&apikey=$api";
	$json = file_get_contents($url);
	
	$obj = json_decode($json,true);
	//var_dump($obj);
	
	if ($local_type == "airquality") {
		$local_val = round($obj['current']['indexes'][0]['value']);
	}elseif ($local_type == "air_pm_25") {
		$local_val = round($obj['current']['values'][1]['value']);
	}elseif ($local_type == "air_pm_10") {
		$local_val = round($obj['current']['values'][2]['value']);
	}
		
		echo $local_rom." - ".$local_type." - ".$local_val."\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
			
			
	}
	
	if (substr($vr['type'],0,3) == 'max'){
		
		
			$local_rom = $vr['rom'];
			$local_type = $vr['type'];
			$local_device = $vr['device'];
			
			$bindrom = $vr['bindsensor'];
			$file=$bindrom .".sql";
			
			
			$db1 = new PDO("sqlite:$ROOT/db/$file");
			
			if ($local_type == "max24"){
				
				$val = $db1->query("SELECT max(value) AS m24max from def WHERE time BETWEEN datetime('now','localtime','-1 day') AND datetime('now','localtime') ") or die('max24');
				$val = $val->fetch(); 
				$local_val = $val['m24max'];
				
			} elseif  ($local_type == "maxweek"){
				
				$val = $db1->query("SELECT max(value) AS mweek from def WHERE time BETWEEN datetime('now','localtime','-7 day') AND datetime('now','localtime') ") or die('maxweek');
				$val = $val->fetch(); 
				$local_val = $val['mweek'];
				
			} elseif  ($local_type == "maxmonth"){
				
				$val = $db1->query("SELECT max(value) AS mmonth from def WHERE time BETWEEN datetime('now','localtime','-1 months') AND datetime('now','localtime') ") or die('maxmonth');
				$val = $val->fetch(); 
				$local_val = $val['mmonth'];
				
			}
		
		echo $local_rom."\n";
		echo $local_val."\n";
		echo $local_type."\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);		
	}
	
	if (substr($vr['type'],0,3) == 'sun'){
			
			$lati = $vr['latitude'];
			$long = $vr['longitude'];
			$tz = $vr['timezone'];
			$localid = $vr['id'];
			$local_rom = $vr['rom'];
			$local_type = $vr['type'];
			$local_device = $vr['device'];
			
			if ($local_type == "sunrise"){	
				$local_val = (date_sunrise(time(),SUNFUNCS_RET_TIMESTAMP,$lati,$long,90.83,$tz));
			} elseif  ($local_type == "sunset"){
				$local_val = (date_sunset(time(),SUNFUNCS_RET_TIMESTAMP,$lati,$long,90.83,$tz));	
			}
			
		echo $local_rom."\n";
		echo $local_val."\n";
		echo date('H:i', $local_val)."\n";
		echo $local_type."\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);	

	}
	
	if (substr($vr['type'],0,3) == 'min'){
		
		
			$local_rom = $vr['rom'];
			$local_type = $vr['type'];
			$local_device = $vr['device'];
			
			$bindrom = $vr['bindsensor'];
			$file=$bindrom .".sql";
			
			
			$db1 = new PDO("sqlite:$ROOT/db/$file");
			
			if ($local_type == "min24"){
				
				$val = $db1->query("SELECT min(value) AS m24min from def WHERE time BETWEEN datetime('now','localtime','-1 day') AND datetime('now','localtime') ") or die('min24');
				$val = $val->fetch(); 
				$local_val = $val['m24min'];
				
			} elseif  ($local_type == "minweek"){
				
				$val = $db1->query("SELECT min(value) AS minweek from def WHERE time BETWEEN datetime('now','localtime','-7 day') AND datetime('now','localtime') ") or die('minweek');
				$val = $val->fetch(); 
				$local_val = $val['minweek'];
				
			} elseif  ($local_type == "minmonth"){
				
				$val = $db1->query("SELECT min(value) AS minmonth from def WHERE time BETWEEN datetime('now','localtime','-1 months') AND datetime('now','localtime') ") or die('minmonth');
				$val = $val->fetch(); 
				$local_val = $val['minmonth'];
				
			}
		
		echo $local_rom."\n";
		echo $local_val."\n";
		echo $local_type."\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
			
			
	}
	
	if ($vr['type'] == 'dewpoint'){
		
		
			$local_rom = $vr['rom'];
			$local_type = $vr['type'];
			$local_device = $vr['device'];
			
			$temprom = $vr['dpromtemp'];
			$humidrom = $vr['dpromhumid'];
	
			$sth = $db->query("SELECT tmp FROM sensors WHERE rom = '$temprom'");
			$sth->execute();
			$tresult = $sth->fetchAll();
			
			foreach($tresult as $temp) {
				$tempdewpoint=$temp['tmp'];
			}
			
			$sth = $db->query("SELECT tmp FROM sensors WHERE rom = '$humidrom'");
			$sth->execute();
			$hresult = $sth->fetchAll();
			
			foreach($hresult as $humid) {
				$humiddewpoint=$humid['tmp'];
			}
	
			echo $tempdewpoint."\n";
			echo $humiddewpoint."\n";
			
				
			$val=243.12*(((LOG10($humiddewpoint)-2)/0.4343)+(17.5*$tempdewpoint)/(243.12+$tempdewpoint))/(17.62-(((LOG10($humiddewpoint)-2)/0.4343)+(17.5*$tempdewpoint)/(243.12+$tempdewpoint)));
			$local_val = number_format ( $val, 1 );
		
		echo $local_rom."\n";
		echo $local_val."\n";
		echo $local_type."\n";
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
			
			
	}
	
	if ($vr['type'] == 'freespace'){
		
		
			$local_rom = $vr['rom'];
			$local_type = $vr['type'];
			$local_device = $vr['device'];
			$dirtocheck = $vr['hddpath'];
			
			$df = disk_free_space("$dirtocheck");
			$Index=0;
			 while($df>=1024)
			  {
				$df/=1024;	
				$Index++;
					
					if ($Index ==2) 
					{
						$df/=1024;
					}
				
			  }
		

			$local_val = number_format ( $df, 2 );
		
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

