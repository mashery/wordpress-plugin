<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/Mashery/Services/ApiPlans.php' );
require_once( constant('MASHERYPORTAL_ROOT') . '/services/BaseService.php' );

Class ApiPlans extends BaseService
{

    public function __construct() {
        parent::__construct();
        $this->service = new Mashery_Services_ApiPlans($this->area_id, $this->area_uuid, $this->apikey, $this->secret, $this->username, $this->password);
    }

    public function fetch()
    {
        $token = get_transient('v3token');
        if ($token == false)
        {
            $token = $this->service->v3Authenticate();
            set_transient('v3token', $token_content['access_token'], 900);
        }
        $response = $this->service->fetch($token, $this->currentUser());

        $content = json_decode($response, true);

        if ($content['error'] != null)
        {
            return new WP_Error( 'ERROR', __( $result['error']['data']) );
        } else
        {
            return $content;
            
        }

    }

}