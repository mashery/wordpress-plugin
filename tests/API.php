<?php

echo "Requiring Mashery.php\n";
require dirname(__FILE__) . '/../lib/Mashery/API.php';

echo "Using \Mashery\API\n";
use \Mashery\API;

echo "Declaring variables\n";
$area_id   = "425";
$area_uuid = "acbb134e-c2f4-4203-b15b-9343e9ad031c";
$apikey    = "sbub7dmvheh4gw8dusx8a38d";
$secret    = "MBxqKP8wfs";
$username  = "demo3_jpollock";
$password  = "mashery2015";
$user      = "jpollock";

echo "Instantiating...\n";
$mashery = new API(
    $area_id,
    $area_uuid,
    $apikey,
    $secret,
    $username,
    $password,
    $user
);

// echo "\nRequesting packages [V3]...\n";
// $response = $mashery->get('packages', 'id,name,plans,plans.roles') . "\n";
// echo $response . "\n";
//
// echo "\nRequesting members [V2]...\n";
// $response = $mashery->get('members', '*') . "\n";
// echo $response . "\n";
//
// echo "\nRequesting applications [V2]...\n";
// $response = $mashery->get('applications', '*,package_keys') . "\n";
// echo $response . "\n";

// echo "\nRequesting all user keys [V2]...\n";
// $keys = $mashery->keys();
// foreach ($keys as $index => $key) {
//     echo "ID  : " . $key["id"] . "\n";
//     echo "KEY : " . $key["apikey"] . "\n";
// }
// // var_dump($keys);

// echo "\nRequesting key " . $keys[0]["id"] . " [V2]...\n";
// $key = $mashery->key($keys[0]["id"]);
// echo "ID  : " . $key["id"] . "\n";
// echo "KEY : " . $key["apikey"] . "\n\n";

echo "\nRequesting applications [V2]...\n";
$applications = $mashery->applications();
// foreach ($applications as $index => $application) {
//     echo "ID  : " . $application["id"] . "\n";
//     echo "KEY : " . $application["apikey"] . "\n";
// }
var_dump($applications);

// echo "\nRequesting application [V2]...\n";
// $response = $mashery->application("256382");
// echo $response . "\n";

?>
