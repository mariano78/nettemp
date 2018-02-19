<?php 

$rows_trig = $db->query("SELECT name FROM sensors WHERE type='volt' ");
$row = $rows_trig->fetchAll();
?>

<div class="panel panel-default">
<div class="panel-heading">Trigger Settings</div>
<div class="table-responsive">
<table class="table table-hover table-condensed small" border="0">
<tr>
<?php

foreach($row as $a) { ?>
	

<td><?php echo $a['name']; ?> </td>

	
<?php}?>

</tr>
</table>
</div>
</div>