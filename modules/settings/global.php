<?php
    $gpio_onoff = isset($_POST['gpio_onoff']) ? $_POST['gpio_onoff'] : '';
    $gpio_onoff1 = isset($_POST['gpio_onoff1']) ? $_POST['gpio_onoff1'] : '';
    if (($gpio_onoff1 == "gpio_onoff2") ){
		$db = new PDO('sqlite:dbf/nettemp.db');
		$db->exec("UPDATE nt_settings SET value='$gpio_onoff' WHERE option='gpio'") or die ($db->lastErrorMsg());
		echo $gpio_onoff;
		header("location: " . $_SERVER['REQUEST_URI']);
		exit();
    }
    
    $MCP23017_onoff = isset($_POST['MCP23017_onoff']) ? $_POST['MCP23017_onoff'] : '';
    $MCP23017_onoff1 = isset($_POST['MCP23017_onoff1']) ? $_POST['MCP23017_onoff1'] : '';
    if (($MCP23017_onoff1 == "MCP23017_onoff2") ){
		$db = new PDO('sqlite:dbf/nettemp.db');
		$db->exec("UPDATE nt_settings SET value='$MCP23017_onoff' WHERE option='MCP23017'") or die ($db->lastErrorMsg());
		header("location: " . $_SERVER['REQUEST_URI']);
		exit();
    }
	
	$screen_onoff = isset($_POST['screen_onoff']) ? $_POST['screen_onoff'] : '';
    $screen_onoff1 = isset($_POST['screen_onoff1']) ? $_POST['screen_onoff1'] : '';
    if (($screen_onoff1 == "screen_onoff2") ){
    $db->exec("UPDATE nt_settings SET value='$screen_onoff' WHERE option='screen'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

	$map_onoff = isset($_POST['map_onoff']) ? $_POST['map_onoff'] : '';
    $map_onoff1 = isset($_POST['map_onoff1']) ? $_POST['map_onoff1'] : '';
    if (($map_onoff1 == "map_onoff2") ){
    $db->exec("UPDATE nt_settings SET value='$map_onoff' WHERE option='mapon'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
	$ntp_onoff = isset($_POST['ntp_onoff']) ? $_POST['ntp_onoff'] : '';
    $rtc_onoff = isset($_POST['rtc_onoff']) ? $_POST['rtc_onoff'] : '';
    $rtc = isset($_POST['rtc']) ? $_POST['rtc'] : '';
    $ntp = isset($_POST['ntp']) ? $_POST['ntp'] : '';

    if (($ntp_onoff == "ntp_onoff") ){
    if (!empty($ntp)) {
	shell_exec("sudo service ntp start");
        shell_exec("sudo update-rc.d ntp enable ");
    }
    else {	
	shell_exec("sudo service ntp stop");
        shell_exec("sudo update-rc.d ntp disable ");
    } 
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
                
    if (($rtc_onoff == "rtc_onoff") ){
    if (!empty($rtc)) {
	    $file='tmp/cronr';
	    if (filesize($file) == 0){
		$current = file_get_contents($file);
		$current = "#crontab file generated by php\n";
		file_put_contents($file, $current);
	    }
		
	    shell_exec("sudo sed -i '\$artc-ds1307' /etc/modules");
	    shell_exec("sudo sed -i '\$aecho ds1307 0x68 > \/sys\/class\/i2c-adapter\/'$(ls /dev/i2c-* |awk -F/ '{print $3}')'\/new_device && hwclock -s' tmp/cronr");
	    shell_exec("sudo touch tmp/reboot");
    }
    else {
	shell_exec("sudo sed -i '/ds1307/d' tmp/cronr");
        shell_exec("sudo sed -i '/rtc-ds1307/d' /etc/modules");
	} 
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
	
	if (exec("cat /etc/modules | grep 'ds1307'") &&  exec("cat tmp/cronr | grep 'ds1307'")) {
		$rtc='on';
	} else {
		$rtc='';
		//echo "module not added or autostart";
	}


	if (exec("sudo service ntp status |grep 'running'")) {
	$ntp='on';
	}
	else {
	$ntp='';
	}

	    $snmpd_onoff = isset($_POST['snmpd_onoff']) ? $_POST['snmpd_onoff'] : '';
    $snmpd = isset($_POST['snmpd']) ? $_POST['snmpd'] : '';

    if (($snmpd_onoff == "snmpd_onoff") ){
    if (!empty($snmpd)) {
	shell_exec("sudo cp /etc/snmp/snmpd.conf /etc/snmp/snmpd.bkp");
	shell_exec("sudo sed -i '/^/d' /etc/snmp/snmpd.conf");
	shell_exec("echo \"# nettemp.pl snmpd server\" | sudo tee -a /etc/snmp/snmpd.conf");
	shell_exec("echo \"view nettemp included .1.3.6.1.3\" |sudo tee -a  /etc/snmp/snmpd.conf");
	shell_exec("echo \"rocommunity public default -V nettemp\" |sudo tee -a /etc/snmp/snmpd.conf");
	shell_exec("echo \"extend .1.3.6.1.3.1 /bin/bash \"/usr/bin/awk -F: ''\'''{print ''\$''1}''\''' /var/www/nettemp/tmp/results\"\" | sudo tee -a /etc/snmp/snmpd.conf");
	shell_exec("echo \"extend .1.3.6.1.3.2 /bin/bash \"/usr/bin/awk -F: ''\'''{print ''\$''2}''\''' /var/www/nettemp/tmp/results\"\" | sudo tee -a /etc/snmp/snmpd.conf");
	shell_exec("echo \"extend .1.3.6.1.3.3 /bin/bash \"/usr/bin/awk -F: ''\'''{print ''\$''3}''\''' /var/www/nettemp/tmp/results\"\" | sudo tee -a /etc/snmp/snmpd.conf");
	shell_exec("echo \"extend .1.3.6.1.3.4 /bin/bash \"/usr/bin/awk -F: ''\'''{print ''\$''4}''\''' /var/www/nettemp/tmp/results\"\" | sudo tee -a /etc/snmp/snmpd.conf");
	shell_exec("echo \"extend .1.3.6.1.3.5 /bin/bash \"/usr/bin/awk -F: ''\'''{print ''\$''5}''\''' /var/www/nettemp/tmp/results\"\" | sudo tee -a /etc/snmp/snmpd.conf");
	shell_exec("echo \"extend .1.3.6.1.3.6 /bin/bash \"/usr/bin/awk -F: ''\'''{print ''\$''6}''\''' /var/www/nettemp/tmp/results\"\" | sudo tee -a /etc/snmp/snmpd.conf");
	shell_exec("echo \"extend .1.3.6.1.3.7 /bin/bash \"/usr/bin/awk -F: ''\'''{print ''\$''7}''\''' /var/www/nettemp/tmp/results\"\" | sudo tee -a /etc/snmp/snmpd.conf");
	shell_exec("echo \"extend .1.3.6.1.3.8 /bin/bash \"/usr/bin/awk -F: ''\'''{print ''\$''8}''\''' /var/www/nettemp/tmp/results\"\" | sudo tee -a /etc/snmp/snmpd.conf");

	
	shell_exec("sudo service snmpd start");
        shell_exec("sudo update-rc.d snmpd enable ");
    }
    else {	
	shell_exec("sudo service snmpd stop");
        shell_exec("sudo update-rc.d snmpd disable ");
	shell_exec("sudo cp -f /etc/snmp/snmpd.conf.bkp /etc/snmp/snmpd.conf");
    } 
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
                


	if (exec("sudo service snmpd status |grep 'running'")) {
	$snmpd='on';
	}
	else {
	$snmpd='';
	}


?>



 
 <div class="grid-item settings">
	<div class="panel panel-default">
		<div class="panel-heading">Global settings</div>
	
		
    <table class="table table-hover table-condensed">
		<tbody>
			<tr>
				<td> GPIO RPI
				</td>
				<td>
					<form action="" method="post">
					<input type="hidden" name="gpio_onoff1" value="gpio_onoff2"  />
					<input data-toggle="toggle" data-size="mini" onchange="this.form.submit()" type="checkbox" name="gpio_onoff" value="on"  <?php echo $nts_gpio == 'on' ? 'checked="checked"' : ''; ?> >
					</form>
				</td>
			</tr>
			
			<tr>
				<td> GPIO MCP23017
				</td>
				<td>
					<form action="" method="post">
					<input type="hidden" name="MCP23017_onoff1" value="MCP23017_onoff2"  />
					<input data-toggle="toggle" data-size="mini" onchange="this.form.submit()" type="checkbox" name="MCP23017_onoff" value="on"  <?php echo $nts_MCP23017 == 'on' ? 'checked="checked"' : ''; ?> >
					</form>
				</td>
			</tr>
			
			<tr>
				<td> Screen
				</td>
				<td>
					<form action="" method="post">
					<input type="hidden" name="screen_onoff1" value="screen_onoff2"  />
					<input data-toggle="toggle" data-size="mini" onchange="this.form.submit()" type="checkbox" name="screen_onoff" value="on"  <?php echo $nts_screen == 'on' ? 'checked="checked"' : ''; ?> >
					</form>
				</td>
			</tr>
			
			<tr>
				<td> Map
				</td>
				<td>
					<form action="" method="post">
					<input type="hidden" name="map_onoff1" value="map_onoff2"  />
					<input data-toggle="toggle" data-size="mini" onchange="this.form.submit()" type="checkbox" name="map_onoff" value="on"  <?php echo $nts_mapon == 'on' ? 'checked="checked"' : ''; ?> >
					</form>
				</td>
			</tr>
			
			<tr>
				<td> Time NTP
				</td>
				<td>
					<form action="" method="post">
					<input onchange="this.form.submit()"  type="checkbox"  data-toggle="toggle" data-size="mini"  name="ntp" value="on" <?php echo $ntp == 'on' ? 'checked="checked"' : ''; ?> />
					<input type="hidden" name="ntp_onoff" value="ntp_onoff" />
					</form>
					<?php
					exec("pgrep ntpd", $pids);
					if(empty($pids)) { ?>
					<span class="label label-danger">NTPd not work</span>
					<?php
					}
					?>
				</td>
			</tr>
			
			<tr>
				<td> Time RTC I2C
				</td>
				<td>
					<form action="" method="post">
					<input data-toggle="toggle" data-size="mini" onchange="this.form.submit()"  type="checkbox" name="rtc" value="on" <?php echo $rtc == 'on' ? 'checked="checked"' : ''; ?>  />
					<input type="hidden" name="rtc_onoff" value="rtc_onoff" />
					</form>
					<?php 
					if ( $rtc == "on") { 
					?>

					<?php
					if ((file_exists("/dev/i2c-0")) || (file_exists("/dev/i2c-1"))) {
					?>


					<hr>
						<?php echo "System date: "; passthru("date");?>
					<?php
					$ntsync = isset($_POST['ntsync']) ? $_POST['ntsync'] : '';
					if ($ntsync == "ntsync") { 
					shell_exec("sudo service ntp restart; sleep 5; sudo /usr/sbin/ntpd -qg");
					header("location: " . $_SERVER['REQUEST_URI']);
					exit();	
					}
					?>
					<form action="" method="post">
						<input type="hidden" name="ntsync" value="ntsync">
						<input  type="submit" value="Time sync"  class="btn btn-xs btn-success"/>
					</form>
					<?php echo "Hwclock date: "; passthru("sudo /sbin/hwclock --show");?>
					<?php
					$hwsync = isset($_POST['hwsync']) ? $_POST['hwsync'] : '';
					if ($hwsync == "hwsync") { 
					shell_exec("sudo /sbin/hwclock -w");
					header("location: " . $_SERVER['REQUEST_URI']);
					exit();	
					}
					?>
					<form action="" method="post">
					<input type="hidden" name="hwsync" value="hwsync">
					<input  type="submit" value="RTC sync" class="btn btn-xs btn-success" />
					</form>
					<?php 
					}
					else { ?>
					RTC - No i2c modules loaded

					<?php 
						}
					?>


					<?php 
						}
					?>
				</td>
			</tr>
			
			<tr>
				<td> SNMPD
				</td>
				<td>
					<form action="" method="post">
					<input data-toggle="toggle" data-size="mini" onchange="this.form.submit()" type="checkbox" name="snmpd" value="on" <?php echo $snmpd == 'on' ? 'checked="checked"' : ''; ?> />
					<input type="hidden" name="snmpd_onoff" value="snmpd_onoff" />
					</form>
				</td>
			</tr>
			
			
		</tbody>
	</table>
	</div>
</div>




