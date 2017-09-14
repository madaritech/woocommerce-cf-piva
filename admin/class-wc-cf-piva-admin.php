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

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wc-cf-piva-admin.css', array(), $this->version, 'all');
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
        $fields['billing']['fields']['billing_cfpiva'] = array(
                                                            'label'       => __('CF o PIVA', 'wc_cf_piva'),
                                                            'description' => 'Partita Iva o Codice Fiscale associato'
                                                        );

        $fields['billing']['fields']['billing_ricfatt'] = array(
                                                            'type'        => 'select',
                                                            'label'       => __('Tipo Emissione Richiesta', 'wc_cf_piva'),
                                                            'description' => 'Tipo di ricevuta per il cliente',
                                                            'options'   => array(
                                                                                    'ricevuta' => 'Ricevuta',
                                                                                    'fattura' => 'Fattura'
                                                                            )
                                                        );

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
        $fields['cfpiva'] = array(
            'label' => __('CF o Partita Iva', 'wc_cf_piva'),
            'show'  => true
        );

        $fields['ricfatt'] = array(
            'label' => __('Tipo Emissione Richiesta', 'wc_cf_piva'),
            'show'  => true
        );

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
        if (get_locale() != 'it_IT') :
    ?>
    
    <div class="notice error is-dismissible" >
        <p><?php _e('<strong>WooCommerce CF PIVA</strong> needs italian language set in WordPress. Set it now! ', 'wc_cf_piva'); ?></p>
    </div>
    
    <?php 
        endif;
    }

    /**
     * Register the JavaScript for the admin area.
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

/*		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-cf-piva-admin.js', array( 'jquery' ), $this->version, false );

    }
*/
}
