<?php
$gpio = isset($_POST['gpio']) ? $_POST['gpio'] : '';
$new_rom = isset($_POST['new_rom']) ? $_POST['new_rom'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';
$ip = isset($_POST['ip']) ? $_POST['ip'] : '';
$vdevice = isset($_POST['vdevice']) ? $_POST['vdevice'] : '';
$vname = isset($_POST['vname']) ? $_POST['vname'] : '';


$delallnewrom = isset($_POST['delallnewrom']) ? $_POST['delallnewrom'] : '';
if ($delallnewrom=='yes'){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("DELETE FROM newdev");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
}
$delnewrom = isset($_POST['delnewrom']) ? $_POST['delnewrom'] : '';
$delnew = isset($_POST['delnew']) ? $_POST['delnew'] : '';
if ($delnew=='yes'){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("DELETE FROM newdev WHERE id='$delnewrom'");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
}

//ADD from NEWDEV 
if(!empty($new_rom)) {
	
	if ($vdevice == 'virtual') {
		$name=$vname."_".mt_rand(0,1000);
		$new_rom=$type."_".mt_rand(0,1000);
		$map_num=substr(rand(), 0, 4);
				
	} else {
	$name=substr(rand(), 0, 4);
	$map_num=substr(rand(), 0, 4);
	$map_num2=substr(rand(), 0, 4);
	}
	
//DB    
if ($type=='elec' || $type=='water' || $type=='gas' || $type=='watt'|| $type=='gpio') {
	$dbnew = new PDO("sqlite:db/$new_rom.sql");
	$dbnew->exec("CREATE TABLE def (time DATE DEFAULT (datetime('now','localtime')), value INTEGER, current INTEGER, last INTEGER)");
	$dbnew->exec("CREATE INDEX time_index ON def(time)");
}
else {
	$dbnew = new PDO("sqlite:db/$new_rom.sql");
	$dbnew->exec("CREATE TABLE def (time DATE DEFAULT (datetime('now','localtime')), value INTEGER)");
	$dbnew->exec("CREATE INDEX time_index ON def(time)");
}

//check if file exist before insert to db 
if(file_exists("db/".$new_rom.".sql")&& filesize("db/".$new_rom.".sql")!=0){
	$device='sensors';

	//SENOSRS ALL
	if ($vdevice == 'virtual') {
		$db->exec("INSERT INTO sensors (rom,type,device,name) VALUES ('$new_rom','$type','$vdevice','$name')");
	} else {
	$db->exec("INSERT INTO sensors (rom,type,device,ip,gpio,i2c,usb,name) SELECT rom,type,device,ip,gpio,i2c,usb,name FROM newdev WHERE rom='$new_rom'");
	}
	
	$db->exec("UPDATE sensors SET alarm='off', tmp='0', adj='0', charts='on', sum='0', position='1', status='on', ch_group='$type',position_group='1',logon='off', thing='off', readerr='60', readerralarm='off', ghide='off', hide='off' WHERE rom='$new_rom'");
	
	
	// Trigger
	
	if($type=='trigger') {
		$db->exec("UPDATE sensors SET trigzeroclr='label-success', trigoneclr='label-danger', trigzero='0.0', trigone='1.0' WHERE rom='$new_rom'");
	}

	//GPIO
	if($type=='gpio') {
		$db->exec("INSERT INTO gpio (gpio, name, status, position, ip, rom, mode) VALUES ('$gpio','new_$gpio','OFF','1','$ip','$new_rom', 'simple')") or exit(header("Location: html/errors/db_error.php"));
		$device='gpio';
	}
	
	
	//maps settings
	$inserted=$db->query("SELECT id FROM sensors WHERE rom='$new_rom'");
	$inserted_id=$inserted->fetchAll();
	$inserted_id=$inserted_id[0];
	$db->exec("INSERT OR IGNORE INTO maps (type, map_pos, map_num,map_on,element_id) VALUES ('$device','{left:0,top:0}','$map_num','on','$inserted_id[id]')") or die ("gpio not maps");
	
	
}
header("location: " . $_SERVER['REQUEST_URI']);
exit();	
}



?>
<div class="panel panel-default">
<div class="panel-heading">Settings</div>
<div class="table-responsive">
<table class="table table-hover table-condensed small">
<thead>
	<tr>
		<th>ID</th>
		<th>List*</th>
		<th>Name</th>
		<th>ROM</th>
		<th>Type</th>
		<th>Device</th>
		<th>IP</th>
		<th>GPIO</th>
		<th>I2C</th>
		<th>USB</th>
		<th></th>
		<th></th>
	</tr>
</thead>
<tbody>

</tbody>
</table>
</div>
</div>

<?php//*********************************************virtual****************************************?>

<div class="panel panel-default">
<div class="panel-heading">Notifications</div>
<div class="table-responsive">
<table class="table table-hover table-condensed small">
<thead>
	<tr>
		<th>Type</th>
		<th>When</th>
		<th>Active systems</th>
		<th>Custom message</th>
		<th>Priority</th>
		<th>Ignore interval</th>
		<th>Recovery</th>
	</tr>
</thead>
<tbody>
	
</tbody>
</table>
</div>
</div>