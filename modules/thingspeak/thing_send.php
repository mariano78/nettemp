<?php
$ROOT=dirname(dirname(dirname(__FILE__)));
//$root=$_SERVER["DOCUMENT_ROOT"];
$db = new PDO("sqlite:$ROOT/dbf/nettemp.db");

// main loop
$rows = $db->query("SELECT * FROM thingspeak WHERE active='on' ");
$rows = $db->query("

SELECT t1.*,t2_1.tmp as tmp1,t2_2.tmp as tmp2,t2_3.tmp as tmp3,t2_4.tmp as tmp4,t2_5.tmp as tmp5,t2_6.tmp as tmp6,t2_7.tmp as tmp7,t2_8.tmp as tmp8 FROM thingspeak t1 LEFT JOIN sensors t2_1 ON t2_1.rom = t1.f1 LEFT JOIN sensors t2_2 ON t2_2.rom = t1.f2 LEFT JOIN sensors t2_3 ON t2_3.rom = t1.f3 LEFT JOIN sensors t2_4 ON t2_4.rom = t1.f4 LEFT JOIN sensors t2_5 ON t2_5.rom = t1.f5 LEFT JOIN sensors t2_6 ON t2_6.rom = t1.f6 LEFT JOIN sensors t2_7 ON t2_7.rom = t1.f7 LEFT JOIN sensors t2_8 ON t2_8.rom = t1.f8 WHERE active='on' ");
$row = $rows->fetchAll();
	foreach ($row as $a) {
			
			$url = 'http://api.thingspeak.com/update';
			$ThingSpeakApiKey = $a['apikey'];
			
			$field1 = $a['tmp1'];
			$field2 = $a['tmp2'];
			$field3 = $a['tmp3'];
			$field4 = $a['tmp4'];
			$field5 = $a['tmp5'];
			$field6 = $a['tmp6'];
			$field7 = $a['tmp7'];
			$field8 = $a['tmp8'];			
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