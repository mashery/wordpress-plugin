<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/Mashery/Services/Keys.php' );

Class BaseService 
{

    protected $area_id;

    protected $area_uuid;

    protected $apikey;

    protected $secret;

    protected $username;

    protected $password;


    public function __construct() {
        $this->area_id = get_option('my_option_name')['mashery_customer_id'];
        $this->area_uuid = get_option('my_option_name')['mashery_customer_uuid'];
        $this->apikey = get_option('my_option_name')['mashery_access_key'];
        $this->secret  = get_option('my_option_name')['mashery_access_secret'];        
        $this->username = get_option('my_option_name')['mashery_access_username'];
        $this->password  = get_option('my_option_name')['mashery_access_password'];
    }

    protected function currentUser()
    {
        global $current_user;
        $ul = '';
        if ( isset($current_user) )
        {
          $ul = $current_user->user_login;
          $useremail = $current_user->user_email;

        }
        if ($ul=='') { $ul = '';}
        return $ul;
    }

}