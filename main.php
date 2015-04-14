<?php
/**
 * Plugin Name: Mashery Developer Portal Integration
 * Plugin URI: https://github.com/lgomez/mashery-developer-portal
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
    private $options;

    public function __construct() {

        add_shortcode( 'mashery:applications', array(__CLASS__, 'applications') );
        add_shortcode( 'mashery:keys', array(__CLASS__, 'keys') );
        add_shortcode( 'mashery:profile', array(__CLASS__, 'profile') );
        add_shortcode( 'mashery:iodocs', array(__CLASS__, 'iodocs') );

        register_activation_hook(__FILE__, array(__CLASS__, 'activation'));
        register_deactivation_hook(__FILE__, array(__CLASS__, 'deactivation'));

        if ( is_admin() ) {
            add_filter('plugin_action_links', array( $this, 'settings_link' ));
            add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
            add_action( 'admin_init', array( $this, 'page_init' ) );
        }

    }

    function activation() {
        add_role( 'developer', 'Developer', array( 'level_1' => true ) );
        $role = get_role( 'developer' );
        $role->add_cap( 'manage_developer_data' );
        // update_option($this->option_name, $this->data);
    }

    function deactivation() {
        $role = get_role( 'developer' );
        $role->remove_cap( 'manage_developer_data' );
        remove_role( 'developer' );
    }

    public function applications(){
        $templatefile = dirname(__FILE__) . "/templates/applications.php";
        $data = array(
            array("name" => "Awesome App", "key" => "765rfgi8765rdfg8765rtdfgh76rdtcf"),
            array("name" => "Another App", "key" => "hrydht84g6bdr4t85rd41tg6rs4g56r"),
            array("name" => "Best App", "key" => "87946t4hdr8y6h4td5y4dt8y4dyt6yh84d")
        );
        if(file_exists($templatefile)){
            ob_start();
            include($templatefile);
            return ob_get_clean();
        } else {
            return "template not implemented please add one to plugin/templates/";
        }
    }

    public function keys(){
        $templatefile = dirname(__FILE__) . "/templates/keys.php";
        $data = array(
            array("name" => "Personal Key", "key" => "765rfgi8765rdfg8765rtdfgh76rdtcf"),
            array("name" => "Work Key", "key" => "hrydht84g6bdr4t85rd41tg6rs4g56r"),
            array("name" => "Test Key", "key" => "87946t4hdr8y6h4td5y4dt8y4dyt6yh84d")
        );
        if(file_exists($templatefile)){
            ob_start();
            include($templatefile);
            return ob_get_clean();
        } else {
            return "template not implemented please add one to plugin/templates/";
        }
    }

    public function profile(){
        $templatefile = dirname(__FILE__) . "/templates/profile.php";
        $user = array(
            "first_name" => "John",
            "last_name" => "Smith",
            "email" => "user@mashery.com",
            "twitter" => "@mashery",
            "phone" => "(555) 123-4567"
        );
        if(file_exists($templatefile)){
            ob_start();
            include($templatefile);
            return ob_get_clean();
        } else {
            return "template not implemented please add one to plugin/templates/";
        }
    }

    public function iodocs(){
        $templatefile = dirname(__FILE__) . "/templates/iodocs.php";
        $api = array("key" => "765rfgi8765rdfg8765rtdfgh76rdtcf");
        if(file_exists($templatefile)){
            ob_start();
            include($templatefile);
            return ob_get_clean();
        } else {
            return "template not implemented please add one to plugin/templates/";
        }
    }

    function settings_link($links) {
        $mylinks = array('<a href="' . admin_url( 'options-general.php?page=mashery' ) . '">Settings</a>');
        return array_merge( $links, $mylinks );
    }

    public function add_plugin_page() {
        add_options_page('Mashery', 'Mashery', 'manage_options', 'mashery', array( $this, 'create_admin_page' ) );
    }

    public function create_admin_page() {
        $this->options = get_option( 'my_option_name' );
        ?>
        <div class="wrap">
            <h2>Mashery</h2>
            <form method="post" action="options.php">
            <?php
                settings_fields( 'my_option_group' );
                do_settings_sections( 'mashery' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    public function page_init() {
        register_setting( 'my_option_group', 'my_option_name', array( $this, 'sanitize' ) );
        add_settings_section( 'mashery-settings-form', 'Developer Portal Integration Settings', array( $this, 'print_section_info' ), 'mashery' );
        add_settings_field( 'mashery_customer_id', 'Customer ID', array( $this, 'mashery_customer_id_callback' ), 'mashery', 'mashery-settings-form' );
        add_settings_field( 'mashery_access_key', 'Access Key', array( $this, 'mashery_access_key_callback' ), 'mashery', 'mashery-settings-form' );
        add_settings_field( 'mashery_enable_iodocs', 'Enable I/O Docs', array( $this, 'mashery_enable_iodocs_callback' ), 'mashery', 'mashery-settings-form' );
        add_settings_field( 'mashery_enable_documentation', 'Enable Documentation', array( $this, 'mashery_enable_documentation_callback' ), 'mashery', 'mashery-settings-form' );
    }

    public function sanitize( $input ) {
        $new_input = array();
        if( isset( $input['mashery_customer_id'] ) ) {
            $new_input['mashery_customer_id'] = absint( $input['mashery_customer_id'] );
        }
        if( isset( $input['mashery_access_key'] ) ) {
            $new_input['mashery_access_key'] = sanitize_text_field( $input['mashery_access_key'] );
        }
        if( isset( $input['mashery_enable_iodocs'] ) ) {
            $new_input['mashery_enable_iodocs'] = absint( $input['mashery_enable_iodocs'] );
        }
        if( isset( $input['mashery_enable_documentation'] ) ) {
            $new_input['mashery_enable_documentation'] = absint( $input['mashery_enable_documentation'] );
        }
        return $new_input;
    }

    public function print_section_info() {
        print 'Enter your Mashery-provided authentication information here:';
    }

    public function mashery_customer_id_callback() {
        printf(
            '<input type="text" id="mashery_customer_id" name="my_option_name[mashery_customer_id]" value="%s" />',
            isset( $this->options['mashery_customer_id'] ) ? esc_attr( $this->options['mashery_customer_id']) : ''
        );
    }

    public function mashery_access_key_callback() {
        printf(
            '<input type="text" id="mashery_access_key" name="my_option_name[mashery_access_key]" value="%s" />',
            isset( $this->options['mashery_access_key'] ) ? esc_attr( $this->options['mashery_access_key']) : ''
        );
    }

    public function mashery_enable_iodocs_callback() {
        echo '<input type="checkbox" id="mashery_enable_iodocs" name="my_option_name[mashery_enable_iodocs]" value="1"' . checked( 1, $this->options['mashery_enable_iodocs'], false ) . ' />';
    }

    public function mashery_enable_documentation_callback() {
        echo '<input type="checkbox" id="mashery_enable_documentation" name="my_option_name[mashery_enable_documentation]" value="1"' . checked( 1, $this->options['mashery_enable_documentation'], false ) . ' />';
    }

}

new Mashery();
