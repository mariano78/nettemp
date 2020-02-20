<?php



try {
 
	
	
	$url = "http://api.nbp.pl/api/exchangerates/rates/a/EUR/last/100/?format=json";
	$json = file_get_contents($url);
	
	$obj = json_decode($json,true);
	//var_dump($obj);
	

	  foreach($obj['rates'] as $key=>$val){// this can be ommited if only 0 index is there after 
//league and $data['league'][0]['events'] can be used in below foreach instead of $val['events'].
        echo $val['effectiveDate']." - Kurs - ".$val['mid']."\n"; 
    }  
    
    //effectiveDate
	
	
	} catch (Exception $e) {
    echo $date." Error.\n";
    echo $e;
    exit;
}
?>