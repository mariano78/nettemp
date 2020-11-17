<?php

if(!empty($_SERVER["DOCUMENT_ROOT"])){
    $root=$_SERVER["DOCUMENT_ROOT"];
}else{
    $root=__DIR__;
    for($i=0;$i<5;$i++){
        $root = file_exists($root.'/dbf/nettemp.db') ? $root : dirname($root) ;
    }
}
// Dołączam ustawienia Oracle i sdk shoper
include("$root/modules/shop/shop_settings.php");


$ftp_host = "robelit.home.pl";
$ftp_user = "shoper@robelit.pl";
$ftp_password = "Ala1Ala2";

//Connect
echo "<br />Connecting to $ftp_host via FTP...";
$conn = ftp_connect($ftp_host);
$login = ftp_login($conn, $ftp_user, $ftp_password);

//
//Enable PASV ( Note: must be done after ftp_login() )
//
$mode = ftp_pasv($conn, TRUE);

//Login OK ?
if ((!$conn) || (!$login) || (!$mode)) {
   die("FTP connection has failed !");
}
echo "<br />Login Ok.<br />";

//
//Now run ftp_nlist()
//
$file_list = ftp_nlist($conn, "5905725026302");
foreach ($file_list as $file)
{
  echo "<br>$file";
}

//close
ftp_close($conn);

?>