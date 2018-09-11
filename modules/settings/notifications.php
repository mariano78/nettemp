<?php
$cfile = '/etc/msmtprc';

$fh = fopen($cfile, 'r');
$theData = fread($fh, filesize($cfile));
$cread = array();
$my_array = explode(PHP_EOL, $theData);
foreach($my_array as $line)
{
    $tmp = explode(" ", $line);
    $cread[$tmp[0]] = $tmp[1];
}
fclose($fh);
$a=$cread;


$db = new PDO('sqlite:dbf/nettemp.db');
$ns_row = $db->query("SELECT value FROM nt_settings WHERE option='mail_topic'") or header("Location: html/errors/db_error.php");
$ns_rows = $ns_row->fetchAll();

foreach ($ns_rows as $v) { 	
	$mail_topic=$v['value'];
}


$address = isset($_POST['address']) ? $_POST['address'] : '';
$user = isset($_POST['user']) ? $_POST['user'] : '';
$host = isset($_POST['host']) ? $_POST['host'] : '';
$port = isset($_POST['port']) ? $_POST['port'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$auth = isset($_POST['auth']) ? $_POST['auth'] : '';
$tls = isset($_POST['tls']) ? $_POST['tls'] : '';
$tlscheck = isset($_POST['tlscheck']) ? $_POST['tlscheck'] : '';
$topic = isset($_POST['topic']) ? $_POST['topic'] : '';



$change_password1 = isset($_POST['change_password1']) ? $_POST['change_password1'] : '';
if  ($change_password1 == "change_password2") {
	if (!file_exists($cfile)) {
		$cmd = "sudo touch $cfile && sudo chown www-data $cfile && sudo chmod 600 $cfile";
		shell_exec($cmd);
	
	}
		$fh = fopen($cfile, 'w');

		if(empty($address)||$address=='default'){
			$address=$user;
		}

$conf = array (
    'defaults' => '', 
    'tls' => "$tls",
    'tls_starttls' => "$tls",
 // 'tls_trust_file' => '/etc/ssl/certs/ca-certificates.crt',
    'tls_certcheck' => "$tlscheck",
    'account' => 'default',
	 'host' => "$host",
	 'port' => "$port",
	 'auth' => "$auth",
	 'user' => "$user",
	 'password' => "$password",
	 'from' => "$address",
	 'logfile' => '/var/log/msmtp.log'
    );
  

		foreach ($conf as $index => $string) {
    		fwrite($fh, $index." ".$string."\n");
		}
		

		$db->exec("UPDATE nt_settings SET value='$topic' WHERE option='mail_topic'") or die ($db->lastErrorMsg());
		
		header("location: " . $_SERVER['REQUEST_URI']);
    	exit();
}

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
		<form action="" method="post">	
			<tr>
				<td>From:</td>
				<td>
					<input id="user" name="address" placeholder="not required" class="form-control input-md" type="text" value="<?php echo $a['from']; ?>">
				</td>
			</tr>
			
			<tr>
				<td>Username:</td>
				<td>
					<input id="user" name="user" placeholder="ex. nettemp@nettemp.pl" class="form-control input-md" required="" type="text" value="<?php echo $a['user']; ?>">
				</td>
			</tr>
			
			<tr>
				<td>Password:</td>
				<td>
					<input id="password" name="password" placeholder="" class="form-control input-md" required="" type="password" value="<?php echo $a['password']; ?>">
				</td>
			</tr>
			
			<tr>
				<td>SMTP Server:</td>
				<td>
					<input id="host" name="host" placeholder="smtp.gmail.com" class="form-control input-md" required="" type="text" value="<?php echo $a['host']; ?>">
				</td>
			</tr>
			
			<tr>
				<td>Port:</td>
				<td>
					<input id="port" name="port" placeholder="587" class="form-control input-md" required="" type="text" value="<?php echo $a['port']; ?>">
				</td>
			</tr>
			
			<tr>
				<td>Auth:</td>
				<td>
					<select id="auth" name="auth" class="form-control">
						<option value="on" <?php echo $a['auth'] == 'on' ? 'selected="selected"' : ''; ?>>on</option>
						<option value="off" <?php echo $a['auth'] == 'off' ? 'selected="selected"' : ''; ?>>off</option>
						<option value="login" <?php echo $a['auth'] == 'login' ? 'selected="selected"' : ''; ?>>login</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td>TLS:</td>
				<td>
					<select id="tls" name="tls" class="form-control">
						<option value="on" <?php echo $a['tls'] == 'on' ? 'selected="selected"' : 'selected="selected"'; ?>>on</option>
						<option value="off" <?php echo $a['tls'] == 'off' ? 'selected="selected"' : ''; ?>>off</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td>TLS Check:</td>
				<td>
					<select id="tlscheck" name="tlscheck" class="form-control">
						<option value="on" <?php echo $a['tlscheck'] == 'on' ? 'selected="selected"' : ''; ?>>on</option>
						<option value="off" <?php echo $a['tlscheck'] == 'off' ? 'selected="selected"' : 'selected="selected"'; ?> >off</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td>Mail topic:</td>
				<td>
					<input id="topic" name="topic" placeholder="" class="form-control input-md" required="" type="topic" value="<?php echo $mail_topic ?>">
				</td>
			</tr>
			
			<tr>
				<td></td>
				<td>
					<input type="hidden" name="change_password1" value="change_password2" />
					<button id="mailsave" name="mailsave" class="btn btn-xs btn-success">Save</button>
		</form>
				</td>
			</tr>
			</form>
			
			<?php
			$db = new PDO('sqlite:dbf/nettemp.db');
			$sth = $db->prepare("select value from nt_settings WHERE option='mail_onoff'");
			$sth->execute();
			$result = $sth->fetchAll();
			foreach ($result as $a) {
				$mail=$a["value"];
			}

			if ($mail == "on" ) { 
				
			?>
			
			<tr>
				<td>Test email:</td>
				<td>
				<form action="" method="post">
					<input id="mail_test" name="test_mail" placeholder="" class="form-control input-md" required="" type="text" value="" placeholder="test@nettemp.pl">
				</td>	
			</tr>
			<tr>
				<td>
					
					
				
				</td>
				<td>
				
				<button id="send" name="send" value="send" class="btn btn-xs btn-success">Send test</button>
				
				</form>
				
				</td>
			</tr>
			
			<?php
			}
			?>			
				
			</tbody>
		</table>
		</div>
	</div>



</div>
</div>




