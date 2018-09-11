<?php

?>

<div class="grid-item">
		<div class="panel panel-default">
			<div class="panel-heading">Pushover (Android / iOs)</div>
			
		<div class="table-responsive">
		<table class="table table-hover table-condensed">
			<tbody>	
	   
			<tr>
				<td><label>Active:</label></td>
				<td>
					<form action="" method="post">
						<input data-toggle="toggle" data-size="mini" onchange="this.form.submit()"  type="checkbox" name="ms_onoff" value="on" <?php echo $nts_pusho_active == 'on' ? 'checked="checked"' : ''; ?>  />
						<input type="hidden" name="po_onoff1" value="po_onoff2" />
					</form>
				</td>
			</tr>
		<form action="" method="post">	
			<tr>
				<td><label>User KEY:</label></td>
				<td>
					<input id="user" name="address" class="form-control input-md" type="text" value="<?php echo $a['from']; ?>">
				</td>
			</tr>
			
			<tr>
				<td><label>API KEY:</label></td>
				<td>
					<input id="user" name="user"  class="form-control input-md" required="" type="text" value="<?php echo $a['user']; ?>">
				</td>
			</tr>
			
			
			<tr>
				<td></td>
				<td>
					<input type="hidden" name="chang" value="change_password2" />
					<button id="mailsave" name="mailsave" class="btn btn-xs btn-success">Save</button>
		</form>
				</td>
			</tr>
			</form>
			
						
				
			</tbody>
		</table>
		</div>
		</div>
	</div>