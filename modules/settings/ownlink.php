<?php
    $csave = isset($_POST['csave']) ? $_POST['csave'] : '';
    $cip = isset($_POST['cip']) ? $_POST['cip'] : '';
	$cport = isset($_POST['cport']) ? $_POST['cport'] : '';
    $ckey = isset($_POST['ckey']) ? $_POST['ckey'] : '';
    if ($csave == "csave"){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE nt_settings SET value='$cip' WHERE option='client_ip'") or die ($db->lastErrorMsg());
    $db->exec("UPDATE nt_settings SET value='$ckey' WHERE option='client_key'") or die ($db->lastErrorMsg());
	$db->exec("UPDATE nt_settings SET value='$cport' WHERE option='client_port'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

 

$root=$_SERVER["DOCUMENT_ROOT"];
$db = new PDO("sqlite:$root/dbf/nettemp.db");


	$sth = $db->prepare("SELECT * FROM ownlinks  ORDER BY id ASC");
    $sth->execute();
    $result = $sth->fetchAll(); 
    $numsen = count($result);


 
?>


<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Own links in menu</h3>
</div>
<div class="panel-body">
<div class="table-responsive">
<table class="table table-hover table-condensed small">

<thead>
	
		<th>Name</th>
		<th>Link</th>
		<th>on/off</th>
	
</thead>

<tbody>




</tbody>
</table>
</div>


<?php

foreach ($result as $a) {
	
	
	
	
	
	
}



?>








</div>



<?php




