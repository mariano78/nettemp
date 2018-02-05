<?php
$ROOT=dirname(dirname(dirname(__FILE__)));
//$root=$_SERVER["DOCUMENT_ROOT"];
$db = new PDO("sqlite:$ROOT/dbf/nettemp.db");

// main loop
$rows = $db->query("SELECT * FROM thingspeak WHERE active='on' ");
$row = $rows->fetchAll();
	foreach ($row as $a) {
			
			$url = 'http://api.thingspeak.com/update';
			$ThingSpeakApiKey = $a['apikey'];
			
				foreach (range(1, 8) as $x) {
					$field.$x = $a['f.$x'];
					//$field2 = $a['f2'];
					//$field3 = $a['f3'];
					//$field4 = $a['f4'];
					//$field5 = $a['f5'];
					//$field6 = $a['f6'];
					//$field7 = $a['f7'];
					//$field8 = $a['f8'];	
				}			
			$data = 'key=' . $ThingSpeakApiKey . '&field1=' . $field1 . '&field2=' . $field2 .'&field3=' . $field3 . '&field4=' . $field4 . '&field5=' . $field5 . '&field6=' . $field6 . '&field7=' . $field7 . '&field8=' . $field8;
			 
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