<?php
Class BaseService
{

    protected $area_id;

    protected $area_uuid;

    protected $apikey;

    protected $secret;

    protected $username;

    protected $password;


    public function __construct() {
        $this->area_id   = get_option('mashery_areaid');
        $this->area_uuid = get_option('mashery_areauuid');
        $this->apikey    = get_option('mashery_apikey');
        $this->secret    = get_option('mashery_apisecret');
        $this->username  = get_option('mashery_username');
        $this->password  = get_option('mashery_password');
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
