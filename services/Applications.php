<?php

require_once dirname(__FILE__) . "/BaseService.php";
require_once dirname(__FILE__) . "/../lib/Mashery/Services/Applications.php";

Class Applications extends BaseService
{

    public function __construct() {
        parent::__construct();
        $this->service = new Mashery_Services_Applications($this->area_id, $this->area_uuid, $this->apikey, $this->secret, $this->username, $this->password);
    }

    public function fetch($app_id) {
        if ($this->currentUser() == '') {
            return new WP_Error( 'ERROR', __( 'Not logged in' ));
        }

        $response = $this->service->fetch($this->currentUser(), $app_id);

        $content = json_decode($response, true);

        if ($content['error'] != null) {
            return new WP_Error( 'ERROR', __( $result['error']['data']) );
        } else {
            if ($app_id != null) {
                return $content['result']['items'][0];
            } else {
                return $content['result']['items'];
            }

        }

    }

    public function create($data) {
        $data['member'] = array (
            'username' => $this->currentUser()
        );

        $data['name'] = $data['appname'];
        unset($data['appname']);
        $response = $this->service->create($data);

        $content = json_decode($response, true);

        if ($content['error'] != null)
        {
            return new WP_Error( 'ERROR', __( $result['error']['data']) );
        } else
        {
            return $content['result'];
        }
    }
}
