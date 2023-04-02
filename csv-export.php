<?php
/**
 * @wordpress-plugin
 * Plugin Name:       CSV Export Plugin
 * Description:       Umožňuje export emailových zpráv z formuláře do CSV
 * Version:           1.0
 * Author:            TomKadlec.cz
 * Author URI:        https://tomkadlec.cz
 * Text Domain:       csv-export
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';

function csv_export_init(){
	if ( current_user_can( 'activate_plugins' ) && ! class_exists ( 'email_log' ) ) {
		add_action('admin_init', 'csv_export_deactivate');
		echo '<div class="error"><p>Plugin vyžaduje plugin <strong>Email Log</strong></p></div>';
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	}
}


/**
 * Deactivate the plugin
 *
 * @return void
 */
function csv_export_deactivate () {
	deactivate_plugins( plugin_basename( __FILE__ ) );
}

