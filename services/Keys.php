<?php

require_once dirname(__FILE__) . "/BaseService.php";
require_once dirname(__FILE__) . "/../lib/Mashery/Services/Keys.php";

Class Keys extends BaseService
{

    public function __construct() {
        parent::__construct();
        $this->service = new Mashery_Services_Keys($this->area_id, $this->area_uuid, $this->apikey, $this->secret, $this->username, $this->password);

    }

    public function fetch($key_id)
    {
        $response = $this->service->fetch($this->currentUser(), $key_id);

        $content = json_decode($response, true);

        if ($content['error'] != null)
        {
            return new WP_Error( 'ERROR', __( $result['error']['data']) );
        } else
        {
            if ($app_id != null)
            {
                return $content['result']['items'][0];
            } else
            {
                return $content['result']['items'];
            }

        }

    }
}
