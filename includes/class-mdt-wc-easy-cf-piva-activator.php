<?php
/**
 * Fired during plugin activation
 *
 * @link       http://www.madaritech.com
 * @since      1.0.0
 *
 * @package    Mdt_Wc_Easy_Cf_Piva
 * @subpackage Mdt_Wc_Easy_Cf_Piva/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Mdt_Wc_Easy_Cf_Piva
 * @subpackage Mdt_Wc_Easy_Cf_Piva/includes
 * @author     Madaritech <freelance@madaritech.com>
 */
class Mdt_Wc_Easy_Cf_Piva_Activator {


	/**
	 * Activation register.
	 *
	 * On activation, if the plugin options exixts, assign default values.
	 *
	 * @since    1.0.1
	 */
	public static function activate() {
		$opts = get_option( 'mdt_wc_easy_cf_piva_options' );

		if ( ! $opts ) {

			$opts['checkout_select']    = __( 'Ricevuta Fiscale o Fattura', 'mdt_wc_easy_cf_piva' );
			$opts['checkout_field']     = __( 'Codice Fiscale o Partita IVA', 'mdt_wc_easy_cf_piva' );
			$opts['profile_field']      = __( 'CF o PIVA', 'mdt_wc_easy_cf_piva' );
			$opts['order_field']        = __( 'CF o Partita Iva', 'mdt_wc_easy_cf_piva' );
			$opts['order_select']       = __( 'Tipo Emissione Richiesta', 'mdt_wc_easy_cf_piva' );
			$opts['settings_field']     = __( 'CF o PIVA', 'mdt_wc_easy_cf_piva' );
			$opts['settings_select']    = __( 'Tipo Emissione Richiesta', 'mdt_wc_easy_cf_piva' );
			$opts['disable_select']     = '';
			$opts['compulsory_company'] = '';

			add_option( 'mdt_wc_easy_cf_piva_options', $opts );
		}
	}
}
