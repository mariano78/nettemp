<?php

$ROOT=dirname(dirname(dirname(dirname(__FILE__))));
$date = date("Y-m-d H:i:s"); 



try {
    $db = new PDO("sqlite:$ROOT/dbf/nettemp.db");
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo $date." Could not connect to the database.\n";
    exit;
}

try {
    include("$ROOT/receiver.php");
    $query = $db->query("SELECT * FROM inverters");
    $result= $query->fetchAll();
	$inv = count($result);
	
	if ($inv > 0){
		
		foreach($result as $invr) {
			
			$inv_name = $invr['name'];
			$inv_ip = $invr['ip'];
			$inv_port = $invr['port'];
			$inv_type = $invr['type'];
			$local_device = 'ip';
			$rom = "inv_".$inv_name; 
			
			
				if ($inv_type == 'fronius'){
					
					$url = "http://".$inv_ip.":".$inv_port."/solar_api/v1/GetInverterRealtimeData.cgi?Scope=Device&DeviceID=1&DataCollection=CommonInverterData";
				
					//  Initiate curl
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_URL,$url);
					$result=curl_exec($ch);
					curl_close($ch);
					
					//var_dump(json_decode($result, true));
					
					$reads = json_decode($result,true);

					$statuscode = $reads['Body']['Data']['DeviceStatus']['StatusCode'] ;
					
						if( $statuscode == 7) {
							
							// Day Energy
							$day_energy		= $reads['Body']['Data']['DAY_ENERGY']['Value'];
							$local_rom = $rom."_day";
							$local_val = $day_energy / 1000;
							$local_type = 'kwatt';
							db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
							
							$fac			= $reads['Body']['Data']['FAC']['Value'];
							$iac			= $reads['Body']['Data']['IAC']['Value'];
							$idc			= $reads['Body']['Data']['IDC']['Value'];
							
							//Current produced energy - PAC
							$pac			= $reads['Body']['Data']['PAC']['Value'];
							$local_rom = $rom."_pac";
							$local_val = $pac;
							db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
							
							$total_energy	= $reads['Body']['Data']['TOTAL_ENERGY']['Value'];
							$uac			= $reads['Body']['Data']['UAC']['Value'];
							$udc			= $reads['Body']['Data']['UDC']['Value'];
							$year_energy	= $reads['Body']['Data']['YEAR_ENERGY']['Value'];

							echo $day_energy."\n";
							echo $year_energy."\n";
							
							//db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
						
						}	else {
								logs(date("Y-m-d H:i:s"),'Info',"Fronius inverter - state other than running ".$statuscode);
							}
					
					
				}
			
		}
	
	} logs(date("Y-m-d H:i:s"),'Info',"No inverters in system");
	
		
    
   	
		
} catch (Exception $e) {
    echo $date." Error.\n";
    echo $e;
    exit;
}





?>