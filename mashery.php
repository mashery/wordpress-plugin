<?php
/*
 * Plugin Name: Mashery Portal Integration
 * Version: 1.0
 * Plugin URI: http://www.mashery.com/
 * Description: Mashery's Wordpress Portal Integration Plugin
 * Author: Mashery, Inc.
 * Author URI: http://www.mashery.com/
 * Requires at least: 4.0
 * Tested up to: 4.0
 *
 * Text Domain: mashery
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Mashery, Inc.
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Load plugin class files
require_once( 'includes/class-mashery.php' );
require_once( 'includes/class-mashery-settings.php' );

// Load plugin libraries
require_once( 'includes/lib/class-mashery-admin-api.php' );
require_once( 'includes/lib/class-mashery-post-type.php' );
require_once( 'includes/lib/class-mashery-taxonomy.php' );

/**
 * Returns the main instance of Mashery to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Mashery
 */
function Mashery () {
    $instance = Mashery::instance( __FILE__, '1.0.0' );

    if ( is_null( $instance->settings ) ) {
        $instance->settings = Mashery_Settings::instance( $instance );
    }

    return $instance;
}

Mashery();
