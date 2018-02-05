<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Thing Speak </h3> 

	<form action="" method="post" style="display:inline!important;">
		<button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-plus"></span> </button>
		<input type="hidden" name="addthc" value="addthc"/>
	</form></div>

<?php

// add thingspeak chanell
$addthc = isset($_POST['addthc']) ? $_POST['addthc'] : '';
if(!empty($addthc) && ($addthc == "addthc")) { 
	
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("INSERT INTO thingspeak ('name', 'apikey', 'active') VALUES ('My new chanell','API KEY', 'off')");
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
}

//name
$name_new = isset($_POST['name_new']) ? $_POST['name_new'] : '';
$name_id = isset($_POST['name_id']) ? $_POST['name_id'] : '';
if(!empty($name_id) && !empty($name_new) && ($th_name == "th_name")) { 
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("UPDATE thingspeak SET name='$name_new' WHERE id='$name_id'");
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
}

//api key
$api_new = isset($_POST['api_new']) ? $_POST['api_new'] : '';
$api_id = isset($_POST['api_id']) ? $_POST['api_id'] : '';
if(!empty($api_id) && !empty($api_new) && ($th_api == "th_api")) { 
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("UPDATE thingspeak SET apikey='$api_new' WHERE id='$api_id'");
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
}




$db = new PDO('sqlite:dbf/nettemp.db');
$rows = $db->query("SELECT * FROM thingspeak");
$row = $rows->fetchAll();
$count = count($row);
if ($count >= "1") {
?>
<div class="table-responsive">
<table class="table table-hover table-condensed small" border="0">
<thead>
<th>Name</th>
<th>API Key</th>
<th>F1</th>
<th>F2</th>
<th>F3</th>
<th>F4</th>
<th>F5</th>
<th>F6</th>
<th>F7</th>
<th>F8</th>
<th>Active</th>
</thead>
<?php
foreach ($row as $a) { 	
?>
<tr>
    <td class="col-md-1">
	<form action="" method="post" style="display:inline!important;">
			<input type="text" name="name_new" size="15" maxlength="30" value="<?php echo $a["name"]; ?>" />
			<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
			<input type="hidden" name="name_id" value="<?php echo $a["id"]; ?>" />
			<input type="hidden" name="th_name" value="th_name"/>
	</form>
	</td>
	
	<td class="col-md-0">
	<form action="" method="post" style="display:inline!important;">
			<input type="text" name="api_new" size="15" maxlength="30" value="<?php echo $a["apikey"]; ?>" />
			<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
			<input type="hidden" name="api_id" value="<?php echo $a["id"]; ?>" />
			<input type="hidden" name="th_api" value="th_api"/>
	</form>
	</td>
	
	<td class="col-md-0">
		<?php echo $a["f1"]; ?>
	</td>
	
	<td class="col-md-0">
		<?php echo $a["f2"]; ?>
	</td>
	
	<td class="col-md-0">
		<?php echo $a["f3"]; ?>
	</td>
	
	<td class="col-md-0">
		<?php echo $a["f4"]; ?>
	</td>
	
	<td class="col-md-0">
		<?php echo $a["f5"]; ?>
	</td>
	
	<td class="col-md-0">
		<?php echo $a["f6"]; ?>
	</td>
	
	<td class="col-md-0">
		<?php echo $a["f7"]; ?>
	</td>
	
	<td class="col-md-0">
		<?php echo $a["f8"]; ?>
	</td>
	
	<td class="col-md-0">
		<?php echo $a["active"]; ?>
	</td>
</tr>
<?php
	}
?>
</table>
<?php
	} 
?>
</div>

