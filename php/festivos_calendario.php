<?php
require_once '../vendor/autoload.php';
$client = new \GuzzleHttp\Client();
$year = date("Y"); // Obtiene el año actual
$response = $client->request('GET', 'https://date.nager.at/api/v3/publicholidays/'.$year.'/CO');
if ($response->getStatusCode() == 200) {
    $json = $response->getBody();
    echo $json;
}
?>
