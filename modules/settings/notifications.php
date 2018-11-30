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

	$po_onoff = isset($_POST['po_onoff']) ? $_POST['po_onoff'] : '';
    $po_onoff1 = isset($_POST['po_onoff1']) ? $_POST['po_onoff1'] : '';
    if (($po_onoff1 == "po_onoff2") ){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE nt_settings SET value='$po_onoff' WHERE option='pusho_active'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
	$pouserkey = isset($_POST['pouserkey']) ? $_POST['pouserkey'] : '';
    $poapikey = isset($_POST['poapikey']) ? $_POST['poapikey'] : '';
	$posave = isset($_POST['posave']) ? $_POST['posave'] : '';
	
    if (($posave == "posave") ){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE nt_settings SET value='$pouserkey' WHERE option='pusho_user_key'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE nt_settings SET value='$poapikey' WHERE option='pusho_api_key'") or die ($db->lastErrorMsg());
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
					<<form action="" method="post"  class="form-inline">
						<select class="selectpicker" data-width="50px" name="sensinterval" class="form-control input-sm" onchange="this.form.submit()">
							<option value="1m" <?php echo $n[priority] == '1m' ? 'selected="selected"' : ''; ?> >1 Minute</option>
							<option value="5m" <?php echo $n[priority] == '5m'? 'selected="selected"' : ''; ?> >5 Minutes</option>
							<option value="15m" <?php echo $n[priority] == '15m'? 'selected="selected"' : ''; ?> >10 Minutes</option>
							<option value="30m" <?php echo $n[priority] == '30m'? 'selected="selected"' : ''; ?> >30 Minutes</option>
							<option value="1h" <?php echo $n[priority] == '1h'? 'selected="selected"' : ''; ?> >1 Hour</option>
							<option value="2h" <?php echo $n[priority] == '2h'? 'selected="selected"' : ''; ?> >2 Hours</option>
							<option value="5h" <?php echo $n[priority] == '5h'? 'selected="selected"' : ''; ?> >5 Hours</option>
							<option value="12h" <?php echo $n[priority] == '12h'? 'selected="selected"' : ''; ?> >12 Huors</option>
						</select>
						<input type="hidden" name="prio_onoff" value="onoff" />
						<input type="hidden" name="prio_not_id" value="<?php echo $n['id']; ?>" />
					</form>
				</td>
			</tr>
				<form action="" method="post">	
			<tr>
				<td><label>Switches/GPIO:</label></td>
				<td>
					<form action="" method="post"  class="form-inline">
						<select class="selectpicker" data-width="50px" name="switchinterval" class="form-control input-sm" onchange="this.form.submit()">
							<option value="0m" <?php echo $n[priority] == '0m' ? 'selected="selected"' : ''; ?> >Immediately</option>
							<option value="1m" <?php echo $n[priority] == '1m' ? 'selected="selected"' : ''; ?> >1 Minute</option>
							<option value="5m" <?php echo $n[priority] == '5m'? 'selected="selected"' : ''; ?> >5 Minutes</option>
							<option value="15m" <?php echo $n[priority] == '15m'? 'selected="selected"' : ''; ?> >10 Minutes</option>
							<option value="30m" <?php echo $n[priority] == '30m'? 'selected="selected"' : ''; ?> >30 Minutes</option>
							<option value="1h" <?php echo $n[priority] == '1h'? 'selected="selected"' : ''; ?> >1 Hour</option>
							<option value="2h" <?php echo $n[priority] == '2h'? 'selected="selected"' : ''; ?> >2 Hours</option>
							<option value="5h" <?php echo $n[priority] == '5h'? 'selected="selected"' : ''; ?> >5 Hours</option>
							<option value="12h" <?php echo $n[priority] == '12h'? 'selected="selected"' : ''; ?> >12 Huors</option>
						</select>
						<input type="hidden" name="prio_onoff" value="onoff" />
						<input type="hidden" name="prio_not_id" value="<?php echo $n['id']; ?>" />
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




