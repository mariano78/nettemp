<?php
$trigzero= isset($_POST['trigzero']) ? $_POST['trigzero'] : '';
$trigone = isset($_POST['trigone']) ? $_POST['trigone'] : '';
$trigrom = isset($_POST['trigrom']) ? $_POST['trigrom'] : '';
$trigupdate = isset($_POST['trigupdate']) ? $_POST['trigupdate'] : '';
$zeroclr = isset($_POST['zeroclr']) ? $_POST['zeroclr'] : '';
$oneclr = isset($_POST['oneclr']) ? $_POST['oneclr'] : '';

    if ( !empty($trigupdate) && ($trigupdate == "trigupdate")){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE sensors SET trigzero='$trigzero' WHERE rom='$trigrom'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE sensors SET trigzeroclr='$zeroclr' WHERE rom='$trigrom'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE sensors SET trigone='$trigone' WHERE rom='$trigrom'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE sensors SET trigoneclr='$oneclr' WHERE rom='$trigrom'") or die ($db->lastErrorMsg());
	
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    } 

$rows_trig = $db->query("SELECT rom, name, trigzero, trigone, trigzeroclr, trigoneclr FROM sensors WHERE type='volt' ORDER BY position ASC ");
$rowtr = $rows_trig->fetchAll();
$labels = array('label-default', 'label-primary', 'label-success', 'label-info', 'label-danger');
?>

<div class="panel panel-default">
<div class="panel-heading">Trigger Settings</div>
<div class="table-responsive">
<table class="table table-hover table-condensed small" border="0">
<th>Trigger name</th>
<th>Settings for value = 0</th>
<th>Settings for value = 1</th>

<?php

foreach($rowtr as $tr) { ?>
	
<tr>
	<td class="col-md-0"><span class="label label-default"><?php echo str_replace("_", " ", $tr['name']) ?></span>
</td>

<td class="col-md-0" style="display:inline!important;">
<form action="" method="post" class="form-inline" style="display:inline!important;"> 
		<input type="hidden" name="trigrom" value="<?php echo $tr['rom']; ?>" />
		<label>For 0 value:</label>
		<input type="text" name="trigzero" size="10" value="<?php echo $tr['trigzero']; ?>" />
		<label>Color:</label>
		<select name="zeroclr" class="form-control input-sm">
		<?php foreach ($labels as $color) { ?>
			<option class="<?php echo $color; ?>" value="<?php echo $color; ?>"<?php echo $tr['trigzeroclr'] == $color ? 'selected="selected"' : ''; ?>><?php echo $color; ?></option>
		<?php } ?>	
		</select>
</td>
<td class="col-md-0" style="display:inline!important;">

		<label>For 1 value:</label>
		<input type="text" name="trigone" size="10" value="<?php echo $tr['trigone']; ?>" />
	
		<label>Color:</label>
		<select name="oneclr" class="form-control input-sm">
		<?php foreach ($labels as $color) { ?>
			<option class="<?php echo $color; ?>" value="<?php echo $color; ?>"<?php echo $tr['trigoneclr'] == $color ? 'selected="selected"' : ''; ?>><?php echo $color; ?></option>
		<?php } ?>
		</select>
		<input type="hidden" name="trigupdate" value="trigupdate" />
		<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
    </form>
</td>
<td class="col-md-3">
</td>

</tr>
	
<?php
}
?>

</table>
</div>
</div>
