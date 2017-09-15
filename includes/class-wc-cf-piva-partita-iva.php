<?php

/**
 * Partiva Iva Features
 *
 * @link       http://www.madaritech.com
 * @since      1.0.0
 *
 * @package    Wc_Cf_Piva
 * @subpackage Wc_Cf_Piva/includes
 */

/**
 * Partiva Iva Features.
 *
 * This class defines all code necessary to manage Partita Iva values.
 *
 * @since      1.0.0
 * @package    Wc_Cf_Piva
 * @subpackage Wc_Cf_Piva/includes
 * @author     Madaritech <freelance@madaritech.com>
 */
class Wc_Cf_Piva_Partita_Iva
{

    /*
    * A {@link Wc_Cf_Piva_Log_Service} instance.
    *
    * @since 1.0.0
    * @access private
    * @var \Wc_Cf_Piva_Log_Service $log A {@link Wc_Cf_Piva_Log_Service} instance.
    */
    private $log;

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Wc_Cf_Piva_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    private $partita_iva;

    /**
     * Core functionalities.
     *
     * Set the partita iva to work on.
     *
     * @since    1.0.0
     */
    public function __construct($piva)
    {
        $this->log = Wc_Cf_Piva_Log_Service::create('Wc_Cf_Piva_Partita_Iva');
        $this->partita_iva = $piva;
    }

    /**
     * Execute check to verify that Partita Iva is valid.
     *
     * @since    1.0.0
     * @access   public
     */
    public function verify()
    {
        if (Wc_cf_Piva_Log_Service::is_enabled()) {
            $this->log->debug("Verifing Partita Iva [ partita iva :: $this->partita_iva ]...");
        }

        if (!empty($this->partita_iva) && strlen($this->partita_iva) == 11) {
            return is_numeric($this->partita_iva);
        }
    }
}
