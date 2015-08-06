<?php

if ( ! defined( 'ABSPATH' ) ) exit;

require dirname(__FILE__) . '/../Mashery/API.php';
use \Mashery\API;

class Mashery {

    /**
     * The single instance of Mashery.
     * @var 	object
     * @access  private
     * @since 	1.0.0
     */
    private static $_instance = null;

    /**
     * Settings class object
     * @var     object
     * @access  public
     * @since   1.0.0
     */
    public $settings = null;

    /**
     * The version number.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $_version;

    /**
     * The token.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $_token;

    /**
     * The main plugin file.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $file;

    /**
     * The main plugin directory.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $dir;

    /**
     * The plugin assets directory.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $assets_dir;

    /**
     * The plugin assets URL.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $assets_url;

    /**
     * Suffix for Javascripts.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $script_suffix;

    /**
     * Constructor function.
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function __construct ( $file = '', $version = '1.0.0' ) {
        $this->_version = $version;
        $this->_token = 'mashery';

        // Load plugin environment variables
        $this->file = $file;
        $this->dir = dirname( $this->file );
        $this->assets_dir = trailingslashit( $this->dir ) . 'assets';
        $this->assets_url = esc_url( trailingslashit( plugins_url( '/assets/', $this->file ) ) );

        $this->script_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        register_activation_hook( $this->file, array( $this, 'install' ) );

        // Load frontend JS & CSS
        // add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 10 );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 10 );

        // Load admin JS & CSS
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 10, 1 );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_styles' ), 10, 1 );

        // Load API for generic admin functions
        if ( is_admin() ) {
            $this->admin = new Mashery_Admin_API();
        }

        // Handle localisation
        $this->load_plugin_textdomain();
        add_action( 'init', array( $this, 'load_localisation' ), 0 );

        $this->shortcodes = array('account', 'keys', 'key', 'new_key');

        foreach ($this->shortcodes as $shortcode) {
            add_shortcode( $this->_token . ':' . $shortcode, array($this, $shortcode . '_shortcode') );
        }

        if(!function_exists('wp_get_current_user')) {
            include(ABSPATH . "wp-includes/pluggable.php");
        }
        $current_user = wp_get_current_user();

        $this->mashery = new API(
            get_option($this->_token . '_apihost'),     // "https://api.mashery.com"
            get_option($this->_token . '_areaid'),      // "425";
            get_option($this->_token . '_areauuid'),    // "acbb134e-c2f4-4203-b15b-9343e9ad031c";
            get_option($this->_token . '_apikey'),      // "sbub7dmvheh4gw8dusx8a38d";
            get_option($this->_token . '_apisecret'),   // "MBxqKP8wfs";
            get_option($this->_token . '_username'),    // "demo3_jpollock";
            get_option($this->_token . '_password'),    // "mashery2015";
            get_option($this->_token . '_test_user')   // "jpollock";
            // $current_user->user_login
        );

        register_activation_hook( $this->file, array( $this, 'generate_pages' ) );
        register_deactivation_hook( $this->file, array( $this, 'trash_pages' ) );

        add_filter( 'query_vars', array( $this, 'register_variables' ), 10, 1 );

        add_action('template_redirect', array( $this, 'router' ), 10, 1 );

    } // End __construct ()

    /**
     */
    public function register_variables($vars) {
        $vars[] = 'key';
        $vars[] = 'mashery_action';
        return $vars;
    }

    /**
     */
    public function register_user($user_login, $user_email, $errors) {
        // $members = new Members();
        // $new_password = wp_generate_password( 10, true, true );
        // $member = $members->create($user_login, $user_email, $new_password);
        // if(is_wp_error($member)) {
        //     $errors->add( 'mashery_member_registration_error', $member->get_error_message() );
        // }
    }

    /**
     */
    public function delete_user($user_id) {
        // $members = new Members();
        // $user_obj = get_userdata( $user_id );
        // $username = $user_obj->user_login;
        // $members->delete($username);
    }

    /**
     */
    public function trash_pages (){
        $this->trash_page("account");
        $this->trash_page("keys");
    }

    /**
     */
    public function generate_pages (){
        $account   = $this->generate_page("Account", "account", "[" . $this->_token . ":account]", $developer);
        $keys      = $this->generate_page("Keys", "keys", "[" . $this->_token . ":keys]", $developer);

    }

    /**
     */
    public function generate_page ($title, $name, $content="", $parent=0){
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
            add_option($this->_token . '_' . $name . "_page_id", $id );
        } else {
            $id = $page->ID;
            $page->post_status = 'publish';
            $id = wp_update_post( $page );
        }
        return $id;
    }

    /**
     */
    public function trash_page ($name){
        // https://wordpress.org/support/topic/how-do-i-create-a-new-page-with-the-plugin-im-building
        $id = get_option( $this->_token . '_' . $name . "_page_id" );
        if( $id ) {
            wp_delete_post( $id );
        }
        // delete_option("mashery_" . $name . "_page_title");
        // delete_option("mashery_" . $name . "_page_name");
        delete_option($this->_token . '_' . $name . "_page_id");
    }

    /**
     */
    public function router ($name){

        $page = NULL;

        switch (get_query_var('mashery_action')) {
            case 'delete':
                $this->mashery->key_delete(get_query_var('key'));
                break;
        }

    }

    /**
     */
    public function render_shortcode ( $template, $data = array() ) {
        $templatefile = $this->dir . "/Mashery/templates/" . $template . ".php";
        $data = $data;
        $output = '';
        if(file_exists($templatefile)){
            ob_start();
            include($templatefile);
            $output = ob_get_clean();
        } else {
            $output = "template not implemented please add one to plugin/templates/";
        }
        return $output;
    }

    /**
     */
    public function account_shortcode () {

        $user = $this->mashery->user();
        $output = $this->render_shortcode('account', $user);
        return $output;

    }

    /**
     */
    public function keys_shortcode () {

        update_option( $this->_token . '_keys_page', get_the_ID(), true );
        $data = $this->mashery->keys();
        $output = $this->render_shortcode('keys/list', $data);
        return $output;

    }

    /**
     */
    public function key_shortcode () {

        update_option( $this->_token . '_key_page', get_the_ID(), true );
        $key = get_query_var('key');
        $data = $this->mashery->key($key);
        $output = $this->render_shortcode('keys/details', $data);
        return $output;

    }

    /**
     */
    public function new_key_shortcode () {

        update_option( $this->_token . '_new_key_page', get_the_ID(), true );
        $output = $this->render_shortcode('keys/form');
        return $output;

    }

    /**
     * Wrapper function to register a new post type
     * @param  string $post_type   Post type name
     * @param  string $plural      Post type item plural name
     * @param  string $single      Post type item single name
     * @param  string $description Description of post type
     * @return object              Post type class object
     */
    public function register_post_type ( $post_type = '', $plural = '', $single = '', $description = '' ) {

        if ( ! $post_type || ! $plural || ! $single ) return;

        $post_type = new Mashery_Post_Type( $post_type, $plural, $single, $description );

        return $post_type;
    }

    /**
     * Wrapper function to register a new taxonomy
     * @param  string $taxonomy   Taxonomy name
     * @param  string $plural     Taxonomy single name
     * @param  string $single     Taxonomy plural name
     * @param  array  $post_types Post types to which this taxonomy applies
     * @return object             Taxonomy class object
     */
    public function register_taxonomy ( $taxonomy = '', $plural = '', $single = '', $post_types = array() ) {

        if ( ! $taxonomy || ! $plural || ! $single ) return;

        $taxonomy = new Mashery_Taxonomy( $taxonomy, $plural, $single, $post_types );

        return $taxonomy;
    }

    /**
     * Load frontend CSS.
     * @access  public
     * @since   1.0.0
     * @return void
     */
    public function enqueue_styles () {
        wp_register_style( $this->_token . '-uikit', esc_url( $this->assets_url ) . 'css/uikit.min.css', array(), $this->_version );
        wp_enqueue_style( $this->_token . '-uikit' );

        wp_register_style( $this->_token . '-frontend', esc_url( $this->assets_url ) . 'css/frontend.css', array(), $this->_version );
        wp_enqueue_style( $this->_token . '-frontend' );
    } // End enqueue_styles ()

    /**
     * Load frontend Javascript.
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function enqueue_scripts () {
        // wp_register_script( $this->_token . '-uikit', esc_url( $this->assets_url ) . 'js/uikit.min.js', array( 'jquery' ), $this->_version );
        // wp_enqueue_script( $this->_token . '-uikit' );

        wp_register_script( $this->_token . '-frontend', esc_url( $this->assets_url ) . 'js/frontend.js', array( 'jquery' ), $this->_version );
        wp_enqueue_script( $this->_token . '-frontend' );
    } // End enqueue_scripts ()

    /**
     * Load admin CSS.
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function admin_enqueue_styles ( $hook = '' ) {
        wp_register_style( $this->_token . '-admin', esc_url( $this->assets_url ) . 'css/admin.css', array(), $this->_version );
        wp_enqueue_style( $this->_token . '-admin' );
    } // End admin_enqueue_styles ()

    /**
     * Load admin Javascript.
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function admin_enqueue_scripts ( $hook = '' ) {
        wp_register_script( $this->_token . '-admin', esc_url( $this->assets_url ) . 'js/admin' . $this->script_suffix . '.js', array( 'jquery' ), $this->_version );
        wp_enqueue_script( $this->_token . '-admin' );
    } // End admin_enqueue_scripts ()

    /**
     * Load plugin localisation
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function load_localisation () {
        load_plugin_textdomain( 'mashery', false, dirname( plugin_basename( $this->file ) ) . '/lang/' );
    } // End load_localisation ()

    /**
     * Load plugin textdomain
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function load_plugin_textdomain () {
        $domain = 'mashery';

        $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

        load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
        load_plugin_textdomain( $domain, false, dirname( plugin_basename( $this->file ) ) . '/lang/' );
    } // End load_plugin_textdomain ()

    /**
     * Main Mashery Instance
     *
     * Ensures only one instance of Mashery is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @see Mashery()
     * @return Main Mashery instance
     */
    public static function instance ( $file = '', $version = '1.0.0' ) {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self( $file, $version );
        }
        return self::$_instance;
    } // End instance ()

    /**
     * Cloning is forbidden.
     *
     * @since 1.0.0
     */
    public function __clone () {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
    } // End __clone ()

    /**
     * Unserializing instances of this class is forbidden.
     *
     * @since 1.0.0
     */
    public function __wakeup () {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
    } // End __wakeup ()

    /**
     * Installation. Runs on activation.
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function install () {
        $this->_log_version_number();
    } // End install ()

    /**
     * Log the plugin version number.
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    private function _log_version_number () {
        update_option( $this->_token . '_version', $this->_version );
    } // End _log_version_number ()

}
