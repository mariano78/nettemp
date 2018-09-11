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
<div class="panel-heading">
<h3 class="panel-title">Notifications</h3>
</div>
<div class="panel-body">

	<div class="grid-item settings">
		<div class="panel panel-default">
			<div class="panel-heading">Email</div>
			
		
		<table class="table table-hover table-condensed">
			<tbody>	
	   
			<tr>
				<td>Active:</td>
				<td>
				<form action="" method="post">
				<input data-toggle="toggle" data-size="mini" onchange="this.form.submit()"  type="checkbox" name="ms_onoff" value="on" <?php echo $nts_mail_onoff == 'on' ? 'checked="checked"' : ''; ?>  />
				<input type="hidden" name="ms_onoff1" value="ms_onoff2" />
				</form>
				</td>
			</tr>
		<form class="form-horizontal" action="" method="post">	
			<tr>
				<td>From:</td>
				<td>
				
				</td>
			</tr>
			
			<tr>
				<td>Username:</td>
				<td>
				
				</td>
			</tr>
			
			<tr>
				<td>Password:</td>
				<td>
				
				</td>
			</tr>
			
			<tr>
				<td>SMTP Server:</td>
				<td>
				
				</td>
			</tr>
			
			<tr>
				<td>Port:</td>
				<td>
				
				</td>
			</tr>
			
			<tr>
				<td>Auth:</td>
				<td>
				
				</td>
			</tr>
			
			<tr>
				<td>TLS:</td>
				<td>
				
				</td>
			</tr>
			
			<tr>
				<td>TLS Check:</td>
				<td>
				
				</td>
			</tr>
			
			<tr>
				<td>Mail topic:</td>
				<td>
				
				</td>
			</tr>
			
			<tr>
				<td>Save switch:</td>
				<td>
				
				</td>
			</tr>
			</form>
			
			<tr>
				<td>Send test:</td>
				<td>
				
				</td>
			</tr>
				
				
			</tbody>
		</table>
		</div>
	</div>



</div>
</div>




