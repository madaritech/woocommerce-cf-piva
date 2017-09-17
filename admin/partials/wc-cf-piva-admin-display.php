<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.madaritech.com
 * @since      1.0.0
 *
 * @package    Wc_Cf_Piva
 * @subpackage Wc_Cf_Piva/admin/partials
 */
?>

<br>
<table>
    <tr>
        <td>
            <img src="<?php echo plugins_url('../images/logo_synchro_mailchimp.png', __FILE__); ?>" alt="WooCommerce Easy Codice Fiscale Partita Iva" height="120px">
        </td>
        <td>
            <div style="font-size: 30px; font-weight: bold; margin-bottom: 10px; color: black;">&nbsp;<?php esc_attr_e('WooCommerce Easy Codice Fiscale Partita Iva', 'wc_cf_piva'); ?></div>
            <div style="font-size: 14px; font-weight: bold;">&nbsp;&nbsp;by <a href="http://www.madaritech.com" target="_blank">Madaritech</a></div>
        </td>
    </tr>
</table>

<h2></h2>

<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h1><?php esc_attr_e('Impostazioni', 'wc_cf_piva'); ?></h1>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

				    <form method="POST">
                        <input type="hidden" name="form_submitted" value="Y">

						<div class="postbox">

							<h2><span><?php esc_attr_e('Main Content Header', 'WpAdminStyle'); ?></span></h2>

							<div class="inside">
								<p><?php esc_attr_e(
                                        'WordPress started in 2003 with a single bit of code to enhance the typography of everyday writing and with fewer users than you can count on your fingers and toes. Since then it has grown to be the largest self-hosted blogging tool in the world, used on millions of sites and seen by tens of millions of people every day.',
                                        'wc_cf_piva'
                                    ); ?></p>
	                                
	                                <input type="text" value="Ricevuta Fiscale o Fattura" class="regular-text" /><span class="description"><?php esc_attr_e('Visualizzato nel front-end per la selezione del tipo di dettaglio di fatturazione desiderato', 'wc_cf_piva'); ?></span><br><br>
	                                
	                                <input type="text" value="Codice Fiscale o Partita IVA" class="regular-text" /><span class="description"><?php esc_attr_e('Visualizzato nel front-end per l\'inserimento del Codice Fiscale o della Partita Iva', 'wc_cf_piva'); ?></span><br><br>
	                                
	                                <input type="text" value="CF o Partita Iva:" class="regular-text" /><span class="description"><?php esc_attr_e('Visualizzato nell\'ordine nel back-end per comunicare il Codice Fiscale o la Partita Iva inserita dal cliente', 'wc_cf_piva'); ?></span><br><br>
	                                
	                                <input type="text" value="Tipo Emissione Richiesta:" class="regular-text" /><span class="description"><?php esc_attr_e('Visualizzato nell\'ordine nel back-end per comunicare il tipo di dettaglio di fatturazione richiesto dal cliente', 'wc_cf_piva'); ?></span><br><br>
	                                
	                                <input type="text" value="CF o PIVA" class="regular-text" /><span class="description"><?php esc_attr_e('Nome dal campo per la pagina di modifica dell\'utente di WordPress', 'wc_cf_piva'); ?></span><br><br>
	                                
	                                <input type="text" value="CF o PIVA" class="regular-text" /><span class="description"><?php esc_attr_e('Nome dal campo per la pagina di profilo del cliente sul front-end', 'wc_cf_piva'); ?></span><br><br>
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

						<h2 class="hndle"><span><?php esc_attr_e(
                                    'Want to contribute?',
                                        'wc_cf_piva'
                                ); ?></span></h2>

						<div class="inside">
						    <p><?php esc_attr_e('This plugin is completely free. Help me to improve it and release new updated versions. If you have requests for features or bug fixing leave a message: ', 'wc_cf_piva'); ?><a href="http://www.madaritech.com/#menu-contact" target="_blank">Madaritech contact form</a></p>
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