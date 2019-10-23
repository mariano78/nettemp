<?php
$url = "http://home.abc-service.com.pl:980//solar_api/v1/GetInverterRealtimeData.cgi?Scope=Device&DeviceID=1&DataCollection=CommonInverterData";
//  Initiate curl
$ch = curl_init();
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a beauty json :3
var_dump(json_decode($result, true));

$reads = json_decode($result,true);

$statuscode = $reads['Body']['Data']['DeviceStatus']['StatusCode'] ;
			if( $statuscode == 7) {
		
			$day_energy		= $reads['Body']['Data']['DAY_ENERGY']['Value'];
			$fac			= $reads['Body']['Data']['FAC']['Value'];
			$iac			= $reads['Body']['Data']['IAC']['Value'];
			$idc			= $reads['Body']['Data']['IDC']['Value'];
			$pac			= $reads['Body']['Data']['PAC']['Value'];
			$total_energy	= $reads['Body']['Data']['TOTAL_ENERGY']['Value'];
			$uac			= $reads['Body']['Data']['UAC']['Value'];
			$udc			= $reads['Body']['Data']['UDC']['Value'];
			$year_energy	= $reads['Body']['Data']['YEAR_ENERGY']['Value'];

				echo $day_energy."\n";
				echo $year_energy."\n";
			
			}else {
				echo "Fronius inverter - state other than running\n";
				echo $statuscode."\n";
			}

?>