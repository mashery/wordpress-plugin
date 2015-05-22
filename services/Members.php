<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/Mashery/Services/Members.php' );
require_once( constant('MASHERYPORTAL_ROOT') . '/services/BaseService.php' );

Class Members extends BaseService
{

    public function __construct() {
        $this->service = new Mashery_Services_Members();
    }

    public function fetch()
    {
        $items = $this->service->fetch();
    }

/*
        if ($result['error'] != null)
        {
            return new WP_Error( 'ERROR', __( $result['error']['data']) );
        } else
        {
            return $result;
        }
*/
}   