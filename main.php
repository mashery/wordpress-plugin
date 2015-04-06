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

    protected $option_name = 'mashery_integration_key';

    protected $data = array(
        'key' => null
    );

    function __construct() {
        register_activation_hook(__FILE__, array(__CLASS__, 'activation'));
        register_deactivation_hook(__FILE__, array(__CLASS__, 'deactivation'));
        add_shortcode( 'mashery:applications', array(__CLASS__, 'applications') );
        add_shortcode( 'mashery:keys', array(__CLASS__, 'keys') );
        add_shortcode( 'mashery:profile', array(__CLASS__, 'profile') );

        add_options_page('Mashery', 'Mashery', 'manage_options', 'mashery', array($this, 'options_page'));
        register_setting('mashery_integration_key', $this->option_name, array($this, 'validate_mashery_integration_key'));

    }

    function activation() {
        add_role( 'developer', 'Developer', array( 'level_1' => true ) );
        $role = get_role( 'developer' );
        $role->add_cap( 'manage_developer_data' );
        update_option($this->option_name, $this->data);
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

    public function validate_mashery_integration_key($input) {
        $valid = array();
        $valid['key'] = sanitize_text_field($input['key']);
        if (strlen($valid['key']) == 0) {
            add_settings_error(
                    'key',
                    'key_texterror',
                    'Please enter a valid KEY',
                    'error'
            );
            $valid['key'] = $this->data['key'];
        }
        return $valid;
    }

    public function options_page() {
        $options = get_option($this->option_name);
        ?>
        <div class="wrap">
            <h2>Mashery Options</h2>
            <form method="post" action="options.php">
                <?php settings_fields('mashery_options'); ?>
                <table class="form-table">
                    <tr valign="top"><th scope="row">App URL:</th>
                        <td><input type="text" name="<?php echo $this->option_name?>[key]" value="<?php echo $options['key']; ?>" /></td>
                    </tr>
                </table>
                <p class="submit">
                    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
                </p>
            </form>
        </div>
        <?php
    }

}

$mashery = new Mashery;

?>
