
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
  <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
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
<div class="panel-heading">Add new notifications</div>
<div class="table-responsive">
<table class="table table-hover table-condensed small">

<form action="" method="post">	

	<tr>
		<td><label>Type:</label></td><td></td>
	</tr>
	<tr>	
		<td><label>When:</label></td><td></td>
		</tr>
	<tr>
		<td><label>Value:</label></td><td></td>
		</tr>
	<tr>
		<td><label>SMS:</label></td><td></td>
		</tr>
	<tr>
		<td><label>Mail:</label></td><td></td>
		</tr>
	<tr>
		<td><label>PushOver:</label></td><td></td>
		</tr>
	<tr>
		<td><label>Custom message:</label></td><td></td>
		</tr>
	<tr>
		<td><label>Priority:</label></td><td></td>
		</tr>
	<tr>
		<td><label>Ignore interval:</label></td><td></td>
		</tr>
	<tr>
		<td><label>Recovery:</label></td><td></td>
		</tr>
	<tr>
		<td><label>Active:</label></td><td></td>
		</tr>
	<tr>
	</tr>


		<td></td>
		
		<td>
		
		
		<input type="hidden" name="change_password1" value="change_password2" />
		<button id="mailsave" name="mailsave" class="btn btn-xs btn-success">Save</button>
    </form>
		
		
		</td>
		
		
	</tr>



	

</table>
</div>

</div>
</div>