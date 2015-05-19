<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/MasheryV2.php' );
require_once( constant('MASHERYPORTAL_ROOT') . '/services/BaseService.php' );

Class Applications extends BaseService 
{
    public function fetch()
    {
        return $this->_fetch('applications', '*, package_keys');
    }
}



