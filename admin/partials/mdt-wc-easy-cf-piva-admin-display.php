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
            <img src="<?php echo plugins_url('../images/icon-128x128.jpg', __FILE__); ?>" alt="WooCommerce Easy Codice Fiscale Partita Iva" height="120px">
        </td>
        <td>
            <div style="font-size: 30px; font-weight: bold; margin-bottom: 10px; color: black;">&nbsp;<?php esc_attr_e('WooCommerce Easy Codice Fiscale Partita Iva', 'mdt_wc_easy_cf_piva'); ?></div>
            <div style="font-size: 14px; font-weight: bold;">&nbsp;&nbsp;by <a href="http://www.madaritech.com" target="_blank">Madaritech</a></div>
        </td>
    </tr>
</table>

<h2></h2>

<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h1><?php esc_attr_e('Impostazioni', 'mdt_wc_easy_cf_piva'); ?></h1>

<?php if ($save_settings) : ?>

    <div class="notice notice-success is-dismissible" >
        <p><strong><?php _e('Impostazioni salvate.', 'mdt_wc_easy_cf_piva'); ?></strong></p>
    </div>

<?php endif; ?>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

				    <form method="POST">
                        <input type="hidden" name="form_submitted" value="Y">

						<div class="postbox">

							<h2><span><?php esc_attr_e('Configura le etichette dei campi che verranno visualizzati', 'mdt_wc_easy_cf_piva'); ?></span></h2>

							<div class="inside">
								<p><?php esc_attr_e('Se si desidera modificare i valori di default delle etichette per ciascun campo, utilizzare i campi qui sotto riportati', 'mdt_wc_easy_cf_piva'); ?>:</p>

                                <input type="text" name="checkout_select_label" placeholder="Ricevuta Fiscale o Fattura" value="<?php echo esc_html($opts['checkout_select']); ?>" class="regular-text" /><span class="description"><?php esc_attr_e('Etichetta visualizzata nel front-end, al checkout, per la selezione del tipo di dettaglio di fatturazione desiderato', 'mdt_wc_easy_cf_piva'); ?></span><br><br>
                                
                                <input type="text" name="checkout_field_label" placeholder="Codice Fiscale o Partita IVA" value="<?php echo esc_html($opts['checkout_field']); ?>" class="regular-text" /><span class="description"><?php esc_attr_e('Etichetta visualizzata nel front-end, al checkout, per l\'inserimento del Codice Fiscale o della Partita Iva', 'mdt_wc_easy_cf_piva'); ?></span><br><br>
                                
                                <input type="text" name="profile_field_label" placeholder="CF o PIVA" value="<?php echo esc_html($opts['profile_field']); ?>" class="regular-text" /><span class="description"><?php esc_attr_e('Etichetta visualizzata nel front-end,  nella pagina di profilo del cliente', 'mdt_wc_easy_cf_piva'); ?></span><br><br>

                                <input type="text" name="order_field_label" placeholder="CF o Partita Iva" value="<?php echo esc_html($opts['order_field']); ?>" class="regular-text" /><span class="description"><?php esc_attr_e('Etichetta visualizzata nel back-end dell\'ordine per il campo che mostra il Codice Fiscale o la Partita Iva inserita dal cliente', 'mdt_wc_easy_cf_piva'); ?></span><br><br>
                                
                                <input type="text" name="order_select_label" placeholder="Tipo Emissione Richiesta" value="<?php echo esc_html($opts['order_select']); ?>" class="regular-text" /><span class="description"><?php esc_attr_e('Etichetta visualizzata nel back-end dell\'ordine per il campo che mostra il tipo di dettaglio di fatturazione richiesto dal cliente', 'mdt_wc_easy_cf_piva'); ?></span><br><br>
                                
                                <input type="text" name="settings_field_label" placeholder="CF o PIVA" value="<?php echo esc_html($opts['settings_field']); ?>" class="regular-text" /><span class="description"><?php esc_attr_e('Etichetta visualizzata nel back-end nella sezione dei Settings degli utenti WordPress', 'mdt_wc_easy_cf_piva'); ?></span><br><br>

                                <input type="text" name="settings_select_label" placeholder="Tipo Enmissione Richiesta" value="<?php echo esc_html($opts['settings_select']); ?>" class="regular-text" /><span class="description"><?php esc_attr_e('Etichetta visualizzata nel back-end nella sezione dei Settings degli utenti WordPress', 'mdt_wc_easy_cf_piva'); ?></span><br><br>

                                <?php submit_button($text = null, $type = 'primary', $name = 'submit', $wrap = true, $other_attributes = null);?>
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
                        <h2 class="hndle"><span><?php esc_attr_e('Take it Easy!', 'mdt_wc_easy_cf_piva'); ?></span></h2>

						<div class="inside">
						 
							<ol>
							    <li>
							    	<p><?php esc_attr_e('Un menu a tendina permette al cliente di specificare il tipo di fatturazione: Ricevuta Fiscale o Fattura', 'mdt_wc_easy_cf_piva'); ?></p>
							    </li>
								<li>
                           			<p><?php esc_attr_e('Nel caso il cliente selezioni la fattura, al checkout viene aggiunto un apposito campo obbligatorio nel quale il cliente può specificare la Partita Iva o il Codice Fiscale', 'mdt_wc_easy_cf_piva'); ?></p>
                           		</li>
                           		<li>
                            		<p><?php esc_attr_e('Nel caso il cliente selezioni la fattura, nell\'ordine verrà specificata la scelta operata e il valore del Codice Fiscale e/o della Partita Iva', 'mdt_wc_easy_cf_piva'); ?></p>
                            	</li>
                            </ol>
						</div>
						<!-- .inside -->
					</div>
					<!-- .postbox -->

					<div class="postbox">

						<h2 class="hndle"><span><?php esc_attr_e(
                                    'Vuoi contribuire?',
                                        'mdt_wc_easy_cf_piva'
                                ); ?></span></h2>

						<div class="inside">
						    <p><?php esc_attr_e('Questo plugin è completamente gratuito. Aiutami a migliorarlo con versioni sempre più aggiornate e ad implementare nuove funzionalità. Puoi contribuire con una recensione e\o una donazione. Per domande o suggerimenti puoi lasciare un messaggio nella seguente form: ', 'mdt_wc_easy_cf_piva'); ?><a href="http://www.madaritech.com/#menu-contact" target="_blank">Madaritech contact form</a></p>

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

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div> <!-- .wrap -->