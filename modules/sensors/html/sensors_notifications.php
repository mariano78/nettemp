
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