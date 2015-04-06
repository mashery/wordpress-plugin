<?php
/**
 * Plugin Name: Mashery Developer Portal Integration
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Mashery's Wordpress-powered Developer Portal Integration
 * Version: 1.0.0
 * Author: Mashery, Inc.
 * Author URI: http://mashery.com
 * License: Copyright 2015 Mashery, Inc. - All rights reserved.
 * GitHub Plugin URI: https://github.com/lgomez/mashery-developer-portal
 * GitHub Branch: master
 */


class Mashery {

    function __construct() {
        // Register hooks
        register_activation_hook(__FILE__, array(__CLASS__, 'activation'));
        register_deactivation_hook(__FILE__, array(__CLASS__, 'deactivation'));

        // Add actions
        add_action('admin_menu', array(__CLASS__, 'admin_menu'));
    } // function __construct

    function activation() {
        self::add_cap();
    } // function activation

    // Add the new capability to all roles having a certain built-in capability
    private function add_cap() {
        $roles = get_editable_roles();
        foreach ($GLOBALS['wp_roles']->role_objects as $key => $role)
            if (isset($roles[$key]) && $role->has_cap('BUILT_IN_CAP'))
                $role->add_cap('THE_NEW_CAP');
    } // private function add_cap
    // Add plugin menu pages to admin menu
    function admin_menu() {
        // Remove the following line if you don't care about new roles
        // that have been created after plugin activation
        self::add_cap();

        // Set up the plugin admin menu
        add_menu_page('Menu', 'Menu', 'THE_NEW_CAP', ...);
        add_submenu_page('Mashery', 'Submenu', 'Submenu', 'THE_NEW_CAP', ...);
    } // function admin_menu
    function deactivation() {
        self::remove_cap();
    } // function deactivation

    // Remove the plugin-specific custom capability
    private function remove_cap() {
        $roles = get_editable_roles();
        foreach ($GLOBALS['wp_roles']->role_objects as $key => $role)
            if (isset($roles[$key]) && $role->has_cap('THE_NEW_CAP'))
                $role->remove_cap('THE_NEW_CAP');
    } // private function remove_cap

} // class Mashery

// Hook for adding admin menus
add_action('admin_menu', 'mashery_add_pages');

function mashery_add_pages() {
   add_menu_page(__('Mashery','menu-test'), __('Mashery','menu-test'), 'manage_options', 'mashery-top-level-handle', 'mashery_toplevel_page' );
}

// mt_toplevel_page() displays the page content for the custom Test Toplevel menu
function mashery_toplevel_page() {
   echo "<h2>" . __( 'Mashery', 'menu-test' ) . "</h2>";
}

// add_menu_page('Page title', 'Top-level menu title', 'manage_options', 'my-top-level-handle', 'my_magic_function');
// add_submenu_page( 'my-top-level-handle', 'Page title', 'Sub-menu title', 'manage_options', 'my-submenu-handle', 'my_magic_function');


// function my_admin_theme_style() {
//     // wp_enqueue_style('my-admin-theme', plugins_url('wp-admin.css', __FILE__));
// }
// // add_action('admin_enqueue_scripts', 'my_admin_theme_style');
// // add_action('login_enqueue_scripts', 'my_admin_theme_style');


// // function my_crazy_admin_footer() {
// //    echo '<p>This theme was made by <a href="http://example.com">Ms. WordPress</a>.</p>';
// // }

// // add_action('admin_footer', 'my_crazy_admin_footer');

// add_filter('admin_footer_text', 'left_admin_footer_text_output'); //left side
// function left_admin_footer_text_output($text) {
//     // $text = 'How much wood would a woodchuck chuck?';
//     // return $text;
// }

// add_filter('update_footer', 'right_admin_footer_text_output', 11); //right side
// function right_admin_footer_text_output($text) {
//     // $text = 'That\'s purely hypothetical.';
//     // return $text;
// }
?>
