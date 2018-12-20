<?php	

$ROOT=dirname(dirname(dirname(__FILE__)));

$dir = '';
$log_del = isset($_POST['log_del']) ? $_POST['log_del'] : '';
	if ($log_del == "Clear"){
	exec("echo log cleared > tmp/log.txt");	
	echo $dir; 
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
<br />
<div style="height:300px;overflow:auto;padding:5px;">
<pre>
<?php
$filearray = file("tmp/log.txt");
$last = array_slice($filearray,-100);
    foreach($last as $f){
    	echo $f;
    }
	
	
	$db = new PDO("sqlite:var/www/nettemp/dbf/nettemp.db");
	$query = $db->query("SELECT * FROM logs");
    $result= $query->fetchAll();
	
    foreach($result as $log) {
		
		echo $log['date']." - ".$log['message'];		
	}
	
	echo $ROOT;
	
	
	
?>
</pre>
</div>
</div>
</div>

