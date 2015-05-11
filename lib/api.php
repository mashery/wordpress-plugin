<?php
namespace Mashery\API;

class Client {

    static function applications() {
        return array(
            array("name" => "Application 1", "key" => "765rfgi8765rdfg8765rtdfgh76rdtcf"),
            array("name" => "Application 2", "key" => "hrydht84g6bdr4t85rd41tg6rs4g56r"),
            array("name" => "Application 3", "key" => "87946t4hdr8y6h4td5y4dt8y4dyt6yh84d")
        );
    }

    static function keys() {
        return array(
            array("name" => "Key 1", "key" => "765rfgi8765rdfg8765rtdfgh76rdtcf"),
            array("name" => "Key 2", "key" => "hrydht84g6bdr4t85rd41tg6rs4g56r"),
            array("name" => "Key 3", "key" => "87946t4hdr8y6h4td5y4dt8y4dyt6yh84d")
        );
    }

    static function profile() {
        return array(
            "first_name" => "Stephen",
            "last_name" => "Colbert",
            "email" => "scolbert@mashery.com",
            "twitter" => "@scolbert",
            "phone" => "(415) 555-1212"
        );
    }

    static function iodocs() {
        return array("key" => "765rfgi8765rdfg8765rtdfgh76rdtcf");
    }

    static function documentation() {
        return array("key" => "765rfgi8765rdfg8765rtdfgh76rdtcf");
    }

}

?>
