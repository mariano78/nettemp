<?php
$ROOT=dirname(dirname(dirname(__FILE__)));
//$root=$_SERVER["DOCUMENT_ROOT"];
$db = new PDO("sqlite:$ROOT/dbf/nettemp.db");

// main loop
$rows = $db->query("SELECT * FROM thingspeak WHERE active='on' ");
$row = $rows->fetchAll();
	foreach ($row as $a => $item) {
			
			$url = 'http://api.thingspeak.com/update';
			$ThingSpeakApiKey = $a['apikey'];
			
			
			
			$item = $row[$a]['f1'];
			//$rom2 = $a['f2'];
			//$rom3 = $a['f3'];
			//$rom4 = $a['f4'];
			//$rom5 = $a['f5'];
			//$rom6 = $a['f6'];
			//$rom7 = $a['f7'];
			//$rom8 = $a['f8'];		
			
			$data = 'key=' . $ThingSpeakApiKey . '&field1=' . $item ;
			 
			$ch = curl_init($url);
			curl_setopt( $ch, CURLOPT_POST, 1);
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
			 
			$response = curl_exec( $ch );
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			echo $httpcode;

	}



?>

