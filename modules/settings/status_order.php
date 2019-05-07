<?php //Modules ORDER

 $modules = $db->query("SELECT * FROM statusorder ORDER BY position ASC") or header("Location: html/errors/db_error.php");
	$morder = $modules->fetchAll();
	

?>


<div class="grid-item settings">
	<div class="panel panel-default">
		<div class="panel-heading">Modules order</div>
		
		<table class="table table-hover table-condensed">
		<tbody>
		
		<?php
		
			foreach($morder as $mor) {
			$moduleposition = $mor['position'];
			$modulename = $mor['modulename'];
		?>
		
			<tr>
			
				<td><?php echo $moduleposition ?></td><td><?php echo $modulename ?></td>
			
			</tr>
		<?php
			}
		
		
		
		
		?>
		
		
		
		</tbody>
		</table>
		
		
		
		
		
	</div>
</div>	