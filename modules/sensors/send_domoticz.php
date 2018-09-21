<?php
$ROOT=dirname(dirname(dirname(__FILE__)));
 
$date = date("Y-m-d H:i:s"); 
$hostname=gethostname(); 

try {
    $db = new PDO("sqlite:$ROOT/dbf/nettemp.db");
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo $date." Could not connect to the database.\n";
    exit;
}
try {
    $sth = $db->query("SELECT * FROM nt_settings");
	$sth->execute();
	$result = $sth->fetchAll();
	foreach ($result as $a) {
		if($a['option']=='client_ip') {
			$client_ip=$a['value'];
		}
		if($a['option']=='client_key') {
			$client_key=$a['value'];
		}
		if($a['option']=='client_on') {
			$client_on=$a['value'];
		}
		if($a['option']=='cauth_on') {
			$cauth_on=$a['value'];
		}
		if($a['option']=='cauth_pass') {
			$cauth_pass=$a['value'];
		}
		if($a['option']=='client_port') {
			$client_port=$a['value'];
		}
}
    
    
    if(!empty($client_ip)&&!empty($client_key)&&!empty($client_on)){
		$query = $db->query("SELECT * FROM sensors WHERE domoticz='on'");
		$result= $query->fetchAll();
		foreach($result as $s) {

			$value=$s['tmp'];
			$type=$s['type'];
			$idx=$s['domoticzidx'];
			$current=$s['current'];
			
			if ($type == 'elec' ){
				
				$value2=$value*1000;
				
				$URL="192.168.50.2/json.htm?type=command&param=udevice&idx=173&nvalue=0&svalue=$current;$value2";

			}
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $URL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERPWD, "admin:" . $cauth_pass);
			$server_output = curl_exec ($ch);
			curl_close ($ch);
			//echo $date." Name:".$name." Rom:".$rom." Value:".$value. " Current:".$current."\n";
			echo $server_output;
		}
    }


} catch (Exception $e) {
    echo $date." Error.\n";
    echo $e;
    exit;
}
?>

