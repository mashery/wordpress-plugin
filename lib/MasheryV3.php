<?php
class MasheryV3
{
    private $token = null;

    private static $instance = null;

    public static function get_instance() {
 
        if ( null == self::$instance ) {
            error_log('get_instance::creating');
            self::$instance = new self;
        }
 
        return self::$instance;
 
    }

    private function __construct() {
    } 

    public function fetch($resource, $fields)
    {
        if (get_transient('v3token') == false) {
          $this->authenticate();  
        }
        $url = 'https://api.mashery.com/v3/rest/' . $resource . '?fields=' . $fields;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Authorization: Bearer ' . get_transient('v3token'))
        ); 
        $response = curl_exec($ch);
        $content = json_decode($response, true);

        return $content;
        
    }

    private function authenticate() {
        error_log('generating token');
        $areaUuid = get_option('my_option_name')['mashery_customer_uuid'];
        $apikey = get_option('my_option_name')['mashery_access_key'];
        $secret  = get_option('my_option_name')['mashery_access_secret'];        
        $username = get_option('my_option_name')['mashery_access_username'];
        $password  = get_option('my_option_name')['mashery_access_password'];

        $url = 'http://api.mashery.com/v3/token';
        
        $data_string = 'grant_type=password&username='. $username . '&password='. $password . '&scope=' . $areaUuid;

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_USERPWD, $apikey. ':' . $secret);
        $response = curl_exec($ch);
        $token_content = json_decode($response, true);

        set_transient('v3token', $token_content['access_token'], 900);
        return;

    }

    private function refresh_token() {
        error_log('refresing token');
        error_log(get_transient('v3refreshToken'));
        if (get_transient('v3refreshToken') == false) {
          return $this->authenticate();  
        }

        $areaUuid = get_option('my_option_name')['mashery_customer_uuid'];
        $apikey = get_option('my_option_name')['mashery_access_key'];
        $secret  = get_option('my_option_name')['mashery_access_secret'];        

        $url = 'http://api.mashery.com/v3/token';
        
        $data_string = 'grant_type=refresh_token&refresh_token='. get_transient('v3refreshToken');

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_USERPWD, $apikey. ':' . $secret);
        $response = curl_exec($ch);
        $token_content = json_decode($response, true);

        return;

    }    
}
?>