<?php

var_dump($argv);

parse_str($argv[1],$params);
$rom=$params['rom'];

parse_str($argv[2],$params);
$gpio=$params['gpio'];

parse_str($argv[3],$params);
$act=$params['act'];

$ROOT=dirname(dirname(__FILE__));
echo $ROOT;
$db = new PDO("sqlite:$ROOT/dbf/nettemp.db");


$rows = $db->query("SELECT status, ip FROM gpio WHERE rom = '$rom' AND gpio = '$gpio'");
$row = $rows->fetchAll();

foreach ($row as $a) {
	
	$state = $a['status'];
	$ip = $a['ip'];
}



echo $status;
echo $ip;


if ($act == 'auto'){
	
}else if ($act == 'on'){
	
}else if ($act == 'off'){
	
}else if ($act == 'status'){
	
}


?>