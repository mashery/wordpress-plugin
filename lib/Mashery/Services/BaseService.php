<?php

require_once( __DIR__. '/../Api/V2.php' );
require_once( __DIR__. '/../Api/V3.php' );

Class Mashery_Services_BaseService
{
    public function __construct($area_id, $area_uuid, $apikey, $secret, $username, $password) {
        $this->masheryV3Api = new Mashery_Api_V3($area_uuid, $apikey, $secret, $username, $password);
        $this->masheryV2Api = new Mashery_Api_V2($area_id, $apikey, $secret);
    }

    public function v3Authenticate()
    {
        return $this->masheryV3Api->authenticate();
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

    protected function _fetchAll($token, $object, $fields, $where, $require_related)
    {
        $response = null;
        if ($object == 'packages') {
            $response = $this->masheryV3Api->fetch($token, $object, $fields);
        } else {
            $response = $this->masheryV2Api->fetch('object.query', $object, $fields, $where, $require_related);
        }
        return $response;
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