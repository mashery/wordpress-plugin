<?php
namespace Mashery\Plugins\Wordpress\Shortcodes;

class Applications {

    public function __construct() {

        add_shortcode( 'mashery:applications', array(__CLASS__, 'applications') );

    }

    public function shortcode($shortcode, $data){
        $templatefile = dirname(__FILE__) . "/templates/" . $shortcode . ".php";
        $data = $data;
        if(file_exists($templatefile)){
            ob_start();
            include($templatefile);
            return ob_get_clean();
        } else {
            return "template not implemented please add one to plugin/templates/";
        }
    }

    public function applications(){
        return self::shortcode(__FUNCTION__, Mashery\API\Client::applications() );
    }

}

?>
