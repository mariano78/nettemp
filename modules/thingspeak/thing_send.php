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
			
			$rom1 = $a['f1'];
			$f1 = $db->query("SELECT tmp FROM sensors WHERE rom='$rom1' ");
			$result = mysql_fetch_array($f1);
			$field1 = $result['tmp'];
			$rom2 = $a['f2'];
			$rom3 = $a['f3'];
			$rom4 = $a['f4'];
			$rom5 = $a['f5'];
			$rom6 = $a['f6'];
			$rom7 = $a['f7'];
			$rom8 = $a['f8'];		
			
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

