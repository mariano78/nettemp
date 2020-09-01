<?php
    $msave = isset($_POST['msave']) ? $_POST['msave'] : '';
    $mip = isset($_POST['mip']) ? $_POST['mip'] : '';
	$mport = isset($_POST['mport']) ? $_POST['mport'] : '';
    $muser = isset($_POST['muser']) ? $_POST['muser'] : '';
    $mpwd = isset($_POST['mpwd']) ? $_POST['mpwd'] : '';
    if ($msave == "msave"){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE nt_settings SET value='$mip' WHERE option='mqtt_ip'") or die ($db->lastErrorMsg());
    $db->exec("UPDATE nt_settings SET value='$mport' WHERE option='mqtt_port'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE nt_settings SET value='$musr' WHERE option='mqtt_usr'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE nt_settings SET value='$mpwd' WHERE option='mqtt_pwd'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

$mqtt_ip=$nts_mqtt_ip;
$mqtt_port=$nts_mqtt_port;
$mqtt_user=$nts_mqtt_usr;
$mqtt_password=$nts_mqtt_pwd;
?>

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">MQTT Server</h3>
</div>
<div class="panel-body">

<form action="" method="post" class="form-horizontal">
<fieldset>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">IP:</label>  
  <div class="col-md-4">
  <input id="textinput" name="mip" placeholder="" class="form-control input-md" required="" type="text" value="<?php echo $mqtt_ip; ?>">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Port:</label>  
  <div class="col-md-4">
  <input id="textinput" name="mport" placeholder="" class="form-control input-md" required="" type="text" value="<?php echo $mqtt_port; ?>">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">User::</label>  
  <div class="col-md-4">
  <input id="textinput" name="musr" placeholder="" class="form-control input-md" required="" type="text" value="<?php echo $mqtt_user; ?>">
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Password:</label>  
  <div class="col-md-4">
  <input id="textinput" name="mpwd" placeholder="" class="form-control input-md" required="" type="text" value="<?php echo $mqtt_password; ?>">
     <input type="hidden" name="msave" value="msave" />
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-xs btn-success">Save</button>
  </div>
</div>

</fieldset>
</form>

</div>
</div>



