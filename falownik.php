<?php

$ROOT='/var/www/nettemp';
include("$ROOT/receiver.php");
$status2 = 3 ;

	$url = "http://192.168.50.8/home.cgi/";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    if(!empty($post)) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    } 
    $inputdata = curl_exec($ch);
    curl_close($ch);
   
   

$inputdata_expl = explode("\n", $inputdata);



$peak =  $inputdata_expl[10];
$total =  $inputdata_expl[11];
$status = $inputdata_expl[12];

if ($status == 'OK') {$status2 = 0 ;}
if ($status != 'OK') {$status2 = 1 ;}


db('falownik_peak',$peak,'peak','ip',$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
db('falownik_total',$total,'total','ip',$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
db('falownik_status',$status2,'trigger','ip',$local_current,$local_ip,$local_gpio,$local_i2c,$local_usb,$local_name);
?>