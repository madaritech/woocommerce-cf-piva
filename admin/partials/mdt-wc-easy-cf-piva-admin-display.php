<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.madaritech.com
 * @since      1.0.0
 *
 * @package    Mdt_Wc_Easy_Cf_Piva
 * @subpackage Mdt_Wc_Easy_Cf_Piva/admin/partials
 */

?>

<br>
<table>
	<tr>
		<td>
			<img src="<?php echo esc_url( plugins_url( '../images/icon-128x128.jpg', __FILE__ ) ); ?>" alt="WooCommerce Easy Codice Fiscale Partita Iva" height="120px">
		</td>
		<td>
			<div style="font-size: 30px; font-weight: bold; margin-bottom: 10px; color: black;">&nbsp;<?php echo esc_html( get_admin_page_title() ); ?></div>
			<div style="font-size: 14px; font-weight: bold;">&nbsp;&nbsp;by <a href="http://www.madaritech.com" target="_blank">Madaritech</a></div>
		</td>
	</tr>
</table>

<?php
// WordPress will add the "settings-updated" $_GET parameter to the url.
if ( isset( $_GET['settings-updated'] ) ) {
	// Add settings saved message with the class of "updated".
	add_settings_error( 'mdt_wc_easy_cf_piva_settings_messages', 'mdt_wc_easy_cf_piva_settings_message', __( 'Impostazioni salvate', 'mdt_wc_easy_cf_piva' ), 'updated' );
}

// Show error/update messages.
settings_errors( 'mdt_wc_easy_cf_piva_settings_messages' );
?>

<div class="wrap">
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<!-- main content -->
			<div id="post-body-content">
				<div class="meta-box-sortables ui-sortable">
					<form action="options.php" method="post">
						<div class="postbox">
							<div class="inside">
<?php
// Output security fields for the registered setting "mdt_wc_easy_cf_piva_settings_page".
settings_fields( 'mdt_wc_easy_cf_piva_settings_page' );

// Output setting sections and their fields.
do_settings_sections( 'mdt_wc_easy_cf_piva_settings_page' );

// Output save settings button.
submit_button( 'Salva le modifiche' );
?>

							</div>
							<!-- .inside -->
						</div>
						<!-- .postbox -->                        
					</form>
				</div>
				<!-- .meta-box-sortables .ui-sortable -->
			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<div class="postbox">
						<h2 class="hndle">
							<span>

<?php esc_attr_e( 'Take it Easy!', 'mdt_wc_easy_cf_piva' ); ?>

								</span>
						</h2>

						<div class="inside">
							<ol>
								<li>
									<p>

<?php esc_attr_e( 'Un menu a tendina permette al cliente di specificare il tipo di fatturazione: Ricevuta Fiscale o Fattura', 'mdt_wc_easy_cf_piva' ); ?>

										</p>
								</li>
								<li>
									<p>

<?php esc_attr_e( 'Nel caso il cliente selezioni la fattura, al checkout viene aggiunto un campo obbligatorio nel quale il cliente può specificare la Partita Iva o il Codice Fiscale', 'mdt_wc_easy_cf_piva' ); ?>

										</p>
								</li>
								<li>
									<p>

<?php esc_attr_e( 'Nel caso il cliente selezioni la fattura, nell\'ordine viene specificata la scelta operata e il valore del Codice Fiscale e/o della Partita Iva', 'mdt_wc_easy_cf_piva' ); ?>

									</p>
								</li>
								<li>
									<p>

<?php esc_attr_e( 'Il menù a tendina può essere opzionalmente disabilitato nelle impostazioni del plugin: in tal caso il campo nel quale il cliente può specificare la Partita Iva o il Codice Fiscale viene sempre mostrato e la sua compilazione è obbligatoria per la riuscita dell\'ordine', 'mdt_wc_easy_cf_piva' ); ?>

									</p>
								</li>
							</ol>
						</div>
						<!-- .inside -->
					</div>
					<!-- .postbox -->

					<div class="postbox">

						<h2 class="hndle"><span>

<?php esc_attr_e( 'Vuoi contribuire?', 'mdt_wc_easy_cf_piva' ); ?>

						</span></h2>

						<div class="inside">
							<p>

<?php esc_attr_e( 'Questo plugin è completamente gratuito. Aiutami a migliorarlo con versioni sempre più aggiornate e ad implementare nuove funzionalità. Puoi contribuire con una recensione e\o una donazione. Per domande o suggerimenti puoi lasciare un messaggio nella seguente form: ', 'mdt_wc_easy_cf_piva' ); ?>

							<a href="http://www.madaritech.com/#menu-contact" target="_blank">Madaritech contact form</a></p>

							<div align="center">
								<p>
									<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										<input type="hidden" name="cmd" value="_s-xclick">
										<input type="hidden" name="hosted_button_id" value="9TZGG6437EUX6">
										<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
										<img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
									</form>
								</p>
							</div>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables -->

			</div>
			<!-- #postbox-container-1 .postbox-container -->
			<!-- sidebar -->

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->
		<br class="clear">
	</div>
	<!-- #poststuff -->
</div>
