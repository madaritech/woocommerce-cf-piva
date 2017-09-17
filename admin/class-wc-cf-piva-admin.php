<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.madaritech.com
 * @since      1.0.0
 *
 * @package    Wc_Cf_Piva
 * @subpackage Wc_Cf_Piva/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Cf_Piva
 * @subpackage Wc_Cf_Piva/admin
 * @author     Madaritech <freelance@madaritech.com>
 */
class Wc_Cf_Piva_Admin
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
    * A {@link Wc_Cf_Piva_Log_Service} instance.
    *
    * @since 1.0.0
    * @access private
    * @var \Wc_Cf_Piva_Log_Service $log A {@link Wc_Cf_Piva_Log_Service} instance.
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
        $this->log = Wc_Cf_Piva_Log_Service::create('Wc_Cf_Piva_Admin');
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * The Admin Menu for the plugin.
     *
     * @since 1.0.0
     */
    public function wc_cf_piva_admin_menu()
    {
        add_menu_page(
            'WooCommerce CF Piva',
            'WC CF PIva',
            'manage_options',
            'wc-cf-piva',
            array(&$this, 'wc_cf_piva_settings_page'),
            plugins_url('/images/menu-icon-16x16.jpg', __FILE__)
        );
    }

    /**
     * Create the Settings Page for the admin area.
     *
     * @since    1.0.0
     */
    public function wc_cf_piva_settings_page()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.', 'wc_cf_piva'));
        }

        if (isset($_POST['form_submitted'])) {
            $hidden_field = esc_html($_POST['form_submitted']);

            if ($hidden_field == 'Y') {
                update_option('wc_cf_piva_options', '');
            }
        }

        $synchro_mailchimp_options = get_option('wc_cf_piva_options');
            
        require_once('partials/wc-cf-piva-admin-display.php');
    }

    /**
    * In the users setting page show the fields, but not the values
    *
    * @since    1.0.0
    * @access   public
    * @param    object $fields Billing fields
    * @return   object $fields Billing fields
    **/
    public function wc_cf_piva_customer_meta_fields($fields)
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Setting customer meta fields [ fields :: " . var_export($fields, true) . " ]...");
        }

        $fields['billing']['fields']['billing_cfpiva'] = array(
                                                            'label'       => __('CF o PIVA', 'wc_cf_piva'),
                                                            'description' => 'Partita Iva o Codice Fiscale associato'
                                                        );

        $fields['billing']['fields']['billing_ricfatt'] = array(
                                                            'type'        => 'select',
                                                            'label'       => __('Tipo Emissione Richiesta', 'wc_cf_piva'),
                                                            'description' => 'Tipo di ricevuta per il cliente',
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
    public function wc_cf_piva_admin_billing_fields($fields)
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Setting labels [ fields :: " . var_export($fields, true) . " ]...");
        }
        
        $fields['cfpiva'] = array(
            'label' => __('CF o Partita Iva', 'wc_cf_piva'),
            'show'  => true
        );

        $fields['ricfatt'] = array(
            'label' => __('Tipo Emissione Richiesta', 'wc_cf_piva'),
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
        <p><?php _e('<strong>WooCommerce CF PIVA</strong> needs italian language set in WordPress. Set it now! ', 'wc_cf_piva'); ?></p>
    </div>
    
    <?php
        endif;

        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Language checked [ lang :: $lang ]...");
        }
    }
}
