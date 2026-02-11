<?php
/**

 * Plugin Name: Ruffer Core
 * Description: This is a helper plugin of ruffer theme
 * Version:     1.0
 * Author:      Themeholy
 * Author URI:  http://themeholy.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: ruffer
 */



 // Blocking direct access

if( ! defined( 'ABSPATH' ) ) {

    exit();

}



// Define Constant

define( 'RUFFER_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'RUFFER_PLUGIN_INC_PATH', plugin_dir_path( __FILE__ ) . 'inc/' );
define( 'RUFFER_PLUGIN_CMB2EXT_PATH', plugin_dir_path( __FILE__ ) . 'cmb2-ext/' );

define( 'RUFFER_PLUGIN_WIDGET_PATH', plugin_dir_path( __FILE__ ) . 'inc/widgets/' );

define( 'RUFFER_PLUGDIRURI', plugin_dir_url( __FILE__ ) );

define( 'RUFFER_ADDONS', plugin_dir_path( __FILE__ ) .'addons/' );

define( 'RUFFER_CORE_PLUGIN_TEMP', plugin_dir_path( __FILE__ ) .'ruffer-template/' );



// load textdomain

load_plugin_textdomain( 'ruffer', false, basename( dirname( __FILE__ ) ) . '/languages' );



//include file.

require_once RUFFER_PLUGIN_INC_PATH .'ruffercore-functions.php';
require_once RUFFER_PLUGIN_INC_PATH .'builder/builder.php';
require_once RUFFER_PLUGIN_INC_PATH . 'MCAPI.class.php';
require_once RUFFER_PLUGIN_INC_PATH .'rufferajax.php';

require_once RUFFER_PLUGIN_CMB2EXT_PATH . 'cmb2ext-init.php';



//Widget

require_once RUFFER_PLUGIN_WIDGET_PATH . 'recent-post-widget.php';
require_once RUFFER_PLUGIN_WIDGET_PATH . 'working-hours.php';
require_once RUFFER_PLUGIN_WIDGET_PATH . 'about-us-widget.php';
require_once RUFFER_PLUGIN_WIDGET_PATH . 'ruffer-cta.php';



//addons

require_once RUFFER_ADDONS . 'addons.php';
require_once RUFFER_ADDONS . 'addons-style-functions.php';
require_once RUFFER_ADDONS . 'addons-field-functions.php';

function widget_styles() {
    wp_register_style( 'editor-style-1', plugins_url( 'assets/css/editor.css', __FILE__ ) );
    wp_enqueue_style( 'editor-style-1' );

}
