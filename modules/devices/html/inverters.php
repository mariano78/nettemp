<?php
$invid = isset($_POST['invid']) ? $_POST['invid'] : '';
$rminv = isset($_POST['rminv']) ? $_POST['rminv'] : '';

$ipaddr = isset($_POST['ipaddr']) ? $_POST['ipaddr'] : '';
$invport = isset($_POST['invport']) ? $_POST['invport'] : '';
$invname = isset($_POST['invname']) ? $_POST['invname'] : '';
$invtype = isset($_POST['invtype']) ? $_POST['invtype'] : '';
$invadd = isset($_POST['invadd']) ? $_POST['invadd'] : '';
$invusr = isset($_POST['invusr']) ? $_POST['invusr'] : '';
$invpass = isset($_POST['invpass']) ? $_POST['invpass'] : '';

$invadd = isset($_POST['invadd']) ? $_POST['invadd'] : '';

    if (!empty($invid) && ($_POST['rminv'] == "rminv") ){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("DELETE FROM inverters WHERE id='$invid'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

    if ($invadd == "invadd"){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("INSERT OR IGNORE INTO inverters (name, ip, port, type, user, pass ) VALUES ('$invname','$ipaddr','$invport', '$invtype', '$invusr', '$invpass')") or die ("cannot insert to DB" );
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
?>

<div class="panel panel-default">
<div class="panel-heading">Inverters</div>

<div class="table-responsive">
<table class="table table-hover table-condensed small">

<?php
$db = new PDO('sqlite:dbf/nettemp.db');
$rows = $db->query("SELECT * FROM inverters") or header("Location: html/errors/db_error.php");
$row = $rows->fetchAll();

?>
<thead>
<tr>
<th>Name</th>
<th>IP Address</th>
<th>Port</th>
<th>User</th>
<th>Password</th>
<th>Type</th>
<th></th>
</tr>
</thead>

<tr>	
	
    <form action="" method="post" class="form-horizontal" style="display:inline!important;">
	
    <div class="form-group">
   
	<td class="col-md-1">
		
		<input type="text" name="invname" value="" class="form-control input-sm" required=""/>
    </td>
    
	<td class="col-md-1">
		<input type="text" name="ipaddr" placeholder="192.168.0.1"  value="" class="form-control input-sm" required=""/>
    </td>
	
	<td class="col-md-1">
		<input type="text" name="invport" placeholder="80" value="" class="form-control input-sm" required=""/>
    </td>
	
	<td class="col-md-1">
		<input type="text" name="invusr" placeholder="user" value="" class="form-control input-sm"/>
    </td>
	
	<td class="col-md-1">
		<input type="text" name="invpass" placeholder="password" value="" class="form-control input-sm"/>
    </td>
	
	<td class="col-md-1">
		<select name="invtype" class="form-control input-sm">
			<option value="zeversolar">Zeversolar</option>
			<option value="fronius">Fronius</option>
			<option value="afore">Afore</option>
		</select>
    </td>
	
	<input type="hidden" name="invadd" value="invadd" class="form-control"/>
    <td class="col-md-9">
	<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span></button>
    </td>
    </div>
    </form>
</tr>





<?php foreach ($row as $a) { 	
	
?>
<tr>
    <td class="col-md-1">
	<img src="media/ico/inverter-icon.png" />
	<?php echo $a['name']; ?>
    </td>
    
	<td class="col-md-1">
	<?php echo  $a["ip"] ;?>
    </td>
	
	<td class="col-md-1">
	<?php echo  $a["port"] ;?>
    </td>
	
	<td class="col-md-1">
	<?php echo  $a["user"] ;?>
    </td>
	
	<td class="col-md-1">
	<?php echo  $a["pass"] ;?>
    </td>
	
	
	<td class="col-md-1">
	<?php echo  $a["type"] ;?>
    </td>


    <td class="col-md-7">
    <form action="" method="post" style="display:inline!important;">
	<input type="hidden" name="invid" value="<?php echo $a["id"]; ?>" />
	<input type="hidden" name="rminv" value="rminv" />
	<button class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> </button>
    </form>
    </td>
</tr>
<?php 
}  
?>

</table>

</div>
</div>
