<?php
$crom=isset($_GET['crom']) ? $_GET['crom'] : '';
$repyear = isset($_POST['repyear']) ? $_POST['repyear'] : '';
$cost1rom = isset($_POST['cost1rom']) ? $_POST['cost1rom'] : '';
$cost2rom = isset($_POST['cost2rom']) ? $_POST['cost2rom'] : '';
$cost1_new = isset($_POST['cost1new']) ? $_POST['cost1new'] : '';
$cost2_new = isset($_POST['cost2new']) ? $_POST['cost2new'] : '';
$c1 = isset($_POST['c1']) ? $_POST['c1'] : '';
$c2 = isset($_POST['c2']) ? $_POST['c2'] : '';

$thisyear = date("Y");
$repyearselect = '';

if(!empty($repyear)) {$repyearselect = $repyear;} else {$repyearselect = $thisyear;} 

if ( !empty($cost1rom) && !empty($cost1_new) && ($c1 == "ok")){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE sensors SET cost1='$cost1_new' WHERE rom='$cost1rom'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    } 
	
if ( !empty($cost2rom) && !empty($cost2_new) && ($c2 == "ok")){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE sensors SET cost2='$cost2_new' WHERE rom='$cost2rom'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    } 

$db = new PDO('sqlite:dbf/nettemp.db');
$rows = $db->query("SELECT * FROM sensors WHERE rom='$crom'");
$row = $rows->fetchAll();
$count = count($row);
if ($count >= "1") {
foreach ($row as $a) { 	
$t1cost = $a["cost1"];
$t2cost = $a["cost2"];

?>

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><?php echo $a["name"]?> </h3></div>
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
		$rows = $dbs->query("SELECT time AS date,strftime('%m',time) AS month ,round(sum(value),3) AS sums from def WHERE strftime('%Y',time) IN ('$repyearselect') GROUP BY strftime('%m',time)") or die('lol');
		
		$row = $rows->fetchAll();
		foreach ($row as $a) { 
		
		?>
		<tr>
			<td class="col-md-0">
			
			<?php 
				$monthraw = $a['date']; 
				$month = date("F",strtotime($monthraw)); 
				echo $month= date("m",strtotime($monthraw)).". ".$month;
			
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
		
		
		
<?php		
}
?>
</table>
</div>
</div>

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Report parameters </h3></div>
<div class="table-responsive">
<table class="table table-hover table-condensed small" border="0">

<tr>
			<td class="col-md-1">Select year: </td>
			
			
			<td class="col-md-1">
				<form action="" method="post" style="display:inline!important;">
					<select name="repyear" id="repyear" onchange="this.form.submit()">
						<option value="<?php echo $thisyear; ?>" <?php echo $repyearselect == $thisyear ? 'selected="selected"' : ''; ?> ><?php echo $thisyear; ?></option>
						<option value="<?php echo $thisyear -1; ?>" <?php echo $repyearselect == $thisyear-1 ? 'selected="selected"' : ''; ?>  ><?php echo $thisyear -1; ?></option>
						<option value="<?php echo $thisyear -2; ?>" <?php echo $repyearselect == $thisyear-2 ? 'selected="selected"' : ''; ?>  ><?php echo $thisyear -2; ?></option>
					</select>
				</form>
			</td>
			
			<td class="col-md-0">T1 Costs: 
				<form action="" method="post" style="display:inline!important;"> 
					<input type="hidden" name="costrom" value="<?php echo $a['rom']; ?>" />
					<input type="text" name="cost1_new" size="1" value="<?php echo $t1cost; ?>" />
					<input type="hidden" name="c1" value="ok" />
					<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
				</form>
			</td> 
			<td class="col-md-0">T2 Costs: 
				<form action="" method="post" style="display:inline!important;"> 
					<input type="hidden" name="costrom" value="<?php echo $a['rom']; ?>" />
					<input type="text" name="cost2_new" size="1" value="<?php echo $t2cost; ?>" />
					<input type="hidden" name="c2" value="ok" />
					<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
				</form>
			
			
			
			</td>
				
		
		</tr>



</table>
</div>
</div>
<?php
	} else { 
		?>
		<div class="panel-body">
		No counters in system
		</div>
		<?php
	}
?>


