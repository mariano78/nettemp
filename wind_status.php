<?php
$root=$_SERVER["DOCUMENT_ROOT"];

$db = new PDO("sqlite:$root/dbf/nettemp.db") or die ("cannot open database");
$sth = $db->prepare("select * from sensors where type='wind';");
$sth->execute();
$result = $sth->fetchAll();
$numRows = count($result);
?>
<?php if ( $numRows > '0' ) { ?>
<?php /*
<!--
<div class="grid-item hs" >
<div class="panel panel-default">
<div class="panel-heading">Wind status</div>
-->
*/?>
<table class="table table-hover condensed small">
<?php
foreach ( $result as $a) {
?>
    <tr>
	<td >
	    <img src="tmp/meteo/roza.php?w=<?php echo $a['tmp']?>">
	</td>
    </tr>
<?php
    }
?>
    </table>
<?php
    }
?>