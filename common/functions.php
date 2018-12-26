<?php
$logroot = "/var/www/nettemp";
function logs($date,$type,$message)
	{
	$logroot = "/var/www/nettemp";	
		
	$db = new PDO("sqlite:$logroot/dbf/nettemp.db") or die ("cannot open database");
	$db->exec("INSERT INTO logs ('date', 'type', 'message') VALUES ('$date', '$type', '$message')");
	}


	
function send_sms($date,$type,$message)
{
$logroot = "/var/www/nettemp";	
	$dbr = new PDO("sqlite:$logroot/dbf/nettemp.db") or die ("cannot open database");
    $sthr = $dbr->query("SELECT tel FROM users WHERE smsa='yes'");
    $row = $sthr->fetchAll();
    foreach($row as $row) {
		$smsto[]=$row['tel'];
    }
	
	
			
			for ($x = 0, $cnt = count($smsto); $x < $cnt; $x++){
			$random=substr(rand(), 0, 4);
			
			$sms = "To: ".$smsto[$x]."\n\n".$message;
			$filepath = $logroot."/tmp/sms/message_".$date."_".$random.".sms";
			$fsms = fopen($filepath, 'a+');
			fwrite($fsms, $sms);
			fclose($fsms);
			$ftosend = "/var/spool/sms/outgoing/message_".$date."_".$random.".sms";
	
			if (!copy($filepath, $ftosend)) {
			echo "Send failed.\n";
			logs($date,'Error',$notmessage." - Unable to send SMS message - check configurations ");
			} else {
				echo "Send OK.\n";
				logs($date,'Info',$notmessage." - SMS was sent.");
			}
			unlink($filepath);
			}
			
}

?>
