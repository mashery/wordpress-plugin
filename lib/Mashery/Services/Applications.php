<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/Mashery/Services/BaseService.php' );

Class Mashery_Services_Applications extends Mashery_Services_BaseService
{
    public function fetch($username, $app_id)
    {
        $where = null;
        if ($app_id)
        {
            $where = 'WHERE id = ' . $app_id;
        } else if ($username)
        {
            $where = 'WHERE username =\'' . $username . '\'';
            
        }
        
        return $this->_fetchAll('applications', '*, package_keys', $where);
    }

    public function create($data)
    {
        return $this->_create('application', $data);;
    }
}



