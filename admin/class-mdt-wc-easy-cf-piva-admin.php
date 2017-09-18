<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.madaritech.com
 * @since      1.0.0
 *
 * @package    Mdt_Wc_Easy_Cf_Piva
 * @subpackage Mdt_Wc_Easy_Cf_Piva/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mdt_Wc_Easy_Cf_Piva
 * @subpackage Mdt_Wc_Easy_Cf_Piva/admin
 * @author     Madaritech <freelance@madaritech.com>
 */
class Mdt_Wc_Easy_Cf_Piva_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /*
    * A {@link Mdt_Wc_Easy_Cf_Piva_Log_Service} instance.
    *
    * @since 1.0.0
    * @access private
    * @var \Mdt_Wc_Easy_Cf_Piva_Log_Service $log A {@link Mdt_Wc_Easy_Cf_Piva_Log_Service} instance.
    */
    private $log;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->log = Mdt_Wc_Easy_Cf_Piva_Log_Service::create('Mdt_Wc_Easy_Cf_Piva_Admin');
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * The Admin Menu for the plugin.
     *
     * @since 1.0.0
     */
    public function mdt_wc_easy_cf_piva_admin_menu()
    {
        add_menu_page(
            'WooCommerce CF Piva',
            'WC CF PIva',
            'manage_options',
            'mdt-wc-easy-cf-piva',
            array(&$this, 'mdt_wc_easy_cf_piva_settings_page'),
            plugins_url('/images/menu-icon-16x16.jpg', __FILE__)
        );
    }

    /**
     * Create the Settings Page for the admin area.
     *
     * @since    1.0.0
     */
    public function mdt_wc_easy_cf_piva_settings_page()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.', 'mdt_wc_easy_cf_piva'));
        }

        if (isset($_POST['form_submitted'])) {
            $hidden_field = esc_html($_POST['form_submitted']);

            if ($hidden_field == 'Y') {
                $opts = array();
                $opts['checkout_select'] = isset($_POST['checkout_select_label']) ? sanitize_text_field($_POST['checkout_select_label']) : '';
                $opts['checkout_field']  = isset($_POST['checkout_field_label']) ? sanitize_text_field($_POST['checkout_field_label']) : '';
                $opts['profile_field']  = isset($_POST['profile_field_label']) ? sanitize_text_field($_POST['profile_field_label']) : '';
                $opts['order_field']  = isset($_POST['order_field_label']) ? sanitize_text_field($_POST['order_field_label']) : '';
                $opts['order_select']  = isset($_POST['order_select_label']) ? sanitize_text_field($_POST['order_select_label']) : '';
                $opts['settings_field']  = isset($_POST['settings_field_label']) ? sanitize_text_field($_POST['settings_field_label']) : '';
                $opts['settings_select']  = isset($_POST['settings_select_label']) ? sanitize_text_field($_POST['settings_select_label']) : '';

                update_option('mdt_wc_easy_cf_piva_options', serialize($opts));
            }
        }

        $opts = unserialize(get_option('mdt_wc_easy_cf_piva_options'));
            
        require_once('partials/mdt-wc-easy-cf-piva-admin-display.php');
    }

    /**
    * In the users setting page show the fields, but not the values
    *
    * @since    1.0.0
    * @access   public
    * @param    object $fields Billing fields
    * @return   object $fields Billing fields
    **/
    public function mdt_wc_easy_cf_piva_customer_meta_fields($fields)
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Setting customer meta fields [ fields :: " . var_export($fields, true) . " ]...");
        }

        $opts = unserialize(get_option('mdt_wc_easy_cf_piva_options'));

        $fields['billing']['fields']['billing_cfpiva'] = array(
                                                            'label'       => $opts['settings_field'], //__('CF o PIVA', 'mdt_wc_easy_cf_piva'),
                                                            'description' => __('Partita Iva o Codice Fiscale associato', 'mdt_wc_easy_cf_piva')
                                                        );

        $fields['billing']['fields']['billing_ricfatt'] = array(
                                                            'type'        => 'select',
                                                            'label'       => $opts['settings_select'], //__('Tipo Emissione Richiesta', 'mdt_wc_easy_cf_piva'),
                                                            'description' => __('Tipo di ricevuta per il cliente', 'mdt_wc_easy_cf_piva'),
                                                            'options'   => array(
                                                                                    'RICEVUTA' => 'Ricevuta',
                                                                                    'FATTURA' => 'Fattura'
                                                                            )
                                                        );
        
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Set customer meta fields [ fields :: " . var_export($fields, true) . " ]...");
        }
        
        return $fields;
    }

    /**
    * Shows the labels (static and in edit mode) in the WooCommerce order administration section
    *
    * @since    1.0.0
    * @access   public
    * @param    object $fields Billing fields
    * @return   object $fields Billing fields
    **/
    public function mdt_wc_easy_cf_piva_admin_billing_fields($fields)
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Setting labels [ fields :: " . var_export($fields, true) . " ]...");
        }
        
        $opts = unserialize(get_option('mdt_wc_easy_cf_piva_options'));

        $fields['cfpiva'] = array(
            'label' => $opts['order_field'], //__('CF o Partita Iva', 'mdt_wc_easy_cf_piva'),
            'show'  => true
        );

        $fields['ricfatt'] = array(
            'label' => $opts['order_select'], //__('Tipo Emissione Richiesta', 'mdt_wc_easy_cf_piva'),
            'show'  => true
        );

        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Labels set [ fields :: " . var_export($fields, true) . " ]...");
        }

        return $fields;
    }

    /**
     * Chek that tha language i ìs italian for WordPress notice.
     *
     * @since  1.0.0
     * @access public
     */
    public function language_admin_notice()
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Language check...");
        }
        $lang = get_locale();
        
        if ($lang != 'it_IT') :
    ?>
    
    <div class="notice error is-dismissible" >
        <p><?php _e('<strong>WooCommerce CF PIVA</strong> richiede l\'impostazione della lingua italiana per WordPress. ', 'mdt_wc_easy_cf_piva'); ?></p>
    </div>
    
    <?php
        endif;

        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Language checked [ lang :: $lang ]...");
        }
    }
}
