<?php

namespace Mashery;

class API {

    const V2_ENDPOINT    = '/v2/json-rpc/';
    const V3_ENDPOINT    = '/v3/rest/';
    const TOKEN_ENDPOINT = '/v3/token';

    /**
     * Construct
     *
     * @access public
     * @param  $host
     * @param  $area_id
     * @param  $area_uuid
     * @param  $apikey
     * @param  $secret
     * @param  $username
     * @param  $password
     * @param  $user
     */
    public function __construct($area_id, $area_uuid, $apikey, $secret, $username, $password, $user=NULL) {

        $this->host      = 'https://api.mashery.com';
        $this->area_id   = $area_id;
        $this->area_uuid = $area_uuid;
        $this->apikey    = $apikey;
        $this->secret    = $secret;
        $this->username  = $username;
        $this->password  = $password;
        $this->user      = $user;

    }

    /**
     * Get apis
     *
     * @access public
     */
    public function apis() {

        // $mql = "SELECT * FROM members WHERE username = '$this->user'";
        // return $this->V2($mql)["result"]["items"][0];

    }

    /**
     * Get plans
     *
     * @access public
     */
    public function user() {

        $mql = "SELECT * FROM members WHERE username = '$this->user'";
        return $this->V2($mql)["result"]["items"][0];

    }

    /**
     * Get plans
     *
     * @access public
     */
    public function plans() {

        $mql = "SELECT roles FROM members WHERE username = '$this->user'";
        return $this->V2($mql);

    }

    /**
     * Get roles
     *
     * @access public
     */
    public function roles() {

        $mql = "SELECT roles FROM members WHERE username = '$this->user'";
        return $this->V2($mql);

    }

    /**
     * Get applications
     *
     * @access public
     */
    public function applications() {

        $mql = "SELECT *, package_keys FROM applications WHERE username = '$this->user'";
        return $this->V2($mql)["result"]["items"];

    }

    /**
     * Get application
     *
     * @access public
     */
    public function application($application_id) {

        $mql = "SELECT *, package_keys FROM applications WHERE id = '$application_id'";
        return $this->V2($mql)["result"]["items"][0];

    }

    /**
     * Get keys
     *
     * @access public
     */
    public function keys() {

        $mql = "SELECT * FROM package_keys REQUIRE RELATED member WITH username = '$this->user'";
        return $this->V2($mql)["result"]["items"];

    }

    /**
     * Get key
     *
     * @access public
     */
    public function key($key_id) {

        $mql = "SELECT * FROM package_keys WHERE id = '$key_id'";
        return $this->V2($mql)["result"]["items"][0];

    }

    /**
     * Delete key
     *
     * @access public
     */
    public function key_delete($key_id) {

        $mql = $key_id;
        var_dump($mql);
        return $this->V2($mql)["result"];

    }

    /**
     * Call API V2
     *
     * @access private
     * @param $mql   : Fully composed Mashery Query Language statement
     * @param $method: RPC method
     */
    private function V2($mql, $method = 'object.query') {

        $sig = hash('md5', $this->apikey . $this->secret . time());
        $url = self::V2_ENDPOINT . '/' . $this->area_id;
        $query = array(
            "apikey" => $this->apikey,
            "sig"    => $sig
        );
        $payload = json_encode(array(
            'method' => $method,
            'params' => array ($mql),
            'id' => 1
        ));
        $headers = array(
            "Content-Length: " . strlen($payload)
        );
        return $this->call(array(
            "url"     => $url,
            "query"   => $query,
            "payload" => $payload,
            "headers" => $headers,
            "method"  => "POST"
        ));

    }

    /**
     * Call API V3
     *
     * @access private
     * @param $resource: Valid resource name
     * @param $select  : Fields to return
     */
    private function V3($resource, $fields) {

        $url = self::V3_ENDPOINT.$resource;
        $headers = array(
            "Authorization: Bearer " . $this->token()
        );
        $query = array(
            "fields" => $fields
        );
        return $this->call(array(
            "url"     => $url,
            "query"   => $query,
            "payload" => $payload,
            "headers" => $headers
        ));

    }

    /**
     * Get a token
     *
     * @access private
     * @param  $resource
     * @param  $fields
     */
    private function token() {

        $url = self::TOKEN_ENDPOINT;
        $payload = http_build_query(array(
            "grant_type" => "password",
            "username"   => $this->username,
            "password"   => $this->password,
            "scope"      => $this->area_uuid
        ));
        $response = $this->call(array(
            "url"     => $url,
            "payload" => $payload,
            "method"  => "POST"
        ));

        return $response['access_token'];

    }

    /**
     * HTTP Call
     *
     * @access private
     */
    private function call($options) {

        $merged = array();
        $merged["url"]     = isset($options["url"])     ? $options["url"] : null;
        $merged["query"]   = isset($options["query"])   ? $options["query"] : array();
        $merged["payload"] = isset($options["payload"]) ? $options["payload"] : array();
        $merged["headers"] = isset($options["headers"]) ? array_merge(array("Content-Type: application/json"), $options["headers"]) : array();
        $merged["method"]  = isset($options["method"])  ? $options["method"] : "GET";

        $url = $this->host . $merged["url"];

        if (count($merged["query"]) > 0) {
            $url = $url . '?' . http_build_query($merged["query"]);
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $merged["headers"]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $merged["method"]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $merged["payload"]);
        if ($merged["url"] == self::TOKEN_ENDPOINT) {
            curl_setopt($curl, CURLOPT_USERPWD, $this->apikey. ':' . $this->secret);
        }
        $json = curl_exec($curl);

        $response = json_decode($json, true);

        // if ($response['error'] != null) {
        //     $data = new WP_Error( 'ERROR', __( $result['error']['data']) );
        // }
        //
        // $items = $response['result']['items'];
        // if (count($items) == 1) {
        //     $items = $items[0];
        // }

        return $response;

    }
}

?>
