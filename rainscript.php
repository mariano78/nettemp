
    
<?php
$ROOT='/var/www/nettemp';
include("$ROOT/receiver.php");


      $db2 = new PDO("sqlite:/var/www/nettemp/db/ip_meteo_id1_rainfall.sql") or die ("cannot open database");
      $query = $db2->query("SELECT sum(value) AS rain24h from def WHERE  time BETWEEN datetime('now', 'localtime', '-1 day') AND datetime('now', 'localtime')");
	  $result = $query->fetchAll();
	  foreach($result as $rainfall) {
	  
			$rain24h=$rainfall['rain24h'];
			
		db('rain24',$rain24h,'rainfall','virtual',$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
	  }
	  
	  $query = $db2->query("SELECT sum(value) AS rain48h from def WHERE  time BETWEEN datetime('now', 'localtime', '-2 day') AND datetime('now', 'localtime')");
	  $result = $query->fetchAll();
	  foreach($result as $rainfall) {
	  
			$rain48h=$rainfall['rain48h'];
		db('rain48',$rain48h,'rainfall','virtual',$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
	  }
	  
	  
      $query = $db2->query("SELECT sum(value) AS rain72h from def WHERE  time BETWEEN datetime('now', 'localtime', '-3 day') AND datetime('now', 'localtime')");
	  $result = $query->fetchAll();
	  foreach($result as $rainfall) {
	  
			$rain72h=$rainfall['rain72h'];
			db('rain72',$rain72h,'rainfall','virtual',$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
	  }
	  
	  $query = $db2->query("SELECT time FROM def WHERE value > 0 ORDER BY time DESC LIMIT 1");
	  $result = $query->fetchAll();
	  foreach($result as $rainfall) {
	  
			$rainlast=substr($rainfall['time'], 0, 10);
			$rainlast2= substr($rainlast, 0, 10);
			$rainlast2 = $rainlast2." 00:00:00";
			$rainlast3 = $rainlast2;
			db('rainlast',$rainlast2,'rainfalllast','virtual',$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
			
	  }
	  
	  $query = $db2->query("SELECT sum(value) AS rainsum FROM def WHERE time  >= '$rainlast3'");
	  $result = $query->fetchAll();
	  foreach($result as $rainfall) {
	  
			$rainlastsum=$rainfall['rainsum'];
			db('rainlastsum',$rainlastsum,'rainfallsum','virtual',$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
	  }

      //db('rain24',$rain24h,'rainfall24h','virtual',$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);

    ?>
