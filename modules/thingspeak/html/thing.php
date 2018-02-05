<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Thing Speak  </h3> 

	<form action="" method="post" style="display:inline!important;">
		<button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-plus"></span> </button>
		<input type="hidden" name="addthc" value="addthc"/>
	</form></div>

<?php

// add thingspeak chanell
$addthc = isset($_POST['addthc']) ? $_POST['addthc'] : '';
if(!empty($addthc) && ($addthc == "addthc")) { 
	
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("INSERT INTO thingspeak ('name', 'apikey', 'active') VALUES ('My new chanell','API KEY', 'off')");
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
}

//name
$name_new = isset($_POST['name_new']) ? $_POST['name_new'] : '';
$name_id = isset($_POST['name_id']) ? $_POST['name_id'] : '';
$name_th = isset($_POST['name_th']) ? $_POST['name_th'] : '';
if(!empty($name_id) && !empty($name_new) && ($name_th == "name_th")) { 
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("UPDATE thingspeak SET name='$name_new' WHERE id='$name_id'");
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
}

//api key
$api_new = isset($_POST['api_new']) ? $_POST['api_new'] : '';
$api_id = isset($_POST['api_id']) ? $_POST['api_id'] : '';
$api_th = isset($_POST['api_th']) ? $_POST['api_th'] : '';
if(!empty($api_id) && !empty($api_new) && ($api_th == "api_th")) { 
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("UPDATE thingspeak SET apikey='$api_new' WHERE id='$api_id'");
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
}

// active
$active_id = isset($_POST['active_id']) ? $_POST['active_id'] : '';
$active_on = isset($_POST['active_on']) ? $_POST['active_on'] : '';
$th_active = isset($_POST['th_active']) ? $_POST['th_active'] : '';
    if ($th_active == "th_active"){
    $db->exec("UPDATE thingspeak SET active='$active_on' WHERE id='$active_id'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

//del from base
$del= isset($_POST['del']) ? $_POST['del'] : '';
$del_id = isset($_POST['del_id']) ? $_POST['del_id'] : '';
if(!empty($del_id) && !empty($del) && ($del == "delete")) { 
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("DELETE FROM thingspeak WHERE id='$del_id'");
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
}
//select sensors for field
$sth = $db->prepare("SELECT * FROM sensors WHERE thing='on'");
$sth->execute();
$result = $sth->fetchAll(); 

$db = new PDO('sqlite:dbf/nettemp.db');
$rows = $db->query("SELECT * FROM thingspeak");
$row = $rows->fetchAll();
$count = count($row);
if ($count >= "1") {
?>
<div class="table-responsive">
<table class="table table-hover table-condensed small" border="0">
<thead>
<th>Name</th>
<th>API Key</th>
<th>F1</th>
<th>F2</th>
<th>F3</th>
<th>F4</th>
<th>F5</th>
<th>F6</th>
<th>F7</th>
<th>F8</th>
<th>Active</th>
<th>Delete</th>
</thead>
<?php
foreach ($row as $a) { 	
?>
<tr>
    <td class="col-md-1">
	<form action="" method="post" style="display:inline!important;">
			<input type="text" name="name_new" size="15" maxlength="30" value="<?php echo $a["name"]; ?>" />
			<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
			<input type="hidden" name="name_id" value="<?php echo $a["id"]; ?>" />
			<input type="hidden" name="name_th" value="name_th"/>
	</form>
	</td>
	
	<td class="col-md-1">
	<form action="" method="post" style="display:inline!important;">
			<input type="text" name="api_new" size="15" maxlength="30" value="<?php echo $a["apikey"]; ?>" />
			<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
			<input type="hidden" name="api_id" value="<?php echo $a["id"]; ?>" />
			<input type="hidden" name="api_th" value="api_th"/>
	</form>
	</td>
	
	<td class="col-md-1">
		<select name="f1" class="form-control input-sm">
		<?php 
			foreach ($result as $select) { ?>
			<option value="<?php echo $select['id']; ?>"><?php echo $select['name']." ".$select['tmp'] ?></option>
		<?php } ?>
		</select>
	</td>
	
	<td class="col-md-1">
		<select name="f2" class="form-control input-sm">
		<?php 
			foreach ($result as $select) { ?>
			<option value="<?php echo $select['id']; ?>"><?php echo $select['name']." ".$select['tmp'] ?></option>
		<?php } ?>
		</select>
	</td>
	
	<td class="col-md-1">
		<select name="f3" class="form-control input-sm">
		<?php 
			foreach ($result as $select) { ?>
			<option value="<?php echo $select['id']; ?>"><?php echo $select['name']." ".$select['tmp'] ?></option>
		<?php } ?>
		</select>
	</td>
	
	<td class="col-md-1">
		<select name="f4" class="form-control input-sm">
		<?php 
			foreach ($result as $select) { ?>
			<option value="<?php echo $select['id']; ?>"><?php echo $select['name']." ".$select['tmp'] ?></option>
		<?php } ?>
		</select>
	</td>
	
	<td class="col-md-1">
		<select name="f5" class="form-control input-sm">
		<?php 
			foreach ($result as $select) { ?>
			<option value="<?php echo $select['id']; ?>"><?php echo $select['name']." ".$select['tmp'] ?></option>
		<?php } ?>
		</select>
	</td>
	
	<td class="col-md-1">
		<select name="f6" class="form-control input-sm">
		<?php 
			foreach ($result as $select) { ?>
			<option value="<?php echo $select['id']; ?>"><?php echo $select['name']." ".$select['tmp'] ?></option>
		<?php } ?>
		</select>
	</td>
	
	<td class="col-md-1">
		<select name="f7" class="form-control input-sm">
		<?php 
			foreach ($result as $select) { ?>
			<option value="<?php echo $select['id']; ?>"><?php echo $select['name']." ".$select['tmp'] ?></option>
		<?php } ?>
		</select>
	</td>
	
	<td class="col-md-1">
		<select name="f8" class="form-control input-sm">
		<?php 
			foreach ($result as $select) { ?>
			<option value="<?php echo $select['id']; ?>"><?php echo $select['name']." ".$select['tmp'] ?></option>
		<?php } ?>
		</select>
	</td>
	
	<td class="col-md-1">
		<form action="" method="post" style="display:inline!important;" > 	
		<input type="hidden" name="active_id" value="<?php echo $a["id"]; ?>" />
		<button type="submit" name="active_on" value="<?php echo $a["active"] == 'on' ? 'off' : 'on'; ?>" <?php echo $a["active"] == 'on' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>>
	    <?php echo $a["active"] == 'on' ? 'ON' : 'OFF'; ?></button>
		<input type="hidden" name="th_active" value="th_active" />
    </form>
	</td>
	
	<td class="col-md-1">
		<form action="" method="post" style="display:inline!important;">
			<button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </button>
			<input type="hidden" name="del_id" value="<?php echo $a['id']; ?>" />
			<input type="hidden" name="del" value="delete"/>
		</form>
	</td>
</tr>
<?php
	}
?>
</table>
<?php
	} 
?>
</div>

