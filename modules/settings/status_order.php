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
			$moduleid = $mor['id'];
			$moduleposition = $mor['position'];
			$modulename = $mor['modulename'];
		?>
		<tr>
		<td class="col-md-0">
		<form action="" method="post" style="display:inline!important;">
		<input type="hidden" name="module_id" value="<?php echo $moduleid; ?>" />
		<input type="text" name="module_position" size="1" maxlength="3" value="<?php echo $moduleposition; ?>" />
		<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
		<input type="hidden" name="module_positionok" value="ok" />
		</form>
		</td>
		
		<td><?php echo $modulename; ?></td>
			
			</tr>
		<?php
			}
		
		
		
		
		?>
		
		
		
		</tbody>
		</table>
		
		
		
		
		
	</div>
</div>	