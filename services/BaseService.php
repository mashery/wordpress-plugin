<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/MasheryV2.php' );
require_once( constant('MASHERYPORTAL_ROOT') . '/lib/MasheryV3.php' );

Class BaseService
{
    public function __construct() {
        $this->masheryV3Api = new MasheryV3();
        $this->masheryV2Api = new MasheryV2();
    }

    protected function currentUser()
    {
        global $current_user;
        $ul = '';
        if ( isset($current_user) )
        {
          $ul = $current_user->user_login;
          $useremail = $current_user->user_email;

        }
        if ($ul=='') { $ul = '';}
        return $ul;
    }

    protected function _create($object, $data)
    {
        $result = null;
        if ($object == 'packages') {
            $result = $this->masheryV3Api->fetch($object, $fields);
        } else {
            $result = $this->masheryV2Api->create($object, $data);
        }
        if ($result['error'] != null)
        {
            return new WP_Error( 'ERROR', __( $result['error']['data']) );
        } else
        {
            return $result;
        }

    }


    protected function _fetchOne($object_id, $object, $fields)
    {
        $items = null;
        if ($object == 'packages') {
            $items = $this->masheryV3Api->fetch($object, $fields);
        } else {
            $results = $this->masheryV2Api->fetchOne($this->currentUser(), $object_id, $object, $fields);
                 
        }
        if ($results['error'] != null)
        {
            return new WP_Error( 'broke', __( "I've fallen and can't get up", "my_textdomain" ) );
        } else
        {
            $items = $results['result']['items'];   

            return $items[0];
        }
    }

    protected function _fetchAll($object, $fields)
    {
        $items = null;
        if ($object == 'packages') {
            $items = $this->masheryV3Api->fetch($object, $fields);
        } else {
            $results = $this->masheryV2Api->fetch($this->currentUser(), $object, $fields);
            $items = $results['result']['items'];        
        }
        return $items;
    }

    protected function _report($resource, $service_key, $service_dev_key, $start_date, $end_date)
    {
        $results = $this->masheryV2Api->report($resource, $service_key, $service_dev_key, $start_date, $end_date);
        return $results;
    }
}