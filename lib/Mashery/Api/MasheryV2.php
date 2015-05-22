<?php
class Mashery_Api_MasheryV2
{

    private $areaId;

    private $api_host = 'https://api.mashery.com';

    private $api_endpoint = '/v2/json-rpc/';

    private $api_reporting_endpoint = '/v2/rest/';


    public function __construct() {
        $this->areaId = get_option('my_option_name')['mashery_customer_id'];

    } 

    public function report($resource, $service_key, $service_dev_key, $start_date, $end_date)
    {
        $url = $this->$api_host . $this->$api_reporting_endpoint . $this->areaId  . '/' . $resource .  '/service/' . $service_key . '/developer/' . $service_dev_key . '?' . $this->getApiAuthenticationData();

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
        error_log($data_string);
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
        ); 
        $response = curl_exec($ch);
        error_log($response);
        return $response;

    }

    public function create($object, $data)
    {
        $request = array (
            'method' => $object . '.create',
            'params' => array ($data),
            'id' => 1
        );

        return $this->call($request);

    }

    public function fetch($method, $object, $select, $where, $require_related)
    {
        $page = 1;
        $items = 1000;

        if ( $method == null )
        {
            throw Exception();
        }

        $params = "SELECT " . $select . " FROM " . $object .  " " . $where . " PAGE " . $page . " ITEMS " . $items;

        if ( $where == null )
        {
            $params = "SELECT " . $select . " FROM " . $object . " PAGE " . $page . " ITEMS " . $items;
        }


        $request = array (
            'method' => $method,
            'params' => array ($params),
            'id' => 1
        );

        return $this->call($request);

    }

    private function call($request)
    {
        $url = $this->api_host . $this->api_endpoint . $this->areaId  . '?' . $this->getApiAuthenticationData();

        $response = $this->curlPost($url, json_encode($request));

        return $response;

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