<?php
$ROOT=dirname(dirname(dirname(__FILE__)));
include("$ROOT/common/gpio_functions.php");
$db = new PDO("sqlite:$ROOT/dbf/nettemp.db");

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
			$sprinkler_trig=$a['sprinkler_trig'];
			//if($rev=='on') {$mode='LOW';} else {$mode='HIGH'; $rev=null;}
			
// Check if Lock by User
				if ($lock=='user') {
					
					$db->exec("UPDATE day_plan SET active='off' WHERE gpio='$gpio' AND rom='$rom' ");
					logs(date("Y-m-d H:i:s"),'Info',$rom." - Sprinkler is in manual mode");
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
									//$status='on';	
									$db->exec("UPDATE day_plan SET active='on' WHERE gpio='$gpio' AND rom='$rom' AND id='$w_profile_id' ");	
									
									} else {
										
										//$status='off';
										$db->exec("UPDATE day_plan SET active='off' WHERE gpio='$gpio' AND rom='$rom' AND id='$w_profile_id' ");									
										
										}
								}
								
								$rows2 = $db->query("SELECT * FROM day_plan WHERE gpio=$gpio AND rom='$rom' AND active='on'");
								$func2 = $rows2->fetchAll();
								$numRows2 = count($func2);
								if ( $numRows2 > '0' ) {	
								
								$rows3 = $db->query("SELECT tmp FROM sensors WHERE rom = '$sprinkler_trig'");
								$row3 = $rows3->fetchAll();
								foreach ($row3 as $as) {
						
								$sprinkler_trig_tmp=$as['tmp'];
								echo $sprinkler_trig_tmp ;
								echo $sprinkler_trig;
						
								}
								if ($sprinkler_trig = 'off' || $sprinkler_trig_tmp = '1.0') {
								
									gp_onoff($gpio,$rom,$ip,$rev,'on');
									logs(date("Y-m-d H:i:s"),'Info',$rom." - Sprinkler is ON");
								}
				
								} else {
									
									gp_onoff($gpio,$rom,$ip,$rev,'off');
									logs(date("Y-m-d H:i:s"),'Info',$rom." - Sprinkler is OFF");
								}
							
							
							} else {
								$db->exec("UPDATE day_plan SET active='off' WHERE gpio='$gpio' AND rom='$rom' ");
								gp_onoff($gpio,$rom,$ip,$rev,'off');
								logs(date("Y-m-d H:i:s"),'Info',$rom." - Sprinkler - Nothing to do - no dayplan");
								}
							
			
						
					}
}//main loop end
?>
