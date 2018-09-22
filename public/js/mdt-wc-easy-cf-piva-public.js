(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 */

    // Deleting the word "opzionale"
    $('#billing_cfpiva_field').find("span").remove(".optional");
    $('#billing_company_field').find("span").remove(".optional");

    $('#billing_cfpiva_field').addClass( "validate-required" );
    $('#billing_cfpiva_field').find("label").append( ' <abbr class="required" title="obbligatorio">*</abbr>' );

    var actual_select = ( $('#billing_ricfatt').val() != undefined ) ? $('#billing_ricfatt').val().toUpperCase() : "FATTURA";

    if ( opts.compulsory_company == 'com_com' && 
        ( actual_select == "FATTURA" || opts.disable_select == 'dis_sel_opt' ) ) {
        
        $('#billing_company_field').addClass( 'validate-required' );
        $('#billing_company_field').find('label').append( ' <abbr class="required" title="obbligatorio">*</abbr>' );
    }
    
    if ( opts.disable_select != 'dis_sel_opt' ) {
        if (actual_select == "RICEVUTA") {
            $('#billing_cfpiva_field').hide();
        }

        $('#billing_ricfatt').live('change', function() {
                                                 if ($('#billing_ricfatt').val().toUpperCase() == 'RICEVUTA') {
                                                     $('#billing_cfpiva_field').fadeOut();

                                                    if ( opts.compulsory_company == 'com_com' ) {
                                                        $('#billing_company_field').removeClass( 'validate-required' );
                                                        $('#billing_company_field').find('label > abbr').remove();
                                                    }
                                                 }
                                                 else {
                                                    $('#billing_cfpiva_field').fadeIn();

                                                    if ( opts.compulsory_company == 'com_com' ) {
                                                        $('#billing_company_field').addClass( 'validate-required' );
                                                        $('#billing_company_field').find('label').append( ' <abbr class="required" title="obbligatorio">*</abbr>' );
                                                    }
                                                }
                                             });
    }

    $('#billing_cfpiva').keyup(function(){
        this.value = this.value.toUpperCase();
    });

})( jQuery );
