<?php

/**
 * Codice Fiscale Features
 *
 * @link       http://www.madaritech.com
 * @since      1.0.0
 *
 * @package    Mdt_Wc_Easy_Cf_Piva
 * @subpackage Mdt_Wc_Easy_Cf_Piva/includes
 */

/**
 * Codice Fiscale Features.
 *
 * This class defines all code necessary to manage Partita Iva values.
 *
 * @since      1.0.0
 * @package    Mdt_Wc_Easy_Cf_Piva
 * @subpackage Mdt_Wc_Easy_Cf_Piva/includes
 * @author     Madaritech <freelance@madaritech.com>
 */
class Mdt_Wc_Easy_Cf_Piva_Codice_Fiscale
{

    /*
    * A {@link Mdt_Wc_Easy_Cf_Piva_Log_Service} instance.
    *
    * @since 1.0.0
    * @access private
    * @var \Mdt_Wc_Easy_Cf_Piva_Log_Service $log A {@link Mdt_Wc_Easy_Cf_Piva_Log_Service} instance.
    */
    private $log;

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Mdt_Wc_Easy_Cf_Piva_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    private $codice_fiscale;

    /**
     * Core functionalities.
     *
     * Set the partita iva to work on.
     *
     * @since    1.0.0
     */
    public function __construct($cf)
    {
        $this->log = Mdt_Wc_Easy_Cf_Piva_Log_Service::create('Mdt_Wc_Easy_Cf_Piva_Codice_Fiscale');
        $this->codice_fiscale = $cf;
    }

    /**
     * Execute check to verify that Codice Fiscale is valid.
     *
     * @since    1.0.0
     * @access   public
     */
    public function verify()
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Verifing Codice Fiscale [ codice_fiscale :: $this->codice_fiscale ]...");
        }

        if (!empty($this->codice_fiscale) && strlen($this->codice_fiscale) == 16) {
            return ctype_alnum($this->codice_fiscale);
        }
    }
}
