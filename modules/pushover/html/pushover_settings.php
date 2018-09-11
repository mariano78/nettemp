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
?>

<div class="grid-item">
		<div class="panel panel-default">
			<div class="panel-heading">Pushover (Android / IOs)</div>
			
		<div class="table-responsive">
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
				<td>User KEY:</td>
				<td>
					<input id="user" name="address" placeholder="not required" class="form-control input-md" type="text" value="<?php echo $a['from']; ?>">
				</td>
			</tr>
			
			<tr>
				<td>API KEY:</td>
				<td>
					<input id="user" name="user" placeholder="ex. nettemp@nettemp.pl" class="form-control input-md" required="" type="text" value="<?php echo $a['user']; ?>">
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
			
						
				
			</tbody>
		</table>
		</div>
		</div>
	</div>