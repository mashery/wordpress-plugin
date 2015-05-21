<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/MasheryV2.php' );
require_once( constant('MASHERYPORTAL_ROOT') . '/services/BaseService.php' );

Class Applications extends BaseService 
{
    public function fetch($app_id)
    {
        if ($app_id)
        {
            return $this->_fetchOne($app_id, 'applications', '*, package_keys');
        } else
        {
            return $this->_fetchAll('applications', '*, package_keys');
        }
        
    }
}



