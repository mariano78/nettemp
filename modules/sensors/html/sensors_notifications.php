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
$activeonoff = isset($_POST['activeonoff']) ? $_POST['activeonoff'] : '';
$nadd = isset($_POST['nadd']) ? $_POST['nadd'] : '';
$nrom = isset($_POST['nrom']) ? $_POST['nrom'] : '';

if(!empty($nrom) && ($nadd == "nadd")) { 
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("INSERT INTO notifications ('rom', 'type', 'wheen', 'value', 'sms', 'mail', 'pov', 'message', 'priority', 'iginterval', 'recovery', 'active') 
	VALUES ('$nrom', '$ntype', '$nwhen', '$nvalue', '$smsonoff', '$mailonoff', '$poonoff', '$nmessage', '$npriority', '$intervalonoff', '$recoveryonoff', '$activeonoff')");
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

//SMS
$notsms = isset($_POST['notsms']) ? $_POST['notsms'] : '';
$sms_not_id = isset($_POST['sms_not_id']) ? $_POST['sms_not_id'] : '';
$not_sms_onoff = isset($_POST['not_sms_onoff']) ? $_POST['not_sms_onoff'] : '';

if(!empty($sms_not_id) && ($not_sms_onoff == "onoff")) { 
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
	$db->exec("UPDATE notifications SET sms = '$notsms' WHERE id='$sms_not_id'");
}
//Mail
$notmail = isset($_POST['notmail']) ? $_POST['notmail'] : '';
$mail_not_id = isset($_POST['mail_not_id']) ? $_POST['mail_not_id'] : '';
$not_mail_onoff = isset($_POST['not_mail_onoff']) ? $_POST['not_mail_onoff'] : '';

if(!empty($mail_not_id) && ($not_mail_onoff == "onoff")) { 
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
	$db->exec("UPDATE notifications SET mail = '$notmail' WHERE id='$mail_not_id'");
}
//Pov
$notpov = isset($_POST['notpov']) ? $_POST['notpov'] : '';
$pov_not_id = isset($_POST['pov_not_id']) ? $_POST['pov_not_id'] : '';
$not_pov_onoff = isset($_POST['not_pov_onoff']) ? $_POST['not_pov_onoff'] : '';

if(!empty($pov_not_id) && ($not_pov_onoff == "onoff")) { 
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
	$db->exec("UPDATE notifications SET pov = '$notpov' WHERE id='$pov_not_id'");
}
//Interval
$notinterv = isset($_POST['notinterv']) ? $_POST['notinterv'] : '';
$interval_not_id = isset($_POST['interval_not_id']) ? $_POST['interval_not_id'] : '';
$not_iginterval_onoff = isset($_POST['not_iginterval_onoff']) ? $_POST['not_iginterval_onoff'] : '';

if(!empty($interval_not_id) && ($not_iginterval_onoff == "onoff")) { 
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
	$db->exec("UPDATE notifications SET iginterval = '$notinterv' WHERE id='$interval_not_id'");
}
//Recovery
$notrecv = isset($_POST['notrecv']) ? $_POST['notrecv'] : '';
$recv_not_id = isset($_POST['recv_not_id']) ? $_POST['recv_not_id'] : '';
$not_rec_onoff = isset($_POST['not_rec_onoff']) ? $_POST['not_rec_onoff'] : '';

if(!empty($recv_not_id) && ($not_rec_onoff == "onoff")) { 
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
	$db->exec("UPDATE notifications SET recovery = '$notrecv' WHERE id='$recv_not_id'");
}

//Active
$notactv = isset($_POST['notactv']) ? $_POST['notactv'] : '';
$actv_not_id = isset($_POST['actv_not_id']) ? $_POST['actv_not_id'] : '';
$not_actv_onoff = isset($_POST['not_actv_onoff']) ? $_POST['not_actv_onoff'] : '';

if(!empty($actv_not_id) && ($not_actv_onoff == "onoff")) { 
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
	$db->exec("UPDATE notifications SET active = '$notactv' WHERE id='$actv_not_id'");
}

//Priority
$priorityselect = isset($_POST['priorityselect']) ? $_POST['priorityselect'] : '';
$prio_not_id = isset($_POST['prio_not_id']) ? $_POST['prio_not_id'] : '';
$prio_onoff = isset($_POST['prio_onoff']) ? $_POST['prio_onoff'] : '';

if(!empty($prio_not_id) && ($prio_onoff == "onoff")) { 
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
	$db->exec("UPDATE notifications SET priority = '$priorityselect' WHERE id='$prio_not_id'");
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
			
			<td> 
				<form action="" method="post" style="display:inline!important;">
					<input type="hidden" name="sms_not_id" value="<?php echo $n['id']; ?>" />
					<input type="checkbox" data-toggle="toggle" data-size="mini"  name="notsms" value="on" <?php echo $n["sms"] == 'on' ? 'checked="checked"' : ''; ?> onchange="this.form.submit()" />
					<input type="hidden" name="not_sms_onoff" value="onoff" />
				</form>
			</td>
			
			<td>
				<form action="" method="post" style="display:inline!important;">
					<input type="hidden" name="mail_not_id" value="<?php echo $n['id']; ?>" />
					<input type="checkbox" data-toggle="toggle" data-size="mini"  name="notmail" value="on" <?php echo $n["mail"] == 'on' ? 'checked="checked"' : ''; ?> onchange="this.form.submit()" />
					<input type="hidden" name="not_mail_onoff" value="onoff" />
				</form>
			</td>
			
			<td> 
				<form action="" method="post" style="display:inline!important;">
					<input type="hidden" name="pov_not_id" value="<?php echo $n['id']; ?>" />
					<input type="checkbox" data-toggle="toggle" data-size="mini"  name="notpov" value="on" <?php echo $n["pov"] == 'on' ? 'checked="checked"' : ''; ?> onchange="this.form.submit()" />
					<input type="hidden" name="not_pov_onoff" value="onoff" />
				</form>
			</td>
			
			<td> 
				<form action="" method="post" style="display:inline!important;">
					<input type="text" name="mes_new" size="10" maxlength="30" value="<?php echo $n["message"]; ?>" />
					<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
					<input type="hidden" name="not_mes_id" value="<?php echo $n['id']; ?>" />
					<input type="hidden" name="new_not_mes" value="new_not_mes"/>
				</form>
			</td>
			
			<td> 
				<form action="" method="post"  class="form-inline">
				<select class="selectpicker" data-width="50px" name="priorityselect" class="form-control input-sm" onchange="this.form.submit()">
					<option value="verylow" <?php echo $n[priority] == 'verylow' ? 'selected="selected"' : ''; ?> >Very low</option>
					<option value="moderate" <?php echo $n[priority] == 'moderate'? 'selected="selected"' : ''; ?> >Moderate</option>
					<option value="normal" <?php echo $n[priority] == 'normal'? 'selected="selected"' : ''; ?> >Normal</option>
					<option value="high" <?php echo $n[priority] == 'high'? 'selected="selected"' : ''; ?> >High</option>
					<option value="emergency" <?php echo $n[priority] == 'emergency'? 'selected="selected"' : ''; ?> >Emergency</option>
				</select>
				<input type="hidden" name="prio_onoff" value="onoff" />
				<input type="hidden" name="prio_not_id" value="<?php echo $n['id']; ?>" />
				</form>
			</td>
			
			<td> 
				<form action="" method="post" style="display:inline!important;">
					<input type="hidden" name="interval_not_id" value="<?php echo $n['id']; ?>" />
					<input type="checkbox" data-toggle="toggle" data-size="mini"  name="notinterv" value="on" <?php echo $n["iginterval"] == 'on' ? 'checked="checked"' : ''; ?> onchange="this.form.submit()" />
					<input type="hidden" name="not_iginterval_onoff" value="onoff" />
				</form>
			</td>
			
			<td> 
				<form action="" method="post" style="display:inline!important;">
					<input type="hidden" name="recv_not_id" value="<?php echo $n['id']; ?>" />
					<input type="checkbox" data-toggle="toggle" data-size="mini"  name="notrecv" value="on" <?php echo $n["recovery"] == 'on' ? 'checked="checked"' : ''; ?> onchange="this.form.submit()" />
					<input type="hidden" name="not_rec_onoff" value="onoff" />
				</form>
			</td>
				
			<td>
				<form action="" method="post" style="display:inline!important;">
					<input type="hidden" name="actv_not_id" value="<?php echo $n['id']; ?>" />
					<input type="checkbox" data-toggle="toggle" data-size="mini"  name="notactv" value="on" <?php echo $n["active"] == 'on' ? 'checked="checked"' : ''; ?> onchange="this.form.submit()" />
					<input type="hidden" name="not_actv_onoff" value="onoff" />
				</form>
			</td>
			
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

</div>

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

	<tr>
		<form action="" method="post">	
		<td>
			<select name="ntype" >
				<option value="value" >Value</option>
				<option value="lupdate" >Last Update</option>
			</select>
		</td>
	
		<td>
			<select name="nwhen" >
				<option value="1" ><</option>
				<option value="2" ><=</option>
				<option value="3" >></option>
				<option value="4" >>=</option>
			</select>
		</td>
		
		<td>
			<input name="nvalue"  required="" type="text" size="1" value="">
		</td>
		
		<td>
			<input type="checkbox" name="smsonoff" value="on">
		</td>
		
		<td>
			<input type="checkbox"  name="mailonoff" value="on">
		</td>
		
		<td>
			<input type="checkbox"  name="poonoff" value="on">
		</td>
		
		<td>
			<input name="nmessage" placeholder="optional"  type="text" value="">
		</td>
		
		<td>
			<select name="npriority" class="selectpicker"">
				<option value="verylow">Very Low</option>
				<option value="moderate">Moderate</option>
				<option value="normal">Normal</option>
				<option value="high">High</option>
				<option value="emergency">Emergency</option>
			</select>
		</td>
		
		<td>
			<input type="checkbox"  name="intervalonoff" value="on">
		</td>
		
		<td>
			<input type="checkbox" name="recoveryonoff" value="on">
		</td>
		
		<td>
			<input type="checkbox" name="activeonoff" value="on">
		</td>
		
		<td>
			<input type="hidden" name="nrom" value="<?php echo $a["rom"]; ?>" />
			<input type="hidden" name="nadd" value="nadd" />
			<button id="nsave" name="nsave" class="btn btn-xs btn-success">Add</button>
		</td>	
	</form>
	
	
	
	</tr>





	

</table>
</div>

</div>
</div>
<a href="index.php?id=<?php echo $id ?>&type=devices&device_group=<?php echo $device_group?>&device_type=<?php echo $device_type?>&device_menu=settings&device id=<?php  if($device_group == '' && $device_type == '') {echo '';} else {echo $a["id"];} ?>" ><button class="btn btn-xs btn-info">Back</button></a>