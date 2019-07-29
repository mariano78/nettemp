
    
<?php
$ROOT='/var/www/nettemp';
include("$ROOT/receiver.php");


      $db2 = new PDO("sqlite:/var/www/nettemp/db/ip_meteo_id1_rainfall.sql") or die ("cannot open database");
      $query = $db2->query("SELECT sum(value) AS rain24h from def WHERE  time BETWEEN datetime('now', 'localtime', '-1 day') AND datetime('now', 'localtime')");
	  $result = $query->fetchAll();
	  foreach($result as $rainfall) {
	  
			$rain24h=$rainfall['rain24h'];
			
		db('rain24',$rain24h,'rainfall24h','virtual',$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
	  }
	  
	  $query = $db2->query("SELECT sum(value) AS rain48h from def WHERE  time BETWEEN datetime('now', 'localtime', '-2 day') AND datetime('now', 'localtime')");
	  $result = $query->fetchAll();
	  foreach($result as $rainfall) {
	  
			$rain48h=$rainfall['rain48h'];
	  }
	  
	  
      $query = $db2->query("SELECT sum(value) AS rain72h from def WHERE  time BETWEEN datetime('now', 'localtime', '-3 day') AND datetime('now', 'localtime')");
	  $result = $query->fetchAll();
	  foreach($result as $rainfall) {
	  
			$rain72h=$rainfall['rain72h'];
	  }
	  
	  $query = $db2->query("SELECT time FROM def WHERE value > 0 ORDER BY time DESC LIMIT 1");
	  $result = $query->fetchAll();
	  foreach($result as $rainfall) {
	  
			$rainlast=substr($rainfall['time'], 0, 10);
			$rainlast2= substr($rainlast, 0, 10);
			$rainlast2 = $rainlast2." 00:00:00";
			
	  }
	  
	  $query = $db2->query("SELECT sum(value) AS rainsum FROM def WHERE time  >= '$rainlast2'");
	  $result = $query->fetchAll();
	  foreach($result as $rainfall) {
	  
			$rainlastsum=$rainfall['rainsum'];
	  }

      //db('rain24',$rain24h,'rainfall24h','virtual',$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);

    ?>
	
	
	
	
	
  <div style="width:100%">
    <div style="width:70%;float:left" ><span>Ostatnie 24h</span></div>
    <div style="width:30%;float:left;text-align: right;"><span><?php echo $rain24h; ?> l/m2</span></div>
  </div>
  
  <div style="width:100%">
    <div style="width:70%;float:left" ><span>Ostatnie 48h</span></div>
    <div style="width:30%;float:left;text-align: right;"><span><?php echo $rain48h; ?> l/m2</span></div>
  </div>
  
  <div style="width:100%">
    <div style="width:70%;float:left" ><span>Ostatnie 72h</span></div>
    <div style="width:30%;float:left;text-align: right;"><span><?php echo $rain72h; ?> l/m2</span></div>
  </div>
  
  <div style="width:100%">
    <div style="width:70%;float:left" ><span>Ostatni deszcz</span></div>
    <div style="width:30%;float:left;text-align: right;"><span><?php echo $rainlast; ?></span></div>
  </div>
  
   <div style="width:100%">
    <div style="width:70%;float:left" ><span>Ostatni deszcz suma</span></div>
    <div style="width:30%;float:left;text-align: right;"><span><?php echo $rainlastsum; ?>l/m2</span></div>
  </div>
 
</div>