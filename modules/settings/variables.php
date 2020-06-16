<?php

		
	
	
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$mod_name = isset($_POST['mod_name']) ? $_POST['mod_name'] : '';
	$mod_val = isset($_POST['mod_val']) ? $_POST['mod_val'] : '';
	$value = isset($_POST['value']) ? $_POST['value'] : '';
	$name = isset($_POST['name']) ? $_POST['name'] : '';
	
    if ($mod_val == 'mod_val'){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE ovariables SET value='$value' WHERE id='$id'") or header("Location: html/errors/db_error.php");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
	if ($mod_name == 'mod_name'){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE ovariables SET name='$name' WHERE id='$id'") or header("Location: html/errors/db_error.php");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
	
    if ($add == 'add1'){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("INSERT OR IGNORE INTO types (type, unit, unit2, ico, title, min, max, value1, value2 ,value3) VALUES ('$type','$unit','$unit2','$ico','$title','$min','$max','$value1','$value2','$value3')") or header("Location: html/errors/db_error.php");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
	$del = isset($_POST['del']) ? $_POST['del'] : '';
	$del_id = isset($_POST['del_id']) ? $_POST['del_id'] : '';
    if ($del == 'del1'){
    $db = new PDO('sqlite:dbf/nettemp.db');
	 $db->exec("DELETE FROM ovariables WHERE id='$del_id'") or die ("Location: html/errors/db_error.php");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

?>

<div class="panel panel-default">
<div class="panel-heading">Variables</div>

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
<th></th>
</tr>
</thead>

<?php 
   foreach ($row as $a) { 	
	?>
<tr>
	 
	<td class="col-md-2">
		<form action="" method="post" style="display:inline!important;">
			<input type="text" name="name" size="5" maxlength="20" value="<?php echo $a['name']; ?>" class="form-control input-sm"/>
			<input type="hidden" name="id" value="<?php echo $a['id']; ?>" />
			<input type="hidden" name="mod_name" value="mod_name" />
			<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
		</form>
    </td>
    
	<td class="col-md-2">
		<form action="" method="post" style="display:inline!important;">
			<input type="text" name="value" size="5" maxlength="20" value="<?php echo $a['value']; ?>" class="form-control input-sm"/>
			<input type="hidden" name="id" value="<?php echo $a['id']; ?>" />
			<input type="hidden" name="mod_val" value="mod_val" />
			<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
		</form>
    </td>
    
    
    <td class="col-md-1">
		<form action="" method="post" style="display:inline!important;">
			<button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </button>
			<input type="hidden" name="del_id" value="<?php echo $a['id']; ?>" />
			<input type="hidden" name="del" value="del1"/>
		</form>
    </td>
	
	<td class="col-md-7">
		
    </td>
</tr>
   
<?php
	}
	?>



</table>
</div>

