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
</thead>
<tr>
    <td class="col-md-0">
		Counter total: <?php echo $a["sum"]; ?>
	</td>
	    <!--NEW GROUP-->
		
<?php		
$dbs = new PDO("sqlite:db/$crom.sql");
$rows = $db->query("select time,strftime('%d',time),sum(value) from def where time BETWEEN datetime('now','localtime','start of month') and datetime('now','localtime') group by strftime('%d',time)");
$row2 = $rows->fetchAll();
$count = count($row2);
if ($count >= "1") {
foreach ($row2 as $b) { 
?>
<tr>
<td class="col-md-0">

<?php echo $b["time"]; ?>
    
    </td>


</tr>

<?php
}
 ?>


    <td class="col-md-9">
    
    </td>
</tr>
<?php

}}
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

