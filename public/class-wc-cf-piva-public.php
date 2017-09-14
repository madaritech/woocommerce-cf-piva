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

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Adding select e test field for choose cd/piva.
     *
     * @since    1.0.0
     * @access   public
     * @param    array $fields WooCommerce fields
     * @return   array $fields Billing fields
     */
    
    public function wc_cf_piva_billing_fields($fields)
    {
        $fields['billing_ricfatt'] = array(
            'type'      => 'select',
            'label'     => __('Ricevuta Fiscale o Fattura', 'wp_cf_piva'),
            'required'  => false,
            'class'     => array('form-row-wide'),
            'clear'     => true,
            'priority'  => 8,
            'options'   => array(
                'ricevuta' => 'Ricevuta',
                'fattura' => 'Fattura'
            )
        );

        $fields['billing_cfpiva'] = array(
            'label'         => __('Codice Fiscale o Partita IVA', 'wp_cf_piva'),
            'placeholder'   => _x('Codice Fiscale o Partita IVA', 'placeholder', 'wp_cf_piva'),
            'required'      => false,
            'class'         => array('form-row-wide'),
            'clear'         => true,
            'priority'      => 21,
        );

        return $fields;
    }

    /**
     * Adding select e test field for choose cd/piva.
     *
     * @since    1.0.0
     * @access   public
     */
    public function wc_cf_piva_js_show_hide_fields()
    {
        wp_enqueue_script('select_show_hide_cf_piva_field', plugin_dir_url(__FILE__) . 'js/wc-cf-piva-public.js', array( 'jquery' ), $this->version, true);
    }

    /**
    * Creating custom validator for cf/piva field in the address section of the customer account page, or in the checkout page of WooCommerce
    *
    * @since    1.0.0
    * @access   public
    */
    public function wc_cf_piva_fields_validation()
    {
        global $WC_Checkout;
        if (!empty($_POST['billing_ricfatt']) and $_POST['billing_ricfatt'] == 'fattura') {
            if (!$_POST['billing_cfpiva']) {
                wc_add_notice('<strong>'.__('Codice Fiscale o Partita IVA').'</strong> '.__(' è un campo obbligatorio.'), 'error');
            }
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
        if ($_POST['billing_ricfatt']) {
            update_post_meta($order_id, 'billing_ricfatt', sanitize_text_field(esc_attr($_POST['billing_ricfatt'])));
        }
        if ($_POST['billing_cfpiva']) {
            update_post_meta($order_id, 'billing_cfpiva', sanitize_text_field(esc_attr($_POST['billing_cfpiva'])));
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
        if ($user_id && $_POST['billing_ricfatt']) {
            update_user_meta($user_id, 'billing_ricfatt', sanitize_text_field(esc_attr($_POST['billing_ricfatt'])));
        }
        if ($user_id && $_POST['billing_cfpiva']) {
            update_user_meta($user_id, 'billing_cfpiva', sanitize_text_field(esc_attr($_POST['billing_cfpiva'])));
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
        $fields['cfpiva'] = get_post_meta($order->get_id(), '_billing_cfpiva', true);  //$order->billing_vat;
        $fields['ricfatt'] = get_post_meta($order->get_id(), '_billing_ricfatt', true);  //$order->billing_ssn;

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
        if ($type == 'billing') {
            $fields['cfpiva'] = get_user_meta($customer_id, 'billing_cfpiva', true);
            $fields['ricfatt'] = get_user_meta($customer_id, 'billing_ricfatt', true);
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
        global $wp_query;

        if (isset($wp_query->query_vars['edit-address']) && $wp_query->query_vars['edit-address'] != 'fatturazione') {
            /*** Se non siamo in modifica non fare nulla ***/
            return $address;
        }

        //js to show the field on select change
        /*wp_enqueue_script('select_add_cf_piva_field', plugin_dir_url(__FILE__) . 'js/wc-cf-piva-public.js', array( 'jquery' ), $this->version, true);*/

        /*** Per la parte di modifica ***/

        if (! isset($address['billing_cfpiva'])) {
            $address['billing_cfpiva'] = array(
                'label'       => __('CF o PIVA', 'wp_cf_piva'),
                'placeholder' => _x('CF o PIVA', 'placeholder', 'wp_cf_piva'),
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
        $address['{cfpiva}'] = '';
        $address['{ricfatt}'] = '';

        $user = wp_get_current_user();

        if (in_array('customer', (array) $user->roles)) {
            //$address['{ssn}'] = '';
            if (!empty($args['cfpiva']) && !empty($args['ricfatt']) && $args['ricfatt']=='fattura') {
                $address['{cfpiva}'] = __('CF o PIVA', 'wc_cf_piva') . ' ' . $args['cfpiva'];
            }
        }

        /*if ( !empty( $args['ssn'] ) ) {
            $address['{ssn}'] = __( 'SSN', 'your-domain' ) . ' ' . strtoupper( $args['ssn'] );
        }*/

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
    public function wc_cf_piva_localisation_address_format($formats)
    {
        //$formats['IT'] .= "\n\n{vat}\n{ssn}";
        $formats['IT'] .= "\n\n{cfpiva}";

        return $formats;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    /*public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wc_Cf_Piva_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wc_Cf_Piva_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
/*
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-cf-piva-public.css', array(), $this->version, 'all' );

    }
*/
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
/*	public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wc_Cf_Piva_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wc_Cf_Piva_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
/*
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-cf-piva-public.js', array( 'jquery' ), $this->version, false );

    }
*/
}
