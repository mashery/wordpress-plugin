<?php
/**
 * Run test: `phpunit tests/API.php`
 */

require dirname(__FILE__) . '/../Mashery/API.php';
use \Mashery\API;

class APITest extends PHPUnit_Framework_TestCase
{

    protected static $mashery;

    public static function setUpBeforeClass() {
        self::$mashery = new API(
            getenv('AREA_ID'),
            getenv('AREA_UUID'),
            getenv('APIKEY'),
            getenv('SECRET'),
            getenv('USERNAME'),
            getenv('PASSWORD'),
            getenv('ASUSER')
        );
    }

    public function testAPIs() {
        $this->markTestIncomplete();
    }

    public function testUser() {
        $item  = self::$mashery->user();
        $this->assertArrayHasKey('username', $item);
        $this->assertEquals($item['username'], self::$mashery->user, "Incorrect username");
        $this->assertArrayHasKey('email', $item);
        $this->assertArrayHasKey('display_name', $item);
        $this->assertArrayHasKey('object_type', $item);
        $this->assertEquals($item['object_type'], "member", "incorrect object_type");
    }

    public function testPlans() {
        $this->markTestIncomplete();
    }

    public function testRoles() {
        $this->markTestIncomplete();
    }

    public function testApplications() {
        $collection = self::$mashery->applications();
        $this->assertInternalType('array', $collection);
    }

    public function testApplication() {
        $collection = self::$mashery->applications();
        $item  = self::$mashery->application($collection[0]['id']);
        $this->assertArrayHasKey('id', $item);
        $this->assertArrayHasKey('username', $item);
        $this->assertEquals($item['username'], self::$mashery->user, "Incorrect username");
        $this->assertArrayHasKey('object_type', $item);
        $this->assertEquals($item['object_type'], "application", "incorrect object_type");
    }

    public function testKeys() {
        $collection = self::$mashery->keys();
        $this->assertInternalType('array', $collection);
    }

    public function testKey() {
        $collection = self::$mashery->keys();
        $item = self::$mashery->key($collection[0]['id']);
        $this->assertArrayHasKey('id', $item);
        $this->assertArrayHasKey('apikey', $item);
        $this->assertArrayHasKey('secret', $item);
    }

}

?>
