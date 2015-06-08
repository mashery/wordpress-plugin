<?php
Class Mashery_Api_V3 extends Mashery_Api_Mashery
{

    private $api_endpoint = '/v3/rest/';

    private $token_endpoint = '/v3/token';

    public function __construct( $area_uuid, $apikey, $secret, $username, $password ) {
        $this->area_uuid = $area_uuid;
        $this->apikey = $apikey;
        $this->secret = $secret;
        $this->username = $username;
        $this->password = $password;
    }

    public function fetch($token, $resource, $fields)
    {
        if ($token == false) {
          $this->authenticate();
        }

        $url = $this->api_host . $this->api_endpoint . $resource . '?fields=' . $fields;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token)
        );
        $response = curl_exec($ch);

        return $response;

    }

    public function authenticate() {

        $url = $this->api_host . $this->token_endpoint;

        $data_string = 'grant_type=password&username='. $this->username . '&password='. $this->password . '&scope=' . $this->area_uuid;

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->apikey. ':' . $this->secret);

        $response = curl_exec($ch);

        $token_content = json_decode($response, true);

        return $token_content['access_token'];

    }

}
?>
