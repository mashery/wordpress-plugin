<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/Mashery/Services/BaseService.php' );

Class Mashery_Services_Keys extends Mashery_Services_BaseService 
{

    public function fetch($username, $key_id)
    {
        $where = null;
        if ($key_id)
        {
            $where = 'WHERE id = ' . $key_id;
        } else if ($username)
        {
            $where = 'WHERE username =\'' . $username . '\'';
            
        }
        
        return $this->_fetchAll('package_keys', '*', $where);
    }    

    public function callsErrorcodesForServiceForDeveloper($service_key, $service_dev_key, $start_date, $end_date)
    {
        return $this->_report('reports/calls/errorcodes', $service_key, $service_dev_key, $start_date, $end_date);
    }

    public function callsGeolocationForServiceForDeveloper($service_key, $service_dev_key, $start_date, $end_date)
    {
        return $this->_report('reports/calls/geolocation', $service_key, $service_dev_key, $start_date, $end_date);
    }

    public function callsMethodsForServiceForDeveloper($service_key, $service_dev_key, $start_date, $end_date)
    {
        return $this->_report('reports/calls/methods', $service_key, $service_dev_key, $start_date, $end_date);  
    }

    public function callsStatusForServiceForDeveloper($service_key, $service_dev_key, $start_date, $end_date)
    {
        return $this->_report('reports/calls/status', $service_key, $service_dev_key, $start_date, $end_date);
    }

}


