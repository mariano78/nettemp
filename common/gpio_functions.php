<?php
//$root=$_SERVER["DOCUMENT_ROOT"];
include("$ROOT/common/functions.php");

//***************************************************************************************************************** 
function gp_onoff($gpio,$rom,$ip,$rev,$act) {
	
	global $froot;
	global $db;
	
	if($act == 'on' && $rev == 'on'){
			$do_act = '0';
		} elseif ($act == 'on' && $rev == ''){
			$do_act = '1';
		} elseif ($act == 'off' && $rev == 'on'){
			$do_act = '1';
		} elseif ($act == 'off' && $rev == ''){
			$do_act = '0';
		}
	
	if(empty($ip)){
		
		$out="/usr/local/bin/gpio -g mode $gpio output";
		exec($out);
		
		$run="/usr/local/bin/gpio -g write $gpio $do_act";
		exec($run);
		
	} else {
		$ch = curl_init();
		$optArray = array(
			CURLOPT_URL => "$ip/control?cmd=GPIO,$gpio,$do_act",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CONNECTTIMEOUT => 1,
			CURLOPT_TIMEOUT => 3
		);
		curl_setopt_array($ch, $optArray);
		$res = curl_exec($ch);
		if(curl_errno($ch))
		{
			//$content = date('Y M d H:i:s')." GPIO ".$gpio." IP ".$ip.", Curl error: ".curl_error($ch)."\n";
			//logs($gpio,$ip,$content);//poprawić logsy
		}
		
	}
	//global $rom;
		
	$arg1 = array('0', '1');
	$arg2 = array('0.0', '1.0');
	$sens_tmp = str_replace ( $arg1, $arg2, $do_act );
		
	
	$db->exec("UPDATE sensors SET tmp='$sens_tmp' WHERE rom='$rom'");
	
	$act = strtoupper($act);
	$db->exec("UPDATE gpio SET status='$act' WHERE gpio='$gpio' AND rom='$rom'");
	
	
	if (file_exists("$froot/db/$gpio.sql")) {
		$dbb = new PDO("sqlite:$froot/db/$gpio.sql") or die ("WARNING timestamp 1\n" );
	    $dbb->exec("INSERT OR IGNORE INTO def (value) VALUES ('$do_act')") or die ("WARNING timestamp 2\n" );
  	}
	else {
		$dbb = new PDO("sqlite:$froot/db/$gpio.sql");
		$dbb->exec("CREATE TABLE def (time DATE DEFAULT (datetime('now','localtime')), value INTEGER)") or die ("WARNING timestamp 3\n" );
    	$db->exec("INSERT OR IGNORE INTO def (value) VALUES ('$do_act')") or die ("WARNING timestamp 4\n" );
	}

}
?>
