<?php
$crom=isset($_GET['crom']) ? $_GET['crom'] : '';
$repyear = isset($_POST['repyear']) ? $_POST['repyear'] : '';

$thisyear = date("Y");

if(empty($repyear)) {$repyear = $thisyear;} 



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
		$rows = $dbs->query("SELECT time AS date,strftime('%m',time) AS month ,round(sum(value),3) AS sums from def WHERE strftime('%Y',time) IN ($repyear) GROUP BY strftime('%m',time)") or die('lol');
		
		$row = $rows->fetchAll();
		foreach ($row as $a) { 
		
		?>
		<tr>
			<td class="col-md-0">
			
			<?php 
				$monthraw = $a['date']; 
				$month = date("F",strtotime($monthraw)); 
				echo $month= date("n",strtotime($monthraw)).". ".$month;
			
			?>
			
			</td>
			<td class="col-md-0">
			
			<?php echo $a['sums']; ?>
			
			</td>
			<td class="col-md-0">
			
			<?php 
			$costs = ($a['sums'] * $nts_kwhcost1);
			echo number_format($costs, 2, '.', '');
			 ?>
			
			</td>
		</tr>
		
		<?php
		}
		?>
		
		<tr>
			<td>
				<form action="" method="post" style="display:inline!important;">
					<select name="repyear" id="repyear" >
						<option value="<?php echo $thisyear; ?>" ><?php echo $thisyear; ?></option>
						<option value="<?php echo $thisyear -1; ?>" ><?php echo $thisyear -1; ?></option>
						<option value="<?php echo $thisyear -2; ?>" ><?php echo $thisyear -2; ?></option>
					</select>
				</form>
			</td>
				
		
		</tr>
		
<?php		
} echo $ryear;
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
</div>

