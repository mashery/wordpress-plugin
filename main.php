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


class Mashery {

    function __construct() {
        register_activation_hook(__FILE__, array(__CLASS__, 'activation'));
        register_deactivation_hook(__FILE__, array(__CLASS__, 'deactivation'));
        add_shortcode( 'mashtest', array(__CLASS__, 'mashtest_func') );
    }

    function activation() {
        add_role( 'developer', 'Developer', array( 'level_1' => true ) );
        $role = get_role( 'developer' );
        $role->add_cap( 'manage_developer_data' );
    }

    function deactivation() {
        $role = get_role( 'developer' );
        $role->remove_cap( 'manage_developer_data' );
        remove_role( 'developer' );
    }


    function mashtest_func( $atts ){
        return "mashery shortcode executed!";
    }


}

$mashery = new Mashery;

?>
