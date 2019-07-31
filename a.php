<?php

$secret = 203730412;
$url = '-i -H "Content-Type: application/x-www-form-urlencoded;charset=UTF-8" -H "X-Ca_key: 203730412" -X GET http://api.general.zevercloud.cn/getPlantOverview?key= ksj6grior5bfv6r3m0xrkescxnxhvmxt';

$urlsign = base64_encode(hash_hmac('sha256', $url, $secret, true));

echo $urlsign;



?>