<?php
class MasheryV2
{

    private static $instance = null;

    public static function get_instance() {
 
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
 
        return self::$instance;
 
    }

    private function __construct() {
    } 

    public function fetch($username, $object, $fields)
    {

        $areaId = get_option('my_option_name')['mashery_customer_id'];
        $apikey = get_option('my_option_name')['mashery_access_key'];
        $secret  = get_option('my_option_name')['mashery_access_secret'];

        $sig= hash('md5', $apikey . $secret . time());

        $data_string = '{"method":"object.query","id":1,"params":["SELECT ' . $fields . ' FROM ' . $object;

        if ($object != 'members') {
            $data_string = $data_string . ' REQUIRE RELATED member WITH username = \'' . $username; 
        } else {
            $data_string = $data_string . ' WHERE username = \'' . $username; 
        }
        $data_string = $data_string . '\' PAGE 1 ITEMS 100"]}';

        $url = 'https://api.mashery.com/v2/json-rpc/' . $areaId . '?apikey=' . $apikey . "&sig=" . $sig;

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
        ); 
        $response = curl_exec($ch);
        
        $content = json_decode($response, true);

        return $content;
        
    }
}
?>