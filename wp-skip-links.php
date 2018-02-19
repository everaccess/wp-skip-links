<?php
/*
 * Plugin Name:  WP Skip Links
 * Plugin URI:   https://developer.wordpress.org/plugins/everaccess-skiplinks/
 * Description:  Add Skip-links to improve accessibility on your WordPress site.
 * Version:      0.1
 * Author:       EverAccess
 * Author URI:   https://www.everaccess.io/
 * License:      GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  everaccess
 * Domain Path:  /languages
*/
define( 'WPSL_ID',      'wpsl' );
define( 'WPSL_NAME',    __('WP Skip Links', WPSL_ID) );
define( 'WPSL_DIR',     plugin_dir_path( __FILE__ ) );

require_once( WPSL_DIR . 'lib/core.php');
require_once( WPSL_DIR . 'lib/panel.php' );
require_once( WPSL_DIR . 'inc/assets.php' );