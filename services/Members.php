<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/Mashery/Services/Members.php' );
require_once( constant('MASHERYPORTAL_ROOT') . '/services/BaseService.php' );

Class Members extends BaseService
{

    public function __construct() {
        parent::__construct();
        $this->service = new Mashery_Services_Members($this->area_id, $this->area_uuid, $this->apikey, $this->secret, $this->username, $this->password);
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