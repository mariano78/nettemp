<?php

var_dump($argv);

parse_str($argv[1],$params);
$rom=$params['rom'];

parse_str($argv[2],$params);
$gpio=$params['gpio'];

parse_str($argv[3],$params);
$act=$params['act'];

$ROOT=dirname(dirname(__FILE__));
//echo $ROOT;
$db = new PDO("sqlite:$ROOT/dbf/nettemp.db");

$action = '';


$rows = $db->query("SELECT status, ip FROM gpio WHERE rom = '$rom' AND gpio = '$gpio'");
$row = $rows->fetchAll();

foreach ($row as $a) {
	
	$state = strtolower($a['status']);
	$ip = $a['ip'];
}

//echo $state;
//echo $ip;

function scurl($ip,$gpio,$action){
	
	$url = 'http://'.$ip.'/control?cmd=GPIO,'.$gpio.','.$action;
	
			$ch = curl_init($url);
			curl_setopt( $ch, CURLOPT_POST, 1);
			//curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
			//curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
			 
			curl_exec( $ch );
			//$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
	
	
}

if ($act == 'auto'){
	
	if ($state == 'on') {
		
		$action = '0';
		scurl ($ip,$gpio,$action );
		
	} else if ($state == 'off') {
		
		$action = '1';
		scurl ($ip,$gpio,$action );
	}
	
}else if ($act == 'on'){
	
		$action = '1';
		scurl ($ip,$gpio,$action );
	
}else if ($act == 'off'){
	
		$action = '0';
		scurl ($ip,$gpio,$action );
	
}else if ($act == 'status'){
	
		echo "State is ".$state."\n"; 
	
}


?>