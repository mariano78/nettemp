<?php
$ROOT=dirname(dirname(dirname(__FILE__)));
$date = date("Y-m-d H:i:s"); 
include("$ROOT/receiver.php");

function get_server_cpu_usage(){
 
	$load = sys_getloadavg();
	return $load[0];
 
}

$cpu=get_server_cpu_usage();

function get_server_memory_usage(){
 
	$free = shell_exec('free');
	$free = (string)trim($free);
	$free_arr = explode("\n", $free);
	$mem = explode(" ", $free_arr[1]);
	$mem = array_filter($mem);
	$mem = array_merge($mem);
	$memory_usage = $mem[2]/$mem[1]*100;
 
	return $memory_usage;
}

$mem=round(get_server_memory_usage(),2);

$system=array("system_cpu","system_memory");
//var_dump($system);
foreach($system as $file) {
	try {
		
		
		if($file=='system_cpu'){
			
		$local_rom = 'system_cpu';
		$local_val = $cpu;
		$local_type = 'cpuusage';
		$local_device = 'system';
			
		
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		
		} 
		if($file=='system_memory'){ 
			
		$local_rom = 'system_memory';
		$local_val = $mem;
		$local_type = 'memoryusage';
		$local_device = 'system';
			
		
		db($local_rom,$local_val,$local_type,$local_device,$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
		} 
		
	} catch (Exception $e) {
		echo $date." Error.\n";
		echo $e;
		exit;
	}
}




?>
