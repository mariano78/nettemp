<?php

$crom=isset($_GET['crom']) ? $_GET['crom'] : '';


$db = new PDO('sqlite:dbf/nettemp.db');
$rows = $db->query("SELECT * FROM sensors WHERE rom='$crom'");
$row = $rows->fetchAll();
$count = count($row);
if ($count >= "1") {
foreach ($row as $a) { 	
?>

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><?php echo $a["name"]; ?> </h3></div>
<div class="table-responsive">
<table class="table table-hover table-condensed small" border="0">



<thead>
<th>Month</th>
<th>Usage</th>
<th>Cost</th>


</thead>
	
	<?php
		$rom=$a['rom'];
		$dbs = new PDO("sqlite:$root/db/$rom.sql") or die('lol');
		$rows = $dbs->query("SELECT time AS date,strftime('%m',time) AS day,sum(value) AS sums from def where time BETWEEN datetime('now','localtime','start of month') and datetime('now','localtime') group by strftime('%d',time)") or die('lol');
		
		$row = $rows->fetchAll();
		foreach ($row as $a) { 
		
		?>
		<tr>
			<td class="col-md-0">
			
			<?php echo $a['day']; ?>
			
			</td>
			<td class="col-md-0">
			
			<?php echo $a['sums']; ?>
			
			</td>
			<td class="col-md-0">
			
			<?php echo $a['sums']; ?>
			
			</td>
		</tr>
		
		<?php
		}
		
		
		?>
	
    
    </td>

<?php

}
?>
</table>
<?php
	} else { 
		?>
		<div class="panel-body">
		No counters in system
		</div>
		<?php
	}
?>
</div>

