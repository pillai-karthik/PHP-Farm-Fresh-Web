<?php

$response['error']=true;
$response['message']="Message";
$response['phone']="+919029192655";

$fp = fsockopen("192.168.0.25", 7881, $errno, $errstr, 3);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
	
    fwrite($fp, json_encode($response));

    // while (!feof($fp)) {
    //     echo fgets($fp, 128);
    // }


    fclose($fp);
}


?>