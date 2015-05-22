<?php

require_once( constant('MASHERYPORTAL_ROOT') . '/lib/Mashery/Services/Keys.php' );

Class BaseService 
{
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