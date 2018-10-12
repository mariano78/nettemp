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
	$db->exec("INSERT INTO notifications ('rom', 'type', 'wheen', 'value', 'sms', 'mail', 'pov', 'message', 'priority', 'iginterval', 'recovery', 'active') VALUES ('$nrom', '$ntype', '$nwhen', '$nvalue', '$smsonoff', '$mailonoff', '$poonoff', '$nmessage', '$npriority', '$intervalonoff', '$recoveryonoff', 'on')") or die ($db->lastErrorMsg());
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
} 

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

	<tr>
		<td>
			<select class="selectpicker" data-width="50px" name="upsbacklight" class="form-control input-sm">
			<option value="1" >Value</option>
			<option value="2" >Last Update</option>
			</select>
		</td>
		
		<td>
			<select class="selectpicker" data-width="50px" name="upsbacklight" class="form-control input-sm">
			<option value="1" >></option>
			<option value="2" >>=</option>
			<option value="3" ><</option>
			<option value="4" ><=</option>
			</select>
		</td>
		
		<td>
		
		<div class="custom-control custom-checkbox">
  <input type="checkbox" class="custom-control-input" id="customCheck1">
  
</div></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
		<td>
		
		<form action="" method="post" style="display:inline!important;">
		<input type="hidden" name="rom" value="<?php echo $a["rom"]; ?>" />
		<input type="hidden" name="type" value="<?php echo $a["type"]; ?>" />
		<input type="hidden" name="gpio" value="<?php echo $a["gpio"]; ?>" />
		<input type="hidden" name="ip" value="<?php echo $a["ip"]; ?>" />
		<input type="hidden" name="usun2222" value="usun333333" />
		<button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
    </form>
		
		
		</td>
		
		
	</tr>


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
				<option value="valaaaaa" >Value</option>
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
			<input name="nvalue" class="form-control input-sm" required="" type="text" value="11">
		</td>
	</tr>
	<tr>
		<td><label>SMS:</label></td>
		<td>
			<input type="checkbox" value="1" data-toggle="toggle" data-size="mini"  name="smsonoff">
		</td>
	</tr>
	<tr>
		<td><label>Mail:</label></td>
		<td>
			<input type="checkbox" value="1" data-toggle="toggle" data-size="mini"  name="mailonoff">
		</td>
	</tr>
	<tr>
		<td><label>PushOver:</label></td>
		<td>
			<input type="checkbox" value="1" data-toggle="toggle" data-size="mini"  name="poonoff">
		</td>
	</tr>
	<tr>
		<td><label>Message:</label></td>
		<td>
			<input name="nmessage" placeholder="optional" class="form-control input-md" type="text" value="xxxxx">
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
			<input type="checkbox" value="1" data-toggle="toggle" data-size="mini"  name="intervalonoff">
		</td>
	</tr>
	<tr>
		<td><label>Recovery:</label></td>
		<td>
			<input type="checkbox" value="1" data-toggle="toggle" data-size="mini"  name="recoveryonoff">
		</td>
	</tr>
	<tr>
	</tr>
		<td></td>
		<td>
			<input type="text" name="nrom" value="<?php echo $a["rom"]; ?>" />
			<input type="text" name="nadd" value="nadd" />
			<button id="nsave" name="nsave" class="btn btn-xs btn-success">Add</button>
		</td>	
	</tr>
	</form>



	

</table>
</div>

</div>
</div>