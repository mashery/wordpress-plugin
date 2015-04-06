<?php
/**
 * Plugin Name: Mashery Developer Portal Integration
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Mashery's Wordpress-powered Developer Portal Integration
 * Version: 1.0.0
 * Author: Mashery, Inc.
 * Author URI: http://mashery.com
 * License: Copyright 2015 Mashery, Inc. - All rights reserved.
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

class Mashery {

    function __construct() {

        register_activation_hook(__FILE__, array(__CLASS__, 'activation'));
        register_deactivation_hook(__FILE__, array(__CLASS__, 'deactivation'));

        add_shortcode( 'mashery:applications', array(__CLASS__, 'applications') );
        add_shortcode( 'mashery:keys', array(__CLASS__, 'keys') );
        add_shortcode( 'mashery:profile', array(__CLASS__, 'profile') );

        add_options_page( 'Mashery', 'Mashery', 'manage_options', 'mashery', 'mashery_options_page' );

        self::$settings = get_option( 'mashery_settings' );

        if ( self::$settings == false ) {
            add_option( 'mashery_settings', array('key' => null, 'email' => '' ) );
            self::$settings = get_option( 'mashery_settings' );
        }

    }

    function activation() {
        add_role( 'developer', 'Developer', array( 'level_1' => true ) );
        $role = get_role( 'developer' );
        $role->add_cap( 'manage_developer_data' );
        /* update_option($this->option_name, $this->data); */
    }

    function mashery_options_page() {
        ?>
        <form action='options.php' method='post'>
            <h2>MailChimp Webhooks</h2>
            <?php
            // settings_fields( 'mcwh' );
            // do_settings_sections( 'mcwh' );
            // submit_button();
            ?>
        </form>
        <?php
    }

    function deactivation() {
        $role = get_role( 'developer' );
        $role->remove_cap( 'manage_developer_data' );
        remove_role( 'developer' );
    }

    function applications(){
        return "[Render applications list here]";
    }

    function keys(){
        return "[Render key list here]";
    }

    function profile(){
        return "[Render user profile here]";
    }

}

$mashery = new Mashery;

?>
