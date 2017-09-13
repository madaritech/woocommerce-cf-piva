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
 * @package           Wc_Cf_Piva
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce CF PIVA
 * Plugin URI:        http://www.madaritech.com/wc-cf-piva
 * Description:       Add the "Partita IVA" e "Codice Fiscale" fields in WooCommerce for the italian market.
 * Version:           1.0.0
 * Author:            Madaritech
 * Author URI:        http://www.madaritech.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-cf-piva
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

define('PLUGIN_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-cf-piva-activator.php
 */
function activate_wc_cf_piva()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-wc-cf-piva-activator.php';
    Wc_Cf_Piva_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-cf-piva-deactivator.php
 */
function deactivate_wc_cf_piva()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-wc-cf-piva-deactivator.php';
    Wc_Cf_Piva_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wc_cf_piva');
register_deactivation_hook(__FILE__, 'deactivate_wc_cf_piva');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-wc-cf-piva.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_cf_piva()
{
    $plugin = new Wc_Cf_Piva();
    $plugin->run();
}
run_wc_cf_piva();
