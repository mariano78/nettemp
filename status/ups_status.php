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
	<td><span class="label label-default">Model </span></td>
	<td><span class="label label-success"><?php echo $value; ?></span></td>
    </tr>
	<?php }
	
	if (strpos($key, 'STATUS') !== false) { ?>
	<tr>
	<td><span class="label label-default">Status </span></td>
	<td><span class="label label-success"><?php echo $value; ?></span></td>
    </tr>
	<?php }
	
	if (strpos($key, 'TIMELEFT') !== false) { ?>
	<tr>
	<td><span class="label label-default">Left time on battery </span></td>
	<td><span class="label label-success"><?php echo $value; ?></span></td>
    </tr>
	<?php }
	
	if (strpos($key, 'BATTV') !== false) { ?>
	<tr>
	<td><span class="label label-default">Battery voltage </span></td>
	<td><span class="label label-success"><?php echo $value; ?></span></td>
    </tr>
	<?php }
	
	if (strpos($key, 'LINEV') !== false) { ?>
	<tr>
	<td><span class="label label-default">Line voltage </span></td>
	<td><span class="label label-success"><?php echo $value; ?></span></td>
    </tr>
	<?php }
	
	if (strpos($key, 'LOADPCT') !== false) { ?>
	<tr>
	<td><span class="label label-default">UPS load </span></td>
	<td><span class="label label-success"><?php echo $value; ?></span></td>
    </tr>
	<?php }
	
	if (strpos($key, 'TONBATT') !== false) { ?>
	<tr>
	<td><span class="label label-default">Time on baterry </span></td>
	<td><span class="label label-success"><?php echo $value; ?></span></td>
    </tr>
	<?php }

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
