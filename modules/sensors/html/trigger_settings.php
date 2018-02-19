<?php
$trigzero= isset($_POST['trigzero']) ? $_POST['trigzero'] : '';
$trigone = isset($_POST['trigone']) ? $_POST['trigone'] : '';
$trigrom = isset($_POST['trigrom']) ? $_POST['trigrom'] : '';
$trigupdate = isset($_POST['trigupdate']) ? $_POST['trigupdate'] : '';
    if ( !empty($trigupdate) && ($trigupdate == "trigupdate")){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE sensors SET trigzero='$trigzero' WHERE rom='$trigrom'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE sensors SET trigone='$trigone' WHERE rom='$trigrom'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    } 





$rows_trig = $db->query("SELECT rom, name, trigzero, trigone FROM sensors WHERE type='volt' ORDER BY position ASC ");
$rowtr = $rows_trig->fetchAll();
?>

<div class="panel panel-default">
<div class="panel-heading">Trigger Settings</div>
<div class="table-responsive">
<table class="table table-hover table-condensed small" border="0">


<?php

foreach($rowtr as $tr) { ?>
	
<tr>
<td class="col-md-0"><span class="label label-default"><?php echo str_replace("_", " ", $tr['name']) ?></span></td>

<td class="col-md-0">
<form action="" method="post" style="display:inline!important;"> 
		<input type="hidden" name="trigrom" value="<?php echo $tr['rom']; ?>" />
		<label for="exampleInputPassword1">For 0:</label>
		<input type="text" name="trigzero" size="10" value="<?php echo $tr['trigzero']; ?>" />
</td>
<td class="col-md-0">		
		<label for="exampleInputPassword1">Color:</label>
		<select name="zeroclr" class="form-control input-sm">
			<option value="label-default">default</option>
			<option value="label-primary">primary</option>
			<option value="label-success">success</option>
			<option value="label-info">info</option>
			<option value="label-danger">danger</option>
		</select>
</td>
<td class="col-md-0">
		<label for="exampleInputPassword1">For 1:</label>
		<input type="text" name="trigone" size="10" value="<?php echo $tr['trigone']; ?>" />
</td>	
<td class="col-md-0">	
		<label for="exampleInputPassword1">Color:</label>
		<select name="oneclr" class="form-control input-sm">
			<option value="label-default">default</option>
			<option value="label-primary">primary</option>
			<option value="label-success">success</option>
			<option value="label-info">info</option>
			<option value="label-danger">danger</option>
		</select>
		<input type="hidden" name="trigupdate" value="trigupdate" />
		<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
    </form>
</td>


</tr>
	
<?php
}
?>

</table>
</div>
</div>
