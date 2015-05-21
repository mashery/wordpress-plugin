<?php
class MasheryV2
{

    private $areaId;

    public function __construct() {
        $this->areaId = get_option('my_option_name')['mashery_customer_id'];
    } 

    public function create($object, $data)
    {
        $data_string = '{"method":"' . $object . '.create","id":1,"params":[' . json_encode($data, JSON_FORCE_OBJECT) . ']}';

        $url = 'https://api.mashery.com/v2/json-rpc/' . $this->areaId  . '?' . $this->getApiAuthenticationData();

        $content = $this->curlPost($url, $data_string);

        return $content;
        
    }

    public function delete($object, $id)
    {
        if ( $object == 'member' )
        {
            $id = '"' . $id . '"';
        }
        $data_string = '{"method":"' . $object . '.delete","id":1,"params":[' . $id . ']}';

        $url = 'https://api.mashery.com/v2/json-rpc/' . $this->areaId  . '?' . $this->getApiAuthenticationData();

        $content = $this->curlPost($url, $data_string);

        return $content;
        
    }

    public function fetch($username, $object, $fields)
    {
        $data_string = '{"method":"object.query","id":1,"params":["SELECT ' . $fields . ' FROM ' . $object;

        if ($object != 'members') {
            $data_string = $data_string . ' REQUIRE RELATED member WITH username = \'' . $username; 
        } else {
            $data_string = $data_string . ' WHERE username = \'' . $username; 
        }
        $data_string = $data_string . '\' PAGE 1 ITEMS 100"]}';

        $url = 'https://api.mashery.com/v2/json-rpc/' . $this->areaId  . '?' . $this->getApiAuthenticationData();

        $content = $this->curlPost($url, $data_string);

        return $content;
        
    }

    public function fetchOne($username, $object_id, $object, $fields)
    {
        $data_string = '{"method":"object.query","id":1,"params":["SELECT ' . $fields . ' FROM ' . $object;

        if ($object != 'members') {
            $data_string = $data_string . ' WHERE id = ' . $object_id; 
        } else {
            $data_string = $data_string . ' WHERE username = \'' . $username . '\'';
        }
        $data_string = $data_string . '"]}';

        $url = 'https://api.mashery.com/v2/json-rpc/' . $this->areaId  . '?' . $this->getApiAuthenticationData();

        $content = $this->curlPost($url, $data_string);

        return $content;
        
    }

    public function report($resource, $service_key, $service_dev_key, $start_date, $end_date)
    {
        $url = 'https://api.mashery.com/v2/rest/' . $this->areaId  . '/' . $resource .  '/service/' . $service_key . '/developer/' . $service_dev_key . '?' . $this->getApiAuthenticationData();

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
        ); 

        $response = curl_exec($ch);
        
        return $content;
        
    }

    private function curlPost($url, $data_string)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
        ); 
        $response = curl_exec($ch);

        if ( true === WP_DEBUG ) {
            if ( is_array( $response ) || is_object( $response ) ) {
                error_log( print_r( $response, true ) );
            } else {
                error_log( $response );
            }
        }
        $content = json_decode($response, true);

        return $content;

    }

    private function getApiAuthenticationData()
    {
        $apikey = get_option('my_option_name')['mashery_access_key'];
        $secret  = get_option('my_option_name')['mashery_access_secret'];

        $sig= hash('md5', $apikey . $secret . time());

        return 'apikey=' . $apikey . "&sig=" . $sig;

    }

}
?>