<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.madaritech.com
 * @since      1.0.0
 *
 * @package    Wc_Cf_Piva
 * @subpackage Wc_Cf_Piva/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wc_Cf_Piva
 * @subpackage Wc_Cf_Piva/includes
 * @author     Madaritech <freelance@madaritech.com>
 */
class Wc_Cf_Piva_Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        if (!get_option('wc_easy_cf_piva_options')) {
            $opts['checkout_select'] = 'Ricevuta Fiscale o Fattura';
            $opts['checkout_field']  = 'Codice Fiscale o Partita IVA';
            $opts['profile_field']  = 'CF o PIVA';
            $opts['order_field']  = 'CF o Partita Iva';
            $opts['order_select']  = 'Tipo Emissione Richiesta';
            $opts['settings_field']  = 'CF o PIVA';
            $opts['settings_select']  = 'Tipo Emissione Richiesta';

            update_option('wc_easy_cf_piva_options', serialize($opts));
        }
    }
}
