<?php
$curl = curl_init();
$timestamp=time();
$privKey="37406e81e115bf5a02249dd58ff09436";
$apiKey="6c65162c5455f34fbe82803096d8ec75";
$tokenPrepare=$privKey."--".$apiKey."--".$timestamp;
$token=hash("sha256", $tokenPrepare);
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-form.couponplus.ch/api/1.1/frmapi.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
   CURLOPT_POSTFIELDS => 'data=%7B%22header%22%3A%7B%22timestamp%22%3A'.$timestamp.'%2C%22api_key%22%3A%22'.$apiKey.'%22%2C%22token%22%3A%22'.$token.'%22%2C%22action%22%3A%22submitdata%22%7D%2C%22payload%22%3A%5B%7B%22id%22%3A%22890605-11950%22%2C%22email%22%3A%20%22test%40test.ch%22%7D%5D%7D',
  CURLOPT_HTTPHEADER => array(
    'timestamp: '.$timestamp,
    'api_key: '.$apiKey,
    'token: '.$token,
    'action: submitdata',
    'Access-Control-Allow-Origin: *',
    'Content-Type: application/x-www-form-urlencoded',
    'Cookie: lbid=92f6c7bf0dd2b3b9a991c83a4a127b9c'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
header("Access-Control-Allow-Origin: https://liferayclone.streamnow.ch");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: https://liferayclone.streamnow.ch");

echo $response;
