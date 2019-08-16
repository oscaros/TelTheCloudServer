<?php

include "./vendor/autoload.php";

//send sms url
$url = 'http://www.spectrumconnect.ug/api/1/sms/send';

$data = [
    'client_id' => '[]',
    'client_secret' => '[]',
    'grant_type' => 'client_credentials',
    'from' => '[]',
    'message'=>'[]',
    'to'=>'[]'
    ];

$data = json_encode($data);

$key =file_get_contents('http://www.spectrumconnect.ug/assets/spectrumconnect.pub');
$rsa =  new phpseclib\Crypt\RSA();
$rsa->loadKey($key);
$rsa->setPublicKey($key);
// read the public key
openssl_public_encrypt($data, $encrypted,$rsa->getPublicKey());
// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query(['data'=> base64_encode($encrypted)]),
    ),
);

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
print_r($result);

?>