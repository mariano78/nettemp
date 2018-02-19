<?php
$rows_trig = $db->query("SELECT rom, name, trigzero, trigone FROM sensors WHERE type='volt' ");
$rowtr = $rows_trig->fetchAll();
?>

<div class="panel panel-default">
<div class="panel-heading">Trigger Settings</div>
<div class="table-responsive">
<table class="table table-hover table-condensed small" border="0">


<?php

foreach($rowtr as $tr) { ?>
	
<tr>
<td><span class="label label-default"><?php echo str_replace("_", " ", $tr['name']) ?></span></td>
<td>
<form action="" method="post" style="display:inline!important;"> 
		<input type="hidden" name="tmp_id" value="<?php echo $tr['rom']; ?>" />
		<input type="text" name="trigzero" size="10" value="<?php echo $tr['trigerzero']; ?>" />
		<input type="text" name="trigone" size="10" value="<?php echo $a['trigerone']; ?>" />
		<input type="hidden" name="trigupdate" value="trigupdate" />
		<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
    </form>
</td>

<td><?php echo $tr["trigzero"]; ?> </td>
<td><?php echo $tr["trigone"]; ?> </td>
</tr>
	
<?php
}
?>

</table>
</div>
</div>
