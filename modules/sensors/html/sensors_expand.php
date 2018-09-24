
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
		<th></th>
		<th></th>
	
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
		<form action="" method="post" style="display:inline!important;"> 	
			<input type="hidden" name="remotedomoticz_id" value="<?php echo $a["id"]; ?>" />
			<button type="submit" name="domoticzon" value="<?php echo $a["domoticz"] == 'on' ? 'off' : 'on'; ?>" <?php echo $a["domoticz"] == 'on' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>>
			<?php echo $a["domoticz"] == 'on' ? 'ON' : 'OFF'; ?></button>
			<input type="hidden" name="domoticzonoff" value="domoticzonoff" />
		</form>
		<label>IDX: </label>
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
		<td>
		<?php if ($a['device'] == 'virtual' && substr($a['type'],0,3) == 'air') { ?>
		<label> API Key: </label>
		<form action="" method="post" style="display:inline!important;"> 
			<input type="hidden" name="api_id" value="<?php echo $a['id']; ?>" />
			<input type="text" name="apikey" size="10" value="<?php echo $a['apikey']; ?>" />
			<input type="hidden" name="api" value="apiok" />
			<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
		</form>
		<?php
		}
		?>
		<?php if ($a['device'] == 'virtual' && (substr($a['type'],0,3) == 'air') || substr($a['type'],0,3) == 'sun') { ?>
		<label> Lat/Lon: </label>
		<form action="" method="post" style="display:inline!important;"> 
			<input type="hidden" name="gps_id" value="<?php echo $a['id']; ?>" />
			<input type="text" name="latitude" size="3" value="<?php echo $a['latitude']; ?>" />
			<input type="text" name="longitude" size="3" value="<?php echo $a['longitude']; ?>" />
			<input type="hidden" name="gps" value="gpsok" />
			<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
		</form>
		
		<?php
		}
		?>
		<?php
		if ($a['device'] == 'virtual' && substr($a['type'],0,3) == 'sun') { ?>
		<label> Time Zone: </label>
		<form action="" method="post" style="display:inline!important;"> 
			<input type="hidden" name="tz_id" value="<?php echo $a['id']; ?>" />
			<input type="text" name="tzone" size="5" value="<?php echo $a['timezone']; ?>" />
			<input type="hidden" name="tz" value="tzok" />
			<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
		</form>
		
		<?php
		}
		?>
		<?php
		if ($a['device'] == 'virtual' && ((substr($a['type'],0,3) == 'max') || (substr($a['type'],0,3) == 'min'))) { ?>
		<label> Bind rom: </label>
		<form action="" method="post" style="display:inline!important;"> 
			<input type="hidden" name="bsens_id" value="<?php echo $a['id']; ?>" />
			<input type="text" name="bindsensor" size="15" value="<?php echo $a['bindsensor']; ?>" />
			<input type="hidden" name="ch_bsensor" value="ch_bsensorok" />
			<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
		</form>
		<?php
		}
		?>
		</td>
		
		
		<td class="col-md-6">
		</td>
		
	
	
	

</tbody>
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

