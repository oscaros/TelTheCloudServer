<?php

 include "./vendor/autoload.php";

    //send sms url
    $url = 'http://www.spectrumconnect.ug/api/0/sms/send';

    $data = [
        'client_id' => '[]',
        'client_secret' => '[]',
        'sender' => '[]',
        'message'=>'[]',
        'contacts'=>'[]'
        ];

    $data = json_encode($data);

    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    print_r($result);



?>