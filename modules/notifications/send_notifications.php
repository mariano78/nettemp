<?php
$ROOT=dirname(dirname(dirname(__FILE__)));

try {
	$db = new PDO("sqlite:$ROOT/dbf/nettemp.db");
	$query = $db->query("SELECT * FROM nt_settings");
    $result= $query->fetchAll();
    
    foreach($result as $s) {
		//if($s['option']=='mail_onoff' && $s['value']!='on') {
		//	echo $date." Cannot send mail bacause fucntion is off, go to settings.\n";
		//	exit();
		//}
		if($s['option']=='pusho_active') {
			$pusho=$s['value'];
		}
		if($s['option']=='pusho_user_key') {
			$pushoukey=$s['value'];
		}
		if($s['option']=='pusho_api_key') {
			$pushoakey=$s['value'];
		}
		if($s['option']=='sensorinterval') {
			$sens_interval=$s['value'];
		}
		if($s['option']=='switchinterval') {
			$sw_interval=$s['value'];
		}
	}
}catch (Exception $e) {
    echo $date." Error\n";
    exit;
}




function send_not ($nrom,$notname,$notmessage,$notsms,$notmail,$notpov,$priority,$pusho,$pushoukey,$pushoakey){
	
	if ($notsms == 'on') {
		
		echo "Wysyłam SMS - ".$notmessage."\n";
		
		
	}
	
	if ($notmail == 'on') {
		
		echo "Wysyłam Mail - ".$notmessage."\n";
		
		
	}
	
	if ($notpov == 'on') {
		
		if (($pusho == "on") ){
			
						curl_setopt_array($ch = curl_init(), array(
						  CURLOPT_URL => "https://api.pushover.net/1/messages.json",
						  CURLOPT_POSTFIELDS => array(
							"token" => "$pushoakey",
							"user" => "$pushoukey",
							"message" => "$notmessage",
							"priority" => "$priority",
							"retry" => "30",
							"expire" => "3600",
													
						  ),
						  CURLOPT_SAFE_UPLOAD => true,
						  CURLOPT_RETURNTRANSFER => true,
						));
						curl_exec($ch);
						curl_close($ch);	
						$postatus = 1;
						
					}
	}
		$db = new PDO("sqlite:$ROOT/dbf/nettemp.db");
		$db->exec("UPDATE sensors SET posend='sent' WHERE rom='$nrom'");
}
 
$date = date("Y-m-d H:i:s"); 
$hostname=gethostname(); 
$minute=date('i');

try {
    $db = new PDO("sqlite:$ROOT/dbf/nettemp.db");
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo $date." Could not connect to the database.\n";
    exit;
}

try {
	$query = $db->query("SELECT * FROM notifications WHERE active='on'");
    $result= $query->fetchAll();
    
    foreach($result as $sn) {
		
		$nrom=$sn['rom'];
		$ntype=$sn['type'];
		$nwhen=$sn['wheen'];
		$nvalue=$sn['value'];
		$nsms=$sn['sms'];
		$nmail=$sn['mail'];
		$npov=$sn['pov'];
		$nmsg=$sn['message'];
		$npriority=$sn['priority'];
		$niginterval=$sn['iginterval'];
		$nrecovery=$sn['recovery'];
				
		$sensor = $db->query("SELECT name,tmp,current,type FROM sensors WHERE rom='$nrom'");
		$sensors = $sensor->fetchAll();
		
		foreach ($sensors as $sen) {
			
			$sname=$sen['name'];
			$stmp=$sen['tmp'];
			$scurrent=$sen['current'];
			$stype=$sen['type'];
			
		}	
//check type 

			if ($nwhen == '1') {
				
				if ($stmp < $nvalue) {
					if (!empty($nmsg)) {
						$message = $nmsg;
					}else {
						$message = $sname." value is ".$stmp." < ".$nvalue;	
					}
					send_not($nrom,$sname,$message,$nsms,$nmail,$npov,$npriority,$pusho,$pushoukey,$pushoakey);
					}
					
			}elseif ($nwhen == '2') {
				
				if ($stmp <= $nvalue) {
					if (!empty($nmsg)) {
						$message = $nmsg;
					}else {
						$message = $sname." value is ".$stmp." <= ".$nvalue;	
					}
					send_not($nrom,$sname,$message,$nsms,$nmail,$npov,$npriority,$pusho,$pushoukey,$pushoakey);
					}
				
			}elseif ($nwhen == '3') {
				
				if ($stmp > $nvalue) {
					if (!empty($nmsg)) {
						$message = $nmsg;
					}else {
						$message = $sname." value is ".$stmp." > ".$nvalue;	
					}
					send_not($nrom,$sname,$message,$nsms,$nmail,$npov,$npriority,$pusho,$pushoukey,$pushoakey);
					}
	
			}elseif ($nwhen == '4') {
				
				if ($stmp >= $nvalue) {
					if (!empty($nmsg)) {
						$message = $nmsg;
					}else {
						$message = $sname." value is ".$stmp." >= ".$nvalue;	
					}
					send_not($nrom,$sname,$message,$nsms,$nmail,$npov,$npriority,$pusho,$pushoukey,$pushoakey);
					}
				
			}elseif ($nwhen == '5') {
				
				if ($stmp == $nvalue) {
					if (!empty($nmsg)) {
						$message = $nmsg;
					}else {
						$message = $sname." value is ".$stmp." = ".$nvalue;	
					}
					send_not($nrom,$sname,$message,$nsms,$nmail,$npov,$npriority,$pusho,$pushoukey,$pushoakey);
					}	
				
			}elseif ($nwhen == '6') {
				
				if ($stmp != $nvalue) {
					if (!empty($nmsg)) {
						$message = $nmsg;
					}else {
						$message = $sname." value is ".$stmp." != ".$nvalue;	
					}
					send_not($nrom,$sname,$message,$nsms,$nmail,$npov,$npriority,$pusho,$pushoukey,$pushoakey);
					}	
			}
	
	}
	
//try end	
} catch (Exception $e) {
    echo $date." Error\n";
    exit;
}

?>