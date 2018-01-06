=== Plugin Name ===
WooCommerce Easy Codice Fiscale Partita Iva
Contributors: Madaritech
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9TZGG6437EUX6
Tags: partita, iva, codice, fiscale, woocommerce, easy, italia
Requires at least: 4.8
Tested up to: 4.9.1
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add the "Partita IVA" e "Codice Fiscale" fields in WooCommerce for the italian market.

== Description ==

WC tested up to: 3.2.6
Requires at least: 3.1.2

= Italiano =

Aggiunge i campi Partita Iva e Codice Fiscale in WooCommerce per realizzare un Ecommerce per il mercato italiano. Le diverse etichette nelle varie sezioni (pagina di checkout, ordine, ecc.) possono essere configurate in modo rapido e semplice. Nel dettaglio:

* un menu a tendina permette al cliente di specificare il tipo di fatturazione: Ricevuta Fiscale o Fattura

* nel caso il cliente selezioni la fattura, al checkout viene aggiunto un apposito campo obbligatorio nel quale il cliente può specificare la Partita Iva o il Codice Fiscale

* nel caso il cliente selezioni la fattura, nell'ordine verrà specificata la scelta operata e il valore del Codice Fiscale e/o della Partita Iva 

* nel caso il cliente selezioni la ricevuta, il cliente non è tenuto ad inserire informazioni sul Codice Fiscale o la Partita Iva. L'ordine riporta tale scelta operata dal cliente

* il menu a tendina può essere disabilitato dalla pagina delle impostazioni: in tal caso il tipo di fatturazione è sempre "Fattura", viene aggiunto un apposito campo obbligatorio nel quale il cliente può specificare la Partita Iva o il Codice Fiscale

= English =

Add the "Partita IVA" e "Codice Fiscale" fields in WooCommerce for the italian market. Different labels in the various sections (checkout page, order, etc.) can be configured quickly and easily. In detail:

* a drop-down menu allows the customer to specify the billing type: Receipt Tax or Invoice

* in case the customer selects the invoice, in the checkout a mandatory field is added, in which the customer can specify the VAT or the Tax Code

* in case the customer selects the invoice, the order will specify the choice made and the value of the Tax Code and/or VAT Code

* the drop-down menu can be disabled from the settings page: in this case the type of invoicing is always "Invoice", a mandatory field is added in which the customer can specify the VAT number or the Tax Code

== Installation ==

This section describes how to install the plugin and get it working.

1. This plugin needs italian language set in WordPress; so set the italian language on Settings > General > Language.
1. Upload the plugin files to the `/wp-content/plugins/madaritech-woocommerce-easy-codice-fiscale-partita-iva` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress.
1. Use the link "WC Easy CF PIva" on the admin menu to enter in the plugin setting page.
1. In the plugin settings page you will see a list of labels that you can configure. Edit your preferences and save.

== Frequently Asked Questions ==



== Screenshots ==

1. Nella pagina delle impostazioni del plugin è possibile configurare le varie etichette e/o disabilitare la il menu a tendina.

2. Al checkout un menu a tendina permette di scegliere il tipo di fatturazione che si preferisce.

3. Se al checkout si seleziona "Fattura", un campo per l'inserimento del Codice Fiscale o della Partita Iva verrà reso disponibile.

4. Al termine dell'acquisto, nel riassunto dell'ordine (front-end), il nuovo campo viene visualizzato all'acquirente.

5. Nella sezione del profilo dell'utente (front-end) la Partita Iva o il Codice Fiscale sono visibili per l'acquirente nell'indirizzo di fatturazione.
 
6. Nella sezione del profilo dell'utente (front-end) la Partita Iva o il Codice Fiscale possono essere editati dall'acquirente nell'indirizzo di fatturazione. Eventuali cambiamenti si riflettono negli ordini futuri, e non in quelli già eseguiti. Questi sono modificabili solo dall'amministratore del sito nel back-end.

7. Nel back-end l'amministratore del sito, nei dettagli dell'ordine, può visualizzare il Codice Fiscale o Partita Iva e il Tipo di Emissione richiesta dal cliente per l'ordine considerato.

8. Nel back-end l'amministratore del sito, nei dettagli dell'ordine, può modificare il Codice Fiscale o Partita Iva e il Tipo di Emissione richiesta dal cliente per l'ordine considerato.

9. Nel back-end l'amministratore del sito, nelle impostazioni dell'utente, può visualizzare il Codice Fiscale o Partita Iva e il Tipo di Emissione impostati dal cliente ed eventualmente modificare tali valori.


== Changelog ==

= 1.1.0 =
* Added checkbox to disable the drop-down menu and always show a mandatory field for the VAT number or the Tax Code

= 1.0.1 =
* Refactored settings page with Settings API and Options API

= 1.0.0 =
* First release

== Upgrade Notice ==

= 1.0.1 =
* Improved security using standard WP function to manage plugin settings
