<?php
$rows_trig = $db->query("SELECT name FROM sensors WHERE type='volt' ");
$rowtr = $rows_trig->fetchAll();
?>

<div class="panel panel-default">
<div class="panel-heading">Trigger Settings</div>
<div class="table-responsive">
<table class="table table-hover table-condensed small" border="0">


<?php

foreach($rowtr as $tr) { ?>
	
<tr>
<td><?php echo $tr["name"]; ?> </td>
<td><?php echo $tr["trigzero"]; ?> </td>
<td><?php echo $tr["trigone"]; ?> </td>
</tr>
	
<?php
}
?>

</table>
</div>
</div>
