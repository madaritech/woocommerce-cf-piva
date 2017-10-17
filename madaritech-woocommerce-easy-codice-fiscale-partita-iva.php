<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.madaritech.com
 * @since             1.0.0
 * @package           Mdt_Wc_Easy_Cf_Piva
 *
 * @woocommerce-cf-piva
 * Plugin Name:       WooCommerce Easy Codice Fiscale Partita Iva
 * Plugin URI:        http://www.madaritech.com/mdt-wc-easy-cf-piva
 * Description:       Add the "Partita IVA" e "Codice Fiscale" fields in WooCommerce for the italian market.
 * Version:           1.0.2
 * Author:            Madaritech
 * Author URI:        http://www.madaritech.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mdt-wc-easy-cf-piva
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_VERSION', '1.0.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mdt-wc-easy-cf-piva-activator.php
 */
function activate_mdt_wc_easy_cf_piva() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mdt-wc-easy-cf-piva-activator.php';
	Mdt_Wc_Easy_Cf_Piva_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mdt-wc-easy-cf-piva-deactivator.php
 */
function deactivate_mdt_wc_easy_cf_piva() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mdt-wc-easy-cf-piva-deactivator.php';
	Mdt_Wc_Easy_Cf_Piva_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mdt_wc_easy_cf_piva' );
register_deactivation_hook( __FILE__, 'deactivate_mdt_wc_easy_cf_piva' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mdt-wc-easy-cf-piva.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mdt_wc_easy_cf_piva() {
	$plugin = new Mdt_Wc_Easy_Cf_Piva();
	$plugin->run();
}
run_mdt_wc_easy_cf_piva();
