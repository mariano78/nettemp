<?php
$upsq = $db->query("SELECT value FROM nt_settings WHERE option='ups_status'");
$upsqr = $upsq->fetchAll();
foreach ($upsqr as $ups) {
    $nts_ups_status=$ups['value'];
}

if ($nts_ups_status != 'on' ) { return; }
else {
	

?>


<div class="grid-item ups">
    <div class="panel panel-default">
    <div class="panel-heading">UPS Status</div>
	
	<div class="table-responsive">
	<table class="table table-hover table-condensed">
		<tbody>      
<?php


	exec("/sbin/apcaccess",$upso);
	foreach($upso as $ar) {
	    $col = explode(":", $ar);
	    $array[$col[0]]=$col[1];
    	}
		
foreach($array as $key => $value){
	
	if (strpos($key, 'MODEL') !== false) { ?>
	<tr>
	<td>Model:</td>
	<td><?php echo $value; ?></td>
    </tr>
	<?php }
	
	
	
    if (strpos($key, 'STATUS') !== false) {
	echo "Status: ".$value."<br>";
    }
    if (strpos($key, 'TIMELEFT') !== false) {
	echo "Left time on battery: ".$value."<br>";
    }
	if (strpos($key, 'BATTV') !== false) {
	echo "Voltage baterry: ".$value."<br>";
    }
	if (strpos($key, 'LINEV') !== false) {
	echo "Voltage line: ".$value."<br>";
    }
	if (strpos($key, 'LOADPCT') !== false) {
	echo "Load: ".$value."<br>";
    }
    if (strpos($key, 'TONBATT') !== false) {
	echo "Time on baterry: ".$value."<br>";
    }

}
?>

</tbody>
</table>
</div>			
	</div>
    </div>
</div>

<?php
}
?>
