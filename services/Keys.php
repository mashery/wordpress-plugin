<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/services/BaseService.php' );

Class Keys extends BaseService 
{

    public function fetch()
    {
        return $this->_fetch('package_keys', '*');
    }
}


