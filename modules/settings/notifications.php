<?php


    $ms_onoff = isset($_POST['ms_onoff']) ? $_POST['ms_onoff'] : '';
    $ms_onoff1 = isset($_POST['ms_onoff1']) ? $_POST['ms_onoff1'] : '';
    if (($ms_onoff1 == "ms_onoff2") ){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE nt_settings SET value='$ms_onoff' WHERE option='mail_onoff'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
?>

<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Notifications</h3></div>
<div class="panel-body">
<div class="grid">
	
<?php include('modules/mail/html/mail_settings.php'); ?>
<?php include('modules/pushover/html/pushover_settings.php'); ?>



<?php


	
	$sensinterval = isset($_POST['sensinterval']) ? $_POST['sensinterval'] : '';
    $sensint_upd = isset($_POST['sensint_upd']) ? $_POST['sensint_upd'] : '';
	
    if (!empty($sensint_upd) && ($sensint_upd == "upd") ){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE nt_settings SET value='$sensinterval' WHERE option='sensorinterval'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	$switchinterval = isset($_POST['switchinterval']) ? $_POST['switchinterval'] : '';
    $swint_upd = isset($_POST['swint_upd']) ? $_POST['swint_upd'] : '';
	
    if (!empty($swint_upd) && ($swint_upd == "upd") ){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE nt_settings SET value='$switchinterval' WHERE option='switchinterval'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

?>

<div class="grid-item">
		<div class="panel panel-default">
			<div class="panel-heading">Notification Intervals</div>
			
		<div class="table-responsive">
		<table class="table table-hover table-condensed">
			<tbody>	
	   
			<tr>
				<td><label>Sensors:</label></td>
				<td>
					<form action="" method="post"  class="form-inline">
						<select class="selectpicker" data-width="50px" name="sensinterval" class="form-control input-sm" onchange="this.form.submit()">
							<option value="1m" <?php echo $nts_sens_interval == '1m' ? 'selected="selected"' : ''; ?> >1 Minute</option>
							<option value="5m" <?php echo $nts_sens_interval == '5m'? 'selected="selected"' : ''; ?> >5 Minutes</option>
							<option value="15m" <?php echo $nts_sens_interval == '15m'? 'selected="selected"' : ''; ?> >10 Minutes</option>
							<option value="30m" <?php echo $nts_sens_interval == '30m'? 'selected="selected"' : ''; ?> >30 Minutes</option>
							<option value="1h" <?php echo $nts_sens_interval == '1h'? 'selected="selected"' : ''; ?> >1 Hour</option>
							<option value="2h" <?php echo $nts_sens_interval == '2h'? 'selected="selected"' : ''; ?> >2 Hours</option>
							<option value="6h" <?php echo $nts_sens_interval == '6h'? 'selected="selected"' : ''; ?> >5 Hours</option>
							<option value="12h" <?php echo $nts_sens_interval == '12h'? 'selected="selected"' : ''; ?> >12 Huors</option>
							<option value="24h" <?php echo $nts_sens_interval == '24h'? 'selected="selected"' : ''; ?> >24 Huors</option>
						</select>
						<input type="hidden" name="sensint_upd" value="upd" />
					</form>
				</td>
			</tr>
				<form action="" method="post">	
			<tr>
				<td><label>Switches/GPIO:</label></td>
				<td>
					<form action="" method="post"  class="form-inline">
						<select class="selectpicker" data-width="50px" name="switchinterval" class="form-control input-sm" onchange="this.form.submit()">
							<option value="0m" <?php echo $nts_sw_interval == '0m' ? 'selected="selected"' : ''; ?> >Immediately</option>
							<option value="1m" <?php echo $nts_sw_interval == '1m' ? 'selected="selected"' : ''; ?> >1 Minute</option>
							<option value="5m" <?php echo $nts_sw_interval == '5m'? 'selected="selected"' : ''; ?> >5 Minutes</option>
							<option value="15m" <?php echo $nts_sw_interval == '15m'? 'selected="selected"' : ''; ?> >10 Minutes</option>
							<option value="30m" <?php echo $nts_sw_interval == '30m'? 'selected="selected"' : ''; ?> >30 Minutes</option>
							<option value="1h" <?php echo $nts_sw_interval == '1h'? 'selected="selected"' : ''; ?> >1 Hour</option>
							<option value="2h" <?php echo $nts_sw_interval == '2h'? 'selected="selected"' : ''; ?> >2 Hours</option>
							<option value="6h" <?php echo $nts_sw_interval == '6h'? 'selected="selected"' : ''; ?> >6 Hours</option>
							<option value="12h" <?php echo $nts_sw_interval == '12h'? 'selected="selected"' : ''; ?> >12 Huors</option>
							<option value="12h" <?php echo $nts_sw_interval == '24h'? 'selected="selected"' : ''; ?> >24 Huors</option>
						</select>
						<input type="hidden" name="swint_upd" value="upd" />
					</form>
				</td>
			</tr>

			</tbody>
		</table>
		</div>
		</div>
	</div>




</div>
</div>
</div>




