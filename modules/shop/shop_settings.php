<?php
//phpinfo();

if(!isset($db)){
    $db = new PDO("sqlite:$root/dbf/nettemp.db");
}

function logs_shop($date,$type,$message)
	{
		
		$froot = "/var/www/nettemp/modules/shop/";	
		$db = new PDO("sqlite:$froot/shop_log.db") or die ("cannot open database");
		//$db->exec("INSERT INTO logs ('date', 'type', 'code', 'operation', 'message') VALUES ('$date', '$type', '$code', '$operation', '$message')");
		$db->exec("INSERT INTO logs ('date', 'type', 'message') VALUES ('$date', '$type', '$message')");
		
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

$conn = oci_connect($user, $pass, $database);
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