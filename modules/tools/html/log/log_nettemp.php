<?php	

$ROOT=dirname(dirname(dirname(dirname(dirname(__FILE__)))));

$db = new PDO("sqlite:$ROOT/dbf/nettemp.db");

$dir = '';
$log_del = isset($_POST['log_del']) ? $_POST['log_del'] : '';
	if ($log_del == "Clear"){
	exec("echo log cleared > tmp/log.txt");	
	echo $dir; 
	
	$db->exec("DELETE FROM logs");
	
	
	
	header("location: " . $_SERVER['REQUEST_URI']);
	exit();
	 } 

	 ?>	
<div class="panel panel-default">
<div class="panel-heading">Logs</div>
<div class="panel-body">

<form action="index.php?id=tools&type=log" method="post">
    <input type="submit" name="log_del" value="Clear" class="btn btn-xs btn-danger" />
</form>

<form action="" method="post" style="display:inline!important;">
	<label>Refresh:</label>
	<input type="hidden" name="id" value="<?php echo $z["id"]; ?>" />
	<button type="submit" name="refresh" value="<?php echo $nts_ref_logs == 'on' ? 'off' : 'on'; ?>" <?php echo $nts_ref_logs == 'on' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>> <?php echo $nts_ref_logs == 'on' ? 'ON' : 'OFF'; ?></button>
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
	
	
	
	$query = $db->query("SELECT * FROM logs");
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

