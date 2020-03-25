<?php
    

	$addlink = isset($_POST['addlink']) ? $_POST['addlink'] : '';
	if(!empty($addlink) && ($addlink == "addlink")) { 
	
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("INSERT INTO ownlinks ('pos', 'name', 'link', 'onoff', 'target', 'logon') VALUES ('0','My_link','http://', 'on' , '_blank', 'on')");
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
	} 
	//position
	$position = isset($_POST['position']) ? $_POST['position'] : '';
    $position_id = isset($_POST['position_id']) ? $_POST['position_id'] : '';
    if (!empty($position_id) && ($_POST['positionok'] == "ok")){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE ownlinks SET pos='$position' WHERE id='$position_id'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
	//name
	$owlnameid = isset($_POST['owlnameid']) ? $_POST['owlnameid'] : '';
    $owlname = isset($_POST['owlname']) ? $_POST['owlname'] : '';
	$owlnameok = isset($_POST['owlnameok']) ? $_POST['owlnameok'] : '';
	
    if (!empty($owlnameok) && ($_POST['owlnameok'] == "owlnameok")){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE ownlinks SET name='$owlname' WHERE id='$owlnameid'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
	//link
	$owllinkid = isset($_POST['owllinkid']) ? $_POST['owllinkid'] : '';
    $owllink = isset($_POST['owllink']) ? $_POST['owllink'] : '';
	$owllinkok = isset($_POST['owllinkok']) ? $_POST['owllinkok'] : '';
	
    if (!empty($owllinkok) && ($_POST['owllinkok'] == "owllinkok")){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE ownlinks SET link='$owllink' WHERE id='$owllinkid'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
	//target
	$targetid = isset($_POST['targetid']) ? $_POST['targetid'] : '';
    $targeton = isset($_POST['targeton']) ? $_POST['targeton'] : '';
	$targetison = isset($_POST['targetison']) ? $_POST['targetison'] : '';
	
    if (!empty($targetison) && ($_POST['targetison'] == "targetison")){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE ownlinks SET target='$targeton' WHERE id='$targetid'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	//logoff
	$logonid = isset($_POST['logonid']) ? $_POST['logonid'] : '';
    $logonon = isset($_POST['logonon']) ? $_POST['logonon'] : '';
	$logonison = isset($_POST['logonison']) ? $_POST['logonison'] : '';
	
    if (!empty($logonison) && ($_POST['logonison'] == "logonison")){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE ownlinks SET logon='$logonon' WHERE id='$logonid'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	

	//on/off
	$linkid = isset($_POST['linkid']) ? $_POST['linkid'] : '';
	$linkon = isset($_POST['linkon']) ? $_POST['linkon'] : '';
	$linkison = isset($_POST['linkison']) ? $_POST['linkison'] : '';
	if(!empty($linkison) && ($linkison == "linkison")) { 
	
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("UPDATE ownlinks SET onoff='$linkon' WHERE id='$linkid'");
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
	} 
	
	//del
	$ownlinkdelid = isset($_POST['ownlinkdelid']) ? $_POST['ownlinkdelid'] : '';
	$ownlinkdel = isset($_POST['ownlinkdel']) ? $_POST['ownlinkdel'] : '';
	if(!empty($ownlinkdel) && ($ownlinkdel == "ownlinkdel")) { 
	
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("DELETE FROM ownlinks WHERE id = '$ownlinkdelid'");
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
	} 
	
	

 

$root=$_SERVER["DOCUMENT_ROOT"];
$db = new PDO("sqlite:$root/dbf/nettemp.db");


	$sth = $db->prepare("SELECT * FROM ownlinks  ORDER BY pos ASC");
    $sth->execute();
    $result = $sth->fetchAll(); 
    $numsen = count($result);


 
?>


<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Own links in menu</h3></div>

<div class="table-responsive">
<table class="table table-hover table-condensed small">

<thead>
		<th>Position</th>
		<th>Name</th>
		<th>Link</th>
		<th>New tab</th>
		<th>Logoff</th>
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
	
		<td class="col-md-0">
			<form action="" method="post" style="display:inline!important;"> 
				<input type="hidden" name="owlnameid" value="<?php echo $a['id']; ?>" />
				<input type="text" name="owlname" size="15" value="<?php echo $a['name']; ?>" />
				<input type="hidden" name="owlnameok" value="owlnameok" />
				<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
			</form>
		</td>
		
		<td class="col-md-0">
			<form action="" method="post" style="display:inline!important;"> 
				<input type="hidden" name="owllinkid" value="<?php echo $a['id']; ?>" />
				<input type="text" name="owllink" size="50" value="<?php echo $a['link']; ?>" />
				<input type="hidden" name="owllinkok" value="owllinkok" />
				<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
			</form>
		</td>
		
		<td class="col-md-0">
			<form action="" method="post" style="display:inline!important;"> 	
				<input type="hidden" name="targetid" value="<?php echo $a["id"]; ?>" />
				<button type="submit" name="targeton" value="<?php echo $a["target"] == '_blank' ? 'off' : '_blank'; ?>" <?php echo $a["target"] == '_blank' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>>
				<?php echo $a["target"] == '_blank' ? 'ON' : 'OFF'; ?></button>
				<input type="hidden" name="targetison" value="targetison" />
			</form>
		</td>
		
		<td class="col-md-0">
			<form action="" method="post" style="display:inline!important;"> 	
				<input type="hidden" name="logonid" value="<?php echo $a["id"]; ?>" />
				<button type="submit" name="logonon" value="<?php echo $a["logon"] == 'on' ? 'off' : 'on'; ?>" <?php echo $a["logon"] == 'on' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>>
				<?php echo $a["logon"] == 'on' ? 'ON' : 'OFF'; ?></button>
				<input type="hidden" name="logonison" value="logonison" />
			</form>
		</td>
		
		<td class="col-md-0">
			<form action="" method="post" style="display:inline!important;"> 	
				<input type="hidden" name="linkid" value="<?php echo $a["id"]; ?>" />
				<button type="submit" name="linkon" value="<?php echo $a["onoff"] == 'on' ? 'off' : 'on'; ?>" <?php echo $a["onoff"] == 'on' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>>
				<?php echo $a["onoff"] == 'on' ? 'ON' : 'OFF'; ?></button>
				<input type="hidden" name="linkison" value="linkison" />
			</form>
		</td>
		
		<td class="col-md-0">
			<form action="" method="post" style="display:inline!important;">
				<input type="hidden" name="ownlinkdelid" value="<?php echo $a["id"]; ?>" />
				<input type="hidden" name="ownlinkdel" value="ownlinkdel" />
				<button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
			</form>
		</td>
	</tr>
	
	
	
	
	
	
<?php	
}

?>
	<tr>
		<td>Add new link:
		<form action="" method="post" style="display:inline!important;">
			<button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-plus"></span> </button>
			<input type="hidden" name="addlink" value="addlink"/>
		</form>
		
		</td>
		<td></td><td></td><td></td><td></td><td></td><td></td>
	</tr>



</tbody>
</table>
</div>














</div>



<?php




