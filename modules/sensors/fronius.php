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
//$array[];
$dayenergy = $reads["Body"]["Data"]["DAY_ENERGY"]["Value"];

echo $dayenergy;


?>