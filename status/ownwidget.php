<?php 

$root=$_SERVER["DOCUMENT_ROOT"];
$db = new PDO("sqlite:$root/dbf/nettemp.db") or die ("cannot open database");


$db = new PDO('sqlite:dbf/nettemp.db');
$rows = $db->query("SELECT * FROM ownwidget");
$row = $rows->fetchAll();
$numRows = count($row);

if ( $numRows > '0' ) { 

	foreach ($row as $ow) {?> 	
	
	<?php
	$owb = $ow['body'];
	
	if (($ow['onoff'] == "on") && ($ow['iflogon'] == "off"))  { ?>
		<div class="grid-item ow<?php echo $owb ?>">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo $ow['name'];?></div>
			<div class="panel-body"><?php include("$root/tmp/ownwidget".$ow['body'].".php");?> </div>
		</div>
		</div>
<?php	
	
		} else { if (($ow['onoff'] == "on") && ($ow['iflogon'] == "on"))  {
			
			if(($_SESSION["perms"] == 'adm') || (isset($_SESSION["user"]))) { ?>

			<div class="grid-item">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo $ow['name'];?></div>
				<div class="panel-body"><?php include("$root/tmp/ownwidget".$ow['body'].".php");?> </div>
			</div>
			</div>

			<?php } 
			
				}
		}
	}
}?>