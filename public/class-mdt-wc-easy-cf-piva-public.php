<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.madaritech.com
 * @since      1.0.0
 *
 * @package    Wc_Cf_Piva
 * @subpackage Wc_Cf_Piva/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wc_Cf_Piva
 * @subpackage Wc_Cf_Piva/public
 * @author     Madaritech <freelance@madaritech.com>
 */
class Wc_Cf_Piva_Public
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
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->log = Wc_Cf_Piva_Log_Service::create('Wc_Cf_Piva_Public');
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Adding selects and text fields for choose cd/piva.
     *
     * @since    1.0.0
     * @access   public
     * @param    array $fields WooCommerce fields
     * @return   array $fields Billing cubrid_field_seek(result)
     */
    
    public function wc_cf_piva_billing_fields($fields)
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Adding select and text fields [ fields :: " . var_export($fields, true) . " ]...");
        }

        $opts = unserialize(get_option('wc_easy_cf_piva_options'));

        $fields['billing_ricfatt'] = array(
            'type'      => 'select',
            'label'     => $opts['checkout_select'],
            'required'  => false,
            'class'     => array('form-row-wide'),
            'clear'     => true,
            'priority'  => 8,
            'options'   => array(
                'RICEVUTA' => 'Ricevuta',
                'FATTURA' => 'Fattura'
            )
        );

        $fields['billing_cfpiva'] = array(
            'label'         => $opts['checkout_field'],
            'placeholder'   => $opts['checkout_field'], //_x('Codice Fiscale o Partita IVA', 'placeholder', 'wp_cf_piva'),
            'required'      => false,
            'class'         => array('form-row-wide'),
            'clear'         => true,
            'priority'      => 21,
        );

        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Select and text fields added [ fields :: " . var_export($fields, true) . " ]...");
        }

        return $fields;
    }

    /**
     * Enqueue js for show/hide CF PIVA field.
     *
     * @since    1.0.0
     * @access   public
     */
    public function wc_cf_piva_js_show_hide_fields()
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Enqueueing js for show/hide CF PIVA field...");
        }

        wp_enqueue_script('select_show_hide_cf_piva_field', plugin_dir_url(__FILE__) . 'js/wc-cf-piva-public.js', array( 'jquery' ), $this->version, true);

        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Enqueued js for show/hide CF PIVA field...");
        }
    }

    /**
    * Creating custom validator for cf/piva field in the address section of the customer account page, or in the checkout page of WooCommerce
    *
    * @since    1.0.0
    * @access   public
    */
    public function wc_cf_piva_fields_validation()
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Validating CF PIVA field...");
        }

        global $WC_Checkout;

        $message = '';

        if (!empty($_POST['billing_ricfatt']) and $_POST['billing_ricfatt'] == 'FATTURA') {
            if (isset($_POST['billing_cfpiva']) && !empty($_POST['billing_cfpiva'])) {
                $cfpiva = sanitize_text_field(esc_attr($_POST['billing_cfpiva']));
                
                switch (strlen($cfpiva)) {
                    case 16:
                        $codice_fiscale = new Wc_Cf_Piva_Codice_Fiscale($cfpiva);
                        $codice_fiscale_ok = $codice_fiscale->verify();
                        if (!$codice_fiscale_ok) {
                            $message = __(' ha un formato non valido.', 'wc_cf_piva');
                        }
                        break;
                    case 11:
                        $partita_iva = new Wc_Cf_Piva_Partita_Iva($cfpiva);
                        $partita_iva_ok = $partita_iva->verify();
                        if (!$partita_iva_ok) {
                            $message = __(' ha un formato non valido.', 'wc_cf_piva');
                        }
                        break;
                    default:
                        $message = __(' ha un formato non valido.', 'wc_cf_piva');
                        break;
                }
            } else {
                $message = __(' è un campo obbligatorio.', 'wc_cf_piva');
            }

            if (!empty($message)) {
                wc_add_notice('<strong>'.__('Codice Fiscale o Partita IVA').'</strong> '.$message, 'error');
            }
        }

        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Validated CF PIVA field...");
        }
    }

    /**
    * Update the order meta with cf/piva field value
    *
    * @since    1.0.0
    * @access   public
    * @param    int $order_id
    */
    public function wc_cf_piva_checkout_field_update_order_meta($order_id)
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Update order meta with CF PIVA and type fields value [ order_id :: $order_id ]...");
        }

        $ricfatt = '';
        $cfpiva = '';

        if (isset($_POST['billing_ricfatt'])) {
            $ricfatt = sanitize_text_field(esc_attr($_POST['billing_ricfatt']));
            update_post_meta($order_id, 'billing_ricfatt', $ricfatt);
        }
        if (isset($_POST['billing_cfpiva'])) {
            $cfpiva = sanitize_text_field(esc_attr($_POST['billing_cfpiva']));
            update_post_meta($order_id, 'billing_cfpiva', $cfpiva);
        }

        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Order meta updated with CF PIVA field value [ ricfatt :: $ricfatt ][ cfpiva :: $cfpiva ]...");
        }
    }

    /**
    * Update the user meta with cf/piva field value
    *
    * @since    1.0.0
    * @access   public
    * @param    int $user_id
    **/
    public function wc_cf_piva_checkout_field_update_user_meta($user_id)
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Update user meta with CF PIVA and type fields value [ user_id :: $user_id ]...");
        }

        $ricfatt = '';
        $cfpiva = '';

        if ($user_id && isset($_POST['billing_ricfatt'])) {
            $ricfatt =sanitize_text_field(esc_attr($_POST['billing_ricfatt']));
            update_user_meta($user_id, 'billing_ricfatt', $ricfatt);
        }
        if ($user_id && isset($_POST['billing_cfpiva'])) {
            $cfpiva = sanitize_text_field(esc_attr($_POST['billing_cfpiva']));
            update_user_meta($user_id, 'billing_cfpiva', $cfpiva);
        }

        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("User meta updated with CF PIVA and type fields value [ ricfatt :: $ricfatt ][ cfpiva :: $cfpiva ]...");
        }
    }

    /**
    * WooCommerce profile page (client authenticated, order section) match the info of the admin order page section
    *
    * @since    1.0.0
    * @access   public
    * @param    object $fields Billing fields
    * @param    object $order Order referenced
    * @return   object $fields Billing fields
    **/
    public function wc_cf_piva_formatted_billing_address($fields, $order)
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Updating CF PIVA and type fields value from order [ fields :: " . var_export($fields, true) . " ][ order :: " . var_export($order, true) . " ]...");
        }
        
        $fields['cfpiva'] = get_post_meta($order->get_id(), '_billing_cfpiva', true);
        $fields['ricfatt'] = get_post_meta($order->get_id(), '_billing_ricfatt', true);

        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Updated CF PIVA and type fields value from order [ cfpiva :: ".$fields['cfpiva']." ][ ricfatt :: ".$fields['ricfatt']." ]...");
        }

        return $fields;
    }

    /**
    * WooCommerce profile page (client authenticated, address section) get user page value. These values then are used in args array in custom_formatted_address_replacements
    *
    * @since    1.0.0
    * @access   public
    * @param    object $fields Billing fields
    * @param    int    $customer_id Order referenced
    * @param    string $type Type of fields (billing or shipping)
    * @return   object $fields Billing fields
    **/
    public function wc_cf_piva_my_account_my_address_formatted_address($fields, $customer_id, $type)
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Updating CF PIVA and type fields value from user meta [ fields :: " . var_export($fields, true) . " ][ customer_id ::  $customer_id ][ type ::  $type ]...");
        }

        if ($type == 'billing') {
            $fields['cfpiva'] = get_user_meta($customer_id, 'billing_cfpiva', true);
            $fields['ricfatt'] = get_user_meta($customer_id, 'billing_ricfatt', true);
        }

        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Updated CF PIVA and type fields value from user meta [ fields :: " . var_export($fields, true) . " ]...");
        }

        return $fields;
    }

    /**
    * WooCommerce profile page (client authenticated, editing address section) get user page value. Shows fields on the update form with the same values as in the user page
    *
    * @since    1.0.0
    * @access   public
    * @param    object $fields Billing fields
    * @param    int    $customer_id Order referenced
    * @param    string $type Type of fields (billing or shipping)
    * @return   object $fields Billing fields
    **/
    public function wc_cf_piva_address_to_edit($address)
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Updating CF PIVA and type address fields value from user meta [ address :: " . var_export($address, true) . " ]...");
        }

        global $wp_query;

        if (isset($wp_query->query_vars['edit-address']) && $wp_query->query_vars['edit-address'] != 'fatturazione') {
            /*** Se non siamo in modifica non fare nulla ***/
            return $address;
        }

        $opts = unserialize(get_option('wc_easy_cf_piva_options'));

        /*** Per la parte di modifica ***/
        if (! isset($address['billing_cfpiva'])) {
            $address['billing_cfpiva'] = array(
                'label'       => $opts['profile_field'],
                'placeholder' => $opts['profile_field'], //_x('CF o PIVA', 'placeholder', 'wp_cf_piva'),
                'required'    => true, //change to false if you do not need this field to be required
                'class'       => array( 'form-row-first' ),
                'value'       => get_user_meta(get_current_user_id(), 'billing_cfpiva', true)
            );
        }

        if (! isset($address['billing_ricfatt'])) {
            $address['billing_ricfatt'] = array(
                'type'        => 'select',
                'label'       => __('Tipo Emissione', 'wp_cf_piva'),
                'placeholder' => _x('Tipo Emissione', 'placeholder', 'wp_cf_piva'),
                'required'    => true, //change to false if you do not need this field to be required
                'class'       => array( 'form-row-first' ),
                'value'       => get_user_meta(get_current_user_id(), 'billing_ricfatt', true)
            );
        }

        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Updated CF PIVA and type address fields value from user meta [ address['billing_cfpiva'] :: ".var_export($address['billing_cfpiva'], true)." ][ address['billing_ricfatt'] :: ".var_export($address['billing_ricfatt'], true)." ]...");
        }

        return $address;
    }

    /**
    * WooCommerce profile page, address static section
    *
    * @since    1.0.0
    * @access   public
    * @param    object $fields Billing fields
    * @param    int    $customer_id Order referenced
    * @param    string $type Type of fields (billing or shipping)
    * @return   object $fields Billing fields
    **/
    public function wc_cf_piva_formatted_address_replacements($address, $args)
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Updating CF PIVA and type address fields value in WooCommerce profile page [ address :: " . var_export($address, true) . " ][ args :: " . var_export($args, true) . " ]...");
        }

        $opts = unserialize(get_option('wc_easy_cf_piva_options'));

        $address['{cfpiva}'] = '';
        $address['{ricfatt}'] = '';

        $user = wp_get_current_user();

        if (in_array('customer', (array) $user->roles)) {
            //$address['{ssn}'] = '';
            if (!empty($args['cfpiva']) && !empty($args['ricfatt']) && $args['ricfatt']=='FATTURA') {
                $address['{cfpiva}'] = $opts['profile_field'] . ' ' . $args['cfpiva'];
            }
        }

        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Updated CF PIVA and type address fields value in WooCommerce profile page [ address :: " . var_export($address, true) . " ]...");
        }

        return $address;
    }
    
    /**
    * Maps the keys in the address section of WooCommerce user profile, based on the country code
    *
    * @since    1.0.0
    * @access   public
    * @param    object $formats
    * @return   object $formats
    **/
    public function wc_cf_piva_localization_address_format($formats)
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Mapping the keys in the address section of WooCommerce user profile, based on the country code [ formats :: " . var_export($formats, true) . " ]...");
        }

        //$formats['IT'] .= "\n\n{vat}\n{ssn}";
        $formats['IT'] .= "\n\n{cfpiva}";

        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Key mapped [ formats['IT'] :: formats['IT'] ]...");
        }

        return $formats;
    }
}
