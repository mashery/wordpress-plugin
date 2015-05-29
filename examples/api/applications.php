<?php
$area_id   = getenv('AREA_ID');
$area_uuid = getenv('AREA_UUID');
$apikey    = getenv('APIKEY');
$secret    = getenv('SECRET');
$username  = getenv('USERNAME');
$password  = getenv('PASSWORD');
$user      = getenv('USER');

include "lib/Mashery/Services/Applications.php";
$service = new Mashery_Services_Applications($area_id, $area_uuid, $apikey, $secret, $username, $password);
$response = $service->fetch($user, null);
$obj = json_decode($response);
$json = json_encode($obj, JSON_PRETTY_PRINT);
print_r($json);
?>
