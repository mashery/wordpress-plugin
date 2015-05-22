<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/Mashery/Services/Keys.php' );
require_once( constant('MASHERYPORTAL_ROOT') . '/services/BaseService.php' );

Class Keys extends BaseService
{

    public function __construct() {
        $this->service = new Mashery_Services_Keys();
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