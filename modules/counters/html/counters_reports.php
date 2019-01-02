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
<th>Name</th>
<th>Type</th>
<th>Counters</th>
<th>Show in status</th>
</thead>
<tr>
    <td class="col-md-0">
		<?php echo $a["name"]; ?>
	</td>
	<td class="col-md-0">
		<?php echo $a["type"]; ?>
	</td>
	<td class="col-md-0">
		<form action="" method="post" style="display:inline!important;">
			<input type="text" name="sum" size="16" maxlength="30" value="<?php echo $a["sum"]; ?>" required=""/>
			<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
			<input type="hidden" name="id" value="<?php echo $a["id"]; ?>" />
			<input type="hidden" name="sum1" value="sum2"/>
    </form>
	</td>
	    <!--NEW GROUP-->

    <td class="col-md-9">
    <form action="" method="post"  class="form-inline">
    <select name="ch_groupon" class="form-control input-sm small" onchange="this.form.submit()" style="width: 100px;" >
		<option value="sensors"  <?php echo $a['ch_group'] == 'sensors' ? 'selected="selected"' : ''; ?>  >Yes</option>
		<option value="none"  <?php echo $a['ch_group'] == 'none' ? 'selected="selected"' : ''; ?>  >No</option>
    </select>
    <input type="hidden" name="ch_grouponoff" value="onoff" />
    <input type="hidden" name="ch_group" value="<?php echo $a['id']; ?>" />
    </form>
    </td>
</tr>
<?php
echo $crom;

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

