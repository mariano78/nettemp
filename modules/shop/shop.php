<?php
// phpinfo();

if(!empty($_SERVER["DOCUMENT_ROOT"])){
    $root=$_SERVER["DOCUMENT_ROOT"];
}else{
    $root=__DIR__;
    for($i=0;$i<5;$i++){
        $root = file_exists($root.'/dbf/nettemp.db') ? $root : dirname($root) ;
    }
}
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
}	

$conn = oci_connect($user, $pass, $database);
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, 'SELECT * FROM JFOX_MAGAZ');
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
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
  //spl_autoload_register(function($class){
   //   $class = str_replace('\\', '/', $class);
     // require 'src/'.$class.'.php';
  //});
 
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
 
  try{
      $client = \DreamCommerce\ShopAppstoreLib\Client::factory(
         \DreamCommerce\ShopAppstoreLib\Client::ADAPTER_BASIC_AUTH,
         array(
             'entrypoint'=>'https://sklep475200.shoparena.pl/',
             'username'=>'mmapi',
             'password'=>'Ala1Ala2!!'
         )
      );
 
$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
 
// Poberanie 1 strony
$currentPage = 1;
$result = $resource->page($currentPage)->limit(50)->get();
 
foreach($result as $product){
    // Pętla po wszystich pierwszych 50 produktach - usuwamy każdy z nich po kolei
    $deleteResult = $resource->delete($product["product_id"]);
}
 
$currentPage++;
 
// Pobranie kolejnych stron jeśli istnieją
while($currentPage <= $result->getPageCount()){
  // Pobieramy produkty z kolejnej strony
  $result = $resource->page($currentPage)->limit(50)->get();
 
  foreach($result as $product){
      // Pętla po 50 produktach z kolejnych stron - usuwamy każdy z nich po kolei
      $deleteResult = $resource->delete($product["product_id"]);
  }
 
  $currentPage++;
}
  }catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
      die($ex->getMessage());
  }

?>