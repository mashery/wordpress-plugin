<?php
/**
 * Plugin Name: Mashery Control Center
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: Mashery's Wordpress-powered Control Center
 * Version: 0.0.1
 * Author: Luis G. Gómez
 * Author URI: http://luis.io
 * License: Copyright 2015 Luis G. Gómez - All rights reserved.
 */

/**
 * https://codex.wordpress.org/Creating_Admin_Themes
 * https://codex.wordpress.org/Must_Use_Plugins
 */

function my_admin_theme_style() {
    wp_enqueue_style('my-admin-theme', plugins_url('wp-admin.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');
add_action('login_enqueue_scripts', 'my_admin_theme_style');


// function my_crazy_admin_footer() {
//    echo '<p>This theme was made by <a href="http://example.com">Ms. WordPress</a>.</p>';
// }

// add_action('admin_footer', 'my_crazy_admin_footer');

add_filter('admin_footer_text', 'left_admin_footer_text_output'); //left side
function left_admin_footer_text_output($text) {
    $text = 'How much wood would a woodchuck chuck?';
    return $text;
}

add_filter('update_footer', 'right_admin_footer_text_output', 11); //right side
function right_admin_footer_text_output($text) {
    $text = 'That\'s purely hypothetical.';
    return $text;
}
?>
