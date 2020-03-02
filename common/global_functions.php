<?php

function numberFormatPrecision($number, $separator, $precision)
{
    $numberParts = explode($separator, $number);
	//if ($precision == '0') { $response = substr($numberParts[0],0,-1);};
	
    $response = $numberParts[0];
    if(count($numberParts)>1 && $precision != 0){
        $response .= $separator;
        $response .= substr($numberParts[1], 0, $precision);
    } else {
		$response = $numberParts[0];
	}
    return $response;
}

?>