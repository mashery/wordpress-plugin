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

    public function create($data)
    {
        $data['member'] = array (
            'username' => $this->currentUser()
        );

        $data['name'] = $data['appname'];
        unset($data['appname']);
        $application = $this->_create('application', $data);
        return $application;
    }
}



