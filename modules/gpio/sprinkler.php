<?php
$ROOT=dirname(dirname(dirname(__FILE__)));
//$root=$_SERVER["DOCUMENT_ROOT"];
include("$ROOT/common/functions.php");
$db = new PDO("sqlite:$ROOT/dbf/nettemp.db");


//***************************************************************************************************************** 


//***************************************************************************************************************** 
function logs($gpio,$ip,$content){
global $ROOT;


if(!empty($ip)){
	$f = fopen("$ROOT/tmp/gpio_".$gpio."_".$ip."_log.txt", "a");
}else {
	$f = fopen("$ROOT/tmp/gpio_".$gpio."_log.txt", "a");
}
fwrite($f, $content);
fclose($f); 
}


// main loop
$rows = $db->query("SELECT * FROM gpio WHERE mode='sprinkler' AND sprinkler_run='on'");
$row = $rows->fetchAll();
		foreach ($row as $a) {
			
			$gpio=$a['gpio'];
			$name=$a['name'];
			$ip=$a['ip'];
			$lock=$a['locked'];
			$rev=$a['rev']; 
			$rom=$a['rom'];
			if($rev=='on') {$mode='LOW';} else {$mode='HIGH'; $rev=null;}
			
// Check if Lock by User
				if ($lock=='user') {
					$db->exec("UPDATE day_plan SET active='off' WHERE gpio='$gpio' AND rom='$rom' ");
					$content = date('Y M d H:i:s')." GPIO ".$gpio.", name: ".$name." - LOCKED by USER.\n";
					logs($gpio,$ip,$content);
				}   else {
						$day=date("D");
						$time=date("Hi");
						$rows = $db->query("SELECT * FROM day_plan WHERE gpio=$gpio AND rom='$rom' AND (Mon='$day' OR Tue='$day' OR Wed='$day' OR Thu='$day' OR Fri='$day' OR Sat='$day' OR Sun='$day')");
						$func = $rows->fetchAll();
						$numRows = count($func);
						
						if ( $numRows > '0' ) { 
							foreach ($func as $b) {
			
								$w_profile_id=$b['id'];
								$w_profile=$b['name'];
								$stime=$b['stime'];
								$stime=str_replace(':', '', $stime);
								$etime=$b['etime'];
								$etime=str_replace(':', '', $etime);
								
						
							if($time >= $stime && $time < $etime) {
								$status='on';	
								$db->exec("UPDATE day_plan SET active='on' WHERE gpio='$gpio' AND rom='$rom' AND id='$w_profile_id' ");	
								$content = date('Y M d H:i:s')." GPIO ".$gpio.", name: ".$name.", Day Plan: ".$w_profile.", SET: ".$status."\n";
								logs($gpio,$ip,$content);
								//action_on($gpio,$rev,$ip,$rom);	
								} else {
									
									$status='off';
									$db->exec("UPDATE day_plan SET active='off' WHERE gpio='$gpio' AND rom='$rom' AND id='$w_profile_id' ");									
									$content = date('Y M d H:i:s')." GPIO ".$gpio.", name: ".$name.", Day Plan: ".$w_profile.", SET: ".$status."\n";
									logs($gpio,$ip,$content);
									//action_off($gpio,$rev,$ip,$rom);	
									}
							}
							
							$rows2 = $db->query("SELECT * FROM day_plan WHERE gpio=$gpio AND rom='$rom' AND active='on'");
							$func2 = $rows2->fetchAll();
							$numRows2 = count($func2);
							if ( $numRows2 > '0' ) {
								
								//action_on($gpio,$rev,$ip,$rom);	
								gp_onoff($gpio,$rom,$ip,$rev,'on')
								
							} else {
								
								//action_off($gpio,$rev,$ip,$rom);
								gp_onoff($gpio,$rom,$ip,$rev,'off')
								
							}
							
							
						}
						   else {
								$db->exec("UPDATE day_plan SET active='off' WHERE gpio='$gpio' AND rom='$rom' ");
								$content = date('Y M d H:i:s')." GPIO ".$gpio.", name: ".$name." - Nothing to do - no dayplan.\n";
								logs($gpio,$ip,$content);
								action_off($gpio,$rev,$ip,$rom);
								}
							
			
						
					}
}//main loop end
?>
