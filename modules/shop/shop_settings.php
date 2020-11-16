<?php
// phpinfo();

if(!isset($db)){
    $db = new PDO("sqlite:$root/dbf/nettemp.db");
}

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
      'logFile' => "logs/application.log",
      'timezone' => 'Europe/Warsaw',
      'php' => array(
          'display_errors' => 'on'
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
 
  $logFile = "php://stdout";
 
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