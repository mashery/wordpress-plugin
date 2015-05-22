<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/Mashery/Services/Applications.php' );
require_once( constant('MASHERYPORTAL_ROOT') . '/services/BaseService.php' );

Class Applications extends BaseService
{

    public function __construct() {
        $this->service = new Mashery_Services_Applications();
    }

    public function fetch($app_id)
    {
        $response = $this->service->fetch($this->currentUser(), $app_id);

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

    public function create($data)
    {
        $data['member'] = array (
            'username' => $this->currentUser()
        );

        $data['name'] = $data['appname'];
        unset($data['appname']);
        $response = $this->service->create($data);
        error_log($response);        
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

