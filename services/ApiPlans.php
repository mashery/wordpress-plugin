<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/Mashery/Services/ApiPlans.php' );
require_once( constant('MASHERYPORTAL_ROOT') . '/services/BaseService.php' );

Class ApiPlans extends BaseService
{

    public function __construct() {
        $this->service = new Mashery_Services_ApiPlans();
    }

    public function fetch()
    {
        $response = $this->service->fetch($this->currentUser());

        error_log('fetch::' . $response);

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