<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/MasheryV2.php' );
require_once( constant('MASHERYPORTAL_ROOT') . '/lib/MasheryV3.php' );

Class BaseService
{
    public function __construct() {
        $this->masheryV3Api = MasheryV3::get_instance();
        $this->masheryV2Api = MasheryV2::get_instance();
    }

    private function currentUser()
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

    protected function _fetch($object, $fields)
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
}