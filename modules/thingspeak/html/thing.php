<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Thing Speak </h3> <form action="" method="post" style="display:inline!important;">
			<button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-plus"></span> </button>
			<input type="hidden" name="addow" value="addow"/>
		</form></div>

<?php
$sum = isset($_POST['sum']) ? $_POST['sum'] : '';
$sum1 = isset($_POST['sum1']) ? $_POST['sum1'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '';


if ($sum1 == 'sum2'){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE sensors SET sum='$sum' WHERE id='$id'") or die ($db->lastErrorMsg());
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();
}

 $ch_group = isset($_POST['ch_group']) ? $_POST['ch_group'] : '';
    $ch_grouponoff = isset($_POST['ch_grouponoff']) ? $_POST['ch_grouponoff'] : '';
    $ch_groupon = isset($_POST['ch_groupon']) ? $_POST['ch_groupon'] : '';
    if (($ch_grouponoff == "onoff")){
	$db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE sensors SET ch_group='$ch_groupon' WHERE id='$ch_group'") or die ($db->lastErrorMsg());
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

