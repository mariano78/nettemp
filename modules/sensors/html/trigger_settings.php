<?php 

$rows_trig = $db->query("SELECT name FROM sensors WHERE type='volt' ");
$row = $rows_trig->fetchAll();
?>

<div class="panel panel-default">
<div class="panel-heading">Trigger Settings</div>
<div class="table-responsive">
<table class="table table-hover table-condensed small" border="0">


<?php

foreach($row as $tr) { ?>
	
<tr>
<td><?php echo $tr['name']; ?> </td>
</tr>
	
<?php}?>


</table>
</div>
</div>
<??>
