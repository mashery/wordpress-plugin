<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/services/BaseService.php' );

Class Keys extends BaseService 
{

    public function fetch($key_id)
    {
        if ($key_id) {
            return $this->_fetchOne($key_id, 'package_keys', '*');   
        } else {
            return $this->_fetchAll('package_keys', '*');
        }
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


