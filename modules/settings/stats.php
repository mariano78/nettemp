<?php
    $save = isset($_POST['save']) ? $_POST['save'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $nick = isset($_POST['nick']) ? $_POST['nick'] : '';
    $sensor_temp = isset($_POST['sensor_temp']) ? $_POST['sensor_temp'] : '';
    $agreement = isset($_POST['agreement']) ? $_POST['agreement'] : '';
    if ($save == "save"){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE statistics SET location='$location', nick='$nick', agreement='$agreement', sensor_temp='$sensor_temp' WHERE id='1'");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }


    $db = new PDO('sqlite:dbf/nettemp.db');
    $sth = $db->prepare("select * from statistics WHERE id='1'");
    $sth->execute();
    $result = $sth->fetchAll();
    foreach ($result as $a) {
    $agreement=$a['agreement'];
    $nick=$a['nick'];
    $location=$a['location'];
    $sensor_temp=$a['sensor_temp'];
    }

    $sth = $db->prepare("SELECT * FROM sensors");
    $sth->execute();
    $sensors = $sth->fetchAll();
?>


<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Statistics</h3>
</div>
<div class="panel-body">
<div class="row">
<div class="col-md-4 col-md-offset-4">

If You want send anonymous info about Your nettemp write in agreement: <span class="label label-success">yes</span><br><br>
Your nettemp will send ID (md5sum from mac-addres), os name, hardware type, nick, location and value from sensor if set.<br><br>

</div>
</div>


<form action="" method="post" class="form-horizontal">
<fieldset>


<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">ID:</label>  
  <div class="col-md-4">
  <input id="textinput"  placeholder="" class="form-control input-md" required="" type="text" value="<?php $md5=passthru('sudo cat /sys/class/net/eth0/address |md5sum |cut -c 1-32 || sudo cat /sys/class/net/wlan0/address |md5sum |cut -c 1-32') ?>" disabled>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Version:</label>  
  <div class="col-md-4">
  <input id="textinput"  placeholder="" class="form-control input-md" required="" type="text" value="<?php passthru("/usr/bin/git branch |grep [*]|awk '{print $2\" \"}' && awk '/Changelog/{y=1;next}y' readme.md |head -2 |grep -v '^$'"); ?>" disabled>
  </div>
</div>

<div class="form-group">   <label class="col-md-4 control-label" for="textinput">OS:</label>   <div class="col-md-4">   <input id="textinput"  placeholder="" class="form-control input-md" required="" type="text" value="<?php passthru('cat /etc/os-release | grep PRETT | sed \'s/^.*=\"\\(.*\\)\".*/\\1/g\'');?>" disabled>   </div> </div>
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Sensor:</label>
  <div class="col-md-4">
    <select id="selectbasic" name="sensor_temp" class="form-control">
	<?php foreach($sensors as $a) { ?>
	    <option value="<?php echo $a['id'] ?>"  <?php echo $a['id'] == $sensor_temp ? 'selected="selected"' : ''; ?> ><?php echo $a['name'] ?></option>
	<?php
	    }
	?>
		    <option value="none" <?php echo $sensor_temp == 'none' ? 'selected="selected"' : ''; ?>  >none</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="latitude">Location:</label>  
  <div class="col-md-4">
  <input id="latitude" name="location" placeholder="" class="form-control input-md"  type="text" value="<?php echo $location; ?>">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Nickname:</label>  
  <div class="col-md-4">
  <input id="textinput" name="nick" placeholder="" class="form-control input-md"  type="text" value="<?php echo $nick; ?>">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Agreement:</label>  
  <div class="col-md-4">
  	<select name="agreement" class="form-control">
			    <option value="yes" <?php echo $agreement=='yes' ? 'selected="selected"' : '' ?> >yes</option>
			    <option value="no" <?php echo $agreement=='no' ? 'selected="selected"' : '' ?> >no</option>
    </select>  
  
    <input type="hidden" name="save" value="save" />
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Save</button>
  </div>
</div>

</fieldset>
</form>

</div>
</div>





