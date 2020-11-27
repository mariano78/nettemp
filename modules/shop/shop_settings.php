<?php
//phpinfo();

if(!isset($db)){
    $db = new PDO("sqlite:$root/dbf/nettemp.db");
}

if(!isset($db2)){
	$froot2 = "/var/www/nettemp/modules/shop/";
    $db2 = new PDO("sqlite:$froot2/shop_log.db") or die ("cannot open database");
}


function logs_shop($date,$type,$message)
	{
		
		$froot = "/var/www/nettemp/modules/shop/";	
		$db = new PDO("sqlite:$froot/shop_log.db") or die ("cannot open database");
		//$db->exec("INSERT INTO logs ('date', 'type', 'code', 'operation', 'message') VALUES ('$date', '$type', '$code', '$operation', '$message')");
		$db->exec("INSERT INTO logs ('date', 'type', 'message') VALUES ('$date', '$type', '$message')");
		
	}
	
function pl_charset($string) {

$string = strtolower($string);
$polskie = array(',', ' - ',' ','ę', 'Ę', 'ó', 'Ó', 'Ą', 'ą', 'Ś', 's', 'ł', 'Ł', 'ż', 'Ż', 'Ź', 'ź', 'ć', 'Ć', 'ń', 'Ń','-',"'","/","?", '"', ":", 'ś', '!','.', '&', '&', '#', ';', '[',']', '(', ')', '`', '%', '”', '„', '…');
$miedzyn = array('-','-','-','e', 'e', 'o', 'o', 'a', 'a', 's', 's', 'l', 'l', 'z', 'z', 'z', 'z', 'c', 'c', 'n', 'n','-',"","-","","","",'s','','', '', '', '', '', '', '', '', '', '', '', '');
$string = str_replace($polskie, $miedzyn, $string);

// usuń wszytko co jest niedozwolonym znakiem
$string = preg_replace('/[^0-9a-z\-]+/', '', $string);

// zredukuj liczbę myślników do jednego obok siebie
$string = preg_replace('/[\-]+/', '-', $string);

// usuwamy możliwe myślniki na początku i końcu
$string = trim($string, '-');

$string = stripslashes($string);

// na wszelki wypadek
$string = urlencode($string);

return $string;
}
// 

$sth = $db->query("SELECT * FROM shop");
$sth->execute();
$result = $sth->fetchAll();
foreach ($result as $a) {
	if($a['option']=='user') {
		$user=$a['value'];
	}
	if($a['option']=='pass') {
		$pass=$a['value'];
	}
	if($a['option']=='database') {
		$database=$a['value'];
	}
	if($a['option']=='shopusr') {
		$shopusr=$a['value'];
	}
	if($a['option']=='shoppass') {
		$shoppass=$a['value'];
	}
	if($a['option']=='shoptest') {
		$shoptest=$a['value'];
	}
	if($a['option']=='paginating') {
		$paginating=$a['value'];
	}
}	
// ORACLE - podłączenie do bazy

$conn = oci_connect($user, $pass, $database, 'AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


// SDK shoper - ustawienia
$config = array(
      'debug' => false,
      'logFile' => "$root/modules/shop/logs/application.log",
      'timezone' => 'Europe/Warsaw',
      'php' => array(
          'display_errors' => 'off'
      )
  );
 
  ini_set('default_charset', 'utf-8');
 
  // tutaj UWAGA - scieżka src to przykładowa ścieżka gdzie znajdują się pliki z sdk czyli ten plik znajduje się w katalogu głównym a w podkatalogu src znajdują się odpowidnie elementy sdk (katalogi DreamCommerce i Psr)
  spl_autoload_register(function($class){
      $class = str_replace('\\', '/', $class);
      require 'src/'.$class.'.php';
  });
 
  date_default_timezone_set($config['timezone']);
  ini_set('display_errors', $config['php']['display_errors']);
 
  $debug = false;
 
  if(isset($config['debug'])){
      if($config['debug']){
          $debug = true;
      }
  }
 
  if(getenv('DREAMCOMMERCE_DEBUG')){
      $debug = true;
  }
 
  define("DREAMCOMMERCE_DEBUG", $debug);
 
  $logFile = "$root/modules/shop/logs/application.log";
 
  if(isset($config['logFile'])){
      if($config['logFile']){
          $logFile = $config['logFile'];
      }else{
          $config['logFile'] = false;
      }
  }
 
  define("DREAMCOMMERCE_LOG_FILE", $logFile);
 
 //Połączenie do shoper
 try{
      $client = \DreamCommerce\ShopAppstoreLib\Client::factory(
         \DreamCommerce\ShopAppstoreLib\Client::ADAPTER_BASIC_AUTH,
         array(
             'entrypoint'=> $shoptest,
             'username'=> $shopusr,
             'password'=> $shoppass
         )
      );
	  
	}catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
      die($ex->getMessage());
  }
 

?>