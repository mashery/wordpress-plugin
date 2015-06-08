#!/usr/bin/env php
<?php
$params = array();
$params['area_id']   = getenv('AREA_ID');
$params['area_uuid'] = getenv('AREA_UUID');
$params['apikey']    = getenv('APIKEY');
$params['secret']    = getenv('SECRET');
$params['username']  = getenv('USERNAME');
$params['password']  = getenv('PASSWORD');
$params['user']      = getenv('USER');

include "lib/Mashery/Services/Applications.php";

$service = new Mashery_Services_Applications(
    $params['area_id'],
    $params['area_uuid'],
    $params['apikey'],
    $params['secret'],
    $params['username'],
    $params['password']
);

$response = $service->fetch($user, null);
// var_dump($response);
// die();
// $obj = json_decode($response);
// $json = json_encode($obj, JSON_PRETTY_PRINT);
// print_r($json);

// class ApplicationsTest extends PHPUnit_Framework_TestCase
// {
//     public function testApplications()
//     {
//         $this->assertEquals(0, count($stack));
//
//         // $stack = array();
//         // $this->assertEquals(0, count($stack));
//         //
//         // array_push($stack, 'foo');
//         // $this->assertEquals('foo', $stack[count($stack)-1]);
//         // $this->assertEquals(1, count($stack));
//         //
//         // $this->assertEquals('foo', array_pop($stack));
//         // $this->assertEquals(0, count($stack));
//     }
// }
?>
