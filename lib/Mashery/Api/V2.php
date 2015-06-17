<?php
require_once dirname(__FILE__) . "/Mashery.php";
Class Mashery_Api_V2 extends Mashery_Api_Mashery
{

    private $api_endpoint = '/v2/json-rpc/';

    public function __construct( $area_id, $apikey, $secret ) {
        $this->area_id = $area_id;
        $this->apikey = $apikey;
        $this->secret = $secret;
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

    private function call($request) {
        $url = $this->api_host . $this->api_endpoint . $this->area_id  . '?' . $this->getApiAuthenticationData();

        var_dump($url);

        $response = $this->curlPost($url, json_encode($request));

        return $response;

    }

    private function getApiAuthenticationData()
    {

        $sig = hash('md5', $this->apikey . $this->secret . time());

        return 'apikey=' . $this->apikey . "&sig=" . $sig;

    }

}
?>
