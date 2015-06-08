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
        $top = self::generate_page("Account", "account", "[mashery:account]");
        $apis_page_id = self::generate_page("APIs", "apis", "[mashery:apis]", $top);
        self::generate_page("Request Access", "apis_request", "[mashery:apis_request]", $apis_page_id);
        $applications_page_id = self::generate_page("Applications", "applications", "[mashery:applications_new]", $top);
        self::generate_page("New Application", "applications", "[mashery:applications]", $applications_page_id);
        self::generate_page("Keys", "keys", "[mashery:keys]", $top);
    }

    function deactivation() {
        self::trash_page("account");
        self::trash_page("apis");
        self::trash_page("apis_request");
        self::trash_page("applications");
        self::trash_page("applications_new");
        self::trash_page("keys");
    }

    public function generate_page($title, $name, $content, $parent=0){
        // https://wordpress.org/support/topic/how-do-i-create-a-new-page-with-the-plugin-im-building
        // delete_option("mashery_" . $name . "_page_title");
        // delete_option("mashery_" . $name . "_page_name");
        // delete_option("mashery_" . $name . "_page_id");
        // add_option("mashery_" . $name . "_page_title", $title, '', 'yes');
        // add_option("mashery_" . $name . "_page_name", $name, '', 'yes');
        // add_option("mashery_" . $name . "_page_id", '0', '', 'yes');
        $page = get_page_by_title( $title );
        if (!$page) {
            $page = array(
                'post_title'     => $title,
                'post_content'   => $content,
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
                'post_parent'    => $parent
            );
            $id = wp_insert_post( $page );
            add_option("mashery_" . $name . "_page_id", $id );
        } else {
            $id = $page->ID;
            $page->post_status = 'publish';
            $id = wp_update_post( $page );
        }
        return $id;
    }

    public function trash_page($name){
        // https://wordpress.org/support/topic/how-do-i-create-a-new-page-with-the-plugin-im-building
        $id = get_option( "mashery_" . $name . "_page_id" );
        if( $id ) {
            wp_delete_post( $id );
        }
        // delete_option("mashery_" . $name . "_page_title");
        // delete_option("mashery_" . $name . "_page_name");
        delete_option("mashery_" . $name . "_page_id");
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
