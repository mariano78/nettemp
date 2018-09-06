<?php
    $gpio_onoff = isset($_POST['gpio_onoff']) ? $_POST['gpio_onoff'] : '';
    $gpio_onoff1 = isset($_POST['gpio_onoff1']) ? $_POST['gpio_onoff1'] : '';
    if (($gpio_onoff1 == "gpio_onoff2") ){
		$db = new PDO('sqlite:dbf/nettemp.db');
		$db->exec("UPDATE nt_settings SET value='$gpio_onoff' WHERE option='gpio'") or die ($db->lastErrorMsg());
		echo $gpio_onoff;
		header("location: " . $_SERVER['REQUEST_URI']);
		exit();
    }
    
    $MCP23017_onoff = isset($_POST['MCP23017_onoff']) ? $_POST['MCP23017_onoff'] : '';
    $MCP23017_onoff1 = isset($_POST['MCP23017_onoff1']) ? $_POST['MCP23017_onoff1'] : '';
    if (($MCP23017_onoff1 == "MCP23017_onoff2") ){
		$db = new PDO('sqlite:dbf/nettemp.db');
		$db->exec("UPDATE nt_settings SET value='$MCP23017_onoff' WHERE option='MCP23017'") or die ($db->lastErrorMsg());
		header("location: " . $_SERVER['REQUEST_URI']);
		exit();
    }
	
	$screen_onoff = isset($_POST['screen_onoff']) ? $_POST['screen_onoff'] : '';
    $screen_onoff1 = isset($_POST['screen_onoff1']) ? $_POST['screen_onoff1'] : '';
    if (($screen_onoff1 == "screen_onoff2") ){
    $db->exec("UPDATE nt_settings SET value='$screen_onoff' WHERE option='screen'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }


?>



 
 <div class="grid-item settings">
	<div class="panel panel-default">
		<div class="panel-heading">Global settings</div>
	
		
    <table class="table table-hover table-condensed">
		<tbody>
			<tr>
				<td> GPIO RPI
				</td>
				<td>
					<form action="" method="post">
					<input type="hidden" name="gpio_onoff1" value="gpio_onoff2"  />
					<input data-toggle="toggle" data-size="mini" onchange="this.form.submit()" type="checkbox" name="gpio_onoff" value="on"  <?php echo $nts_gpio == 'on' ? 'checked="checked"' : ''; ?> >
					</form>
				</td>
			</tr>
			
			<tr>
				<td> GPIO MCP23017
				</td>
				<td>
					<form action="" method="post">
					<input type="hidden" name="MCP23017_onoff1" value="MCP23017_onoff2"  />
					<input data-toggle="toggle" data-size="mini" onchange="this.form.submit()" type="checkbox" name="MCP23017_onoff" value="on"  <?php echo $nts_MCP23017 == 'on' ? 'checked="checked"' : ''; ?> >
					</form>
				</td>
			</tr>
			<tr>
				<td> SCREEN
				</td>
				<td>
					<form action="" method="post">
					<input type="hidden" name="screen_onoff1" value="screen_onoff2"  />
					<input data-toggle="toggle" data-size="mini" onchange="this.form.submit()" type="checkbox" name="screen_onoff" value="on"  <?php echo $nts_screen == 'on' ? 'checked="checked"' : ''; ?> >
					</form>
				</td>
			</tr>
		</tbody>
	</table>
	</div>
</div>




