<?php
$ntype = isset($_POST['ntype']) ? $_POST['ntype'] : '';
$nwhen = isset($_POST['nwhen']) ? $_POST['nwhen'] : '';
$nvalue = isset($_POST['nvalue']) ? $_POST['nvalue'] : '';
$smsonoff = isset($_POST['smsonoff']) ? $_POST['smsonoff'] : '';
$mailonoff = isset($_POST['mailonoff']) ? $_POST['mailonoff'] : '';
$poonoff = isset($_POST['poonoff']) ? $_POST['poonoff'] : '';
$nmessage = isset($_POST['nmessage']) ? $_POST['nmessage'] : '';
$npriority = isset($_POST['npriority']) ? $_POST['npriority'] : '';
$intervalonoff = isset($_POST['intervalonoff']) ? $_POST['intervalonoff'] : '';
$recoveryonoff = isset($_POST['recoveryonoff']) ? $_POST['recoveryonoff'] : '';
$nadd = isset($_POST['nadd']) ? $_POST['nadd'] : '';
$nrom = isset($_POST['nrom']) ? $_POST['nrom'] : '';

if(!empty($nrom) && ($nadd == "nadd")) { 
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("INSERT INTO notifications ('rom', 'type', 'wheen', 'value', 'sms', 'mail', 'pov', 'message', 'priority', 'iginterval', 'recovery', 'active') 
	VALUES ('$nrom', '$ntype', '$nwhen', '$nvalue', '$smsonoff', '$mailonoff', '$poonoff', '$nmessage', '$npriority', '$intervalonoff', '$recoveryonoff', 'on')");
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
} 

//DEL from Base
$del_not_rom = isset($_POST['del_not_rom']) ? $_POST['del_not_rom'] : '';
$del_not = isset($_POST['del_not']) ? $_POST['del_not'] : '';
$del_not_id = isset($_POST['del_not_id']) ? $_POST['del_not_id'] : '';


if(!empty($del_not_rom) && ($del_not == "del_not") && !empty($del_not_id) ) { 
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
	
	$db->exec("DELETE FROM notifications WHERE id='$del_not_id'");
}

//New Value
$val_new = isset($_POST['val_new']) ? $_POST['val_new'] : '';
$val_id = isset($_POST['val_id']) ? $_POST['val_id'] : '';
$val_ok = isset($_POST['val_ok']) ? $_POST['val_ok'] : '';

if(!empty($val_new) && ($val_ok == "val_ok")) { 
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
	
	$db->exec("UPDATE notifications SET value = '$val_new' WHERE id='$val_id'");
}

//New message
$mes_new = isset($_POST['mes_new']) ? $_POST['mes_new'] : '';
$not_mes_id = isset($_POST['not_mes_id']) ? $_POST['not_mes_id'] : '';
$new_not_mes = isset($_POST['new_not_mes']) ? $_POST['new_not_mes'] : '';

if(!empty($not_mes_id) && ($new_not_mes == "new_not_mes")) { 
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
	
	$db->exec("UPDATE notifications SET message = '$mes_new' WHERE id='$not_mes_id'");
}





$db = new PDO("sqlite:$root/dbf/nettemp.db");	
$notif = $db->query("SELECT * FROM notifications WHERE rom='$device_rom'");
$notifs = $notif->fetchAll();	

?>



<div class="panel panel-default">
<div class="panel-heading">Notifications</div>
<div class="table-responsive">
<table class="table table-hover table-condensed small">
<thead>
	<tr>
		<th>Type</th>
		<th>When</th>
		<th>Value</th>
		<th>SMS</th>
		<th>Mail</th>
		<th>PushOver</th>
		<th>Custom message</th>
		<th>Priority</th>
		<th>Ignore interval</th>
		<th>Recovery</th>
		<th>Active</th>
		<th></th>
	</tr>
</thead>

<?php	
	foreach ($notifs as $n) { ?>
		<tr>
			<td> 
				<?php if ($n[type] == 'value') {echo "Value";} elseif ($n[type] == 'lupdate') {echo "Last update";}  ?> 
			</td>
			
			<td> 
				<?php if ($n[wheen] == '1') {echo "<";} elseif ($n[wheen] == '2') {echo "<=";} elseif ($n[wheen] == '3') {echo ">";} elseif ($n[wheen] == '4') {echo ">=";}  ?> 
			</td>
		
			<td>
				<form action="" method="post" style="display:inline!important;"> 
					<input type="hidden" name="val_id" value="<?php echo $n['id']; ?>" />
					<input type="text" name="val_new" size="1" value="<?php echo $n['value']; ?>" />
					<input type="hidden" name="val_ok" value="val_ok" />
					<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
				</form>
			</td>
			
			<td> <?php echo $n[sms]; ?> </td>
			<td> <?php echo $n[mail]; ?> </td>
			<td> <?php echo $n[pov]; ?> </td>
			
			<td> 
				<form action="" method="post" style="display:inline!important;">
					<input type="text" name="mes_new" size="10" maxlength="30" value="<?php echo $n["message"]; ?>" />
					<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
					<input type="hidden" name="not_mes_id" value="<?php echo $n['id']; ?>" />
					<input type="hidden" name="new_not_mes" value="new_not_mes"/>
				</form>
			</td>
			
			<td> <?php echo $n[priority]; ?> </td>
			<td> <?php echo $n[iginterval]; ?> </td>
			<td> <?php echo $n[recovery]; ?> </td>
			<td> <?php echo $n[active]; ?> </td>
			
			<td> 
				<form action="" method="post" style="display:inline!important;">
					<input type="hidden" name="del_not_rom" value="<?php echo $n["rom"]; ?>" />
					<input type="hidden" name="del_not_id" value="<?php echo $n["id"]; ?>" />
					<input type="hidden" name="del_not" value="del_not" />
					<button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
				</form>
			</td>
			
		</tr>
<?php    
}
?>


</table>
</div>
<table class="table table-hover table-condensed small">
<thead>
</thead>
<tbody>
<tr>
<td>
<a href="index.php?id=<?php echo $id ?>&type=devices&device_group=<?php echo $device_group?>&device_type=<?php echo $device_type?>&device_menu=settings&device id=<?php  if($device_group == '' && $device_type == '' && $device_id == '') {echo '';} else {echo $a["id"];} ?>" ><button class="btn btn-xs btn-info">Back</button></a>
</td>
</tr>
</tbody>

</table>
</div>
<div class="grid-item">
<div class="panel panel-default">
<div class="panel-heading">New notifications</div>
<div class="table-responsive">
<table class="table table-hover table-condensed small">

<form action="" method="post">	

	<tr>
		<td><label>Type:</label></td>
		<td>
			<select name="ntype" class="form-control input-sm">
				<option value="value" >Value</option>
				<option value="lupdate" >Last Update</option>
			</select>
		</td>
	</tr>
	<tr>	
		<td><label>When:</label></td>
		<td>
			<select name="nwhen" class="form-control input-sm">
				<option value="1" ><</option>
				<option value="2" ><=</option>
				<option value="3" >></option>
				<option value="4" >>=</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><label>Value:</label></td>
		<td>
			<input name="nvalue" class="form-control input-sm" required="" type="text" value="">
		</td>
	</tr>
	<tr>
		<td><label>SMS:</label></td>
		<td>
			<input type="checkbox" name="smsonoff" value="on">
		</td>
	</tr>
	<tr>
		<td><label>Mail:</label></td>
		<td>
			<input type="checkbox"  name="mailonoff" value="on">
		</td>
	</tr>
	<tr>
		<td><label>PushOver:</label></td>
		<td>
			<input type="checkbox"  name="poonoff" value="on">
			
		</td>
	</tr>
	<tr>
		<td><label>Message:</label></td>
		<td>
			<input name="nmessage" placeholder="optional" class="form-control input-md" type="text" value="">
		</td>
	</tr>
	<tr>
		<td><label>Priority:</label></td>
		<td>
			<select name="npriority" class="form-control input-sm">
				<option value="verylow">Very Low</option>
				<option value="moderate">Moderate</option>
				<option value="normal">Normal</option>
				<option value="high">High</option>
				<option value="emergency">Emergency</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><label>Ignore interval:</label></td>
		<td>
			<input type="checkbox"  name="intervalonoff" value="on">
		</td>
	</tr>
	<tr>
		<td><label>Recovery:</label></td>
		<td>
			<input type="checkbox" data-toggle="toggle" data-size="mini"  name="recoveryonoff" value="on">
		</td>
	</tr>
	<tr>
	</tr>
		<td></td>
		<td>
			<input type="hidden" name="nrom" value="<?php echo $a["rom"]; ?>" />
			<input type="hidden" name="nadd" value="nadd" />
			<button id="nsave" name="nsave" class="btn btn-xs btn-success">Add</button>
		</td>	
	</tr>
	</form>



	

</table>
</div>

</div>
</div>