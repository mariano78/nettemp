<?php
$ROOT=dirname(dirname(dirname(__FILE__)));
 
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
		echo $date." More than one \n";
		
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
		
		echo $ntype." is type \n";
		
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
				
				echo $date." Type is < ".$sname." - sensor\n";
				
				
				
			}
			
			if ($nwhen == '2') {
				
				echo $date." Type is <= ".$sname." - sensor\n";
				
				
				
			}
			
			if ($nwhen == '3') {
				
				echo $date." Type is > ".$sname." - sensor\n";
				
				
				
			}
			
			if ($nwhen == '4') {
				
				echo $date." Type is >= ".$sname." - sensor\n";
				
				
				
			}
			
			if ($nwhen == '5') {
				
				echo $date." Type is == ".$sname." - sensor\n";
				
				
				
			}
			
			if ($nwhen == '6') {
				
				echo $date." Type is != ".$sname." - sensor\n";
				
				
				
			}
		
		
		
		
		
//sms	
		if ($nsms == "on") {
			
			
		}
// sms end

//mail	
		if ($nmail == "on") {
			
			
		}
//mail end
	
//poshover	
		if ($npov == "on") {
			
			
		}
//poshover end	

	
	
	}
	
	
//try end	
} catch (Exception $e) {
    echo $date." Error\n";
    exit;
}

?>