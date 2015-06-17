<?php

require_once dirname(__FILE__) . "/BaseService.php";

Class Mashery_Services_Members extends Mashery_Services_BaseService
{

    public function fetch($user_login)
    {
        if ($user_login) {
            return $this->_fetchOne($user_login, 'members', '*');
        } else {
            return $this->_fetchAll('', 'members', '*');
        }
    }

    public function create($user_login, $user_email)
    {
        $user = null;
        if (!$this->userAlreadyInWpDatabase($user_login))
        {
            $data = array (
                'username' => $user_login,
                'email' => $user_email,
                'display_name' => 'test'
            );
            $user = $this->_create('member', $data);
        }

        return $user;
    }

    public function delete($username)
    {
        return $this->_delete('member', $username);
    }

    private function userAlreadyInWpDatabase($user_login)
    {
        if (username_exists($user_login))
        {
            return true;
        }

    }
}
