<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Counters </h3></div>

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


$db = new PDO('sqlite:dbf/nettemp.db');
$rows = $db->query("SELECT * FROM sensors WHERE type='elec' OR type='water' OR type='gas'");
$row = $rows->fetchAll();
$count = count($row);
if ($count >= "1") {
?>
<div class="table-responsive">
<table class="table table-hover table-condensed small" border="0">
<thead>
<th>Name</th>
<th>Type</th>
<th>Counter</th>
<th>Show in status</th>
<th>Costs</th>
</thead>
<?php
foreach ($row as $a) { 	
?>
<tr>
    <td class="col-md-1">
		<?php echo $a["name"]; ?>
	</td>
	<td class="col-md-1">
		<?php if ($a["type"] == 'elec') {echo 'Electricity';} else if ($a["type"] == 'gas') {echo 'Gas';} if ($a["type"] == 'water') {echo 'Water';}  ?>
	</td>
	<td class="col-md-1">
		<form action="" method="post" style="display:inline!important;">
			<input type="text" name="sum" size="10" maxlength="30" value="<?php echo $a["sum"]; ?>" required=""/>
			<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
			<input type="hidden" name="id" value="<?php echo $a["id"]; ?>" />
			<input type="hidden" name="sum1" value="sum2"/>
    </form>
	</td>
	
	<td class="col-md-6">
	
	<a href="index.php?id=creports&crom=<?php echo $a["rom"]; ?>"><button class="btn btn-xs btn-info">Reports</button></a>

   </td>
</tr>
<?php
	}
?>
</table>
<?php
	} else { 
		?>
		<div class="panel-body">
		No counters in system
		</div>
		<?php
	}
?>
</div>
</div>

