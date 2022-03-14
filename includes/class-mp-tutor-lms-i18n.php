<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://brandmarketers.id
 * @since      1.0.0
 *
 * @package    Mp_Tutor_Lms
 * @subpackage Mp_Tutor_Lms/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mp_Tutor_Lms
 * @subpackage Mp_Tutor_Lms/includes
 * @author     brandmarketers.id <wildan@brandmarketers.id>
 */
class Mp_Tutor_Lms_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mp-tutor-lms',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
