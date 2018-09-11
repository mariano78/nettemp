<style type="text/css">


/* ---- grid-item ---- */

.grid-item {
    width: 340px;
    float: left;
    border-radius: 5px;
	margin-right: 10px;
	margin-bottom: 20px;
}

</style>

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





	
<?php 
include('modules/mail/html/mail_settings.php');
include('modules/pushover/html/pushover_settings.php');
 ?>







