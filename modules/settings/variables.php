<?php
    $save = isset($_POST['save']) ? $_POST['save'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $unit = isset($_POST['unit']) ? $_POST['unit'] : '';
    $unit2 = isset($_POST['unit2']) ? $_POST['unit2'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
	$ico = isset($_POST['ico']) ? $_POST['ico'] : '';
    $save_id = isset($_POST['save_id']) ? $_POST['save_id'] : '';
	$add = isset($_POST['add']) ? $_POST['add'] : '';
	$min = isset($_POST['min']) ? $_POST['min'] : '';
	$max = isset($_POST['max']) ? $_POST['max'] : '';
	$value1 = isset($_POST['value1']) ? $_POST['value1'] : '';
	$value2 = isset($_POST['value2']) ? $_POST['value2'] : '';
	$value3 = isset($_POST['value3']) ? $_POST['value3'] : '';



   	 
    if ($save == 'save1'){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE types SET title='$title',unit2='$unit2',unit='$unit',type='$type',ico='$ico',min='$min',max='$max',value1='$value1',value2='$value2',value3='$value3' WHERE id='$save_id'") or header("Location: html/errors/db_error.php");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
    if ($add == 'add1'){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max, value1, value2 ,value3) VALUES ('$type','$unit','$unit2','$ico','$title','$min','$max','$value1','$value2','$value3')") or header("Location: html/errors/db_error.php");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
    if ($add == 'del1'){
    $db = new PDO('sqlite:dbf/nettemp.db');
	 $db->exec("DELETE FROM types WHERE id='$save_id'") or die ("cannot insert to DB");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

?>

<div class="panel panel-default">
<div class="panel-heading">Varibles</div>

<div class="table-responsive">
<table class="table table-hover table-condensed small" border="0">

<?php
$rows = $db->query("SELECT * FROM ovariables");
$row = $rows->fetchAll();
?>
<thead>
<tr>
<th>Name</th>
<th>Value</th>
<th>Delete</th>
</tr>
</thead>

<?php 
   foreach ($row as $a) { 	
	?>
<tr>
	 
	<td class="col-md-0">
		<form action="" method="post" style="display:inline!important;">
			<input type="text" name="type" size="10" maxlength="30" value="<?php echo $a['name']; ?>" class="form-control input-sm"/>
		</form>
    </td>
    
	<td class="col-md-0">
		<form action="" method="post" style="display:inline!important;">
			<input type="text" name="unit" size="10" maxlength="30" value="<?php echo $a['value']; ?>" class="form-control input-sm"/>
		</form>
    </td>
    
    
    <td class="col-md-0">
		<form action="" method="post" style="display:inline!important;">
			<button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </button>
			<input type="hidden" name="save_id" value="<?php echo $a['id']; ?>" />
			<input type="hidden" name="add" value="del1"/>
		/form>
    </td>
</tr>
   
<?php
	}
	?>



</table>
</div>

