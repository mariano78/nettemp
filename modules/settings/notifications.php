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
			<div class="panel-heading">Notification Intervals)</div>
			
		<div class="table-responsive">
		<table class="table table-hover table-condensed">
			<tbody>	
	   
			<tr>
				<td><label>Sensors:</label></td>
				<td>
					<form action="" method="post" style="display:inline!important;">
						<input data-toggle="toggle" data-size="mini" onchange="this.form.submit()"  type="checkbox" name="po_onoff" value="on" <?php echo $nts_pusho_active == 'on' ? 'checked="checked"' : ''; ?>  />
						<input type="hidden" name="po_onoff1" value="po_onoff2" />
					</form>
				</td>
			</tr>
				<form action="" method="post">	
			<tr>
				<td><label>Switches/GPIO:</label></td>
				<td>
					<input name="pouserkey" class="form-control input-md"  type="text" value="<?php echo $nts_pusho_user_key; ?>">
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




