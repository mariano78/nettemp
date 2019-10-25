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
			$local_ip = $inv_ip;
			
// Fronius Inverters		
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
							
							// Status
							$local_rom = $rom."_status";
							$local_val = 1;
							$local_type = 'trigger';
							db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
							
							// Day Energy
							$day_energy		= $reads['Body']['Data']['DAY_ENERGY']['Value'];
							$local_rom = $rom."_day";
							$local_val = $day_energy / 1000;
							$local_type = 'kwatt';
							db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
							
							// AC Frequency
							$fac			= $reads['Body']['Data']['FAC']['Value'];
							$local_rom = $rom."_fac";
							$local_val = $fac;
							$local_type = 'frequency';
							db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
							
							// AC Current
							$iac			= $reads['Body']['Data']['IAC']['Value'];
							$local_rom = $rom."_iac";
							$local_val = $iac;
							$local_type = 'amps';
							db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
							
							// DC Current
							$idc			= $reads['Body']['Data']['IDC']['Value'];
							$local_rom = $rom."_idc";
							$local_val = $idc;
							$local_type = 'amps';
							db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
							
							
							//Current produced energy - PAC
							$pac			= $reads['Body']['Data']['PAC']['Value'];
							$local_rom = $rom."_pac";
							$local_val = $pac;
							$local_type = 'watt';
							db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
							
							// Total produced energy
							$total_energy	= $reads['Body']['Data']['TOTAL_ENERGY']['Value'];
							$local_rom = $rom."_total";
							$local_val = $total_energy / 1000;
							$local_type = 'kwatt';
							db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
							
							//  AC Valtage
							$uac			= $reads['Body']['Data']['UAC']['Value'];
							$local_rom = $rom."_uac";
							$local_val = $uac;
							$local_type = 'volt';
							db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
							
							// DC Voltage
							$udc			= $reads['Body']['Data']['UDC']['Value'];
							$local_rom = $rom."_udc";
							$local_val = $udc;
							$local_type = 'volt';
							db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
							
							// Year produced energy
							$year_energy	= $reads['Body']['Data']['YEAR_ENERGY']['Value'];
							$local_rom = $rom."_year";
							$local_val = $year_energy / 1000;
							$local_type = 'kwatt';
							db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
							
						
						}	else {
								logs(date("Y-m-d H:i:s"),'Info',"Fronius ".$inv_name." inverter - state other than running ".$statuscode);
								
								// Status
								$local_rom = $rom."_status";
								$local_val = 0;
								$local_type = 'trigger';
								db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
								// UDC
								$local_rom = $rom."_udc";
								$local_val = 0;
								$local_type = 'volt';
								db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
								// UAC
								$local_rom = $rom."_uac";
								$local_val = 0;
								$local_type = 'volt';
								db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
								// AC Current
								$local_rom = $rom."_iac";
								$local_val = 0;
								$local_type = 'amps';
								db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
								// DC Current
								$local_rom = $rom."_idc";
								$local_val = 0;
								$local_type = 'amps';
								db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
							}

				}		
// Zeversolar Inverters					
				if ($inv_type == 'zeversolar'){
					
					$url = "http://".$inv_ip.":".$inv_port."/home.cgi";
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					if(!empty($post)) {
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
					}
					$inputdata = curl_exec($ch);
					curl_close($ch);
					
					$inputdata_expl = explode("\n", $inputdata);
					
					$statuscode = $inputdata_expl[12];
					
					if( $statuscode == 'OK') {
								
						//Current produced energy - PAC
						$peak =  $inputdata_expl[10];
						$local_rom = $rom."_pac";
						$local_val = $peak;
						$local_type = 'watt';
						db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
						
						//Day Energy
						$day_energy =  $inputdata_expl[11];
						$local_rom = $rom."_day";
						$local_val = $day_energy;
						$local_type = 'kwatt';
						db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
						
						//Status
						$local_rom = $rom."_status";
						$local_val = 1;
						$local_type = 'trigger';
						db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);

						
					} else {
						
						logs(date("Y-m-d H:i:s"),'Info',"Zeversolar ".$inv_name."inverter - state other than running ".$statuscode);
								
						// Status
						$local_rom = $rom."_status";
						$local_val = 0;
						$local_type = 'trigger';
						db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
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