<?php
    $ms_onoff = isset($_POST['ms_onoff']) ? $_POST['ms_onoff'] : '';
    $ms_onoff1 = isset($_POST['ms_onoff1']) ? $_POST['ms_onoff1'] : '';
    if (($ms_onoff1 == "ms_onoff2") ){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE nt_settings SET value='$ms_onoff' WHERE option='mail_onoff'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
?>

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Notifications</h3>
</div>
<div class="panel-body">

	<div class="grid-item settings">
		<div class="panel panel-default">
			<div class="panel-heading">Email</div>
			
		
		<table class="table table-hover table-condensed">
			<tbody>	
	   
			<tr>
				<td>Active:</td>
				<td>
				<form action="" method="post">
				<input data-toggle="toggle" data-size="mini" onchange="this.form.submit()"  type="checkbox" name="ms_onoff" value="on" <?php echo $nts_mail_onoff == 'on' ? 'checked="checked"' : ''; ?>  />
				<input type="hidden" name="ms_onoff1" value="ms_onoff2" />
				</form>
				</td>
			</tr>
		<form class="form-horizontal" action="" method="post">
<fieldset>

<!-- Form Name -->

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="user">From</label>  
  <div class="col-md-2">
  <input id="user" name="address" placeholder="not required" class="form-control input-md" type="text" value="<?php echo $a['from']; ?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="user">Username</label>  
  <div class="col-md-2">
  <input id="user" name="user" placeholder="ex. nettemp@nettemp.pl" class="form-control input-md" required="" type="text" value="<?php echo $a['user']; ?>">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password</label>
  <div class="col-md-2">
    <input id="password" name="password" placeholder="" class="form-control input-md" required="" type="password" value="<?php echo $a['password']; ?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="smtp">Server SMTP</label>  
  <div class="col-md-2">
  <input id="host" name="host" placeholder="smtp.gmail.com" class="form-control input-md" required="" type="text" value="<?php echo $a['host']; ?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="port">Port</label>  
  <div class="col-md-1">
  <input id="port" name="port" placeholder="587" class="form-control input-md" required="" type="text" value="<?php echo $a['port']; ?>">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="auth">Auth</label>
  <div class="col-md-1">
    <select id="auth" name="auth" class="form-control">
      <option value="on" <?php echo $a['auth'] == 'on' ? 'selected="selected"' : ''; ?>>on</option>
      <option value="off" <?php echo $a['auth'] == 'off' ? 'selected="selected"' : ''; ?>>off</option>
      <option value="login" <?php echo $a['auth'] == 'login' ? 'selected="selected"' : ''; ?>>login</option>
    </select>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="tls">TLS</label>
  <div class="col-md-1">
    <select id="tls" name="tls" class="form-control">
    <option value="on" <?php echo $a['tls'] == 'on' ? 'selected="selected"' : 'selected="selected"'; ?>>on</option>
    <option value="off" <?php echo $a['tls'] == 'off' ? 'selected="selected"' : ''; ?>>off</option>
    </select>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="tlscheck">TLS Check</label>
  <div class="col-md-1">
    <select id="tlscheck" name="tlscheck" class="form-control">
      <option value="on" <?php echo $a['tlscheck'] == 'on' ? 'selected="selected"' : ''; ?>>on</option>
      <option value="off" <?php echo $a['tlscheck'] == 'off' ? 'selected="selected"' : 'selected="selected"'; ?> >off</option>
    </select>
  </div>
</div>

<!-- Mail topic-->
<div class="form-group">
  <label class="col-md-4 control-label" for="topic">Mail topic</label>
  <div class="col-md-2">
    <input id="topic" name="topic" placeholder="" class="form-control input-md" required="" type="topic" value="<?php echo $mail_topic ?>">
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="mailsave"></label>
  <div class="col-md-4">
    <input type="hidden" name="change_password1" value="change_password2" />
    <button id="mailsave" name="mailsave" class="btn btn-xs btn-success">Save</button>
  </div>
</div>

</fieldset>
</form>
				
				
			</tbody>
		</table>
		</div>
	</div>



</div>
</div>




