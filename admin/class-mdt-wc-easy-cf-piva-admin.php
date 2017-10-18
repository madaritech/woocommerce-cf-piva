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
class Mdt_Wc_Easy_Cf_Piva_Admin {


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
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->log = Mdt_Wc_Easy_Cf_Piva_Log_Service::create( 'Mdt_Wc_Easy_Cf_Piva_Admin' );
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * The Admin Menu for the plugin.
	 *
	 * @since 1.0.0
	 */
	public function mdt_wc_easy_cf_piva_admin_menu() {
		add_menu_page(
			'WooCommerce Easy Codice Fiscale Partita Iva',
			'WC Easy CF PIva',
			'manage_options',
			'mdt-wc-easy-cf-piva-top-menu',
			array( &$this, 'mdt_wc_easy_cf_piva_settings_page' ),
			plugins_url( '/images/menu-icon-16x16.jpg', __FILE__ )
		);
	}

	/**
	 * The Admin Setting page Initialization.
	 *
	 * @since 1.0.1
	 */
	public function mdt_wc_easy_cf_piva_settings_init() {
		// Register a new setting for "mdt_wc_easy_cf_piva_settings_page" page.
		register_setting( 'mdt_wc_easy_cf_piva_settings_page', 'mdt_wc_easy_cf_piva_options', 'mdt_wc_easy_cf_piva_options_sanitize_cb' );

		// Register a new section in the "mdt_wc_easy_cf_piva_settings_page" page.
		add_settings_section(
			'mdt_wc_easy_cf_piva_settings_section',
			'<h2><strong>' . __( 'Configura le etichette dei campi che verranno visualizzati', 'mdt_wc_easy_cf_piva' ) . '</strong></h2>',
			array( &$this, 'mdt_wc_easy_cf_piva_settings_section_cb' ),
			'mdt_wc_easy_cf_piva_settings_page'
		);

		// Get the value of the setting we've registered with register_setting().
		$setting = get_option( 'mdt_wc_easy_cf_piva_options' );

		// Compatibility check with version 1.0.0.
		$setting = is_serialized( $setting ) ? unserialize( $setting ) : $setting;

		$placeholder['checkout_select'] = __( 'Ricevuta Fiscale o Fattura', 'mdt_wc_easy_cf_piva' );
		$placeholder['checkout_field']  = __( 'Codice Fiscale o Partita IVA', 'mdt_wc_easy_cf_piva' );
		$placeholder['profile_field']   = __( 'CF o PIVA', 'mdt_wc_easy_cf_piva' );
		$placeholder['order_field']     = __( 'CF o Partita Iva', 'mdt_wc_easy_cf_piva' );
		$placeholder['order_select']    = __( 'Tipo Emissione Richiesta', 'mdt_wc_easy_cf_piva' );
		$placeholder['settings_field']  = __( 'CF o PIVA', 'mdt_wc_easy_cf_piva' );
		$placeholder['settings_select'] = __( 'Tipo Emissione Richiesta', 'mdt_wc_easy_cf_piva' );

		$label['checkout_select'] = __( 'Menù pagina Checkout', 'mdt_wc_easy_cf_piva' );
		$label['checkout_field']  = __( 'Campo pagina Checkout', 'mdt_wc_easy_cf_piva' );
		$label['profile_field']   = __( 'Campo pagina Profilo', 'mdt_wc_easy_cf_piva' );
		$label['order_field']     = __( 'Campo pagina Ordine', 'mdt_wc_easy_cf_piva' );
		$label['order_select']    = __( 'Menù pagina Ordine', 'mdt_wc_easy_cf_piva' );
		$label['settings_field']  = __( 'Campo pagina Utente', 'mdt_wc_easy_cf_piva' );
		$label['settings_select'] = __( 'Menù pagina Utente', 'mdt_wc_easy_cf_piva' );

		$description['checkout_select'] = __( 'Etichetta visualizzata nel front-end, al checkout, per la selezione del tipo di dettaglio di fatturazione desiderato', 'mdt_wc_easy_cf_piva' );
		$description['checkout_field']  = __( 'Etichetta visualizzata nel front-end, al checkout, per l\'inserimento del Codice Fiscale o della Partita Iva', 'mdt_wc_easy_cf_piva' );
		$description['profile_field']   = __( 'Etichetta visualizzata nel front-end,  nella pagina di profilo del cliente', 'mdt_wc_easy_cf_piva' );
		$description['order_field']     = __( 'Etichetta visualizzata nel back-end dell\'ordine per il campo che mostra il Codice Fiscale o la Partita Iva inserita dal cliente', 'mdt_wc_easy_cf_piva' );
		$description['order_select']    = __( 'Etichetta visualizzata nel back-end dell\'ordine per il campo che mostra il tipo di dettaglio di fatturazione richiesto dal cliente', 'mdt_wc_easy_cf_piva' );
		$description['settings_field']  = __( 'Etichetta visualizzata nel back-end nella sezione dei Settings degli utenti WordPress', 'mdt_wc_easy_cf_piva' );
		$description['settings_select'] = __( 'Etichetta visualizzata nel back-end nella sezione dei Settings degli utenti WordPress', 'mdt_wc_easy_cf_piva' );

		foreach ( $placeholder as $setting_key => $plc_value ) {
			$value = isset( $setting[ $setting_key ] ) ? $setting[ $setting_key ] : '';

			// Register a new field in the "mdt_wc_easy_cf_piva_settings_section" section, inside the "mdt_wc_easy_cf_piva_settings_page".
			add_settings_field(
				'mdt_wc_easy_cf_piva_settings_field' . $setting_key,
				$label[ $setting_key ],
				array( &$this, 'mdt_wc_easy_cf_piva_settings_field_cb' ),
				'mdt_wc_easy_cf_piva_settings_page',
				'mdt_wc_easy_cf_piva_settings_section',
				[
					'value' => $value,
					'key' => $setting_key,
					'desc' => $description[ $setting_key ],
					'placeholder' => $plc_value,
				]
			);
		}
	}

	/**
	 * The Admin Setting Sanitizing Callback.
	 *
	 * @param array $options_array The array of options to sanitize.
	 * @since 1.0.1
	 */
	public function mdt_wc_easy_cf_piva_sanitize_cb( $options_array ) {
		$options_array['checkout_select'] = sanitize_text_field( $options_array['checkout_select'] );
		$options_array['checkout_field'] = sanitize_text_field( $options_array['checkout_field'] );
		$options_array['profile_field'] = sanitize_text_field( $options_array['profile_field'] );
		$options_array['order_field'] = sanitize_text_field( $options_array['order_field'] );
		$options_array['order_select'] = sanitize_text_field( $options_array['order_select'] );
		$options_array['settings_field'] = sanitize_text_field( $options_array['settings_field'] );
		$options_array['settings_select'] = sanitize_text_field( $options_array['settings_select'] );

		return $options_array;
	}

	/**
	 * The Admin Setting Section Callback.
	 *
	 * @since 1.0.1
	 */
	public function mdt_wc_easy_cf_piva_settings_section_cb() {
		echo '<p>' . esc_html( __( 'Se si desidera modificare i valori di default delle etichette per ciascun campo, utilizzare i campi qui sotto riportati', 'mdt_wc_easy_cf_piva' ) ) . ':</p>';
	}

	/**
	 * The Admin Setting Field Callback.
	 *
	 * @param array $args Parameters defined in the add_settings_field function call.
	 * @since 1.0.1
	 */
	public function mdt_wc_easy_cf_piva_settings_field_cb( $args ) {
		?>

		<input type="text" name="mdt_wc_easy_cf_piva_options[<?php echo esc_attr( $args['key'] ); ?>]" placeholder="<?php echo esc_attr( $args['placeholder'] ); ?>" value= "<?php echo esc_attr( $args['value'] ); ?>" class="regular-text" /><span class="description"><?php echo esc_attr( $args['desc'] ); ?></span><br></br>

	<?php
	}

	/**
	 * Create the Settings Page for the admin area.
	 *
	 * @since    1.0.1
	 */
	public function mdt_wc_easy_cf_piva_settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html( __( 'You do not have sufficient permissions to access this page.', 'mdt_wc_easy_cf_piva' ) ) );
		}

		require_once( 'partials/mdt-wc-easy-cf-piva-admin-display.php' );
	}

	/**
	 * In the users setting page show the fields, but not the values
	 *
	 * @since    1.0.1
	 * @access   public
	 * @param    object $fields Billing fields.
	 * @return   object $fields Billing fields
	 **/
	public function mdt_wc_easy_cf_piva_customer_meta_fields( $fields ) {

		$this->log->debug( 'Setting customer meta fields [ fields :: ' . var_export( $fields, true ) . ' ]...' );

		// Compatibility check: in old version 1.0.0 need serialization.
		$options = get_option( 'mdt_wc_easy_cf_piva_options' );

		$opts = '';

		if ( ! empty( $options ) && ! is_wp_error( $options ) ) {
			$opts = is_serialized( $options ) ? unserialize( $options ) : $options;
		}

		$fields['billing']['fields']['billing_cfpiva'] = array(
			'label'       => $opts['settings_field'],
			'description' => __( 'Partita Iva o Codice Fiscale associato', 'mdt_wc_easy_cf_piva' ),
		);

		$fields['billing']['fields']['billing_ricfatt'] = array(
			'type'        => 'select',
			'label'       => $opts['settings_select'],
			'description' => __( 'Tipo di ricevuta per il cliente', 'mdt_wc_easy_cf_piva' ),
			'options'   => array(
				'RICEVUTA' => 'Ricevuta',
				'FATTURA' => 'Fattura',
			),
		);

		$this->log->debug( 'Set customer meta fields [ fields :: ' . var_export( $fields, true ) . ' ]...' );

		return $fields;
	}

	/**
	 * Shows the labels (static and in edit mode) in the WooCommerce order administration section
	 *
	 * @since    1.0.1
	 * @access   public
	 * @param    object $fields Billing fields.
	 * @return   object $fields Billing fields
	 **/
	public function mdt_wc_easy_cf_piva_admin_billing_fields( $fields ) {

		$this->log->debug( 'Setting labels [ fields :: ' . var_export( $fields, true ) . ' ]...' );

		// Compatibility check: in old version 1.0.0 need serialization.
		$options = get_option( 'mdt_wc_easy_cf_piva_options' );
		$opts = is_serialized( $options ) ? unserialize( $options ) : $options;

		$fields['cfpiva'] = array(
			'label' => $opts['order_field'], // __('CF o Partita Iva', 'mdt_wc_easy_cf_piva'),
			'show'  => true,
		);

		$fields['ricfatt'] = array(
			'label' => $opts['order_select'], // __('Tipo Emissione Richiesta', 'mdt_wc_easy_cf_piva'),
			'show'  => true,
		);

		$this->log->debug( 'Labels set [ fields :: ' . var_export( $fields, true ) . ' ]...' );

		return $fields;
	}

	/**
	 * Checks that the language is italian for WordPress notice.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function language_admin_notice() {

		$this->log->debug( 'Language check...' );

		$lang = get_locale();

		if ( 'it_IT' != $lang ) :
	?>

<div class="notice error is-dismissible" >
<p>
<?php
	wp_kses(
		__( '<strong>WooCommerce CF PIVA</strong> richiede l\'impostazione della lingua italiana per WordPress. ', 'mdt_wc_easy_cf_piva' ), array(
			'strong' => array(),
		)
	);
?>
</p>
	</div>

<?php
		endif;

		$this->log->debug( "Language checked [ lang :: $lang ]..." );
	}
}
