<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/Mashery/Api/MasheryV2.php' );
require_once( constant('MASHERYPORTAL_ROOT') . '/lib/Mashery/Api/MasheryV3.php' );

Class Mashery_Services_BaseService
{
    public function __construct() {
        $this->masheryV3Api = new Mashery_Api_MasheryV3();
        $this->masheryV2Api = new Mashery_Api_MasheryV2();
    }


    protected function _create($object, $data)
    {
        $response = null;
        if ($object == 'packages') {
            $response = $this->masheryV3Api->fetch($object, $fields);
        } else {
            $response = $this->masheryV2Api->create($object, $data);
        }
        
        return $response;
        

    }

    protected function _delete($object, $id)
    {
        $result = null;
        if ($object == 'packages') {
            $result = $this->masheryV3Api->fetch($object, $fields);
        } else {
            $result = $this->masheryV2Api->delete($object, $id);
        }

        return $result;

    }


    protected function _fetchAll($object, $fields, $where)
    {
        $response = null;
        if ($object == 'packages') {
            $response = $this->masheryV3Api->fetch($object, $fields);
        } else {
            $response = $this->masheryV2Api->fetch('object.query', $object, $fields, $where, null);
        }
        return $response;
    }

    protected function _report($resource, $service_key, $service_dev_key, $start_date, $end_date)
    {
        $results = $this->masheryV2Api->report($resource, $service_key, $service_dev_key, $start_date, $end_date);
        return $results;
    }


    protected function matchedRoles($objectRoles, $userRoles)
    {
        foreach ($userRoles as $key=>$role) {
            foreach ($objectRoles as $objectRole) {
                if (array_search($role->name, (array) ($objectRole)) || $objectRole->name == 'Everyone') {
                    return true;
                }
            }
        }

        return false;
    }
}