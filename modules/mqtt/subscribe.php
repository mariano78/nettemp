<?php

/*

# IP IP/device/name/type
192.168.0.1/gpio/18

# localhost IP/device/addr/name/type
localhost/gpio/18/dht22/humid 
localhost/gpio/18/dht22/temp
localhost/i2c/55/BMP/temp
localhost/1wire/rom/temp

*/


$ROOT=(dirname(dirname(dirname(__FILE__))));
require("phpMQTT.php");
include("$ROOT/receiver.php");
define("LOCAL","local");
$date = date("Y-m-d H:i:s"); 


$server = "localhost";     // change if necessary
$port = 1883;                     // change if necessary
$username = "";                   // set your username
$password = "";                   // set your password
$client_id = "phpMQTT-subscriber"; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new phpMQTT($server, $port, $client_id);

if(!$mqtt->connect(true, NULL, $username, $password)) {
	exit(1);
}

$topics['#'] = array("qos" => 0, "function" => "procmsg");
$mqtt->subscribe($topics, 0);

while($mqtt->proc()){
		
}

$mqtt->close();


function procmsg($topic, $msg){
		echo "Msg Recieved: {$msg}\n";
		echo "Topic: {$topic}\n\n";
	//	echo "\t$msg\n\n";


    $ttp=(explode("/",$topic));
    foreach($ttp as $p) {
	$arr[]=$p;
    }

    global $date;

    global $local_rom;
    global $local_type;
    global $local_val;
    global $local_device;
    global $local_i2c;
    global $local_current;
    global $local_name;
    global $local_ip;
    global $local_gpio;
    global $local_usb;
	global $local_tskname;

    $output = trim($msg);

    $gpio='';
    $local_gpio='';
    
	
	// Shelly devices
	if ($arr['0']=='shellies') {
		
		echo "_____________________shellies____________________"."\n";
		
		// Check type of shelly device
		
		$t_type=(explode("-",$arr['1']));
			foreach($t_type as $tt) {
				$arr2[]=$tt;
			}
			
			$type = $arr2['0']; //rgbw2, shelly2.5 or another shelly device
			$id = $arr2['1']; //unique ID
				
				if ($type = 'rgbw2') {
					
					$reads = json_decode($output,true);
					$rgbw2_mode = $reads["mode"];
					$last = array_key_last($arr);
					
					if ( $arr[$last] == 'status' && $rgbw2_mode == 'white'){
						
						$channel = $arr[3] + 1;
						$output = (int)$reads["ison"];
						
						echo "output = ".$output."\n";
						echo "channel = ".$channel."\n";
						echo "ison = ".$reads["ison"]."\n";
						echo "mode = ".$reads["mode"]."\n";
						echo "brightness = ".$reads["brightness"]."\n";
						echo "power = ".$reads["power"]."\n";
						echo "overpower = ".$reads["overpower"]."\n";
						
					} else if ( $arr[$last] == 'status' && $rgbw2_mode == 'color'){
						
						$output = (int)$reads["ison"];
						
						echo "output = ".$output."\n";
						echo "ison = ".$reads["ison"]."\n";
						echo "mode = ".$reads["mode"]."\n";
						echo "red = ".$reads["red"]."\n";
						echo "green = ".$reads["green"]."\n";
						echo "blue = ".$reads["blue"]."\n";
						echo "white = ".$reads["white"]."\n";
						echo "gain = ".$reads["gain"]."\n";
						echo "effect = ".$reads["effect"]."\n";
						echo "power = ".$reads["power"]."\n";
						echo "overpower = ".$reads["overpower"]."\n";
						
						
					}
					
					$ip='';
		
					$name=$arr['1']; //rgbw2-XXXXXX
					$type = $arr2['0']; //rgbw2
					$id = $arr2['1']; // id = XXXXXX
					
					$local_device	=	'mqtt';
					$local_type		=	$type;
					$local_val		=	$output;
					$local_name		=	$name;
					$local_ip		=	$ip;
					//$local_gpio	=	$gpio;
					//$local_tskname = $tskname;
					$local_rom=$local_name;
					
				}  
			
		
		
		
	} else if ($arr['3']=='gpio') {
		
	$ip=$arr['1'];
	$name=$arr['2'];
	$type=$arr['3'];
	$gpio=$arr['4'];
	$tskname=$arr['5'];
    
	$local_device	=	'ip_mqtt';
	$local_type	=	$type;
	$local_val	=	$output;
	$local_name	=	$name;
	$local_ip	=	$ip;
	$local_gpio	=	$gpio;
	$local_tskname = $tskname;
	$local_rom=$local_device."_".$local_name."_".$local_type."_".$local_gpio."_".$local_tskname;
    }
    else {
	$ip=$arr['1'];
	$name=$arr['2'];
	$type=$arr['3'];
	$tskname=$arr['4'];
    
    $local_device	=	'ip_mqtt';
	$local_type	=	$type;
	$local_val	=	$output;
	$local_name	=	$name;
	$local_ip	=	$ip;
	$local_tskname = $tskname;
	$local_rom=$local_device."_".$local_name."_".$local_type."_".$local_tskname;
    }
    echo $date." Rom:".$local_rom." Name: ".$local_name." Value: ".$output." IP: ".$local_ip." GPIO: ".$local_gpio."\n";
    db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);

}
