<?php 
session_start();

if (isset($_GET['owb'])) { 
    $owb = $_GET['owb'];
} 

$root=$_SERVER["DOCUMENT_ROOT"];
$db = new PDO("sqlite:$root/dbf/nettemp.db") or die ("cannot open database");


$db = new PDO('sqlite:dbf/nettemp.db');

if(($_SESSION["perms"] == 'adm') || (isset($_SESSION["user"]))) {

$rows = $db->query("SELECT * FROM ownwidget WHERE body='$owb'");

}else
{
	
$rows = $db->query("SELECT * FROM ownwidget WHERE iflogon='off' AND body='$owb'");	
}
$row = $rows->fetchAll();
$numRows = count($row);

if ( $numRows > '0' ) { 

	foreach ($row as $ow) {?> 	
	
		<div class="grid-item ow<?php echo $owb ?>">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo $own;?></div>
			<div class="panel-body"><?php include("$root/tmp/ownwidget".$owb.".php");?> </div>
		</div>
		</div>

			<?php
				}
		}
?>