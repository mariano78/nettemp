<?php
    $csave = isset($_POST['csave']) ? $_POST['csave'] : '';
    $cip = isset($_POST['cip']) ? $_POST['cip'] : '';
	$cport = isset($_POST['cport']) ? $_POST['cport'] : '';
    $ckey = isset($_POST['ckey']) ? $_POST['ckey'] : '';
    if ($csave == "csave"){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE nt_settings SET value='$cip' WHERE option='client_ip'") or die ($db->lastErrorMsg());
    $db->exec("UPDATE nt_settings SET value='$ckey' WHERE option='client_key'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE nt_settings SET value='$cport' WHERE option='client_port'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

 

$root=$_SERVER["DOCUMENT_ROOT"];
$db = new PDO("sqlite:$root/dbf/nettemp.db");


	$sth = $db->prepare("SELECT * FROM ownlinks  ORDER BY id ASC");
    $sth->execute();
    $result = $sth->fetchAll(); 
    $numsen = count($result);


 
?>


<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Own links in menu</h3>
</div>
<div class="panel-body">
<div class="table-responsive">
<table class="table table-hover table-condensed small">

<thead>
	
		<th>Name</th>
		<th>Link</th>
		<th>on/off</th>
		<th></th>
	
</thead>

<tbody>
<?php

foreach ($result as $a) {
?>
	
	<tr>
		<td></td>
		<td></td>
		<td>
			<form action="" method="post" style="display:inline!important;"> 	
				<input type="hidden" name="linkid" value="<?php echo $a["id"]; ?>" />
				<button type="submit" name="linkon" value="<?php echo $a["onoff"] == 'on' ? 'off' : 'on'; ?>" <?php echo $a["onoff"] == 'on' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>>
				<?php echo $a["onoff"] == 'on' ? 'ON' : 'OFF'; ?></button>
				<input type="hidden" name="linkison" value="linkison" />
			</form>
		</td>
		<td></td>
	</tr>
	
	
	
	
	
<?php	
}



?>




</tbody>
</table>
</div>













</div>



<?php




