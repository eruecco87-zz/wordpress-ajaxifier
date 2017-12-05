<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://oscarviquez.com/wordpress-ajaxifier
 * @since      1.0.0
 *
 * @package    Wordpress_Ajaxifier
 * @subpackage Wordpress_Ajaxifier/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wordpress_Ajaxifier
 * @subpackage Wordpress_Ajaxifier/includes
 * @author     Oscar Viquez <hola@oscarviquez.com>
 */
class Wordpress_Ajaxifier_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wordpress-ajaxifier',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
