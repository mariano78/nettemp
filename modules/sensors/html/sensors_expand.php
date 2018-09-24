
<div class="panel panel-default">
<div class="panel-heading">Settings</div>
<div class="table-responsive">
<table class="table table-hover table-condensed small">
<thead>
	<tr>
		<th>Adjust</th>
		<th>Thing Speak</th>
		<th>Remote NT</th>
		<th>Remote Domoticz</th>
		<th>LCD</th>
	
	</tr>
</thead>
<tbody>

	<tr>
	<!--Adjust-->
	
		<td class="col-md-0">
		<?php if ($a["device"] != 'remote') { ?>
		<form action="" method="post" style="display:inline!important;">
		<input type="text" name="adj" size="2" maxlength="30" value="<?php echo $a["adj"]; ?>" required="" <?php echo $a["device"] == 'remote' ? 'disabled' : ''; ?> />
		<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
		<input type="hidden" name="name_id" value="<?php echo $a["id"]; ?>" />
		<input type="hidden" name="adj1" value="adj2"/>
		</form>
		<?php
		}
		?>
		</td>
	<!--Thing Speak-->
		<td class="col-md-0">
		<form action="" method="post" style="display:inline!important;" > 	
			<input type="hidden" name="thing_id" value="<?php echo $a["id"]; ?>" />
			<button type="submit" name="thing_on" value="<?php echo $a["thing"] == 'on' ? 'off' : 'on'; ?>" <?php echo $a["thing"] == 'on' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>>
			<?php echo $a["thing"] == 'on' ? 'ON' : 'OFF'; ?></button>
			<input type="hidden" name="th_on" value="th_on" />
		</form>
		</td>
	<!--Remote NT-->
		<td class="col-md-0">
		<?php if ($a["device"] != 'remote' && $a["device"] != 'gpio') { ?>
		<form action="" method="post" style="display:inline!important;"> 	
			<input type="hidden" name="remote" value="<?php echo $a["id"]; ?>" />
			<button type="submit" name="remoteon" value="<?php echo $a["remote"] == 'on' ? 'off' : 'on'; ?>" <?php echo $a["remote"] == 'on' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>>
			<?php echo $a["remote"] == 'on' ? 'ON' : 'OFF'; ?></button>
			<input type="hidden" name="remoteonoff" value="onoff" />
		</form>
		<?php 
		}
		?>
		</td>
	<!--Remote Domoticz-->
		<td class="col-md-0">
		<?php if ($a["device"] != 'remote' && $a["device"] != 'gpio') { ?>
		<form action="" method="post" style="display:inline!important;"> 	
			<input type="hidden" name="remote" value="<?php echo $a["id"]; ?>" />
			<button type="submit" name="remoteon" value="<?php echo $a["domoticz"] == 'on' ? 'off' : 'on'; ?>" <?php echo $a["domoticz"] == 'on' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>>
			<?php echo $a["domoticz"] == 'on' ? 'ON' : 'OFF'; ?></button>
			<input type="hidden" name="remoteonoff" value="onoff" />
		</form>
		<?php 
		}
		?>
		<form action="" method="post" style="display:inline!important;"> 
			<input type="hidden" name="domoticz_id" value="<?php echo $a['id']; ?>" />
			<input type="text" name="domoticz_idx" size="1" value="<?php echo $a['domoticzidx']; ?>" />
			<input type="hidden" name="domoticzidx" value="domoticzidx" />
		<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
		</form>
    
		</td>
	<!--LCD-->
		<td class="col-md-0">
		<form action="" method="post" style="display:inline!important;"> 	
			<input type="hidden" name="lcdid" value="<?php echo $a["id"]; ?>" />
			<button type="submit" name="lcdon" value="<?php echo $a["lcd"] == 'on' ? 'off' : 'on'; ?>" <?php echo $a["lcd"] == 'on' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>>
			<?php echo $a["lcd"] == 'on' ? 'ON' : 'OFF'; ?></button>
			<input type="hidden" name="lcd" value="lcd" />
		</form>
		</td>
		
		
		<td class="col-md-8">
		</td>
	</tr>
	
	

</tbody>
</table>
</div>
</div>

