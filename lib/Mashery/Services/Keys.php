<?php

require_once( 'BaseService.php' );

Class Mashery_Services_Keys extends Mashery_Services_BaseService 
{

    public function fetch($username, $key_id)
    {
        $where = null;
        $require_related = null;
        if ($key_id)
        {
            $where = 'WHERE id = ' . $key_id;
        } else if ($username)
        {
            $require_related = 'REQUIRE RELATED member WITH username =\'' . $username . '\'';
            
        }
        
        return $this->_fetchAll('', 'package_keys', '*', $where, $require_related);
    }    

}


