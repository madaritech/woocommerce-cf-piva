(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 */

    $('#billing_cfpiva_field').addClass( "validate-required" );
    $('#billing_cfpiva_field').find("label").append( ' <abbr class="required" title="obbligatorio">*</abbr>' );
    if ($('#billing_ricfatt').val() == "ricevuta") 
        $('#billing_cfpiva_field').hide();

    $('#billing_ricfatt').live('change', function() {
                                             if ($('#billing_ricfatt').val() == 'ricevuta') {
                                                 $('#billing_cfpiva_field').fadeOut();
                                             }
                                             else {
                                                 $('#billing_cfpiva_field').fadeIn();
                                             }
                                         });
})( jQuery );
