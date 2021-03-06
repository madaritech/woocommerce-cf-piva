<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.madaritech.com
 * @since      1.0.0
 *
 * @package    Mdt_Wc_Easy_Cf_Piva
 * @subpackage Mdt_Wc_Easy_Cf_Piva/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Mdt_Wc_Easy_Cf_Piva
 * @subpackage Mdt_Wc_Easy_Cf_Piva/includes
 * @author     Madaritech <freelance@madaritech.com>
 */
class Mdt_Wc_Easy_Cf_Piva {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Mdt_Wc_Easy_Cf_Piva_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_VERSION' ) ) {
			$this->version = PLUGIN_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'mdt-wc-easy-cf-piva';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Mdt_Wc_Easy_Cf_Piva_Loader. Orchestrates the hooks of the plugin.
	 * - Mdt_Wc_Easy_Cf_Piva_i18n. Defines internationalization functionality.
	 * - Mdt_Wc_Easy_Cf_Piva_Admin. Defines all hooks for the admin area.
	 * - Mdt_Wc_Easy_Cf_Piva_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mdt-wc-easy-cf-piva-log-service.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mdt-wc-easy-cf-piva-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mdt-wc-easy-cf-piva-i18n.php';

		/**
		 * The class responsible for defining functionality of the Partita Iva.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mdt-wc-easy-cf-piva-partita-iva.php';

		/**
		 * The class responsible for defining functionality of the Codice Fiscale.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mdt-wc-easy-cf-piva-codice-fiscale.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mdt-wc-easy-cf-piva-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mdt-wc-easy-cf-piva-public.php';

		$this->loader = new Mdt_Wc_Easy_Cf_Piva_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Mdt_Wc_Easy_Cf_Piva_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new Mdt_Wc_Easy_Cf_Piva_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Mdt_Wc_Easy_Cf_Piva_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_notices', $plugin_admin, 'language_admin_notice' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'mdt_wc_easy_cf_piva_admin_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'mdt_wc_easy_cf_piva_settings_init' );

		$this->loader->add_filter( 'woocommerce_admin_billing_fields', $plugin_admin, 'mdt_wc_easy_cf_piva_admin_billing_fields' );
		$this->loader->add_filter( 'woocommerce_customer_meta_fields', $plugin_admin, 'mdt_wc_easy_cf_piva_customer_meta_fields' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new Mdt_Wc_Easy_Cf_Piva_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'woocommerce_after_order_notes', $plugin_public, 'mdt_wc_easy_cf_piva_js_show_hide_fields' );
		$this->loader->add_action( 'woocommerce_before_edit_account_address_form', $plugin_public, 'mdt_wc_easy_cf_piva_js_show_hide_fields' );
		$this->loader->add_action( 'woocommerce_checkout_process', $plugin_public, 'mdt_wc_easy_cf_piva_fields_validation' );
		$this->loader->add_action( 'woocommerce_after_save_address_validation', $plugin_public, 'mdt_wc_easy_cf_piva_fields_validation' );
		$this->loader->add_action( 'woocommerce_checkout_update_order_meta', $plugin_public, 'mdt_wc_easy_cf_piva_checkout_field_update_order_meta' );
		$this->loader->add_action( 'woocommerce_checkout_update_user_meta', $plugin_public, 'mdt_wc_easy_cf_piva_checkout_field_update_user_meta' );

		$this->loader->add_filter( 'woocommerce_billing_fields', $plugin_public, 'mdt_wc_easy_cf_piva_billing_fields' );
		$this->loader->add_filter( 'woocommerce_order_formatted_billing_address', $plugin_public, 'mdt_wc_easy_cf_piva_formatted_billing_address', 10, 2 );
		$this->loader->add_filter( 'woocommerce_my_account_my_address_formatted_address', $plugin_public, 'mdt_wc_easy_cf_piva_my_account_my_address_formatted_address', 10, 3 );
		$this->loader->add_filter( 'woocommerce_address_to_edit', $plugin_public, 'mdt_wc_easy_cf_piva_address_to_edit' );
		$this->loader->add_filter( 'woocommerce_formatted_address_replacements', $plugin_public, 'mdt_wc_easy_cf_piva_formatted_address_replacements', 10, 2 );
		$this->loader->add_filter( 'woocommerce_localisation_address_formats', $plugin_public, 'mdt_wc_easy_cf_piva_localization_address_format' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Mdt_Wc_Easy_Cf_Piva_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
