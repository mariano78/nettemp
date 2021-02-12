<?php

$dboracle = isset($_POST['dboracle']) ? $_POST['dboracle'] : '';
$dbuser = isset($_POST['dbuser']) ? $_POST['dbuser'] : '';
$dbpass = isset($_POST['dbpass']) ? $_POST['dbpass'] : '';
$shopuser = isset($_POST['shopuser']) ? $_POST['shopuser'] : '';
$shoppass2 = isset($_POST['shoppass2']) ? $_POST['shoppass2'] : '';
$shopshop = isset($_POST['shopshop']) ? $_POST['shopshop'] : '';
$ftpusr = isset($_POST['ftpusr']) ? $_POST['ftpusr'] : '';
$ftppass = isset($_POST['ftppass']) ? $_POST['ftppass'] : '';

    if ($msave == "msave"){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE nt_settings SET value='$dboracle' WHERE option='database'") or die ($db->lastErrorMsg());
    $db->exec("UPDATE nt_settings SET value='$dbuser' WHERE option='user'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE nt_settings SET value='$dbpass' WHERE option='pass'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE nt_settings SET value='$shopuser' WHERE option='shopusr'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE nt_settings SET value='$shoppass2' WHERE option='shoppass'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE nt_settings SET value='$shopshop' WHERE option='shoptest'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE nt_settings SET value='$ftpusr' WHERE option='shopftp'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE nt_settings SET value='$ftppass' WHERE option='shopftppass'") or die ($db->lastErrorMsg());	
	
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

if(!empty($_SERVER["DOCUMENT_ROOT"])){
    $root=$_SERVER["DOCUMENT_ROOT"];
}else{
    $root=__DIR__;
    for($i=0;$i<5;$i++){
        $root = file_exists($root.'/dbf/nettemp.db') ? $root : dirname($root) ;
    }
}
// Dołączam ustawienia Oracle i sdk shoper
include("$root/modules/shop/shop_settings.php");




?>

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Shoper ustawienia</h3>
</div>
<div class="panel-body">

<form action="" method="post" class="form-horizontal">
<fieldset>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">DB oracle:</label>  
  <div class="col-md-4">
  <input id="textinput" name="dboracle" placeholder="" class="form-control input-md" required="" type="text" value="<?php echo $database; ?>">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">DB Oracle user:</label>  
  <div class="col-md-4">
  <input id="textinput" name="dbuser" placeholder="" class="form-control input-md" required="" type="text" value="<?php echo $user; ?>">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">DB Oracle password:</label>  
  <div class="col-md-4">
  <input id="textinput" name="dbpass" placeholder="" class="form-control input-md"  type="text" value="<?php echo $pass; ?>">
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Shoper user:</label>  
  <div class="col-md-4">
  <input id="textinput" name="shopuser" placeholder="" class="form-control input-md"  type="text" value="<?php echo $shopusr; ?>">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Shoper password:</label>  
  <div class="col-md-4">
  <input id="textinput" name="shoppass2" placeholder="" class="form-control input-md"  type="text" value="<?php echo $shoppass; ?>">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Shoper sklep:</label>  
  <div class="col-md-4">
  <input id="textinput" name="shopshop" placeholder="" class="form-control input-md"  type="text" value="<?php echo $shoptest; ?>">
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">FTP user:</label>  
  <div class="col-md-4">
  <input id="textinput" name="ftpusr" placeholder="" class="form-control input-md"  type="text" value="<?php echo $shopftp; ?>">
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">FTP password:</label>  
  <div class="col-md-4">
  <input id="textinput" name="ftppass" placeholder="" class="form-control input-md"  type="text" value="<?php echo $shopftppass; ?>">
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