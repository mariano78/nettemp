<?php
$logroot = "/var/www/nettemp";
function logs($date,$type,$message)
	{
	$logroot = "/var/www/nettemp";	
		
	$db = new PDO("sqlite:$logroot/dbf/nettemp.db");
	$db->exec("INSERT INTO logs ('date', 'type', 'message') VALUES ('$date', '$type', '$message')");
	}


	
function send_sms($date,type,$message)
{

	$dbr = new PDO("sqlite:".__DIR__."/dbf/nettemp.db") or die ("cannot open database");
    $sthr = $dbr->query("SELECT tel FROM users WHERE smsa='yes'");
    $row = $sthr->fetchAll();
    foreach($row as $row) {
		$smsto[]=$row['tel'];
    }
	
	
	if ($sms == 'on') {
			
			for ($x = 0, $cnt = count($smsto); $x < $cnt; $x++){
			$random=substr(rand(), 0, 4);
			
			$sms = "To: ".$smsto[$x]."\n\n".$message;
			$filepath = "tmp/sms/message_".$date."_".$random.".sms";
			$fsms = fopen($filepath, 'a+');
			fwrite($fsms, $sms);
			fclose($fsms);
			$ftosend = "/var/spool/sms/outgoing/message_".$date."_".$random.".sms";
	
			if (!copy($filepath, $ftosend)) {
			echo "Send failed.\n";
			} else {
				echo "Send OK.\n";
			}
			unlink($filepath);
			}
		}	
}

?>
