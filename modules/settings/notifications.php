<?php


    $ms_onoff = isset($_POST['ms_onoff']) ? $_POST['ms_onoff'] : '';
    $ms_onoff1 = isset($_POST['ms_onoff1']) ? $_POST['ms_onoff1'] : '';
    if (($ms_onoff1 == "ms_onoff2") ){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE nt_settings SET value='$ms_onoff' WHERE option='mail_onoff'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
?>

<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Notifications</h3></div>
<div class="panel-body">
<div class="grid">
	
<?php include('modules/mail/html/mail_settings.php'); ?>
<?php include('modules/pushover/html/pushover_settings.php'); ?>

<?php
	
	$sensinterval = isset($_POST['sensinterval']) ? $_POST['sensinterval'] : '';
    $sensint_upd = isset($_POST['sensint_upd']) ? $_POST['sensint_upd'] : '';
	
    if (!empty($sensint_upd) && ($sensint_upd == "upd") ){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE nt_settings SET value='$sensinterval' WHERE option='sensorinterval'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	$switchinterval = isset($_POST['switchinterval']) ? $_POST['switchinterval'] : '';
    $swint_upd = isset($_POST['swint_upd']) ? $_POST['swint_upd'] : '';
	
    if (!empty($swint_upd) && ($swint_upd == "upd") ){
    $db = new PDO('sqlite:dbf/nettemp.db');
    $db->exec("UPDATE nt_settings SET value='$switchinterval' WHERE option='switchinterval'") or die ($db->lastErrorMsg());
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

?>



</div>
</div>
</div>




