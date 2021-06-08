<?php


if(!empty($_SERVER["DOCUMENT_ROOT"])){
    $root=$_SERVER["DOCUMENT_ROOT"];
}
// name:
// type: temp, humid, relay, lux, press, humid, gas, water, elec, volt, amps, watt, trigger
// device: ip, wireless, remote, gpio, i2c, usb

// definied source (middle part): tty, ip, gpio number

// curl --connect-timeout 3 -G "http://172.18.10.10/receiver.php" -d "value=1&key=123456&device=wireless&type=gas&ip=172.18.10.9"
// curl --connect-timeout 3 -G "http://172.18.10.10/receiver.php" -d "value=20&key=123456&device=wireless&type=elec&ip=172.18.10.9"
// php-cgi -f receiver.php key=123456 rom=new_12_temp value=23

if (isset($_GET['kod'])) { 
    $kod = $_GET['kod'];
} else { 
    $kod='';
}

shell_exec("php -f /modules/shop/shop_prod.php c=$kod");


echo $kod;



?>

