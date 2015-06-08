<?php
if ( ! defined( 'WPINC' ) ) {
    die;
}


class Mashery {
    private $options;

    public function __construct() {

        register_activation_hook(__FILE__, array(__CLASS__, 'activation'));
        register_deactivation_hook(__FILE__, array(__CLASS__, 'deactivation'));

        add_action( 'register_post', array( $this, 'register_user' ));
        add_action( 'delete_user', array( $this, 'delete_user' ));

    }

    function activation() {
        // update_option($this->option_name, $this->data);
    }

    function deactivation() {
    }

    public function generate_page($title, $name, $content, $parent=0){
    }

    public function trash_page($name){
    }

    public function register_user($user_login, $user_email, $errors) {
        $members = new Members();
        $new_password = wp_generate_password( 10, true, true );
        $member = $members->create($user_login, $user_email, $new_password);
        if(is_wp_error($member)) {
            $errors->add( 'mashery_member_registration_error', $member->get_error_message() );
        }
    }

    public function delete_user($user_id) {
        $members = new Members();
        $user_obj = get_userdata( $user_id );
        $username = $user_obj->user_login;
        $members->delete($username);
    }

}
new Mashery($fixtures);
