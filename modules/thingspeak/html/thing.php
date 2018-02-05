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
	$db->exec("INSERT INTO thingspeak ('name', 'apikey', 'onoff', 'active') VALUES ('My new chanell','API KEY', 'off')");
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
</thead>
<?php
foreach ($row as $a) { 	
?>
<tr>
    <td class="col-md-1">
		<?php echo $a["name"]; ?>
	</td>
	
	<td class="col-md-0">
		<?php echo $a["apikey"]; ?>
	</td>
	
	<td class="col-md-0">
		<?php echo $a["f1"]; ?>
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

