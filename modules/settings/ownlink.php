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
	
	$addlink = isset($_POST['addlink']) ? $_POST['addlink'] : '';
	if(!empty($addlink) && ($addlink == "addlink")) { 
	
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("INSERT INTO ownlinks ('pos', 'name', 'link', 'onoff') VALUES ('0','My_link','http://', 'on')");
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
	} 
	
	$position = isset($_POST['position']) ? $_POST['position'] : '';
    $position_id = isset($_POST['position_id']) ? $_POST['position_id'] : '';
    if (!empty($position_id) && ($_POST['positionok'] == "ok")){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE ownlinks SET pos='$position' WHERE id='$position_id'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
	$linkid = isset($_POST['linkid']) ? $_POST['linkid'] : '';
	$linkon = isset($_POST['linkon']) ? $_POST['linkon'] : '';
	$linkison = isset($_POST['linkison']) ? $_POST['linkison'] : '';
	if(!empty($linkison) && ($linkison == "linkison")) { 
	
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("UPDATE ownlinks SET onoff='$linkon' WHERE id='$linkid'");
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

<form action="" method="post" style="display:inline!important;">
			<button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-plus"></span> </button>
			<input type="hidden" name="addlink" value="addlink"/>
		</form>

</div>
<div class="panel-body">
<div class="table-responsive">
<table class="table table-hover table-condensed small">

<thead>
		<th>Position</th>
		<th>Name</th>
		<th>Link</th>
		<th>Active</th>
		<th></th>
	
</thead>

<tbody>
<?php

foreach ($result as $a) {
?>
	
	<tr>
	
		<td class="col-md-0">
			<form action="" method="post" style="display:inline!important;">
				<input type="hidden" name="position_id" value="<?php echo $a["id"]; ?>" />
				<input type="text" name="position" size="1" maxlength="3" value="<?php echo $a['pos']; ?>" />
				<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
				<input type="hidden" name="positionok" value="ok" />
			</form>
		</td>
	
		<td>
			<form action="" method="post" style="display:inline!important;"> 
				<input type="hidden" name="owlnameid" value="<?php echo $a['id']; ?>" />
				<input type="text" name="owlname" size="15" value="<?php echo $a['name']; ?>" />
				<input type="hidden" name="owlnameok" value="owlnameok" />
				<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
			</form>
		
		
		</td>
		<td>
			<form action="" method="post" style="display:inline!important;"> 
				<input type="hidden" name="owllinkid" value="<?php echo $a['id']; ?>" />
				<input type="text" name="owllink" size="50" value="<?php echo $a['link']; ?>" />
				<input type="hidden" name="owllinkok" value="owllinkok" />
				<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
			</form>
		
		</td>
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




