<?php
$ROOT=dirname(dirname(dirname(__FILE__)));

function send_not ($notname,$notmessage,$notsms,$notmail,$notpov){
	
	if ($notsms == 'on') {
		
		echo "Wysyłam SMS - ".$notmessage."\n";
		
		
	}
	
	if ($notmail == 'on') {
		
		echo "Wysyłam Mail - ".$notmessage."\n";
		
		
	}
	
	if ($notpov == 'on') {
		
		echo "Wysyłam PushOver - ".$notmessage."\n";
		
		
	}
	
	
	
	
	
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
					send_not($sname,$message,$nsms,$nmail,$npov);
					}
					
			}elseif ($nwhen == '2') {
				
				if ($stmp <= $nvalue) {
					if (!empty($nmsg)) {
						$message = $nmsg;
					}else {
						$message = $sname." value is ".$stmp." <= ".$nvalue;	
					}
					send_not($sname,$message,$nsms,$nmail,$npov);
					}
				
			}elseif ($nwhen == '3') {
				
				if ($stmp > $nvalue) {
					if (!empty($nmsg)) {
						$message = $nmsg;
					}else {
						$message = $sname." value is ".$stmp." > ".$nvalue;	
					}
					send_not($sname,$message,$nsms,$nmail,$npov);
					}
	
			}elseif ($nwhen == '4') {
				
				if ($stmp >= $nvalue) {
					if (!empty($nmsg)) {
						$message = $nmsg;
					}else {
						$message = $sname." value is ".$stmp." >= ".$nvalue;	
					}
					send_not($sname,$message,$nsms,$nmail,$npov);
					}
				
			}elseif ($nwhen == '5') {
				
				if ($stmp == $nvalue) {
					if (!empty($nmsg)) {
						$message = $nmsg;
					}else {
						$message = $sname." value is ".$stmp." = ".$nvalue;	
					}
					send_not($sname,$message,$nsms,$nmail,$npov);
					}	
				
			}elseif ($nwhen == '6') {
				
				if ($stmp != $nvalue) {
					if (!empty($nmsg)) {
						$message = $nmsg;
					}else {
						$message = $sname." value is ".$stmp." != ".$nvalue;	
					}
					send_not($sname,$message,$nsms,$nmail,$npov);
					}
				
			}
	
	
	}
	
	
//try end	
} catch (Exception $e) {
    echo $date." Error\n";
    exit;
}

?>