<?php	

$ROOT=dirname(dirname(dirname(dirname(dirname(__FILE__)))));

$db = new PDO("sqlite:$ROOT/dbf/nettemp.db");
$db2 = new PDO("sqlite:$ROOT/dbf/nettemp_log.db");

$dir = '';
$log_del = isset($_POST['log_del']) ? $_POST['log_del'] : '';
	if ($log_del == "Clear"){
	exec("echo log cleared > tmp/log.txt");	
	echo $dir; 
	
	$db2->exec("DELETE FROM logs");
	$db2->exec("vacuum") or die ("No vacuum." );
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();
	 } 
	 
	 
//auto refresh
$refresh = isset($_POST['refresh']) ? $_POST['refresh'] : '';
$refvalue = isset($_POST['refvalue']) ? $_POST['refvalue'] : '';
if(!empty($refresh) && ($refresh == "refresh")) { 
	$db = new PDO('sqlite:dbf/nettemp.db');
	$db->exec("UPDATE nt_settings SET value = '$refvalue'  WHERE option='logrefresh'");
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();	
} 

	 ?>	
<div class="panel panel-default">
<div class="panel-heading">Logs</div>
<div class="panel-body">

<form action="index.php?id=tools&type=log" method="post" style="display:inline!important;">
    <input type="submit" name="log_del" value="Clear" class="btn btn-xs btn-danger" />
</form>

<form action="" method="post" style="display:inline!important;">
	<label>Refresh:</label>
	<button type="submit" name="refvalue" value="<?php echo $nts_ref_logs == 'on' ? 'off' : 'on'; ?>" <?php echo $nts_ref_logs == 'on' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>> <?php echo $nts_ref_logs == 'on' ? 'ON' : 'OFF'; ?></button>
	<input type="hidden" name="refresh" value="refresh" />
</form>

<br />
<div id="logs" style="height:600px; overflow:auto">
<pre>
<?php
$filearray = file("tmp/log.txt");
$last = array_slice($filearray,-100);
    foreach($last as $f){
    	echo $f;
    }	
	$query = $db2->query("SELECT * FROM logs");
    $result= $query->fetchAll();
	
    foreach($result as $log) {
		
		echo $log['id']." - ".$log['date']." - ".$log['type']." - ".$log['message']."\n";		
	}	
?>
</pre>
</div>
</div>
</div>

<script type="text/javascript">
<?php 
if ($nts_ref_logs == 'on'){ ?>

$('#logs').scrollTop($('#logs')[0].scrollHeight);
    setInterval( function() {
		$("#logs").load(location.href+" #logs>*",""); 		
		$('#logs').scrollTop($('#logs')[0].scrollHeight);			
}, 5000);
<?php
}
?>
</script>

